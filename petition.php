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
$datetime = changedate(date("Y-m-d"));

$memdate2 = $array_login3['mem_birthday'];
$YearStart2 = date("Y");
$YearEnd2 = date("Y", strtotime($memdate2));
$DateNum2 = $YearStart2 - $YearEnd2;
//var_dump($array_login3['mem_date']);
?>
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="dashboard.php">Home</a></li>
    <li><a href="petition_show.php">คำร้องขอเอกสารการกู้ยืม</a></li>
    <li class="active">รายการคำร้องขอเอกสารการกู้ยืมใหม่</li>
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
            <?php
//session_unset($_SESSION['ss_pet_type']);
            ?>
            <form class="form-horizontal" action="petition_save.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>ใบคำร้องขอกู้เงินเพื่อพัฒนาคุณภาพชีวิต</strong>สมาชิกกองทุนสวัสดิการชุมชน กองสวัสดิการสังคม เทศบาลเมืองยโสธร</h3>
                        <ul class="panel-controls">
                            <li style="margin-right: 80px;"><a href="petition_show.php" ><button type="button" class="btn btn-danger"><span class="fa fa-reply"></span> ย้อนกลับ</button></a></li>
                        </ul>
                    </div>
                    <div class="panel-body">     
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-8"></div>
                                    <label class="col-md-2 control-label">เขียนที่</label>
                                    <div class="col-md-2">                                            
                                        <div class="input-group">
                                            <div id='show-data2'></div>
                                            <input type="text" value="-" readonly="" class="form-control hiddenrow"/>
                                        </div>                                            
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-8"></div>
                                    <label class="col-md-2 control-label">วันที่</label>
                                    <div class="col-md-2">                                            
                                        <div class="input-group">
                                            <input type="text" name="pet_date" value="<?= $datetime ?>" readonly="" class="form-control"/>
                                        </div>                                            
                                    </div>
                                </div>
                            </div>
                        </div><br> 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" style="text-align:left;">เรื่อง ขอกู้เงินประเภทเงินกู้เพื่อพัฒนาคุณภาพชีวิต <b style="color:red;">*</b></label>
                                    <div class="col-md-3">             
                                        <select class="form-control" data-live-search="true" name="pet_type" id="pet_type" required="">
                                            <option style="display: none;">--</option>
                                            <option value="ผู้สูงอายุ">ผู้สูงอายุ</option>
                                            <option value="ผู้พิการ">ผู้พิการ</option>
                                            <option value="กู้สามัญ">กู้สามัญ</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div id='show-data_view'></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" style="text-align:left;">เรียน ผู้จัดการสถาบันการเงินชุมชนเทศบาลเมืองยโสธร</label>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-1"></div>
                                    <label class="col-md-2 control-label" style="text-align:left;">ด้วยข้าพเจ้า</label>
                                    <div class="col-md-2">             
                                        <input type="text" value="<?= $array_login3['mem_name'] ?>  <?= $array_login3['mem_lastname'] ?>" readonly="" class="form-control"/>
                                    </div>
                                    <label class="col-md-1 control-label" style="text-align:right;">อายุ</label>
                                    <div class="col-md-1">             
                                        <input type="text" value="<?= $DateNum2 ?>" name="pet_age" readonly="" class="form-control"/>
                                    </div>
                                    <label class="col-md-1 control-label" style="text-align:left;">ปี</label>
                                    <label class="col-md-2 control-label" style="text-align:right;">สมาชิกทะเบียนเลขที่</label>
                                    <div class="col-md-2">             
                                        <input type="text" value="<?= $array_login3['mem_id'] ?>" id="mem_id" readonly="" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-1"></div>
                                    <label class="col-md-2 control-label" style="text-align:left;">ที่อยู่บ้านเลขที่</label>
                                    <div class="col-md-9">             
                                        <textarea class="form-control" rows="3" cols="110" readonly=""><?= $array_login3['mem_address'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div id='show-data'></div> <!-- script  -->

                        <br><br><br><br><br>

                    </div>
                </div>                    
            </form>
        </div>
        <!-- END PAGE CONTENT WRAPPER -->                                                
    </div>            
    <!-- END PAGE CONTENT -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-10"><br>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:auto;">
                <div class=" modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">เพิ่มรายชื่อผู้กู้ร่วม</h4>
                        </div>
                        <div class="modal-body-view">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTAINER --> 
<script>
    $(document).ready(function () {
        $(".hiddenrow").removeClass('hidden'); // ปิดเขียนที่ 3 ไว้
        $('#pet_type').change(function () { //เมื่อมีการเปลี่ยนค่า pet_type ให้ส่งข้อมูลไป petition2
            var pet_type = $(this).val();
            $.ajax({
                type: "GET",
                url: 'petition2.php',
                data: {pet_type},
                success: function (data) {
                    $('#show-data').html(data);
                }
            });
            var mem_id = $('#mem_id').val(); //เมื่อมีการเปลี่ยนค่า pet_type ให้ส่งข้อมูลไป petition3
            $.ajax({
                type: "GET",
                url: 'petition3.php',
                data: {pet_type, mem_id},
                success: function (data) {
                    $('#show-data2').html(data);
                }
            });
            $(".hiddenrow").addClass('hidden'); //เปิด เขียนที 3
            if(pet_type === 'กู้สามัญ'){
                $.ajax({
                    type: "GET",
                    url: 'petition_view1.php',
                    data: {pet_type},
                    success: function (data) {
                        $('#show-data_view').html(data);
                    }
                });
            }
        });
    }
    );
</script>
<?php
include 'footer.php';
?>