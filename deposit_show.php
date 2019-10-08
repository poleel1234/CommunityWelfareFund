<?php
session_start();
$pagename = 'deposit';
include "connect_db.php";
$ses_userid = $_SESSION['ses_userid'];
if ($ses_userid <> session_id()) {
    echo "<script>alert('กรุณาทำการ Login ก่อนใช้งานระบบ');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=login.php' />";
    exit();
}
if ($array_login['aut_position'] != "ผู้ดูแลระบบ" && $array_login['aut_position'] != "ผู้บริหาร" && $array_login['aut_position'] != "เจ้าหน้าที่") {
    echo "<script>alert('You have no permission to access this page.');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=logout.php' />";
    exit();
}
include 'header.php';
?>
<ul class="breadcrumb">
    <li><a href="dashboard.php">Home</a></li>                    
    <li class="active">ฝากเงินกองทุน</li>
</ul>
<div class="page-title">                    
    <h2><i class="fa fa-info-circle"></i> ฝากเงินกองทุน</h2>
</div>
<div class="page-content-wrap">                

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">                   
                    <h3 class="panel-title">ข้อมูลฝากเงินกองทุน</h3>    
                    <ul class="panel-controls">
                        <li style="margin-right: 120px;"><a href="deposit.php"><button type="button" class="btn btn-info">เพิ่มรายการฝากเงินใหม่</button></a></li>
                        <li style="margin-right: 80px;"><a href="#" class="panel-collapse"><button type="button" class="btn btn-warning"><span class="fa fa-angle-down"></span> Hide/Show</button></a></li>
                    </ul>  
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <!--<th>รหัสรับเงินฝาก</th>-->
                                <th>วันที่รับเงินฝาก</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th>ยอดฝากต่อเดือน</th>
                                <th>จำนวนเงินฝาก</th>
                                <th>เจ้าหน้าที่</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_basic1 = "select * from deposit d join member m on m.mem_id = d.mem_id join authorities a on a.aut_id = d.aut_id order by d.dep_id desc";
                            $query_basic1 = mysqli_query($connect, $sql_basic1);
                            while ($array_basic1 = mysqli_fetch_array($query_basic1)) {
                                ?>
                                <tr>
                                    <!--<td><?= $array_basic1['dep_id'] ?></td>-->
                                    <td><?= changedate($array_basic1['dep_date']) ?></td>
                                    <td><?= $array_basic1['mem_name'] ?> <?= $array_basic1['mem_lastname'] ?></td>
                                    <td style="text-align: right;"><?= number_format($array_basic1['dep_amount'],2) ?></td>
                                    <td style="text-align: right;"><?= number_format($array_basic1['dep_amount2'],2) ?></td>
                                    <td><?= $array_basic1['aut_name'] ?> <?= $array_basic1['aut_lastname'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    
</div>     
<!-- PAGE CONTENT WRAPPER -->                                
</div>    
<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->     
<?php
include 'footer.php';
?>