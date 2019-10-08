<?php
session_start();
$pagename = 'give_money';
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
    <li class="active">บันทึกการมอบเงิน</li>
</ul>
<div class="page-title">                    
    <h2><i class="fa fa-info-circle"></i> บันทึกการมอบเงิน</h2>
</div>
<div class="page-content-wrap">                

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">                   
                    <h3 class="panel-title">ข้อมูลบันทึกการมอบเงิน</h3>    
                    <ul class="panel-controls">
                        <li style="margin-right: 130px;"><a href="give_money.php"><button type="button" class="btn btn-info">เพิ่มบันทึกการมอบเงินใหม่</button></a></li>
                        <li style="margin-right: 80px;"><a href="#" class="panel-collapse"><button type="button" class="btn btn-warning"><span class="fa fa-angle-down"></span> Hide/Show</button></a></li>
                    </ul>  
                </div>
                <div class="panel-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <!--<th>รหัสการมอบเงิน</th>-->
                                <th>รหัสขอรับสวัสดิการ</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th>การขอรับสวัสดิการ</th>
                                <th>วันที่มอบ</th>
                                <th>จำนวนเงินที่มอบ</th>
                                <th>มารับด้วยตนเอง/มอบฉันทะ</th>
                                <th>ชื่อผู้รับเงิน</th>
                                <th>เจ้าหน้าที่</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_basic1 = "select * from give_money m "
                                    . "join get_benefits b on b.get_id = m.get_id "
                                    . "join member me on me.mem_id = b.mem_id "
                                    . "join benefits be on be.ben_id = b.ben_id "
                                    . "join authorities a on a.aut_id = m.aut_id "
                                    . "order by m.give_id desc";
                            $query_basic1 = mysqli_query($connect, $sql_basic1);
                            while ($array_basic1 = mysqli_fetch_array($query_basic1)) {
                                ?>
                                <tr>
                                    <!--<td><?= $array_basic1['give_id'] ?></td>-->
                                    <td><?= $array_basic1['get_id'] ?></td>
                                    <td><?= $array_basic1['mem_name'] ?> <?= $array_basic1['mem_lastname'] ?></td>
                                    <td><?= $array_basic1['ben_category'] ?></td>
                                    <td><?= changedate($array_basic1['give_date']) ?></td>
                                    <td style="text-align: center;"><?=$array_basic1['give_money']?></td>
                                    <td><?= $array_basic1['give_chk'] ?></td>
                                    <td><?php if($array_basic1['give_chk'] == 'มารับด้วยตนเอง'){ echo $array_basic1['mem_name']."  ".$array_basic1['mem_lastname']; }else{ echo $array_basic1['give_name']; } ?></td>
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