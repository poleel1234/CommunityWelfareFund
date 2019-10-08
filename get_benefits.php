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
if ($array_login['aut_position'] == "ผู้ดูแลระบบ" || $array_login['aut_position'] == "ผู้บริหาร" || $array_login['aut_position'] == "เจ้าหน้าที่") {
    echo "<script>alert('You have no permission to access this page.');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=logout.php' />";
    exit();
}
include 'header.php';
$sql_newid = "Select Max(substr(get_id,-6))+1 as MaxID from get_benefits";
$query_newid = mysqli_query($connect, $sql_newid);
$array_newid = mysqli_fetch_array($query_newid);
if ($array_newid['MaxID'] == '') {
    $newid = "GET-000001";
} else {
    $newid = "GET-" . sprintf("%06d", $array_newid['MaxID']);
}
$datetime = changedate(date("Y-m-d"));
$sql_newid2 = "Select sum(get_condition2) as get_condition2 from get_benefits where mem_id = '" . $array_login3['mem_id'] . "' and YEAR(get_condition1) = YEAR(NOW()) and ben_id = 'BEN-000012'";
$query_newid2 = mysqli_query($connect, $sql_newid2);
$array_newid2 = mysqli_fetch_array($query_newid2);
$i = $array_newid2['get_condition2'];
$i2 = 20 - $i;


$memdate2 = $array_login3['mem_birthday'];
$YearStart2 = date("Y");
$YearEnd2 = date("Y", strtotime($memdate2));
$DateNum2 = $YearStart2 - $YearEnd2;
?>
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="dashboard.php">Home</a></li>
    <li><a href="get_benefits_show.php">ขอรับสวัสดิการ</a></li>
    <li class="active">รายการขอรับสวัสดิการใหม่</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<style>
    /* The container */
    .container {
        display: block;
        position: relative;
        padding-left: 30px;
        margin-bottom: 5px;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default checkbox */
    .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #ccc;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input ~ .checkmark {
        background-color: #2196F3;
    }

    /* When the checkbox is checked, add a blue background */
    .container input:checked ~ .checkmark {
        background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .container input:checked ~ .checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .container .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="get_benefits_save.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>แบบคำขอรับเงินค่าสวัสดิการ</strong>สมาชิกกองทุนสวัสดิการชุมชน กองสวัสดิการสังคม เทศบาลเมืองยโสธร</h3>
                        <ul class="panel-controls">
                            <li style="margin-right: 80px;"><a href="get_benefits_show.php" ><button type="button" class="btn btn-danger"><span class="fa fa-reply"></span> ย้อนกลับ</button></a></li>
                        </ul>
                    </div>
                    <div class="panel-body">                                                                        
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label class="col-md-2 control-label">รหัสขอรับเงินค่าสวัสดิการ
                                        <b style="color:red;"><?= $_GET['ben_id']; ?></b>
                                    </label>
                                    <div class="col-md-3">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-bookmark-o"></span></span>
                                            <input type="text" name="get_id" value="<?= $newid ?>" readonly="" class="form-control"/>
                                        </div>                                            
                                    </div>
                                    <label class="col-md-2 control-label">วันที่ขอรับเงินค่าสวัสดิการ</label>
                                    <div class="col-md-3">   
                                        <input type="text" name="get_date" value="<?= $datetime ?>" readonly="" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">ผู้ขอรับสวัสดิการ</label>
                                    <div class="col-md-3">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-bookmark-o"></span></span>
                                            <input type="text" value="<?= $array_login3['mem_title'] ?><?= $array_login3['mem_name'] ?>  <?= $array_login3['mem_lastname'] ?>" readonly="" class="form-control"/>
                                        </div>                                            
                                    </div>
                                    <label class="col-md-2 control-label">อายุ</label>
                                    <div class="col-md-3">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-bookmark-o"></span></span>
                                            <input type="text" value="<?= $DateNum2 ?>" readonly="" class="form-control"/>
                                        </div>                                            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">เลขบัตรประจำตัวประชาชน</label>
                                    <div class="col-md-3">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-bookmark-o"></span></span>
                                            <input type="text" value="<?= $array_login3['mem_card'] ?>" readonly="" class="form-control"/>
                                        </div>                                            
                                    </div>
                                    <label class="col-md-2 control-label">วันเดือนปีเกิด</label>
                                    <div class="col-md-3">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-bookmark-o"></span></span>
                                            <input type="text" value="<?= $array_login3['mem_birthday'] ?>" readonly="" class="form-control"/>
                                        </div>                                            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">อาชีพ</label>
                                    <div class="col-md-3">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-bookmark-o"></span></span>
                                            <input type="text" value="<?= $array_login3['mem_work'] ?>" readonly="" class="form-control"/>
                                        </div>                                            
                                    </div>
                                    <label class="col-md-2 control-label">สถานภาพ</label>
                                    <div class="col-md-3">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-bookmark-o"></span></span>
                                            <input type="text" value="<?= $array_login3['mem_status'] ?>" readonly="" class="form-control"/>
                                        </div>                                            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">สัญชาติ</label>
                                    <div class="col-md-3">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-bookmark-o"></span></span>
                                            <input type="text" value="<?= $array_login3['mem_nationality'] ?>" readonly="" class="form-control"/>
                                        </div>                                            
                                    </div>
                                    <label class="col-md-2 control-label">เบอร์โทรศัพท์</label>
                                    <div class="col-md-3">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-bookmark-o"></span></span>
                                            <input type="text" value="<?= $array_login3['mem_tel'] ?>" readonly="" class="form-control"/>
                                        </div>                                            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">เป็นสมาชิกตั้งแต่</label>
                                    <div class="col-md-3">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-bookmark-o"></span></span>
                                            <input type="text" value="<?= changedate($array_login3['mem_date']) ?>" readonly="" class="form-control"/>
                                        </div>                                            
                                    </div>
                                    <label class="col-md-2 control-label">เลขที่สมาชิก</label>
                                    <div class="col-md-3">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-bookmark-o"></span></span>
                                            <input type="text" value="<?= $array_login3['mem_id'] ?>" readonly="" class="form-control"/>
                                        </div>                                            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">ที่อยู่</label>
                                    <div class="col-md-9 col-xs-12">                                         
                                        <div class="input-group">
                                            <textarea class="form-control" rows="3" cols="110" readonly=""><?= $array_login3['mem_address'] ?></textarea>
                                        </div>                                            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">ประเภทสวัสดิการ</label>
                                    <div class="col-md-3">             
                                        <select class="form-control select" data-live-search="true" name="ben_id" id="ben_id" required="">
                                            <option style="display: none;"></option>
                                            <?php
                                            $sql_ba = "SELECT COUNT(*) as c FROM get_benefits g JOIN benefits b ON b.ben_id = g.ben_id AND b.ben_category like '%เสียชีวิต%' WHERE g.mem_id = '" . $array_login3['mem_id'] . "'";
                                            $query_ba = mysqli_query($connect, $sql_ba);
                                            $array_ba = mysqli_fetch_array($query_ba);

                                            if ($array_login3['mem_title'] == 'นาง' || $array_login3['mem_title'] == 'นางสาว') {
                                                if ($array_ba['c'] > 0) {
                                                    $sql_basic1 = "select * from benefits where ben_category not like '%เสียชีวิต%' and ben_sex != 'ชาย' and '$DateNum2' BETWEEN span_of_age_to AND span_of_age_from order by ben_id asc";
                                                } else {
                                                    $sql_basic1 = "select * from benefits where ben_sex != 'ชาย' and '$DateNum2' BETWEEN span_of_age_to AND span_of_age_from order by ben_id asc";
                                                }
                                            } else if ($array_login3['mem_title'] == 'นาย') {
                                                if ($array_ba['c'] > 0) {
                                                $sql_basic1 = "select * from benefits where ben_category not like '%เสียชีวิต%' and ben_sex != 'หญิง' and  '$DateNum2' BETWEEN span_of_age_to AND span_of_age_from order by ben_id asc";
                                                }else{
                                                $sql_basic1 = "select * from benefits where ben_sex != 'หญิง' and  '$DateNum2' BETWEEN span_of_age_to AND span_of_age_from order by ben_id asc";
                                                }
                                            }
                                            $query_basic1 = mysqli_query($connect, $sql_basic1);
                                            while ($array_basic1 = mysqli_fetch_array($query_basic1)) {
                                                ?>
                                                <option value="<?= $array_basic1['ben_id'] ?>"><?= $array_basic1['ben_category'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">             
                                        <label class="container">&emsp;กรณีมอบฉันทะ
                                            <input type="checkbox" value="1" id="chkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                                                                <!--<label class="container"><input type="checkbox" name="chk"  id="chkbox" class="checkmark"/> กรณีมอบฉันทะ</label>-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="Copy7 col-md-2 control-label">ชื่อกรณีมอบฉันทะ</label>
                                    <div class="Copy7 col-md-3">                                            
                                        <input type="text" id="name_other" name="name_other" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group Copy9">
                                    <label class="col-md-2 control-label"></label>
                                    <div class="col-md-6">             
                                        <b name="Copy9" id="Copy9" style="color:red;">***เงื่อนไขข้อจำกัดการนอนโรงพยาบาล จะต้องไม่เกิน 20 คืน / 1 ปี</b><h3 style="color:red;">ตอนนี้คุณใช้สิทธิ์ไปแล้ว <?= number_format($i, 0) ?> คืน</h3>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">เงินสวัสดิการในการนอนรักษาพยาบาล ตั้งแต่</label>
                                    <div class="col-md-3">                                                                                            
                                        <input type="date" name="get_condition1" required="" class="form-control copydis2"/>
                                    </div>
                                    <label class="col-md-1 control-label">จำนวน</label>
                                    <div class="col-md-3">    
                                        <input type="hidden" name="get_condition4" id="get_condition4" value="<?= $i2 ?>" required="" class="form-control copydis2"/>
                                        <input type="number" name="get_condition2" id="get_condition3" required="" class="form-control copydis2"/>
                                    </div>
                                    <label class="col-md-1 control-label">คืน</label>
                                </div>
                                <div id='show-data'></div>

                            </div>
                            <b style="color:red;">แนบไฟล์ที่มีนามสกุล : pdf, gif, png เท่านั้น</b>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-default" type="reset">Clear Form</button>      
                        <?php
                        if ($i < 20) {
                            ?>
                            <button class="btn btn-primary pull-right Copy10" type="submit">Submit</button>
                        <?php } ?>
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
        $('#get_condition3').keyup(function () {
            var con3 = Number($('#get_condition3').val());
            var con4 = Number($('#get_condition4').val());
            console.log('get_condition3: ' + con3);
            console.log('get_condition4: ' + con4);
            if (con3 > con4) {
                $(".Copy10").addClass('hidden');
            } else {
                $(".Copy10").removeClass('hidden');
            }
        });
        $('.copydis').attr('disabled', true);
        $('.copydis2').attr('disabled', true);
        $(".Copy3").addClass('hidden');
        $(".Copy4").addClass('hidden');
//        $(".Copy7").addClass('hidden');
        $(".Copy8").addClass('hidden');
        $(".Copy9").addClass('hidden');
        
        var ses = '<?=$array_login3['req_beneficiary']?>';
        $('#ben_id').change(function () {
            var ben_id = $(this).val();
            if (ben_id === 'BEN-000006') {
                $("#name_other").val(ses);
            } else {
                $("#name_other").val('');
            }

            $.ajax({
                type: "GET",
                url: 'get_benefits2.php',
                data: {ben_id},
                success: function (data) {
                    $('#show-data').html(data);
                }
            });

            if ($('#ben_id').val() === 'BEN-000016') { //คลอดบุตร
                $('.copydis').attr('disabled', false);
                $('.copydis2').attr('disabled', false);
                $(".Copy3").addClass('hidden');
                $(".Copy4").removeClass('hidden');
                $(".Copy8").addClass('hidden');
                $(".Copy9").addClass('hidden');
            } else if ($('#ben_id').val() === 'BEN-000012') { //นอนโรงพยาบาล
                $('.copydis2').attr('disabled', false);
                $('.copydis').attr('disabled', true);
                $(".Copy3").removeClass('hidden');
                $(".Copy4").addClass('hidden');
                $(".Copy8").addClass('hidden');
                $(".Copy9").removeClass('hidden');
            } else if ($('#ben_id').val() === 'BEN-000006' || $('#ben_id').val() === 'BEN-000007' || $('#ben_id').val() === 'BEN-000008' || $('#ben_id').val() === 'BEN-000009' || $('#ben_id').val() === 'BEN-000010' || $('#ben_id').val() === 'BEN-000011') { //เสียชีวิต
                $('.copydis').attr('disabled', true);
                $('.copydis2').attr('disabled', true);
                $(".Copy3").addClass('hidden');
                $(".Copy4").addClass('hidden');
                $(".Copy8").removeClass('hidden');
                $(".Copy9").addClass('hidden');
            } else {
                $('.copydis').attr('disabled', true);
                $('.copydis2').attr('disabled', true);
                $(".Copy3").addClass('hidden');
                $(".Copy4").addClass('hidden');
                $(".Copy8").addClass('hidden');
                $(".Copy9").addClass('hidden');
            }
        });
        $(".Copy7").addClass('hidden');
        $('#chkbox').click(function () {
            if ($(this).is(':checked')) {
                $(".Copy7").removeClass('hidden');
            } else {
                $(".Copy7").addClass('hidden');
            }
        });
    }
    );
</script>
<?php
include 'footer.php';
?>