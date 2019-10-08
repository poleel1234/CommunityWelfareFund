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
if (isset($_GET['mode']) == "") {
    $mode = 'add';
    $name = 'เพิ่ม';
    $readonly = '';
    $sql_newid = "Select Max(substr(ben_id,-6))+1 as MaxID from benefits";
    $query_newid = mysqli_query($connect, $sql_newid);
    $array_newid = mysqli_fetch_array($query_newid);
    if ($array_newid['MaxID'] == '') {
        $newid = "BEN-000001";
    } else {
        $newid = "BEN-" . sprintf("%06d", $array_newid['MaxID']);
    }
} elseif (isset($_GET['mode']) == "edit") {
    $mode = "edit";
    $name = 'แก้ไข';
    $readonly = 'readonly';
    $sql_edit = "select * from benefits where ben_id='" . $_GET['ben_id'] . "'";
    $query_edit = mysqli_query($connect, $sql_edit);
    $array_edit = mysqli_fetch_array($query_edit);
    $newid = $array_edit['ben_id'];
}
?>
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="dashboard.php">Home</a></li>
    <li><a href="#">ข้อมูลพื้นฐาน</a></li>
    <li><a href="basic_benefits.php">ข้อมูลสวัสดิการ</a></li>
    <li class="active"><?= $name ?>ข้อมูลสวัสดิการ</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="basic_benefits_save.php?mode=<?= $mode ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong><?= $name ?></strong> ข้อมูลสวัสดิการ</h3>
                        <ul class="panel-controls">
                            <li style="margin-right: 80px;"><a href="basic_benefits.php" ><button type="button" class="btn btn-danger"><span class="fa fa-reply"></span> ย้อนกลับ</button></a></li>
                        </ul>
                    </div>
                    <div class="panel-body">                                                                        

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-md-3 control-label">รหัสสวัสดิการ</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-bookmark-o"></span></span>
                                            <input type="text" name="ben_id" value="<?= $newid ?>" readonly="" class="form-control"/>
                                        </div>                                            
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">ชื่อประเภทสวัสดิการ</label>
                                    <div class="col-md-9">                                                                                            
                                            <input type="text" name="ben_category" value="<?= $array_edit['ben_category'] ?>" required="" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">เงื่อนไข</label>
                                    <div class="col-md-9 col-xs-12">                                            
                                        <textarea class="form-control" name="ben_condition" rows="5" required=""><?= $array_edit['ben_condition'] ?></textarea>
                                    </div>
                                </div>
                              

                                <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">หลักฐานการรับสวัสดิการ</label>
                                        <div class="col-md-5 col-xs-12">                                                                                                                                        
                                            <label class="check"><input type="checkbox" name="ben_document1" value="1" class="icheckbox" checked="checked" <?php if($array_edit['ben_document1'] == 1){ echo "checked=checked"; } ?>/> สำเนาบัตรประจำตัวประชาชน</label>
                                        </div>
                                        <div class="col-md-4 col-xs-12">                                                                                                                                        
                                            <label class="check"><input type="checkbox" name="ben_document2" value="1" class="icheckbox" checked="checked" <?php if($array_edit['ben_document2'] == 1){ echo "checked=checked"; } ?>/> สำเนาทะเบียนบ้าน</label>
                                        </div>
                                    </div>
                                <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label"></label>
                                        <div class="col-md-5 col-xs-12">                                                                                                                                        
                                            <label class="check"><input type="checkbox" name="ben_document3" value="1" class="icheckbox" <?php if($array_edit['ben_document3'] == 1){ echo "checked=checked"; } ?>/> สมุดการเป็นสมาชิกกองทุน</label>
                                        </div>
                                        <div class="col-md-4 col-xs-12">                                                                                                                                        
                                            <label class="check"><input type="checkbox" name="ben_document4" value="1" class="icheckbox" <?php if($array_edit['ben_document4'] == 1){ echo "checked=checked"; } ?>/> สำเนาใบแจ้งเกิดลูก</label>
                                        </div>
                                    </div>
                                <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label"></label>
                                        <div class="col-md-5 col-xs-12">                                                                                                                                        
                                            <label class="check"><input type="checkbox" name="ben_document5" value="1" class="icheckbox" <?php if($array_edit['ben_document5'] == 1){ echo "checked=checked"; } ?>/> สำเนาสูติบัตรลูก</label>
                                        </div>
                                        <div class="col-md-4 col-xs-12">        
                                            <label class="check"><input type="checkbox" name="ben_document7" value="1" class="icheckbox" <?php if($array_edit['ben_document7'] == 1){ echo "checked=checked"; } ?>/> สำเนาใบมรณะบัตร</label>
                                        </div>
                                    </div>
                                <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label"></label>
                                        <div class="col-md-9 col-xs-12">    
                                            <label class="check"><input type="checkbox" name="ben_document6" value="1" class="icheckbox" <?php if($array_edit['ben_document6'] == 1){ echo "checked=checked"; } ?>/> ใบรับรองการนอนรักษาตัวในโรงพยาบาล</label>
                                        </div>
                                    </div>
                                <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label"></label>
                                        <div class="col-md-9 col-xs-12">                                                                                                                                        
                                            <label class="check"><input type="checkbox" name="ben_document8" value="1" class="icheckbox" <?php if($array_edit['ben_document8'] == 1){ echo "checked=checked"; } ?>/> กรณีมอบฉันทะ สำเนาบัตรประจำตัวประชาชน</label>
                                        </div>
                                    </div>
                                <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label"></label>
                                        <div class="col-md-9 col-xs-12">                                                                                                                                        
                                            <label class="check"><input type="checkbox" name="ben_document9" value="1" class="icheckbox" <?php if($array_edit['ben_document9'] == 1){ echo "checked=checked"; } ?>/> กรณีมอบฉันทะ สำเนาทะเบียนบ้าน</label>
                                        </div>
                                    </div>
                             <div class="form-group">
                                    <label class="col-md-3 control-label">อื่นๆ</label>
                                    <div class="col-md-9 col-xs-12">                                            
                                        <textarea class="form-control" name="ben_evidence" rows="5" required=""><?= $array_edit['ben_evidence'] ?></textarea>
                                    </div>    
                             </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ได้รับเงิน</label>
                                    <div class="col-md-9 col-xs-12">                                            
                                        <input type="number" name="ben_condition1" class="form-control" required="" value="<?= $array_edit['ben_condition1'] ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ยอดที่กู้ได้</label>
                                    <div class="col-md-9 col-xs-12">                                            
                                        <input type="number" name="ben_condition2" class="form-control" required="" value="<?= $array_edit['ben_condition2'] ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ดอกเบี้ย</label>
                                    <div class="col-md-9 col-xs-12">                                            
                                        <input type="number" name="interest" class="form-control" required="" value="<?= $array_edit['interest'] ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">การคิดดอกเบี้ย</label>
                                    <div class="col-md-9 col-xs-12">                                            
                                                                       <select class="form-control" data-live-search="true" name="interest_type" id="interest_type" required="">
                                            <option style="display: none;">NaN</option>
                                            <option value="ต่อครั้ง" <?php if ($array_edit['interest_type'] == 'ต่อครั้ง') {
    echo 'selected';
} ?>>ต่อครั้ง</option>
                                            <option value="ร้อยละ" <?php if ($array_edit['interest_type'] == 'ร้อยละ') {
    echo 'selected';
} ?>>ร้อยละ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ประเภทขอกู้</label>
                                    <div class="col-md-9 col-xs-12">     
                                        <select class="form-control" data-live-search="true" name="ben_type" id="ben_type" required="">
                                            <option style="display: none;">NaN</option>
                                            <option value="ผู้สูงอายุ" <?php if ($array_edit['ben_type'] == 'ผู้สูงอายุ') {
    echo 'selected';
} ?>>ผู้สูงอายุ</option>
                                            <option value="ผู้พิการ" <?php if ($array_edit['ben_type'] == 'ผู้พิการ') {
    echo 'selected';
} ?>>ผู้พิการ</option>
                                            <option value="กู้สามัญ" <?php if ($array_edit['ben_type'] == 'กู้สามัญ') {
    echo 'selected';
} ?>>กู้สามัญ</option>
                                        </select>
                                    </div>
                                </div>
                             
                              <div class="form-group">
                                    <label class="col-md-3 control-label">อายุผู้กู้ตั้งแต่</label>  
                                    <div class="col-md-3 col-xs-9">                                            
                                        <input type="number" name="span_of_age_to" class="form-control" required="" value="<?= $array_edit['span_of_age_to'] ?>"/>
									</div>
                                    <label class="col-md-3 control-label">อายุผู้กู้ต้องไม่เกิน</label>
                                    <div class="col-md-3 col-xs-9">                                            
                                        <input type="number" name="span_of_age_from" class="form-control" required="" value="<?= $array_edit['span_of_age_from'] ?>"/>
               			</div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ระยะหักจ่าย/เดือน</label>
                                    <div class="col-md-9 col-xs-12">                                            
                                        <input type="number" name="ben_condition3" class="form-control" required="" value="<?= $array_edit['ben_condition3'] ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ปีละไม่เกิน/คืน</label>
                                    <div class="col-md-9 col-xs-12">                                            
                                        <input type="number" name="ben_condition4" class="form-control" required="" value="<?= $array_edit['ben_condition4'] ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ได้รับเงินกรณีนอนโรงบาลเพื่อคลอดบุตร/คืน</label>
                                    <div class="col-md-9 col-xs-12">                                            
                                        <input type="number" name="ben_condition5" class="form-control" required="" value="<?= $array_edit['ben_condition5'] ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ครั้งละไม่เกิน/คืน</label>
                                    <div class="col-md-9 col-xs-12">                                            
                                        <input type="number" name="ben_condition6" class="form-control" required="" value="<?= $array_edit['ben_condition6'] ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">เพศของผู้ขอใช้สิทธิ์</label>
                                    <div class="col-md-9 col-xs-12">     
                                        <select class="form-control" data-live-search="true" name="ben_sex" id="ben_type" required="">
                                            <option style="display: none;">NaN</option>
                                            <option value="ชาย" <?php if ($array_edit['ben_sex'] == 'ชาย') {
    echo 'selected';
} ?>>ชาย</option>
                                            <option value="หญิง" <?php if ($array_edit['ben_sex'] == 'หญิง') {
    echo 'selected';
} ?>>หญิง</option>
                                            <option value="ทั้งชายและหญิง" <?php if ($array_edit['ben_sex'] == 'ทั้งชายและหญิง') {
    echo 'selected';
} ?>>ทั้งชายและหญิง</option>
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




