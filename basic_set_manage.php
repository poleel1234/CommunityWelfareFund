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
include 'header.php';
    $mode = "edit";
    $name = 'แก้ไข';
    $readonly = 'readonly';
    $sql_edit = "select * from member where mem_id='" .$array_login3['mem_id'] . "'";
    $query_edit = mysqli_query($connect, $sql_edit);
    $array_edit = mysqli_fetch_array($query_edit);
    $newid = $array_edit['mem_id'];
    
    $memdate2 = $array_edit['mem_birthday'];
    $YearStart2 = date("Y");
    $YearEnd2 = date("Y", strtotime($memdate2));
    $DateNum2 = $YearStart2 - $YearEnd2;
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

            <form class="form-horizontal" action="basic_setr_save.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong><?= $name ?></strong> ข้อมูลสมาชิก</h3>
                        <ul class="panel-controls">
                          
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
                                        <select class="form-control" name="mem_title" id="mem_title" required="" disabled="">
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
                                            <input type="text" name="mem_name" class="form-control" required="" value="<?= $array_edit['mem_name'] ?>" readonly=""/>
                                        </div>                                            
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">สกุล</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="mem_lastname" class="form-control" required="" value="<?= $array_edit['mem_lastname'] ?>" readonly=""/>
                                        </div>                                            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">อายุ</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="number" name="mem_age" id="reg_age_new" readonly="" class="form-control" value="<?= $DateNum2 ?>" readonly=""/>
                                        </div>                                            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ที่อยู่</label>
                                    <div class="col-md-9 col-xs-12">                                            
                                        <textarea class="form-control" name="mem_address" rows="5" required="" readonly=""><?= $array_edit['mem_address'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">                                        
                                    <label class="col-md-3 control-label">เลขบัตร ปชช.</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="mem_card" maxlength="13" minlength="13" class="form-control" value="<?= $array_edit['mem_card'] ?>" required="" readonly="">                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">วันเดือนปีเกิด</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="date" name="mem_birthday" id="mem_birthday" class="form-control datepicker" readonly="" required="" value="<?= $array_edit['mem_birthday'] ?>"/>
                                        </div>                                            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">อาชีพ</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="mem_work" class="form-control" readonly="" required="" value="<?= $array_edit['mem_work'] ?>"/>
                                        </div>                                            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">สถานภาพ</label>
                                    <div class="col-md-9">                                                                                            
                                        <select class="form-control" name="mem_status" id="mem_status" required="" disabled="">
                                            <option style="display:none;">NAN</option>
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
                                            <input type="text" name="mem_nationality" class="form-control" required="" readonly="" value="<?= $array_edit['mem_nationality'] ?>"/>
                                        </div>                                            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">เบอร์โทรศัพท์</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="mem_tel" maxlength="10" class="form-control" readonly="" required="" value="<?= $array_edit['mem_tel'] ?>"/>
                                        </div>                                            
                                    </div>
                                </div>
                                
                                 <div class="form-group">
                                    <label class="col-md-3 control-label">รหัสผ่าน</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="mem_pass" maxlength="10" class="form-control"  value="<?= $array_edit['mem_pass'] ?>"/>
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
    $(document).ready(function () { //แสดงอายุ 
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




