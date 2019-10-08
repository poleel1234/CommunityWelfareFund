<?php
session_start();
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
                        <td><?= $array_mem['mem_date'] ?></td>
                        <?php
                        $mw = 1;
                        $text = "";
                        $sql_dep = "select MAX(dep_date) as maxx,MONTH(dep_date) as mm,YEAR(dep_date) as yy from deposit where mem_id = '" . $array_mem['mem_id'] . "' and YEAR(dep_date) = " . $_GET['year'] . " ";
                        $query_dep = mysqli_query($connect, $sql_dep);
                        $array_dep = mysqli_fetch_array($query_dep);
                        foreach ($THAI_MOUTH as $m) {
                            $sql_deposit = "select * from deposit where mem_id = '" . $array_mem['mem_id'] . "' and MONTH(dep_date) = $mw and YEAR(dep_date) = " . $_GET['year'] . " ";
                            $query_deposit = mysqli_query($connect, $sql_deposit);
                            $array_deposit = mysqli_fetch_array($query_deposit);
                            $memYM2 = strtotime($array_deposit['dep_date']); //วันฝากเงิน
                            $memM2 = date("n", $memYM2);
                            $memY2 = date("Y", $memYM2);
                            if ($memM2 == $mw && $memY2 == $_GET['year']) {
                                $text = "ชำระแล้ว";
                            } else {
                                if ($mw < $memM2 && $_GET['year'] <= $memY2) {
                                    $text = "ค้างชำระ";
                                } else {
//                                    $text = $mw . "   " . $memM2 . "    " . $_GET['year'] . "    " . $memY2;
                                    $text = "";
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
<?php
include 'footer.php';
?>