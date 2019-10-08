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
                    <h3 class="panel-title">ประวัติการฝากเงิน</h3>
                    <ul class="panel-controls">
                        <li style="margin-right: 80px;"><a href="#" class="panel-collapse"><button type="button" class="btn btn-warning"><span class="fa fa-angle-down"></span> Hide/Show</button></a></li>
                    </ul>                                
                </div>
                <div class="panel-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>รหัสรับเงินฝาก</th>
                                <th>วันที่รับเงินฝาก</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th>จำนวนเงินฝาก</th>
                                <th>เจ้าหน้าที่</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $mem_deposit = 0;
                            $sql_basic1 = "select * from deposit d join member m on m.mem_id = d.mem_id join authorities a on a.aut_id = d.aut_id where m.mem_id = '" . $array_login3['mem_id'] . "' order by d.dep_id desc";
                            $query_basic1 = mysqli_query($connect, $sql_basic1);
                            while ($array_basic1 = mysqli_fetch_array($query_basic1)) {
                                ?>
                                <tr>
                                    <td><?= $array_basic1['dep_id'] ?></td>
                                    <td><?= changedate($array_basic1['dep_date']) ?></td>
                                    <td><?= $array_basic1['mem_name'] ?> <?= $array_basic1['mem_lastname'] ?></td>
                                    <td style="text-align: right;"><?= number_format($array_basic1['dep_amount'],2) ?></td>
                                    <td><?= $array_basic1['aut_name'] ?> <?= $array_basic1['aut_lastname'] ?></td>
                                </tr>
                            <?php 
                            $mem_deposit += $array_basic1['dep_amount'];
                            }  ?>
                        </tbody>
                    </table>
                    <h1 style="color: red;">ยอดเงินฝาก <?=$mem_deposit?> บาท</h1>
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->
        </div>
    </div> 
</div>
<?php
include 'footer.php';
?> 