<?php
session_start();
$pagename = 'deposit';
include "connect_db.php";
?>       
<?php
$sql_basic2 = "select * from benefits where ben_id = '" . $_GET['ben_id'] . "'";
$query_basic2 = mysqli_query($connect, $sql_basic2);
while ($array_basic2 = mysqli_fetch_array($query_basic2)) {
    ?>
    <?php if ($array_basic2['ben_document1'] == 1) { ?>
        <div class="form-group">
            <label class="col-md-3 control-label">สำเนาบัตรประชาชน</label>
            <div class="col-md-9">
                <input type="file" class="fileinput btn-success" name="Copy1" id="Copy1" data-filename-placement="inside" title="Browse"/>
            </div>
        </div>
    <?php } ?>
    <?php if ($array_basic2['ben_document2'] == 1) { ?>
        <div class="form-group">
            <label class="col-md-3 control-label">สำเนาทะเบียนบ้าน</label>
            <div class="col-md-9">
                <input type="file" class="fileinput btn-success" name="Copy2" id="Copy1" data-filename-placement="inside" title="Browse"/>
            </div>
        </div>
    <?php } ?>
    <?php if ($array_basic2['ben_document3'] == 1) { ?>
        <div class="form-group">
            <label class="col-md-3 control-label">สมุดการเป็นสมาชิกกองทุน</label>
            <div class="col-md-9">
                <input type="file" class="fileinput btn-success" name="Copy3" id="Copy1" data-filename-placement="inside" title="Browse"/>
            </div>
        </div>
    <?php } ?>
    <?php if ($array_basic2['ben_document4'] == 1) { ?>
        <div class="form-group">
            <label class="col-md-3 control-label">สำเนาใบแจ้งเกิดลูก</label>
            <div class="col-md-9">
                <input type="file" class="fileinput btn-success" name="Copy4" id="Copy1" data-filename-placement="inside" title="Browse"/>
            </div>
        </div>
    <?php } ?>
    <?php if ($array_basic2['ben_document5'] == 1) { ?>
        <div class="form-group">
            <label class="col-md-3 control-label">สำเนาสูติบัตรลูก</label>
            <div class="col-md-9">
                <input type="file" class="fileinput btn-success" name="Copy5" id="Copy1" data-filename-placement="inside" title="Browse"/>
            </div>
        </div>
    <?php } ?>
    <?php if ($array_basic2['ben_document6'] == 1) { ?>
        <div class="form-group">
            <label class="col-md-3 control-label">ใบรับรองการนอนรักษาตัวในโรงพยาบาล <b style="color:red;">*</b></label>
            <div class="col-md-9">
                <input type="file" class="fileinput btn-success" name="Copy6" id="Copy1" data-filename-placement="inside" title="Browse" required="required"/>
            </div>
        </div>
    <?php } ?>
    <?php if ($array_basic2['ben_document7'] == 1) { ?>
        <div class="form-group">
            <label class="col-md-3 control-label">สำเนาใบมรณะบัตร <b style="color:red;">*</b></label>
            <div class="col-md-9">
                <input type="file" class="fileinput btn-success" name="Copy7" id="Copy1" data-filename-placement="inside" title="Browse" required="required"/>
            </div>
        </div>
    <?php } ?>
    <?php if ($array_basic2['ben_document8'] == 1) { ?>
        <div class="form-group Copy7">
            <label class="col-md-3 control-label">กรณีมอบฉันทะ สำเนาบัตรประจำตัวประชาชน <b style="color:red;">*</b></label>
            <div class="col-md-9">
                <input type="file" class="fileinput btn-success Copy7" name="Copy8" id="Copy1" data-filename-placement="inside" title="Browse" required="required"/>
            </div>
        </div>
    <?php } ?>
    <?php if ($array_basic2['ben_document9'] == 1) { ?>
        <div class="form-group Copy7">
            <label class="col-md-3 control-label">กรณีมอบฉันทะ สำเนาทะเบียนบ้าน <b style="color:red;">*</b></label>
            <div class="col-md-9">
                <input type="file" class="fileinput btn-success Copy7" name="Copy9" id="Copy1" data-filename-placement="inside" title="Browse" required="required"/>
            </div>
        </div>
    <?php } ?>
<?php } ?>