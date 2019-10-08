<?php
@session_start();
include "connect_db.php";
?>
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
                $sql_mem = "SELECT m.mem_id,m.mem_date,m.mem_name,m.mem_lastname FROM member m LEFT JOIN register r ON r.reg_id = m.reg_id ORDER BY m.mem_date ASC";
                $query_mem = mysqli_query($connect, $sql_mem);
                while ($array_mem = mysqli_fetch_array($query_mem)) {
                    ?>
                    <tr>
                        <td><?= $array_mem['mem_name'] ?> <?= $array_mem['mem_lastname'] ?></td>
                        <td><?= changedate($array_mem['mem_date']); ?></td>
                        <?php
                        $mw = 1;
                        $text = "";
                        $sql_dep = "select MAX(dep_date) as maxx,dep_month as mm,dep_year as yy from deposit where mem_id = '" . $array_mem['mem_id'] . "' and dep_year = " . $_GET['year'] . " ";
                        $query_dep = mysqli_query($connect, $sql_dep);
                        $array_dep = mysqli_fetch_array($query_dep);
                        foreach ($THAI_MOUTH as $m) {
                            $sql_deposit = "select * from deposit where mem_id = '" . $array_mem['mem_id'] . "' and dep_month = '$m' and dep_year = " . $_GET['year'] . " ";
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

                            if ($memM2 == $m && $memY2 == $_GET['year']) {
                                $text = "<b style='color:white;background-color:green;padding:5px;'>ชำระแล้ว</b>";
                            } else {
                                if ($_GET['year'] < $ynow) {
                                    if ($_GET['year'] < $ynow2) {
                                        $text = "";
                                    }else if($_GET['year'] == $ynow2 && $mw < $mnow2){
                                        $text = "";
                                    }else {
                                        $text = "<b style='color:white;background-color:red;padding:5px;'>ค้างชำระ</b>";
                                    }
                                } else if ($mw < $mnow && $_GET['year'] <= $ynow) {
                                    if($_GET['year'] == $ynow2 && $mw < $mnow2){
                                        $text = "";
                                    }else {
                                        $text = "<b style='color:white;background-color:red;padding:5px;'>ค้างชำระ</b>";
                                    }
                                } else if ($_GET['year'] < $memY2) {
                                    $text = "-";
                                } else {
//                                    $text = $mw."/".$mnow."/".$_GET['year']."/".$ynow;
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