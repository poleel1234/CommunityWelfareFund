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
$mode = 'add';
$name = 'เพิ่ม';
$readonly = '';
$sql_newid = "Select Max(substr(give_id,-5))+1 as MaxID from give_money";
$query_newid = mysqli_query($connect, $sql_newid);
$array_newid = mysqli_fetch_array($query_newid);
if ($array_newid['MaxID'] == '') {
    $newid = "GIVE-00001";
} else {
    $newid = "GIVE-" . sprintf("%05d", $array_newid['MaxID']);
}
$datetime = changedate(date("Y-m-d"));
?>
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="dashboard.php">Home</a></li>
    <li><a href="give_money.php">บันทึกการมอบเงิน</a></li>
    <li class="active"><?= $name ?>รายการบันทึกการมอบเงิน</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="give_money_save.php?mode=<?= $mode ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong><?= $name ?></strong> รายการบันทึกการมอบเงิน</h3>
                        <ul class="panel-controls">
                            <li style="margin-right: 80px;"><a href="give_money_show.php" ><button type="button" class="btn btn-danger"><span class="fa fa-reply"></span> ย้อนกลับ</button></a></li>
                        </ul>
                    </div>
                    <div class="panel-body">                                                                        

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-md-3 control-label">รหัสมอบเงิน</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-bookmark-o"></span></span>
                                            <input type="text" name="give_id" value="<?= $newid ?>" readonly="" class="form-control"/>
                                        </div>                                            
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">วันที่มอบเงิน</label>
                                    <div class="col-md-9">                                                                                            
                                        <input type="text" name="dep_date" value="<?= $datetime ?>" readonly="" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ผู้รับเงิน</label>
                                    <div class="col-md-9">                                                                                
                                        <select class="form-control select" data-live-search="true" name="mem_id" id="mem_id_give" required="">
                                            <option style="display: none;"></option>
                                            <?php
                                            $sql_basic1 = "select * from get_benefits g join member m on m.mem_id = g.mem_id join benefits b on b.ben_id = g.ben_id where (g.get_date_ap != null or g.get_date_ap != '') and g.get_id not in(select get_id from give_money)";
                                            $query_basic1 = mysqli_query($connect, $sql_basic1);
                                            while ($array_basic1 = mysqli_fetch_array($query_basic1)) {
                                                ?>
                                                <option value="<?= $array_basic1['get_id'] ?>">[<?= $array_basic1['get_id'] ?> <?= $array_basic1['ben_category'] ?>]-[<?= $array_basic1['mem_id'] ?>] <?= $array_basic1['mem_name'] ?> <?= $array_basic1['mem_lastname'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div id='show-data'></div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">มารับด้วยตนเอง</label>
                                    <div class="col-md-9 col-xs-12">    
                                        <div class="radio">
                                            <label><input type="radio" name="give_chk" value="มารับด้วยตนเอง" id='req_condition1' checked="checked"></label>
                                        </div>                                        </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">มอบฉันทะ</label>
                                    <div class="col-md-9 col-xs-12">    
                                        <div class="radio">
                                            <label><input type="radio" name="give_chk" value="มอบฉันทะ" id='req_condition2'></label>
                                        </div>                                        </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ชื่อผู้รับเงิน</label>
                                    <div class="col-md-9">                                                                                            
                                        <input type="text" name="give_name" required="" class="form-control frmdis1 frmdis2"/>
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
<script>
    $(document).ready(function () {
        $('#mem_id_give').change(function () {
            var mem_id = $(this).val();
            $.ajax({
                type: "GET",
                url: 'give_money2.php',
                data: {mem_id},
                success: function (data) {
                    $('#show-data').html(data);
                }
            });
        });
$('.frmdis1').attr('disabled', false);
    $('.frmdis2').attr('disabled', true);
        $('#req_condition2').click(function () {
            if ($(this).is(':checked')) {
                $('.frmdis1').attr('disabled', false);
            } else {
                $('.frmdis1').attr('disabled', true);
            }
        });
        $('#req_condition1').click(function () {
            if ($(this).is(':checked')) {
                $('.frmdis2').attr('disabled', true);
            } else {
                $('.frmdis2').attr('disabled', false);
            }
        });


    }
    );
</script>
<?php
include 'footer.php';
?>




