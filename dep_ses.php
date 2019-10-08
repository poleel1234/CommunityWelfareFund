<?php
@session_start();
include "connect_db.php";
if (isset($_GET['alldata']['mem_id'])) {
    $_SESSION['session_mem_id'] = $_GET['alldata']['mem_id'];
} else {
    $_SESSION['session_mem_id'] = $_SESSION['session_mem_id'];
}
if (isset($_GET['alldata']['year'])) {
    $_SESSION['session_year_ses'] = $_GET['alldata']['year'];
} else {
    $_SESSION['session_year_ses'] = $_SESSION['session_year_ses'];
}
$sql_basic2 = "select * from member m join register r on r.reg_id = m.reg_id where m.mem_id = '" . $_SESSION['session_mem_id'] . "'";
$query_basic2 = mysqli_query($connect, $sql_basic2);
$array_basic2 = mysqli_fetch_array($query_basic2);
if ($array_basic2['req_condition'] == '1') {
    $req_condition_output = 'ครั้งละ 1 บาท ส่งเงินทุกวัน ครั้งละ 30 บาท (30วัน) ส่งเงินวันที่ ' . $array_basic2['req_condition_date1'] . ' ของทุกเดือน';
    $dep_amount = 1;
} elseif ($array_basic2['req_condition'] == '2') {
    $req_condition_output = 'ครั้งละ 90 บาท (90 วัน หรือ 3 เดือน) ส่งเงินวันที่ ' . $array_basic2['req_condition_date1'] . ' เดือน ' . $array_basic2['req_condition_month1'] . ' และวันที่ ' . $array_basic2['req_condition_date2'] . ' เดือน ' . $array_basic2['req_condition_month2'] . '';
    $dep_amount = 90;
} elseif ($array_basic2['req_condition'] == '3') {
    $req_condition_output = 'ครั้งละ 180 บาท (180 วัน หรือ 6 เดือน) ส่งเงินวันที่ ' . $array_basic2['req_condition_date1'] . ' เดือน ' . $array_basic2['req_condition_month1'] . ' และวันที่ ' . $array_basic2['req_condition_date2'] . ' เดือน ' . $array_basic2['req_condition_month2'] . '';
    $dep_amount = 180;
} elseif ($array_basic2['req_condition'] == '4') {
    $req_condition_output = 'ครั้งละ 360 บาท (360 วัน หรือ 1 ปี) ส่งเงินวันที่ ' . $array_basic2['req_condition_date1'] . ' เดือน ' . $array_basic2['req_condition_month1'] . ' และวันที่ ' . $array_basic2['req_condition_date2'] . ' เดือน ' . $array_basic2['req_condition_month2'] . '';
    $dep_amount = 360;
}
?>
<div class="form-group">
    <div class="col-md-1"></div>
    <label class="col-md-12 control-label" style="text-align:left;color: red;">เงื่อนไขการฝากเงินที่สมาชิกท่านนี้เลือก : <?php echo $req_condition_output; ?></label>
</div>
<div class="row">

    <div class="col-md-12">
        <?php
        $THAI_MOUTH = array(1 => "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
            "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>สมาชิก</th>
                    <th>เป็นสมาชิกตั้งแต่</th>
                    <?php
                    foreach ($THAI_MOUTH as $m) {
                        ?>
                        <th><?= $m ?></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_mem = "SELECT m.mem_id,m.mem_date,m.mem_name,m.mem_lastname FROM member m LEFT JOIN register r ON r.reg_id = m.reg_id  where m.mem_id = '" . $_SESSION['session_mem_id'] . "' ORDER BY m.mem_date ASC";
                $query_mem = mysqli_query($connect, $sql_mem);
                while ($array_mem = mysqli_fetch_array($query_mem)) {
                    ?>
                    <tr>
                        <td><?= $array_mem['mem_name'] ?> <?= $array_mem['mem_lastname'] ?></td>
                        <td><?= changedate($array_mem['mem_date']); ?></td>
                        <?php
                        $mw = 1;
                        $text = "";
                        $sql_dep = "select MAX(dep_date) as maxx,dep_month as mm,dep_year as yy from deposit where mem_id = '" . $array_mem['mem_id'] . "' and dep_year = " . $_SESSION['session_year_ses'] . " ";
                        $query_dep = mysqli_query($connect, $sql_dep);
                        $array_dep = mysqli_fetch_array($query_dep);
                        foreach ($THAI_MOUTH as $m) {
                            $sql_deposit = "select * from deposit where mem_id = '" . $array_mem['mem_id'] . "' and dep_month = '$m' and dep_year = " . $_SESSION['session_year_ses'] . " ";
                            $query_deposit = mysqli_query($connect, $sql_deposit);
                            $array_deposit = mysqli_fetch_array($query_deposit);
                            $memM2 = $array_deposit['dep_month'];
                            $memY2 = $array_deposit['dep_year'];

                            $timen = strtotime("now");
                            $mnow = date("n", $timen);
                            $ynow = date("Y", $timen);

                            $timen2 = strtotime($array_mem['mem_date']);
                            $mnow2 = date("n", $timen2);
                            $ynow2 = date("Y", $timen2);

                            if ($memM2 == $m && $memY2 == $_SESSION['session_year_ses']) {
                                $text = "<b style='color:white;background-color:green;padding:5px;'>ชำระแล้ว</b>";
                            } else {
                                if ($_SESSION['session_year_ses'] < $ynow) {
                                    if ($_SESSION['session_year_ses'] < $ynow2) {
                                        $text = "";
                                    }else if($_SESSION['session_year_ses'] == $ynow2 && $mw < $mnow2){
                                        $text = "";
                                    }else {
                                        $text = "<b style='color:white;background-color:red;padding:5px;'>ค้างชำระ</b>";
                                    }
                                } else if ($mw < $mnow && $_SESSION['session_year_ses'] <= $ynow) {
                                    if($_SESSION['session_year_ses'] == $ynow2 && $mw < $mnow2){
                                        $text = "";
                                    }else {
                                        $text = "<b style='color:white;background-color:red;padding:5px;'>ค้างชำระ</b>";
                                    }
                                } else if ($_SESSION['session_year_ses'] < $memY2) {
                                    $text = "-";
                                } else {
//                                    $text = $mw."/".$mnow."/".$_SESSION['session_year_ses']."/".$ynow;
                                    $text = "-";
                                }
                            }
                            ?>
                            <th><?= $text ?></th>
                            <?php
                            $mw++;
                        }
                        ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</div>