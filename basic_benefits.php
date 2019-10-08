<?php
session_start();
$pagemain = 'main_basic';
$pagename = 'basic_benefits';
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
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="dashboard.php">Home</a></li>                    
    <li><a href="#">ข้อมูลพื้นฐาน</a></li>
    <li class="active">ข้อมูลสวัสดิการ</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">                    
    <h2><i class="fa fa-info-circle"></i> ข้อมูลพื้นฐาน</h2>
</div>
<!-- END PAGE TITLE -->                

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">                

    <div class="row">
        <div class="col-md-12">
            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">                   
                    <h3 class="panel-title">ข้อมูลสวัสดิการ</h3>
                    <ul class="panel-controls">
                        <li style="margin-right: 50px;"><a href="basic_benefits_manage.php"><button type="button" class="btn btn-info">เพิ่มข้อมูล</button></a></li>
                        <li style="margin-right: 80px;"><a href="#" class="panel-collapse"><button type="button" class="btn btn-warning"><span class="fa fa-angle-down"></span> Hide/Show</button></a></li>
                    </ul>                                
                </div>
                <div class="panel-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>รหัสสวัสดิการ</th>
                                <th style="width: 30%">ประเภทสวัสดิการ</th>
                                <th>เงื่อนไข</th>
                                <th style="width: 30%">หลักฐานการรับสวัสดิการ</th>
                                <th>จัดการข้อมูล</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_basic1 = "select * from benefits order by ben_id asc";
                            $query_basic1 = mysqli_query($connect, $sql_basic1);
                            $num = mysqli_num_rows($query_basic1);
                            if($num >= 1){
                            while ($array_basic1 = mysqli_fetch_array($query_basic1)) {
                                ?>
                                <tr>
                                    <td><?= $array_basic1['ben_id'] ?></td>
                                    <td><?= $array_basic1['ben_category'] ?></td>
                                    <td><?= $array_basic1['ben_condition'] ?></td>
                                    <td>
                                    <?php
                                    if($array_basic1['ben_document1']==1){
                                        echo "<i class='fa fa-check' aria-hidden='true'></i> สำเนาบัตรประจำตัวประชาชน<br>";
                                    }
                                    if($array_basic1['ben_document2']==1){
                                        echo "<i class='fa fa-check' aria-hidden='true'></i> สำเนาทะเบียนบ้าน<br>";
                                    }
                                    if($array_basic1['ben_document3']==1){
                                        echo "<i class='fa fa-check' aria-hidden='true'></i> สมุดการเป็นสมาชิกกองทุน<br>";
                                    }
                                    if($array_basic1['ben_document4']==1){
                                        echo "<i class='fa fa-check' aria-hidden='true'></i> สำเนาใบแจ้งเกิดลูก<br>";
                                    }
                                    if($array_basic1['ben_document5']==1){
                                        echo "<i class='fa fa-check' aria-hidden='true'></i> สำเนาสูติบัตรลูก<br>";
                                    }
                                    if($array_basic1['ben_document6']==1){
                                        echo "<i class='fa fa-check' aria-hidden='true'></i> ใบรับรองการนอนรักษาตัวในโรงพยาบาล<br>";
                                    }
                                    if($array_basic1['ben_document7']==1){
                                        echo "<i class='fa fa-check' aria-hidden='true'></i> สำเนาใบมรณะบัตร<br>";
                                    }
                                    if($array_basic1['ben_document8']==1){
                                        echo "<i class='fa fa-check' aria-hidden='true'></i> กรณีมอบฉันทะ สำเนาบัตรประจำตัวประชาชน<br>";
                                    }
                                    if($array_basic1['ben_document9']==1){
                                        echo "<i class='fa fa-check' aria-hidden='true'></i> กรณีมอบฉันทะ สำเนาทะเบียนบ้าน<br>";
                                    }
                                    ?>
                                    </td>
                                    <td>
                                        <a href="basic_benefits_manage.php?mode=edit&ben_id=<?=$array_basic1['ben_id']?>"><button type="button" class="btn btn-warning">แก้ไข</button></a></li>
                                        <?php if ($array_basic1['ben_id'] != $_SESSION['login_aut_id']) { ?>
                                            <a href="basic_benefits_save.php?mode=del&ben_id=<?=$array_basic1['ben_id']?>"><button type="button" class="btn btn-danger">ลบ</button></a></li>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php }
                            
                                        }else{
                                ?>
                                <tr>
                                    <td colspan="5" style="color: red;"><center><b>ไม่พบข้อมูล</b></center></td>
                                </tr>
                                <?php
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->
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