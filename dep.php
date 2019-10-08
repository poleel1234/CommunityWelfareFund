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
$mode = 'add';
$name = 'เพิ่ม';
$readonly = '';
$sql_newid = "Select Max(substr(dep_id,-6))+1 as MaxID from deposit";
$query_newid = mysqli_query($connect, $sql_newid);
$array_newid = mysqli_fetch_array($query_newid);
if ($array_newid['MaxID'] == '') {
    $newid = "DEP-000001";
} else {
    $newid = "DEP-" . sprintf("%06d", $array_newid['MaxID']);
}
$datetime = changedate(date("Y-m-d"));
?>
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="dashboard.php">Home</a></li>
    <li><a href="dep.php">ฝากเงินกองทุน</a></li>
    <li class="active"><?= $name ?>รายการฝากเงินกองทุน</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="dep_add.php?mode=add" method="POST" autocomplete="off" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong><?= $name ?></strong> รายการฝากเงินกองทุน</h3>
                        <ul class="panel-controls">
                            <li style="margin-right: 80px;"><a href="dep_show.php" ><button type="button" class="btn btn-danger"><span class="fa fa-reply"></span> ย้อนกลับ</button></a></li>
                        </ul>
                    </div>
                    <div class="panel-body">                                                                        

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-md-3 control-label">รหัสรับเงินฝาก</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-bookmark-o"></span></span>
                                            <input type="text" name="dep_id" value="<?= $newid ?>" readonly="" class="form-control"/>
                                        </div>                                            
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">วันที่ทำรายการฝาก</label>
                                    <div class="col-md-9">                                                                                            
                                        <input type="text" name="dep_date" value="<?= $datetime ?>" readonly="" class="form-control"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">ผู้นำฝาก</label>
                                    <div class="col-md-9">                                                                                
                                        <select class="form-control" data-live-search="true" name="mem_id" id="mem_id" required="">
                                            <option style="display: none;"></option>
                                            <?php
                                            $sql_basic1 = "select * from member order by mem_id asc";
                                            $query_basic1 = mysqli_query($connect, $sql_basic1);
                                            while ($array_basic1 = mysqli_fetch_array($query_basic1)) {
                                                if ($_SESSION['session_mem_id'] == $array_basic1['mem_id']) {
                                                    $selected = "selected=selected";
                                                } else {
                                                    $selected = "";
                                                }
                                                ?>
                                                <option value="<?= $array_basic1['mem_id'] ?>" <?= $selected ?>>[<?= $array_basic1['mem_id'] ?>] <?= $array_basic1['mem_name'] ?> <?= $array_basic1['mem_lastname'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php
                                if (count($_SESSION['session_mem_id']) > 0) {
                                ?>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">เดือนที่ต้องการฝาก</label>
                                    <div class="col-md-9">                                                                                
                                        <select class="form-control" data-live-search="true" name="month" id="month" required="">
                                            <?php
                                            $THAI_MOUTH = array(1 => "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
                                                "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

                                            foreach ($THAI_MOUTH as $m) {
                                                if($m == $_SESSION['session1']){
                                                    $sec = "selected=selected";
                                                }else{
                                                    $sec = "";
                                                }
                                                ?>
                                                <option value="<?= $m ?>" <?=$sec?>><?= $m ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ปี</label>
                                    <div class="col-md-9">                                                                                
                                        <select class="form-control" data-live-search="true" name="year" id="year" required="">
                                            <?php
                                            $time = strtotime("now");
                                            $pyear = date("Y", $time);
                                            $year = date("Y", $time) - 10;
                                            for ($index = 0; $index < 21; $index++) {
                                                $THAI_YEAR = $year + 543;
                                                if($year == $_SESSION['session2']){
                                                    $sec = "selected=selected";
                                                }else{
                                                    $sec = "";
                                                }
                                                ?>
                                                <option value="<?= $year ?>" <?=$sec?>><?= $THAI_YEAR ?></option>
                                                        <?php
                                                        $year++;
                                                    }
                                                    ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ยอดฝาก/บาท</label>
                                    <div class="col-md-9">                                                                                
                                        <input type="number" name="dep_amount" value="30" readonly="" class="form-control"/>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>

                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-default" type="reset">Clear Form</button> 
                        <?php
                                if (count($_SESSION['session_mem_id']) <= 0) {
                                ?>
                        <a href="dep.php"><button class="btn btn-primary pull-right" type="button">ถัดไป</button></a>
                        <?php
                                }
                                if (count($_SESSION['session_mem_id']) > 0) {
                                ?>
                        <button class="btn btn-primary pull-right" type="submit">เพิ่มรายการฝาก</button>
                                <?php } ?>
                    </div>
                </div>
            </form>

        </div>
    </div>                    

</div>
<?php
                                if (count($_SESSION['session_mem_id']) > 0) {
                                ?>
<div class="panel-body">
    <table class="table">
        <thead>
            <tr>
                <th>เดือน</th>
                <th>ปี</th>
                <th>ยอดฝาก (บาท)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($_SESSION['session_monthyear']) == 0) {
                ?>	
                <tr>
                    <th style="text-align: center;color: darkred;" colspan="2"><i class="icon-info-sign"></i> ไม่พบข้อมูล</th>
                </tr>
                <?php
            } else {
                $sum = 0;
                foreach ($_SESSION['session_monthyear'] as $key => $value) {
                    ?>
                    <tr>
                        <td><?= $_SESSION['session_month'][$key] ?></td>
                        <td><?= $_SESSION['session_year'][$key] ?></td>
                        <td style="text-align: right;">30</td>
                    </tr>
                <?php
                $sum += 30;
                }
            }
            ?>
                    <tr>
                        <td></td>
                        <td style="text-align: right;"><b>ยอดรวม (บาท)</b></td>
                        <td style="text-align: right;font-size: 30px;"><b><?= number_format($sum,2);?></b></td>
                    </tr>
        </tbody>
    </table>
     <div class="panel-footer">
                        <?php
                                if (count($_SESSION['session_mem_id']) > 0) {
                                ?>
         <a href="dep_save.php"><button class="btn btn-primary pull-right" type="button">บันทึกข้อมูล</button></a>
                                <?php } ?>
                    </div>
</div>
<?php
                                }
            if (count($_SESSION['session_mem_id']) > 0) {
                ?>	
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="col-md-3 control-label">ตรวจสอบรายการนำฝากของปี</label>
            <div class="col-md-9">                                                                                
                <select class="form-control" data-live-search="true" name="year2" id="year2" required="">
                    <option style="display: none;"></option>
                    <?php
                    $time = strtotime("now");
                    $pyear = date("Y", $time);
                    $year = date("Y", $time) - 10;
                    for ($index = 0; $index < 21; $index++) {
                        $THAI_YEAR = $year + 543;
                        ?>
                        <option value="<?= $year ?>" <?php
                        if (count($_SESSION['session_year_ses']) > 0) {
                                if ($year == $_SESSION['session_year_ses']) {
                                    echo "selected=selected";
                                }else{
                                     echo "";
                                }
                        }
                                ?>><?= $THAI_YEAR ?></option>
    <?php $year++;
}
?>
                </select>
            </div>
        </div>
    </div>
</div>
<br><div id='show-data'></div><br><br><br><br><br><br><br><br><br><br><br>
                                <?php } ?>
<!-- END PAGE CONTENT WRAPPER -->                                                
</div>            
<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER --> 
<script>
    var ses = '<?=$_SESSION['session_year_ses']?>';
         if (ses.length > 0) {
           var year = ses;
            var mem_id = $('#mem_id').val();
            var alldata = {mem_id:mem_id,year:year};
            $.ajax({
                type: "GET",
                url: 'dep_ses.php',
                data: {alldata},
                success: function (data) {
                    $('#show-data').html(data);
                }
            });
        }else{
            var d = new Date();
            var year = d.getFullYear();
            var mem_id = $('#mem_id').val();
            var alldata = {mem_id:mem_id,year:year};
            $.ajax({
                type: "GET",
                url: 'dep_ses.php',
                data: {alldata},
                success: function (data) {
                    $('#show-data').html(data);
                }
            });
        }
    $(document).ready(function () {
        $('#mem_id').change(function () {
            var mem_id = $(this).val();
            var year = $('#year2').val();
            var alldata = {mem_id:mem_id,year:year};
            $.ajax({
                type: "GET",
                url: 'dep_ses.php',
                data: {alldata},
                success: function (data) {
                    $('#show-data').html(data);
                }
            });
        });
        
        $('#year2').change(function () {
            var year = $(this).val();
            var mem_id = $('#mem_id').val();
            var alldata = {mem_id:mem_id,year:year};
            $.ajax({
                type: "GET",
                url: 'dep_ses.php',
                data: {alldata},
                success: function (data) {
                    $('#show-data').html(data);
                }
            });
        });
        
            
            
    });
</script>
<?php
include 'footer.php';
?>




