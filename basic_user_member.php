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
if (isset($_GET['mode']) == "") {
    $mode = 'add';
    $name = 'เพิ่ม';
    $readonly = '';
    $sql_newid = "Select Max(substr(aut_id,-6))+1 as MaxID from authorities";
    $query_newid = mysqli_query($connect, $sql_newid);
    $array_newid = mysqli_fetch_array($query_newid);
    if ($array_newid['MaxID'] == '') {
        $newid = "AUT-000001";
    } else {
        $newid = "AUT-" . sprintf("%06d", $array_newid['MaxID']);
    }
} elseif (isset($_GET['mode']) == "edit") {
    $mode = "edit";
    $name = 'แก้ไข';
    $readonly = 'readonly';
    $sql_edit = "select * from authorities where aut_id='" . $_GET['aut_id'] . "'";
    $query_edit = mysqli_query($connect, $sql_edit);
    $array_edit = mysqli_fetch_array($query_edit);
    $newid = $array_edit['aut_id'];
    $img = "<table width=100% border=0>
		<tr>
                    <td><b>รูปถ่ายเดิม</b></td>
                </tr>
                <tr>
                <td align=center><a href='" . $array_edit['aut_img'] . "' target='_blank'><img src=" . $array_edit['aut_img'] . " width=40% /></a></td>
                </tr>
            </table>";
}
?>
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="dashboard.php">Home</a></li>
    <li><a href="#">ข้อมูลพื้นฐาน</a></li>
    <li><a href="basic_user.php">ข้อมูลเจ้าหน้าที่</a></li>
    <li class="active"><?= $name ?>ข้อมูลเจ้าหน้าที่</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="basic_user_save.php?mode=<?= $mode ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong><?= $name ?></strong> ข้อมูลเจ้าหน้าที่</h3>
                        <ul class="panel-controls">
                            <li style="margin-right: 80px;"><a href="basic_user.php" ><button type="button" class="btn btn-danger"><span class="fa fa-reply"></span> ย้อนกลับ</button></a></li>
                        </ul>
                    </div>
                    <div class="panel-body">                                                                        

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-md-3 control-label">รหัสเจ้าหน้าที่</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-bookmark-o"></span></span>
                                            <input type="text" name="aut_id" value="<?= $newid ?>" readonly="" class="form-control"/>
                                        </div>                                            
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">ชื่อ</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="aut_name" class="form-control" required="" value="<?= $array_edit['aut_name'] ?>"/>
                                        </div>                                            
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">สกุล</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="aut_lastname" class="form-control" required="" value="<?= $array_edit['aut_lastname'] ?>"/>
                                        </div>                                            
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">ที่อยู่</label>
                                    <div class="col-md-9 col-xs-12">                                            
                                        <textarea class="form-control" name="aut_address" rows="5" required=""><?= $array_edit['aut_address'] ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">รูป</label>
                                    <div class="col-md-9">                                                                                                                                        
                                        <input type="file" class="fileinput btn-primary" name="aut_img" title="Browse file"/>
                                    <?php if($array_edit['aut_img'] != ''){ echo $img;} ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-md-3 control-label">เบอร์โทรศัพท์</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="aut_tel" class="form-control" required="" maxlength="10" minlength="9" value="<?= $array_edit['aut_tel'] ?>"/>
                                        </div>                                            
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Username</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="aut_username" class="form-control" required="" <?= $readonly ?> value="<?= $array_edit['aut_username'] ?>"/>
                                        </div>                                            
                                    </div>
                                </div>

                                <div class="form-group">                                        
                                    <label class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                            <input type="password" name="aut_password" class="form-control" required="" value="<?= $array_edit['aut_password'] ?>"/>
                                        </div>            
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">ตำแหน่ง</label>
                                    <div class="col-md-9">                                                                                            
                                        <select class="form-control select" name="aut_position" required="">
                                            <option value="ผู้บริหาร" <?php if ($array_edit['aut_position'] == 'ผู้บริหาร') {
    echo 'selected';
} ?>>ผู้บริหาร</option>
                                            <option value="เจ้าหน้าที่" <?php if ($array_edit['aut_position'] == 'เจ้าหน้าที่') {
    echo 'selected';
} ?>>เจ้าหน้าที่</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-default" type="reset">Clear Form</button>                                    
                        <button class="btn btn-primary pull-right" type="submit">Submit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>                    

</div>
<!-- END PAGE CONTENT WRAPPER -->                                                
</div>            
<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER --> 
<?php
include 'footer.php';
?>




