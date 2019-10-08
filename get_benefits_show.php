<?php
session_start();
$pagemain = 'index';
include "connect_db.php";
$ses_userid = $_SESSION['ses_userid'];
if ($ses_userid <> session_id()) {
    echo "<script>alert('กรุณาทำการ Login ก่อนใช้งานระบบ');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=login.php' />";
    exit();
}
if ($array_login['aut_position'] == "ผู้ดูแลระบบ" || $array_login['aut_position'] == "ผู้บริหาร" || $array_login['aut_position'] == "เจ้าหน้าที่") {
    echo "<script>alert('You have no permission to access this page.');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=logout.php' />";
    exit();
}
include 'header.php';

$sql_newid2 = "Select sum(get_condition2) as get_condition2 from get_benefits where mem_id = '" . $array_login3['mem_id'] . "' and YEAR(get_condition1) = YEAR(NOW()) and ben_id = 'BEN-000012'";
$query_newid2 = mysqli_query($connect, $sql_newid2);
$array_newid2 = mysqli_fetch_array($query_newid2);
    $i = $array_newid2['get_condition2'];
?>        
<style>
    .message-box .mb-container {
        /* position: absolute; */
        left: 0px;
        top: 5%;
        background: rgba(0, 0, 0, 0.9);
        padding: 20px;
        width: 100%;
        height: 90%;
    }
</style>
<div class="page-content-wrap">                 
    <div class="row">
        <div class="col-md-12">
            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">                   
                    <h3 class="panel-title">ขอรับสวัสดิการ</h3>
                    <ul class="panel-controls">
                        <?php
                        $memdate = $array_login3['mem_date'];
                        $DateStart = date("d");
                        $MonthStart = date("m");
                        $YearStart = date("Y");
                        $DateEnd = date("d", strtotime($memdate));
                        $MonthEnd = date("m", strtotime($memdate));
                        $YearEnd = date("Y", strtotime($memdate));
                        $Start = mktime(0, 0, 0, $MonthStart, $DateStart, $YearStart);
                        $End = mktime(0, 0, 0, $MonthEnd, $DateEnd, $YearEnd);
                        $DateNum = ceil(($Start - $End) / 86400);
                        if ($DateNum >= 365) {
                            ?>
                            <li style="margin-right: 100px;"><a href="get_benefits.php"><button type="button" class="btn btn-info">ขอรับสวัสดิการใหม่</button></a></li>
                        <?php } ?>
                        <li style="margin-right: 80px;"><a href="#" class="panel-collapse"><button type="button" class="btn btn-warning"><span class="fa fa-angle-down"></span> Hide/Show</button></a></li>
                    </ul>                                
                </div>
                <div class="panel-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <!--<th>รหัสขอรับสวัสดิการ</th>-->
                                <th>วันที่ขอรับสวัสดิการ</th>
                                <th>รหัสสมาชิก</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th>การขอรับสวัสดิการ</th>
                                <th>ผู้อนุมัติ</th>
                                <th>สถานะ</th>
                                <th>ไม่อนุมัติเนื่องจาก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
//                            $mem_get_benefits = 0;
                            $sql_basic1 = "select * from get_benefits d "
                                    . "join member m on m.mem_id = d.mem_id join benefits b on b.ben_id = d.ben_id "
                                    . "left join authorities a on a.aut_id = d.aut_id where m.mem_id = '" . $array_login3['mem_id'] . "' "
                                    . "order by d.get_id desc";
                            $query_basic1 = mysqli_query($connect, $sql_basic1);
                            while ($array_basic1 = mysqli_fetch_array($query_basic1)) {
                                ?>
                                <tr>
                                    <!--<td><?= $array_basic1['get_id'] ?></td>-->
                                    <td><?= changedate($array_basic1['get_date']) ?></td>
                                    <td><?= $array_basic1['mem_id'] ?></td>
                                    <td><?= $array_basic1['mem_name'] ?> <?= $array_basic1['mem_lastname'] ?></td>
                                    <td><?= $array_basic1['ben_category'] ?></td>
                                    <td><?= $array_basic1['aut_name'] ?> <?= $array_basic1['aut_lastname'] ?></td>
                                    <td><?php
                                        if ($array_basic1['get_state'] == 0) {
                                            echo 'รออนุมัติ';
                                        } else if ($array_basic1['get_state'] == 1) { 
                                            echo 'อนุมัติแล้ว';
                                        } else if ($array_basic1['get_state'] == 2) { 
                                            echo 'ไม่อนุมัติ';
                                        }
                                        ?></td>
                                    <td><?= $array_basic1['get_reason'] ?></td>
                                </tr>
                                <?php
//                            $mem_get_benefits += $array_basic1['dep_amount'];
                            }
                            ?>
                        </tbody>
                    </table>
                    <!--<h1 style="color: red;">ยอดเงินฝาก <?= $mem_get_benefits ?> บาท</h1>-->
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->
        </div>
    </div> 
    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-md-12">             
            <b style="color:red;">***เงื่อนไขข้อจำกัดการนอนโรงพยาบาล จะต้องไม่เกิน 20 คืน / 1 ปี</b>
            <h3 style="color:red;">ตอนนี้คุณใช้สิทธิ์ไปแล้ว <?= number_format($i,0)?> คืน</h3>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?> 