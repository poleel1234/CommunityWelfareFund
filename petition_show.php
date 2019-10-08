<?php
session_start();
$pagename = 'petition';
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
                    <h3 class="panel-title">คำร้องขอเอกสารการกู้ยืม</h3>
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
                            <li style="margin-right: 150px;"><a href="petition.php"><button type="button" class="btn btn-info">คำร้องขอเอกสารการกู้ยืมใหม่</button></a></li>
                        <?php } ?>
                        <li style="margin-right: 80px;"><a href="#" class="panel-collapse"><button type="button" class="btn btn-warning"><span class="fa fa-angle-down"></span> Hide/Show</button></a></li>
                    </ul>                                
                </div>
                <div class="panel-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <!--<th>รหัสขอเอกสารการกู้ยืม</th>-->
                                <th>วันที่ขอเอกสารการกู้ยืม</th>
                                <th>รหัสสมาชิก</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th>ประเภท</th>
                                <th>ประเภทขอเอกสารการกู้ยืม</th>
                                <th>ยอดที่กู้</th>
                                <th>วัตถุประสงค์</th>
                                <th>ผู้อนุมัติ</th>
                                <th colspan="2">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
//                            $mem_get_benefits = 0;
                            $sql_basic1 = "select * from petition d "
                                    . "join member m on m.mem_id = d.mem_id join benefits b on b.ben_id = d.ben_id "
                                    . "left join authorities a on a.aut_id = d.aut_id where m.mem_id = '" . $array_login3['mem_id'] . "' "
                                    . "order by d.pet_id desc";
                            $query_basic1 = mysqli_query($connect, $sql_basic1);
                            while ($array_basic1 = mysqli_fetch_array($query_basic1)) {
                                ?>
                                <tr>
                                    <!--<td><?= $array_basic1['pet_id'] ?></td>-->
                                    <td><?= changedate($array_basic1['pet_date']) ?></td>
                                    <td><?= $array_basic1['mem_id'] ?></td>
                                    <td><?= $array_basic1['mem_name'] ?> <?= $array_basic1['mem_lastname'] ?></td>
                                    <td><?= $array_basic1['pet_type'] ?></td>
                                    <td><?= $array_basic1['ben_category'] ?></td>
                                    <td style="text-align: right;"><?= number_format($array_basic1['amount'],2); ?></td>
                                    <td><?= $array_basic1['cause'] ?></td>
                                    <td><?= $array_basic1['aut_name'] ?> <?= $array_basic1['aut_lastname'] ?></td>
                                    <td><?php
                                        if ($array_basic1['aut_id'] == '') {
                                            echo 'รออนุมัติ';
                                        } else {
                                            echo 'อนุมัติแล้ว';
                                        }
                                        ?></td>
                                    <td class="center" style="text-align: center;"><a class="btn btn-info" href="petition_print.php?pet_id=<?= $array_basic1['pet_id'] ?>" target="_blank"><i class="fa fa-file-pdf-o fa-fw" title="พิมพ์"></i>พิมพ์</a></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 
</div>
<?php
include 'footer.php';
?> 