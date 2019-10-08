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
    <li><a href="deposit.php">ฝากเงินกองทุน</a></li>
    <li class="active"><?= $name ?>รายการฝากเงินกองทุน</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="deposit_save.php?mode=<?= $mode ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong><?= $name ?></strong> รายการฝากเงินกองทุน</h3>
                        <ul class="panel-controls">
                            <li style="margin-right: 80px;"><a href="deposit_show.php" ><button type="button" class="btn btn-danger"><span class="fa fa-reply"></span> ย้อนกลับ</button></a></li>
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
                                                ?>
                                                <option value="<?= $array_basic1['mem_id'] ?>">[<?= $array_basic1['mem_id'] ?>] <?= $array_basic1['mem_name'] ?> <?= $array_basic1['mem_lastname'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div><br><div id='show-data2'></div><br>
                        <div class="row">
                            <div class="col-md-6">
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
                                                ?>
                                                <option value="<?= $year ?>" <?php if ($year == $pyear) {
                                                echo "selected";
                                            } ?>><?= $THAI_YEAR ?></option>
    <?php $year++;
} ?>
                                        </select>
                                    </div>
                                </div>
                            </div><br><br><br><br>
                        </div>
                        <div id='show-data'></div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-default" type="reset">Clear Form</button>                                    
                        <button class="btn btn-primary pull-right" type="submit">Submit</button>
                    </div>
                </div>
            </form>

        </div>                    

    </div>
    <!-- END PAGE CONTENT WRAPPER -->                                                
</div>            
<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER --> 
<script>
    $(document).ready(function () {
        $('#year').change(function () {
            var year = $(this).val();
            $.ajax({
                type: "GET",
                url: 'deposit2.php',
                data: {year},
                success: function (data) {
                    $('#show-data').html(data);
                }
            });
        });
        var d = new Date();
        var year = d.getFullYear();;
            $.ajax({
                type: "GET",
                url: 'deposit2.php',
                data: {year},
                success: function (data) {
                    $('#show-data').html(data);
                }
            });
    }
    );
        $(document).ready(function () {
        $('#mem_id').change(function () {
            var mem_id = $(this).val();
            $.ajax({
                type: "GET",
                url: 'deposit3.php',
                data: {mem_id},
                success: function (data) {
                    $('#show-data2').html(data);
                }
            });
        });
    }
    );
</script>
<?php
include 'footer.php';
?>




