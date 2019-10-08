<?php
session_start();
$pagemain = 'main_basic';
$pagename = 'basic_user';
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
    <li class="active">ข้อมูลเจ้าหน้าที่</li>
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
                    <h3 class="panel-title">ข้อมูลเจ้าหน้าที่</h3>
                    <ul class="panel-controls">
                        <li style="margin-right: 50px;"><a href="basic_user_manage.php"><button type="button" class="btn btn-info">เพิ่มข้อมูล</button></a></li>
                        <li style="margin-right: 80px;"><a href="#" class="panel-collapse"><button type="button" class="btn btn-warning"><span class="fa fa-angle-down"></span> Hide/Show</button></a></li>
                    </ul>                                
                </div>
                <div class="panel-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>รหัสเจ้าหน้าที่</th>
                                <th>ชื่อ-สกุล</th>
                                <th>ที่อยู่</th>
                                <th>เบอร์โทรศัพท์</th>
                                <th>ตำแหน่ง</th>
                                <th>ชื่อผู้ใช้งาน</th>
                                <th>รหัสผ่าน</th>
                                <th>รูป</th>
                                <th>จัดการข้อมูล</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_basic1 = "select * from authorities order by aut_id asc";
                            $query_basic1 = mysqli_query($connect, $sql_basic1);
                            $num = mysqli_num_rows($query_basic1);
                            if($num > 0){
                            while ($array_basic1 = mysqli_fetch_array($query_basic1)) {
                                ?>
                                <tr>
                                    <td><?= $array_basic1['aut_id'] ?></td>
                                    <td><?= $array_basic1['aut_name'] ?> <?= $array_basic1['aut_lastname'] ?></td>
                                    <td><?= $array_basic1['aut_address'] ?></td>
                                    <td><?= $array_basic1['aut_tel'] ?></td>
                                    <td><?= $array_basic1['aut_position'] ?></td>
                                    <td><?= $array_basic1['aut_username'] ?></td>
                                    <td><?= $array_basic1['aut_password'] ?></td>
                                    <td>
                                        <?php if ($array_basic1['aut_img'] != '') { ?>
                                            <a href="<?= $array_basic1['aut_img'] ?>" target="_blank"><i class="fa fa-file-image-o" aria-hidden="true"></i></a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="basic_user_manage.php?mode=edit&aut_id=<?=$array_basic1['aut_id']?>"><button type="button" class="btn btn-warning">แก้ไข</button></a></li>
                                        <?php if ($array_basic1['aut_id'] != $_SESSION['login_aut_id']) { ?>
                                            <a href="basic_user_save.php?mode=del&aut_id=<?=$array_basic1['aut_id']?>"><button type="button" class="btn btn-danger">ลบ</button></a></li>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php }}else{
                                ?>
                                <tr>
                                    <td colspan="9" style="color: red;"><center><b>ไม่พบข้อมูล</b></center></td>
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