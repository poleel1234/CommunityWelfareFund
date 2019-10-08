<?php
session_start();
$pagemain = 'main_basic';
$pagename = 'basic_member';
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
    $sql_newid = "Select Max(substr(mem_id,-6))+1 as MaxID from member";
    $query_newid = mysqli_query($connect, $sql_newid);
    $array_newid = mysqli_fetch_array($query_newid);
    if ($array_newid['MaxID'] == '') {
        $newid = "MEM-000001";
    } else {
        $newid = "MEM-" . sprintf("%06d", $array_newid['MaxID']);
    }
} elseif (isset($_GET['mode']) == "edit") {
    $mode = "edit";
    $name = 'แก้ไข';
    $readonly = 'readonly';
    $sql_edit = "select * from member where mem_id='" . $_GET['mem_id'] . "'";
    $query_edit = mysqli_query($connect, $sql_edit);
    $array_edit = mysqli_fetch_array($query_edit);
    $newid = $array_edit['mem_id'];
    
    $memdate2 = $array_edit['mem_birthday'];
    $YearStart2 = date("Y");
    $YearEnd2 = date("Y", strtotime($memdate2));
    $DateNum2 = $YearStart2 - $YearEnd2;
}
?>
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="dashboard.php">Home</a></li>
    <li><a href="#">ข้อมูลพื้นฐาน</a></li>
    <li><a href="basic_member.php">ข้อมูลสมาชิก</a></li>
    <li class="active"><?= $name ?>ข้อมูลสมาชิก</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="basic_member_save.php?mode=<?= $mode ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong><?= $name ?></strong> ข้อมูลสมาชิก</h3>
                        <ul class="panel-controls">
                            <li style="margin-right: 80px;"><a href="basic_member.php" ><button type="button" class="btn btn-danger"><span class="fa fa-reply"></span> ย้อนกลับ</button></a></li>
                        </ul>
                    </div>
                    <div class="panel-body">                                                                        

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-md-3 control-label">รหัสสมาชิก</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-bookmark-o"></span></span>
                                            <input type="text" name="mem_id" value="<?= $newid ?>" readonly="" class="form-control"/>
                                        </div>                                            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">คำนำหน้า</label>
                                    <div class="col-md-9">                                                                                            
                                        <select class="form-control" name="mem_title" id="mem_title" required="">
                                            <option style="display:none;">NAN</option>
                                            <option value="นาย" <?php
                                            if ($array_edit['mem_title'] == 'นาย') {
                                                echo 'selected';
                                            }
                                            ?>>นาย</option>
                                            <option value="นาง" <?php
                                            if ($array_edit['mem_title'] == 'นาง') {
                                                echo 'selected';
                                            }
                                            ?>>นาง</option>
                                            <option value="นางสาว" <?php
                                            if ($array_edit['mem_title'] == 'นางสาว') {
                                                echo 'selected';
                                            }
                                            ?>>นางสาว</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label">ชื่อ</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="mem_name" class="form-control" required="" value="<?= $array_edit['mem_name'] ?>"/>
                                        </div>                                            
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">สกุล</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="mem_lastname" class="form-control" required="" value="<?= $array_edit['mem_lastname'] ?>"/>
                                        </div>                                            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">อายุ</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="number" name="mem_age" id="reg_age_new" readonly="" class="form-control" value="<?= $DateNum2 ?>"/>
                                        </div>                                            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ที่อยู่</label>
                                    <div class="col-md-9 col-xs-12">                                            
                                        <textarea class="form-control" name="mem_address" rows="5" required=""><?= $array_edit['mem_address'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">                                        
                                    <label class="col-md-3 control-label">เลขบัตร ปชช.</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="mem_card" maxlength="13" minlength="13" class="form-control" value="<?= $array_edit['mem_card'] ?>" required="">                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">วันเดือนปีเกิด</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="date" name="mem_birthday" id="mem_birthday" class="form-control datepicker" required="" value="<?= $array_edit['mem_birthday'] ?>"/>
                                        </div>                                            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">อาชีพ</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="mem_work" class="form-control" required="" value="<?= $array_edit['mem_work'] ?>"/>
                                        </div>                                            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">สถานภาพ</label>
                                    <div class="col-md-9">                                                                                            
                                        <select class="form-control" name="mem_status" id="mem_status" required="">
                                            <option style="display:none;">--</option>
                                            <option value="โสด" <?php
                                            if ($array_edit['mem_status'] == 'โสด') {
                                                echo 'selected';
                                            }
                                            ?>>โสด</option>
                                            <option value="สมรส" <?php
                                            if ($array_edit['mem_status'] == 'สมรส') {
                                                echo 'selected';
                                            }
                                            ?>>สมรส</option>
                                            <option value="หม้าย" <?php
                                            if ($array_edit['mem_status'] == 'หม้าย') {
                                                echo 'selected';
                                            }
                                            ?>>หม้าย</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">สัญชาติ</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="mem_nationality" class="form-control" required="" value="<?= $array_edit['mem_nationality'] ?>"/>
                                        </div>                                            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">เบอร์โทรศัพท์</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="mem_tel" maxlength="10" class="form-control" required="" value="<?= $array_edit['mem_tel'] ?>"/>
                                        </div>                                            
                                    </div>
                                </div>
                                
                                 <div class="form-group">
                                    <label class="col-md-3 control-label">รหัสผ่าน</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="mem_pass" maxlength="10" class="form-control" required="" value="<?= $array_edit['mem_pass'] ?>"/>
                                        </div>                                            
                                    </div>
                                 </div><br><br>
                                
                                </div>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">รูป</label>
                                    <div class="col-md-9">                                                                                                                                        
                                        <input type="file" class="fileinput btn-primary" name="mem_img" title="Browse file"/>
                                    <?php if($array_edit['mem_img'] != ''){ echo $img;} ?>
                                    </div>
                            </div><br><br>

                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-default" type="reset">Clear Form</button>                                    
                            <button class="btn btn-primary pull-right" type="submit">Submit</button>
                        </div>
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
<script>
    $(document).ready(function () {
        $("#mem_birthday").change(function () {
            var d1 = new Date(this.value);
            var d2 = new Date();
            var years = d2.getFullYear() - d1.getFullYear();
            $('#reg_age_new').val(years);
        });
    });
</script>
<?php
include 'footer.php';
?>




