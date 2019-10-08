<?php
session_start();
include "connect_db.php";
if (isset($_GET['reg_id']) != "") {
    $act = "register_save.php?mode=edit";
    $sql_edit = "select * from register where reg_id='" . $_GET['reg_id'] . "'";
    $query_edit = mysqli_query($connect, $sql_edit);
    $array_edit = mysqli_fetch_array($query_edit);
    $newid = $array_edit['reg_id'];
} else {
    $sql_newid = "Select Max(substr(reg_id,-6))+1 as MaxID from register";
    $query_newid = mysqli_query($connect, $sql_newid);
    $array_newid = mysqli_fetch_array($query_newid);
    if ($array_newid['MaxID'] == '') {
        $newid = "REQ-000001";
    } else {
        $newid = "REQ-" . sprintf("%06d", $array_newid['MaxID']);
    }
    $act = "register_save.php";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title>ระบบกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->      
        <style>
            h2 {
                text-align: center;
                text-transform: uppercase;
                font-family: 'Niramit', sans-serif;
            }
            .form-control[disabled], .form-control[readonly] {
                color: black;
            }
        </style>
    </head>
    <body>
        <div class="error-container" style="margin-left: 300px;">
            <!-- START WIZARD WITH VALIDATION -->
            <div class="block" style="width: 800px;">
                <h2><strong style="color:#1caf9a;">ใบสมัครเข้าเป็นสมาชิก</strong><br>กองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร<br>(กองทุนวันละบาท)</h2>                                
                <form action="<?= $act ?>" method="POST" role="form" class="form-horizontal" id="wizard-validation" autocomplete="off">
                    <div class="wizard show-submit wizard-validation">
                        <ul>
                            <li>
                                <a href="#step-7">
                                    <span class="stepNumber">1</span>
                                    <span class="stepDesc">กรอกใบสมัคร<br /><small>กรุณากรอกข้อมูลให้ครบ</small></span>
                                </a>
                            </li>
                            <li>
                                <a href="#step-8">
                                    <span class="stepNumber">2</span>
                                    <span class="stepDesc">ยืนยันใบสมัคร<br /><small>กรุณาตรวจสอบข้อมูลก่อนกดยืนยัน</small></span>
                                </a>
                            </li>                                    
                        </ul>

                        <div id="step-7">   
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-8"></div>
                                        <label class="col-md-2 control-label">เลขทะเบียนสมาชิกที่</label>
                                        <div class="col-md-2">                                            
                                            <div class="input-group">
                                                <input type="text" value="<?= $newid ?>" class="form-control" name="reg_id" readonly=""/>
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
                                                <?php
                                                if (isset($_GET['reg_id']) == "") {
                                                    ?>
                                                    <input type="text" value="<?= changedate(date("Y-m-d")); ?>" class="form-control" name="reg_date" readonly=""/>
                                                <?php } else { ?>
                                                    <input type="text" value="<?= changedate($array_edit['reg_date']) ?>" class="form-control" name="reg_date" readonly=""/>
                                                <?php } ?>                                            </div>                                         
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-11 control-label" style="text-align:left;">เรียน คณะกรรมการบริหารกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร</label>
                                    </div>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-1"></div>
                                        <label class="col-md-11 control-label" style="text-align:left;">ข้าพเจ้าขอสมัครเป็นสมาชิกกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร และขอให้ถ้อยคำเป็นหลักฐานดังต่อไปนี้</label>
                                    </div>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-1"></div>
                                        <label class="col-md-2 control-label" style="text-align:left;">(1) ข้าพเจ้า <b style="color:red;">*</b></label>
                                        <div class="col-md-3">             
                                            <select class="form-control" id="reg_title" name="req_title" id="req_title" required="">
                                                <option style="display:none;">-</option>
                                                <option value="นาย" <?php
                                                if ($array_edit['req_title'] == 'นาย') {
                                                    echo 'selected';
                                                }
                                                ?>>นาย</option>
                                                <option value="นาง" <?php
                                                if ($array_edit['req_title'] == 'นาง') {
                                                    echo 'selected';
                                                }
                                                ?>>นาง</option>
                                                <option value="นางสาว" <?php
                                                if ($array_edit['req_title'] == 'นางสาว') {
                                                    echo 'selected';
                                                }
                                                ?>>นางสาว</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">             
                                            <input type="text" class="form-control" placeholder="ชื่อ" name="reg_name" value="<?= $array_edit['reg_name'] ?>" id="reg_name" required="" onkeyup="myFunction1()"/>
                                        </div>
                                        <div class="col-md-3">             
                                            <input type="text" class="form-control" placeholder="นามสกุล" name="reg_lastname" value="<?= $array_edit['reg_lastname'] ?>" id="reg_lastname" required=""/>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-1"></div>
                                        <label class="col-md-3 control-label" style="text-align:left;">เลขประจำตัวประชาชน <b style="color:red;">*</b></label>
                                        <div class="col-md-3">             
                                            <input type="text" class="form-control" placeholder="เลขประจำตัวประชาชน" maxlength="13" minlength="13" name="reg_card" value="<?= $array_edit['reg_card'] ?>" id="reg_card" required=""/>
                                        </div>
                                        <label class="col-md-2 control-label" style="text-align:left;">วัน/เดือน/ปีเกิด <b style="color:red;">*</b></label>
                                        <div class="col-md-3">             
                                            <input type="date" class="form-control" placeholder="วัน/เดือน/ปีเกิด" name="reg_birthday" value="<?=$array_edit['reg_birthday'] ?>" id="reg_birthday" required=""/>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-1"></div>
                                        <label class="col-md-1 control-label" style="text-align:left;">อายุ</label>
                                        <div class="col-md-2">             
                                            <input type="text" class="form-control" placeholder="อายุ" name="reg_age" value="<?= $array_edit['reg_age'] ?>" id="reg_age_new" readonly=""/>
                                        </div>
                                        <label class="col-md-1 control-label" style="text-align:left;">อาชีพ <b style="color:red;">*</b></label>
                                        <div class="col-md-3">             
                                            <input type="text" class="form-control" placeholder="อาชีพ" name="reg_work" value="<?= $array_edit['reg_work'] ?>" id="reg_work" required=""/>
                                        </div>
                                        <label class="col-md-2 control-label" style="text-align:left;">สถานภาพ <b style="color:red;">*</b></label>
                                        <div class="col-md-2">      
                                            <select class="form-control" name="req_status" id="req_status" required="">
                                                <option style="display:none;">-</option>
                                                <option value="โสด" <?php
                                                if ($array_edit['req_status'] == 'โสด') {
                                                    echo 'selected';
                                                }
                                                ?>>โสด</option>
                                                <option value="สมรส" <?php
                                                if ($array_edit['req_status'] == 'สมรส') {
                                                    echo 'selected';
                                                }
                                                ?>>สมรส</option>
                                                <option value="หม้าย" <?php
                                                if ($array_edit['req_status'] == 'หม้าย') {
                                                    echo 'selected';
                                                }
                                                ?>>หม้าย</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <?php
                            if (isset($_GET['reg_id']) != "") {
                                ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-2 control-label" style="text-align:left;">สัญชาติ <b style="color:red;">*</b></label>
                                            <div class="col-md-2">             
                                                <input type="text" class="form-control" name="req_nationality" value="<?= $array_edit['req_nationality'] ?>" id="req_nationality" required=""/>
                                            </div>
                                            <label class="col-md-1 control-label" style="text-align:left;">ที่อยู่ <b style="color:red;">*</b></label>
                                            <div class="col-md-6">             
                                                <textarea class="form-control" name="req_address" rows="1" required=""><?= $array_edit['req_address'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-2 control-label" style="text-align:left;">เบอร์โทรศัพท์ <b style="color:red;">*</b></label>
                                            <div class="col-md-2">             
                                                <input type="text" maxlength="10" minlength="9" class="form-control" name="req_tel" value="<?= $array_edit['req_tel'] ?>" id="req_tel" required=""/>
                                            </div>
                                            <label class="col-md-7 control-label" style="text-align:left;">ได้รับทราบข้อความในระเบียบข้อบังคับกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร</label>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-7 control-label" style="text-align:left;">เข้าใจและเห็นชอบในวัตถุประสงค์ของกองทุนสวัสดิการ</label>
                                        </div>
                                    </div>
                                </div><br>
                            <?php } else { ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-2 control-label" style="text-align:left;">สัญชาติ <b style="color:red;">*</b></label>
                                            <div class="col-md-2">             
                                                <input type="text" class="form-control" name="req_nationality" value="<?= $array_edit['req_nationality'] ?>" id="req_nationality" required=""/>
                                            </div>
                                            <label class="col-md-2 control-label" style="text-align:left;">บ้านเลขที่ <b style="color:red;">*</b></label>
                                            <div class="col-md-2">             
                                                <input type="text" class="form-control" name="req_address1" id="req_address1" required=""/>
                                            </div>
                                            <label class="col-md-1 control-label" style="text-align:left;">ถนน <b style="color:red;">*</b></label>
                                            <div class="col-md-2">             
                                                <input type="text" class="form-control" name="req_address2" id="req_address2" required=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-1 control-label" style="text-align:left;">ตำบล <b style="color:red;">*</b></label>
                                            <div class="col-md-2">             
                                                <input type="text" class="form-control" name="req_address3" id="req_address3" required=""/>
                                            </div>
                                            <label class="col-md-1 control-label" style="text-align:left;">อำเภอ <b style="color:red;">*</b></label>
                                            <div class="col-md-2">             
                                                <input type="text" class="form-control" name="req_address4" id="req_address4" required=""/>
                                            </div>
                                            <label class="col-md-2 control-label" style="text-align:left;">จังหวัด <b style="color:red;">*</b></label>
                                            <div class="col-md-3">             
                                                <input type="text" class="form-control" name="req_address5" id="req_address5" required=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-2 control-label" style="text-align:left;">รหัสไปรษณีย์ <b style="color:red;">*</b></label>
                                            <div class="col-md-2">             
                                                <input type="text" class="form-control" maxlength="5" minlength="5" name="req_address6" id="req_address6" required=""/>
                                            </div>
                                            <label class="col-md-2 control-label" style="text-align:left;">เบอร์โทรศัพท์ <b style="color:red;">*</b></label>
                                            <div class="col-md-2">             
                                                <input type="text" maxlength="10" minlength="9" class="form-control" name="req_tel" value="<?= $array_edit['req_tel'] ?>" id="req_tel" required=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-11 control-label" style="text-align:left;">ได้รับทราบข้อความในระเบียบข้อบังคับกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร เข้าใจและเห็นชอบในวัตถุประสงค์ของกองทุนสวัสดิการ</label>
                                        </div>
                                    </div>
                                </div><br>
                            <?php } ?>



                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-1"></div>
                                        <label class="col-md-11 control-label" style="text-align:left;">(2) ข้าพเจ้าสมัครใจส่งเงินสัจจะวันละ 1 บาท เข้ากองทุนสวัสดิการชุมชน ดังนี้</label>
                                    </div>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-6">
                                            <div class="radio">
                                                <label><input type="radio" name="req_condition" value="1" id='req_condition' <?php
                                                    if ($array_edit['req_condition'] == '1') {
                                                        echo 'checked';
                                                    }
                                                    ?>>ครั้งละ 1 บาท ส่งเงินทุกวัน ครั้งละ 30 บาท (30วัน) ส่งเงินวันที่</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control frmdis" name="req_condition_date1" id="req_condition_date1" required="">
                                                <option style="display:none;">-</option>
                                                <option value="01" <?php
                                                if ($array_edit['req_condition_date1'] == '01' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>01</option>
                                                <option value="02" <?php
                                                if ($array_edit['req_condition_date1'] == '02' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>02</option>
                                                <option value="03" <?php
                                                if ($array_edit['req_condition_date1'] == '03' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>03</option>
                                                <option value="04" <?php
                                                if ($array_edit['req_condition_date1'] == '04' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>04</option>
                                                <option value="05" <?php
                                                if ($array_edit['req_condition_date1'] == '05' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>05</option>
                                                <option value="06" <?php
                                                if ($array_edit['req_condition_date1'] == '06' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>06</option>
                                                <option value="07" <?php
                                                if ($array_edit['req_condition_date1'] == '07' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>07</option>
                                                <option value="08" <?php
                                                if ($array_edit['req_condition_date1'] == '08' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>08</option>
                                                <option value="09" <?php
                                                if ($array_edit['req_condition_date1'] == '09' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>09</option>
                                                <option value="10" <?php
                                                if ($array_edit['req_condition_date1'] == '10' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>10</option>
                                                <option value="11" <?php
                                                if ($array_edit['req_condition_date1'] == '11' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>11</option>
                                                <option value="12" <?php
                                                if ($array_edit['req_condition_date1'] == '12' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>12</option>
                                                <option value="13" <?php
                                                if ($array_edit['req_condition_date1'] == '13' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>13</option>
                                                <option value="14" <?php
                                                if ($array_edit['req_condition_date1'] == '14' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>14</option>
                                                <option value="15" <?php
                                                if ($array_edit['req_condition_date1'] == '15' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>15</option>
                                                <option value="16" <?php
                                                if ($array_edit['req_condition_date1'] == '16' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>16</option>
                                                <option value="17" <?php
                                                if ($array_edit['req_condition_date1'] == '17' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>17</option>
                                                <option value="18" <?php
                                                if ($array_edit['req_condition_date1'] == '18' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>18</option>
                                                <option value="19" <?php
                                                if ($array_edit['req_condition_date1'] == '19' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>19</option>
                                                <option value="20" <?php
                                                if ($array_edit['req_condition_date1'] == '20' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>20</option>
                                                <option value="21" <?php
                                                if ($array_edit['req_condition_date1'] == '21' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>21</option>
                                                <option value="22" <?php
                                                if ($array_edit['req_condition_date1'] == '22' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>22</option>
                                                <option value="23" <?php
                                                if ($array_edit['req_condition_date1'] == '23' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>23</option>
                                                <option value="24" <?php
                                                if ($array_edit['req_condition_date1'] == '24' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>24</option>
                                                <option value="25" <?php
                                                if ($array_edit['req_condition_date1'] == '25' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>25</option>
                                                <option value="26" <?php
                                                if ($array_edit['req_condition_date1'] == '26' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>26</option>
                                                <option value="27" <?php
                                                if ($array_edit['req_condition_date1'] == '27' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>27</option>
                                                <option value="28" <?php
                                                if ($array_edit['req_condition_date1'] == '28' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>28</option>
                                                <option value="29" <?php
                                                if ($array_edit['req_condition_date1'] == '29' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>29</option>
                                                <option value="30" <?php
                                                if ($array_edit['req_condition_date1'] == '30' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>30</option>
                                                <option value="31" <?php
                                                if ($array_edit['req_condition_date1'] == '31' && $array_edit['req_condition'] == '1') {
                                                    echo 'selected';
                                                }
                                                ?>>31</option>
                                            </select>
                                        </div>
                                        <label class="col-md-2 control-label" style="text-align:left;">ของทุกเดือน</label>
                                    </div>
                                </div><br><br><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-5">
                                                <div class="radio">
                                                    <label><input type="radio" name="req_condition" value="2" id='req_condition2' <?php
                                                        if ($array_edit['req_condition'] == '2') {
                                                            echo 'checked';
                                                        }
                                                        ?>>ครั้งละ 90 บาท (90 วัน หรือ 3 เดือน) ส่งเงินวันที่</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <select class="form-control frmdis2" name="req_condition_date1" id="req_condition_date2" required="">
                                                    <option style="display:none;">-</option>
                                                    <option value="01" <?php
                                                    if ($array_edit['req_condition_date1'] == '01' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>01</option>
                                                    <option value="02" <?php
                                                    if ($array_edit['req_condition_date1'] == '02' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>02</option>
                                                    <option value="03" <?php
                                                    if ($array_edit['req_condition_date1'] == '03' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>03</option>
                                                    <option value="04" <?php
                                                    if ($array_edit['req_condition_date1'] == '04' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>04</option>
                                                    <option value="05" <?php
                                                    if ($array_edit['req_condition_date1'] == '05' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>05</option>
                                                    <option value="06" <?php
                                                    if ($array_edit['req_condition_date1'] == '06' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>06</option>
                                                    <option value="07" <?php
                                                    if ($array_edit['req_condition_date1'] == '07' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>07</option>
                                                    <option value="08" <?php
                                                    if ($array_edit['req_condition_date1'] == '08' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>08</option>
                                                    <option value="09" <?php
                                                    if ($array_edit['req_condition_date1'] == '09' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>09</option>
                                                    <option value="10" <?php
                                                    if ($array_edit['req_condition_date1'] == '10' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>10</option>
                                                    <option value="11" <?php
                                                    if ($array_edit['req_condition_date1'] == '11' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>11</option>
                                                    <option value="12" <?php
                                                    if ($array_edit['req_condition_date1'] == '12' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>12</option>
                                                    <option value="13" <?php
                                                    if ($array_edit['req_condition_date1'] == '13' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>13</option>
                                                    <option value="14" <?php
                                                    if ($array_edit['req_condition_date1'] == '14' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>14</option>
                                                    <option value="15" <?php
                                                    if ($array_edit['req_condition_date1'] == '15' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>15</option>
                                                    <option value="16" <?php
                                                    if ($array_edit['req_condition_date1'] == '16' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>16</option>
                                                    <option value="17" <?php
                                                    if ($array_edit['req_condition_date1'] == '17' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>17</option>
                                                    <option value="18" <?php
                                                    if ($array_edit['req_condition_date1'] == '18' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>18</option>
                                                    <option value="19" <?php
                                                    if ($array_edit['req_condition_date1'] == '19' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>19</option>
                                                    <option value="20" <?php
                                                    if ($array_edit['req_condition_date1'] == '20' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>20</option>
                                                    <option value="21" <?php
                                                    if ($array_edit['req_condition_date1'] == '21' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>21</option>
                                                    <option value="22" <?php
                                                    if ($array_edit['req_condition_date1'] == '22' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>22</option>
                                                    <option value="23" <?php
                                                    if ($array_edit['req_condition_date1'] == '23' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>23</option>
                                                    <option value="24" <?php
                                                    if ($array_edit['req_condition_date1'] == '24' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>24</option>
                                                    <option value="25" <?php
                                                    if ($array_edit['req_condition_date1'] == '25' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>25</option>
                                                    <option value="26" <?php
                                                    if ($array_edit['req_condition_date1'] == '26' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>26</option>
                                                    <option value="27" <?php
                                                    if ($array_edit['req_condition_date1'] == '27' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>27</option>
                                                    <option value="28" <?php
                                                    if ($array_edit['req_condition_date1'] == '28' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>28</option>
                                                    <option value="29" <?php
                                                    if ($array_edit['req_condition_date1'] == '29' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>29</option>
                                                    <option value="30" <?php
                                                    if ($array_edit['req_condition_date1'] == '30' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>30</option>
                                                    <option value="31" <?php
                                                    if ($array_edit['req_condition_date1'] == '31' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>31</option>
                                                </select>
                                            </div>
                                            <label class="col-md-1 control-label" style="text-align:left;">เดือน</label>
                                            <div class="col-md-2">
                                                <select class="form-control frmdis2" name="req_condition_month1" id="req_condition_month2" required="">
                                                    <option style="display:none;">-</option>
                                                    <option value="มกราคม" <?php
                                                    if ($array_edit['req_condition_month1'] == 'มกราคม' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>มกราคม</option>
                                                    <option value="กุมภาพันธ์" <?php
                                                    if ($array_edit['req_condition_month1'] == 'กุมภาพันธ์' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>กุมภาพันธ์</option>
                                                    <option value="มีนาคม" <?php
                                                    if ($array_edit['req_condition_month1'] == 'มีนาคม' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>มีนาคม</option>
                                                    <option value="เมษายน" <?php
                                                    if ($array_edit['req_condition_month1'] == 'เมษายน' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>เมษายน</option>
                                                    <option value="พฤษภาคม" <?php
                                                    if ($array_edit['req_condition_month1'] == 'พฤษภาคม' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>พฤษภาคม</option>
                                                    <option value="มิถุนายน" <?php
                                                    if ($array_edit['req_condition_month1'] == 'มิถุนายน' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>มิถุนายน</option>
                                                    <option value="กรกฎาคม" <?php
                                                    if ($array_edit['req_condition_month1'] == 'กรกฎาคม' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>กรกฎาคม</option>
                                                    <option value="สิงหาคม" <?php
                                                    if ($array_edit['req_condition_month1'] == 'สิงหาคม' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>สิงหาคม</option>
                                                    <option value="กันยายน" <?php
                                                    if ($array_edit['req_condition_month1'] == 'กันยายน' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>กันยายน</option>
                                                    <option value="ตุลาคม" <?php
                                                    if ($array_edit['req_condition_month1'] == 'ตุลาคม' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>ตุลาคม</option>
                                                    <option value="พฤศจิกายน" <?php
                                                    if ($array_edit['req_condition_month1'] == 'พฤศจิกายน' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>พฤศจิกายน</option>
                                                    <option value="ธันวาคม" <?php
                                                    if ($array_edit['req_condition_month1'] == 'ธันวาคม' && $array_edit['req_condition'] == '2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>ธันวาคม</option>
                                                </select>
                                            </div> 
                                        </div>
                                    </div><br><br><br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-2"></div>
                                                <label class="col-md-1 control-label" style="text-align:left;">และวันที่</label>
                                                <div class="col-md-2">
                                                    <select class="form-control frmdis2" name="req_condition_date2" id="req_condition_date3" required="">
                                                        <option style="display:none;">-</option>
                                                        <option value="01" <?php
                                                        if ($array_edit['req_condition_date2'] == '01' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>01</option>
                                                        <option value="02" <?php
                                                        if ($array_edit['req_condition_date2'] == '02' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>02</option>
                                                        <option value="03" <?php
                                                        if ($array_edit['req_condition_date2'] == '03' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>03</option>
                                                        <option value="04" <?php
                                                        if ($array_edit['req_condition_date2'] == '04' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>04</option>
                                                        <option value="05" <?php
                                                        if ($array_edit['req_condition_date2'] == '05' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>05</option>
                                                        <option value="06" <?php
                                                        if ($array_edit['req_condition_date2'] == '06' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>06</option>
                                                        <option value="07" <?php
                                                        if ($array_edit['req_condition_date2'] == '07' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>07</option>
                                                        <option value="08" <?php
                                                        if ($array_edit['req_condition_date2'] == '08' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>08</option>
                                                        <option value="09" <?php
                                                        if ($array_edit['req_condition_date2'] == '09' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>09</option>
                                                        <option value="10" <?php
                                                        if ($array_edit['req_condition_date2'] == '10' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>10</option>
                                                        <option value="11" <?php
                                                        if ($array_edit['req_condition_date2'] == '11' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>11</option>
                                                        <option value="12" <?php
                                                        if ($array_edit['req_condition_date2'] == '12' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>12</option>
                                                        <option value="13" <?php
                                                        if ($array_edit['req_condition_date2'] == '13' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>13</option>
                                                        <option value="14" <?php
                                                        if ($array_edit['req_condition_date2'] == '14' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>14</option>
                                                        <option value="15" <?php
                                                        if ($array_edit['req_condition_date2'] == '15' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>15</option>
                                                        <option value="16" <?php
                                                        if ($array_edit['req_condition_date2'] == '16' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>16</option>
                                                        <option value="17" <?php
                                                        if ($array_edit['req_condition_date2'] == '17' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>17</option>
                                                        <option value="18" <?php
                                                        if ($array_edit['req_condition_date2'] == '18' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>18</option>
                                                        <option value="19" <?php
                                                        if ($array_edit['req_condition_date2'] == '19' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>19</option>
                                                        <option value="20" <?php
                                                        if ($array_edit['req_condition_date2'] == '20' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>20</option>
                                                        <option value="21" <?php
                                                        if ($array_edit['req_condition_date2'] == '21' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>21</option>
                                                        <option value="22" <?php
                                                        if ($array_edit['req_condition_date2'] == '22' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>22</option>
                                                        <option value="23" <?php
                                                        if ($array_edit['req_condition_date2'] == '23' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>23</option>
                                                        <option value="24" <?php
                                                        if ($array_edit['req_condition_date2'] == '24' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>24</option>
                                                        <option value="25" <?php
                                                        if ($array_edit['req_condition_date2'] == '25' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>25</option>
                                                        <option value="26" <?php
                                                        if ($array_edit['req_condition_date2'] == '26' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>26</option>
                                                        <option value="27" <?php
                                                        if ($array_edit['req_condition_date2'] == '27' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>27</option>
                                                        <option value="28" <?php
                                                        if ($array_edit['req_condition_date2'] == '28' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>28</option>
                                                        <option value="29" <?php
                                                        if ($array_edit['req_condition_date2'] == '29' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>29</option>
                                                        <option value="30" <?php
                                                        if ($array_edit['req_condition_date2'] == '30' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>30</option>
                                                        <option value="31" <?php
                                                        if ($array_edit['req_condition_date2'] == '31' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>31</option>
                                                    </select>
                                                </div>   
                                                <label class="col-md-1 control-label" style="text-align:left;">เดือน</label>
                                                <div class="col-md-2">
                                                    <select class="form-control frmdis2" name="req_condition_month2" id="req_condition_month3" required="">
                                                        <option style="display:none;">-</option>
                                                        <option value="มกราคม" <?php
                                                        if ($array_edit['req_condition_month1'] == 'มกราคม' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>มกราคม</option>
                                                        <option value="กุมภาพันธ์" <?php
                                                        if ($array_edit['req_condition_month1'] == 'กุมภาพันธ์' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>กุมภาพันธ์</option>
                                                        <option value="มีนาคม" <?php
                                                        if ($array_edit['req_condition_month1'] == 'มีนาคม' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>มีนาคม</option>
                                                        <option value="เมษายน" <?php
                                                        if ($array_edit['req_condition_month1'] == 'เมษายน' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>เมษายน</option>
                                                        <option value="พฤษภาคม" <?php
                                                        if ($array_edit['req_condition_month1'] == 'พฤษภาคม' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>พฤษภาคม</option>
                                                        <option value="มิถุนายน" <?php
                                                        if ($array_edit['req_condition_month1'] == 'มิถุนายน' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>มิถุนายน</option>
                                                        <option value="กรกฎาคม" <?php
                                                        if ($array_edit['req_condition_month1'] == 'กรกฎาคม' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>กรกฎาคม</option>
                                                        <option value="สิงหาคม" <?php
                                                        if ($array_edit['req_condition_month1'] == 'สิงหาคม' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>สิงหาคม</option>
                                                        <option value="กันยายน" <?php
                                                        if ($array_edit['req_condition_month1'] == 'กันยายน' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>กันยายน</option>
                                                        <option value="ตุลาคม" <?php
                                                        if ($array_edit['req_condition_month1'] == 'ตุลาคม' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>ตุลาคม</option>
                                                        <option value="พฤศจิกายน" <?php
                                                        if ($array_edit['req_condition_month1'] == 'พฤศจิกายน' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>พฤศจิกายน</option>
                                                        <option value="ธันวาคม" <?php
                                                        if ($array_edit['req_condition_month1'] == 'ธันวาคม' && $array_edit['req_condition'] == '2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>ธันวาคม</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div><br><br><br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-5">
                                                        <div class="radio">
                                                            <label><input type="radio" name="req_condition" value="3" id='req_condition3' <?php
                                                                if ($array_edit['req_condition'] == '3') {
                                                                    echo 'checked';
                                                                }
                                                                ?>>ครั้งละ 180 บาท (180 วัน หรือ 6 เดือน) ส่งเงินวันที่</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <select class="form-control frmdis3" name="req_condition_date1" id="req_condition_date4" required="">
                                                            <option style="display:none;">-</option>
                                                            <option value="01" <?php
                                                            if ($array_edit['req_condition_date1'] == '01' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>01</option>
                                                            <option value="02" <?php
                                                            if ($array_edit['req_condition_date1'] == '02' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>02</option>
                                                            <option value="03" <?php
                                                            if ($array_edit['req_condition_date1'] == '03' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>03</option>
                                                            <option value="04" <?php
                                                            if ($array_edit['req_condition_date1'] == '04' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>04</option>
                                                            <option value="05" <?php
                                                            if ($array_edit['req_condition_date1'] == '05' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>05</option>
                                                            <option value="06" <?php
                                                            if ($array_edit['req_condition_date1'] == '06' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>06</option>
                                                            <option value="07" <?php
                                                            if ($array_edit['req_condition_date1'] == '07' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>07</option>
                                                            <option value="08" <?php
                                                            if ($array_edit['req_condition_date1'] == '08' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>08</option>
                                                            <option value="09" <?php
                                                            if ($array_edit['req_condition_date1'] == '09' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>09</option>
                                                            <option value="10" <?php
                                                            if ($array_edit['req_condition_date1'] == '10' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>10</option>
                                                            <option value="11" <?php
                                                            if ($array_edit['req_condition_date1'] == '11' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>11</option>
                                                            <option value="12" <?php
                                                            if ($array_edit['req_condition_date1'] == '12' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>12</option>
                                                            <option value="13" <?php
                                                            if ($array_edit['req_condition_date1'] == '13' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>13</option>
                                                            <option value="14" <?php
                                                            if ($array_edit['req_condition_date1'] == '14' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>14</option>
                                                            <option value="15" <?php
                                                            if ($array_edit['req_condition_date1'] == '15' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>15</option>
                                                            <option value="16" <?php
                                                            if ($array_edit['req_condition_date1'] == '16' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>16</option>
                                                            <option value="17" <?php
                                                            if ($array_edit['req_condition_date1'] == '17' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>17</option>
                                                            <option value="18" <?php
                                                            if ($array_edit['req_condition_date1'] == '18' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>18</option>
                                                            <option value="19" <?php
                                                            if ($array_edit['req_condition_date1'] == '19' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>19</option>
                                                            <option value="20" <?php
                                                            if ($array_edit['req_condition_date1'] == '20' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>20</option>
                                                            <option value="21" <?php
                                                            if ($array_edit['req_condition_date1'] == '21' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>21</option>
                                                            <option value="22" <?php
                                                            if ($array_edit['req_condition_date1'] == '22' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>22</option>
                                                            <option value="23" <?php
                                                            if ($array_edit['req_condition_date1'] == '23' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>23</option>
                                                            <option value="24" <?php
                                                            if ($array_edit['req_condition_date1'] == '24' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>24</option>
                                                            <option value="25" <?php
                                                            if ($array_edit['req_condition_date1'] == '25' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>25</option>
                                                            <option value="26" <?php
                                                            if ($array_edit['req_condition_date1'] == '26' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>26</option>
                                                            <option value="27" <?php
                                                            if ($array_edit['req_condition_date1'] == '27' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>27</option>
                                                            <option value="28" <?php
                                                            if ($array_edit['req_condition_date1'] == '28' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>28</option>
                                                            <option value="29" <?php
                                                            if ($array_edit['req_condition_date1'] == '29' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>29</option>
                                                            <option value="30" <?php
                                                            if ($array_edit['req_condition_date1'] == '30' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>30</option>
                                                            <option value="31" <?php
                                                            if ($array_edit['req_condition_date1'] == '31' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>31</option>
                                                        </select>
                                                    </div>
                                                    <label class="col-md-1 control-label" style="text-align:left;">เดือน</label>
                                                    <div class="col-md-2">
                                                        <select class="form-control frmdis3" name="req_condition_month1" id="req_condition_month4" required="">
                                                            <option style="display:none;">-</option>
                                                            <option value="มกราคม" <?php
                                                            if ($array_edit['req_condition_month1'] == 'มกราคม' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>มกราคม</option>
                                                            <option value="กุมภาพันธ์" <?php
                                                            if ($array_edit['req_condition_month1'] == 'กุมภาพันธ์' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>กุมภาพันธ์</option>
                                                            <option value="มีนาคม" <?php
                                                            if ($array_edit['req_condition_month1'] == 'มีนาคม' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>มีนาคม</option>
                                                            <option value="เมษายน" <?php
                                                            if ($array_edit['req_condition_month1'] == 'เมษายน' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>เมษายน</option>
                                                            <option value="พฤษภาคม" <?php
                                                            if ($array_edit['req_condition_month1'] == 'พฤษภาคม' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>พฤษภาคม</option>
                                                            <option value="มิถุนายน" <?php
                                                            if ($array_edit['req_condition_month1'] == 'มิถุนายน' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>มิถุนายน</option>
                                                            <option value="กรกฎาคม" <?php
                                                            if ($array_edit['req_condition_month1'] == 'กรกฎาคม' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>กรกฎาคม</option>
                                                            <option value="สิงหาคม" <?php
                                                            if ($array_edit['req_condition_month1'] == 'สิงหาคม' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>สิงหาคม</option>
                                                            <option value="กันยายน" <?php
                                                            if ($array_edit['req_condition_month1'] == 'กันยายน' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>กันยายน</option>
                                                            <option value="ตุลาคม" <?php
                                                            if ($array_edit['req_condition_month1'] == 'ตุลาคม' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>ตุลาคม</option>
                                                            <option value="พฤศจิกายน" <?php
                                                            if ($array_edit['req_condition_month1'] == 'พฤศจิกายน' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>พฤศจิกายน</option>
                                                            <option value="ธันวาคม" <?php
                                                            if ($array_edit['req_condition_month1'] == 'ธันวาคม' && $array_edit['req_condition'] == '3') {
                                                                echo 'selected';
                                                            }
                                                            ?>>ธันวาคม</option>
                                                        </select>
                                                    </div> 
                                                </div>
                                            </div><br><br><br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="col-md-2"></div>
                                                        <label class="col-md-1 control-label" style="text-align:left;">และวันที่</label>
                                                        <div class="col-md-2">
                                                            <select class="form-control frmdis3" name="req_condition_date2" id="req_condition_date5" required="">
                                                                <option style="display:none;">-</option>
                                                                <option value="01" <?php
                                                                if ($array_edit['req_condition_date2'] == '01' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>01</option>
                                                                <option value="02" <?php
                                                                if ($array_edit['req_condition_date2'] == '02' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>02</option>
                                                                <option value="03" <?php
                                                                if ($array_edit['req_condition_date2'] == '03' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>03</option>
                                                                <option value="04" <?php
                                                                if ($array_edit['req_condition_date2'] == '04' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>04</option>
                                                                <option value="05" <?php
                                                                if ($array_edit['req_condition_date2'] == '05' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>05</option>
                                                                <option value="06" <?php
                                                                if ($array_edit['req_condition_date2'] == '06' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>06</option>
                                                                <option value="07" <?php
                                                                if ($array_edit['req_condition_date2'] == '07' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>07</option>
                                                                <option value="08" <?php
                                                                if ($array_edit['req_condition_date2'] == '08' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>08</option>
                                                                <option value="09" <?php
                                                                if ($array_edit['req_condition_date2'] == '09' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>09</option>
                                                                <option value="10" <?php
                                                                if ($array_edit['req_condition_date2'] == '10' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>10</option>
                                                                <option value="11" <?php
                                                                if ($array_edit['req_condition_date2'] == '11' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>11</option>
                                                                <option value="12" <?php
                                                                if ($array_edit['req_condition_date2'] == '12' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>12</option>
                                                                <option value="13" <?php
                                                                if ($array_edit['req_condition_date2'] == '13' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>13</option>
                                                                <option value="14" <?php
                                                                if ($array_edit['req_condition_date2'] == '14' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>14</option>
                                                                <option value="15" <?php
                                                                if ($array_edit['req_condition_date2'] == '15' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>15</option>
                                                                <option value="16" <?php
                                                                if ($array_edit['req_condition_date2'] == '16' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>16</option>
                                                                <option value="17" <?php
                                                                if ($array_edit['req_condition_date2'] == '17' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>17</option>
                                                                <option value="18" <?php
                                                                if ($array_edit['req_condition_date2'] == '18' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>18</option>
                                                                <option value="19" <?php
                                                                if ($array_edit['req_condition_date2'] == '19' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>19</option>
                                                                <option value="20" <?php
                                                                if ($array_edit['req_condition_date2'] == '20' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>20</option>
                                                                <option value="21" <?php
                                                                if ($array_edit['req_condition_date2'] == '21' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>21</option>
                                                                <option value="22" <?php
                                                                if ($array_edit['req_condition_date2'] == '22' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>22</option>
                                                                <option value="23" <?php
                                                                if ($array_edit['req_condition_date2'] == '23' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>23</option>
                                                                <option value="24" <?php
                                                                if ($array_edit['req_condition_date2'] == '24' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>24</option>
                                                                <option value="25" <?php
                                                                if ($array_edit['req_condition_date2'] == '25' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>25</option>
                                                                <option value="26" <?php
                                                                if ($array_edit['req_condition_date2'] == '26' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>26</option>
                                                                <option value="27" <?php
                                                                if ($array_edit['req_condition_date2'] == '27' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>27</option>
                                                                <option value="28" <?php
                                                                if ($array_edit['req_condition_date2'] == '28' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>28</option>
                                                                <option value="29" <?php
                                                                if ($array_edit['req_condition_date2'] == '29' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>29</option>
                                                                <option value="30" <?php
                                                                if ($array_edit['req_condition_date2'] == '30' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>30</option>
                                                                <option value="31" <?php
                                                                if ($array_edit['req_condition_date2'] == '31' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>31</option>
                                                            </select>
                                                        </div>   
                                                        <label class="col-md-1 control-label" style="text-align:left;">เดือน</label>
                                                        <div class="col-md-2">
                                                            <select class="form-control frmdis3" name="req_condition_month2" id="req_condition_month5" required="">
                                                                <option style="display:none;">-</option>
                                                                <option value="มกราคม" <?php
                                                                if ($array_edit['req_condition_month1'] == 'มกราคม' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>มกราคม</option>
                                                                <option value="กุมภาพันธ์" <?php
                                                                if ($array_edit['req_condition_month1'] == 'กุมภาพันธ์' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>กุมภาพันธ์</option>
                                                                <option value="มีนาคม" <?php
                                                                if ($array_edit['req_condition_month1'] == 'มีนาคม' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>มีนาคม</option>
                                                                <option value="เมษายน" <?php
                                                                if ($array_edit['req_condition_month1'] == 'เมษายน' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>เมษายน</option>
                                                                <option value="พฤษภาคม" <?php
                                                                if ($array_edit['req_condition_month1'] == 'พฤษภาคม' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>พฤษภาคม</option>
                                                                <option value="มิถุนายน" <?php
                                                                if ($array_edit['req_condition_month1'] == 'มิถุนายน' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>มิถุนายน</option>
                                                                <option value="กรกฎาคม" <?php
                                                                if ($array_edit['req_condition_month1'] == 'กรกฎาคม' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>กรกฎาคม</option>
                                                                <option value="สิงหาคม" <?php
                                                                if ($array_edit['req_condition_month1'] == 'สิงหาคม' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>สิงหาคม</option>
                                                                <option value="กันยายน" <?php
                                                                if ($array_edit['req_condition_month1'] == 'กันยายน' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>กันยายน</option>
                                                                <option value="ตุลาคม" <?php
                                                                if ($array_edit['req_condition_month1'] == 'ตุลาคม' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>ตุลาคม</option>
                                                                <option value="พฤศจิกายน" <?php
                                                                if ($array_edit['req_condition_month1'] == 'พฤศจิกายน' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>พฤศจิกายน</option>
                                                                <option value="ธันวาคม" <?php
                                                                if ($array_edit['req_condition_month1'] == 'ธันวาคม' && $array_edit['req_condition'] == '3') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>ธันวาคม</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div><br><br><br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-md-2"></div>
                                                            <div class="col-md-5">
                                                                <div class="radio">
                                                                    <label><input type="radio" name="req_condition" value="4" id='req_condition4' <?php
                                                                        if ($array_edit['req_condition'] == '4') {
                                                                            echo 'checked';
                                                                        }
                                                                        ?>>ครั้งละ 360 บาท (360 วัน หรือ 1 ปี) ส่งเงินวันที่</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <select class="form-control frmdis4" name="req_condition_date1" id="req_condition_date6" required="">
                                                                    <option style="display:none;">-</option>
                                                                    <option value="01" <?php
                                                                    if ($array_edit['req_condition_date1'] == '01' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>01</option>
                                                                    <option value="02" <?php
                                                                    if ($array_edit['req_condition_date1'] == '02' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>02</option>
                                                                    <option value="03" <?php
                                                                    if ($array_edit['req_condition_date1'] == '03' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>03</option>
                                                                    <option value="04" <?php
                                                                    if ($array_edit['req_condition_date1'] == '04' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>04</option>
                                                                    <option value="05" <?php
                                                                    if ($array_edit['req_condition_date1'] == '05' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>05</option>
                                                                    <option value="06" <?php
                                                                    if ($array_edit['req_condition_date1'] == '06' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>06</option>
                                                                    <option value="07" <?php
                                                                    if ($array_edit['req_condition_date1'] == '07' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>07</option>
                                                                    <option value="08" <?php
                                                                    if ($array_edit['req_condition_date1'] == '08' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>08</option>
                                                                    <option value="09" <?php
                                                                    if ($array_edit['req_condition_date1'] == '09' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>09</option>
                                                                    <option value="10" <?php
                                                                    if ($array_edit['req_condition_date1'] == '10' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>10</option>
                                                                    <option value="11" <?php
                                                                    if ($array_edit['req_condition_date1'] == '11' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>11</option>
                                                                    <option value="12" <?php
                                                                    if ($array_edit['req_condition_date1'] == '12' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>12</option>
                                                                    <option value="13" <?php
                                                                    if ($array_edit['req_condition_date1'] == '13' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>13</option>
                                                                    <option value="14" <?php
                                                                    if ($array_edit['req_condition_date1'] == '14' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>14</option>
                                                                    <option value="15" <?php
                                                                    if ($array_edit['req_condition_date1'] == '15' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>15</option>
                                                                    <option value="16" <?php
                                                                    if ($array_edit['req_condition_date1'] == '16' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>16</option>
                                                                    <option value="17" <?php
                                                                    if ($array_edit['req_condition_date1'] == '17' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>17</option>
                                                                    <option value="18" <?php
                                                                    if ($array_edit['req_condition_date1'] == '18' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>18</option>
                                                                    <option value="19" <?php
                                                                    if ($array_edit['req_condition_date1'] == '19' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>19</option>
                                                                    <option value="20" <?php
                                                                    if ($array_edit['req_condition_date1'] == '20' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>20</option>
                                                                    <option value="21" <?php
                                                                    if ($array_edit['req_condition_date1'] == '21' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>21</option>
                                                                    <option value="22" <?php
                                                                    if ($array_edit['req_condition_date1'] == '22' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>22</option>
                                                                    <option value="23" <?php
                                                                    if ($array_edit['req_condition_date1'] == '23' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>23</option>
                                                                    <option value="24" <?php
                                                                    if ($array_edit['req_condition_date1'] == '24' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>24</option>
                                                                    <option value="25" <?php
                                                                    if ($array_edit['req_condition_date1'] == '25' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>25</option>
                                                                    <option value="26" <?php
                                                                    if ($array_edit['req_condition_date1'] == '26' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>26</option>
                                                                    <option value="27" <?php
                                                                    if ($array_edit['req_condition_date1'] == '27' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>27</option>
                                                                    <option value="28" <?php
                                                                    if ($array_edit['req_condition_date1'] == '28' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>28</option>
                                                                    <option value="29" <?php
                                                                    if ($array_edit['req_condition_date1'] == '29' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>29</option>
                                                                    <option value="30" <?php
                                                                    if ($array_edit['req_condition_date1'] == '30' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>30</option>
                                                                    <option value="31" <?php
                                                                    if ($array_edit['req_condition_date1'] == '31' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>31</option>
                                                                </select>
                                                            </div>
                                                            <label class="col-md-1 control-label" style="text-align:left;">เดือน</label>
                                                            <div class="col-md-2">
                                                                <select class="form-control frmdis4" name="req_condition_month1" id="req_condition_month6" required="">
                                                                    <option style="display:none;">-</option>
                                                                    <option value="มกราคม" <?php
                                                                    if ($array_edit['req_condition_month1'] == 'มกราคม' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>มกราคม</option>
                                                                    <option value="กุมภาพันธ์" <?php
                                                                    if ($array_edit['req_condition_month1'] == 'กุมภาพันธ์' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>กุมภาพันธ์</option>
                                                                    <option value="มีนาคม" <?php
                                                                    if ($array_edit['req_condition_month1'] == 'มีนาคม' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>มีนาคม</option>
                                                                    <option value="เมษายน" <?php
                                                                    if ($array_edit['req_condition_month1'] == 'เมษายน' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>เมษายน</option>
                                                                    <option value="พฤษภาคม" <?php
                                                                    if ($array_edit['req_condition_month1'] == 'พฤษภาคม' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>พฤษภาคม</option>
                                                                    <option value="มิถุนายน" <?php
                                                                    if ($array_edit['req_condition_month1'] == 'มิถุนายน' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>มิถุนายน</option>
                                                                    <option value="กรกฎาคม" <?php
                                                                    if ($array_edit['req_condition_month1'] == 'กรกฎาคม' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>กรกฎาคม</option>
                                                                    <option value="สิงหาคม" <?php
                                                                    if ($array_edit['req_condition_month1'] == 'สิงหาคม' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>สิงหาคม</option>
                                                                    <option value="กันยายน" <?php
                                                                    if ($array_edit['req_condition_month1'] == 'กันยายน' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>กันยายน</option>
                                                                    <option value="ตุลาคม" <?php
                                                                    if ($array_edit['req_condition_month1'] == 'ตุลาคม' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>ตุลาคม</option>
                                                                    <option value="พฤศจิกายน" <?php
                                                                    if ($array_edit['req_condition_month1'] == 'พฤศจิกายน' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>พฤศจิกายน</option>
                                                                    <option value="ธันวาคม" <?php
                                                                    if ($array_edit['req_condition_month1'] == 'ธันวาคม' && $array_edit['req_condition'] == '4') {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>ธันวาคม</option>
                                                                </select>
                                                            </div> 
                                                        </div>
                                                    </div><br><br><br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="col-md-2"></div>
                                                                <label class="col-md-1 control-label" style="text-align:left;">และวันที่</label>
                                                                <div class="col-md-2">
                                                                    <select class="form-control frmdis4" name="req_condition_date2" id="req_condition_date7" required="">
                                                                        <option style="display:none;">-</option>
                                                                        <option value="01" <?php
                                                                        if ($array_edit['req_condition_date2'] == '01' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>01</option>
                                                                        <option value="02" <?php
                                                                        if ($array_edit['req_condition_date2'] == '02' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>02</option>
                                                                        <option value="03" <?php
                                                                        if ($array_edit['req_condition_date2'] == '03' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>03</option>
                                                                        <option value="04" <?php
                                                                        if ($array_edit['req_condition_date2'] == '04' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>04</option>
                                                                        <option value="05" <?php
                                                                        if ($array_edit['req_condition_date2'] == '05' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>05</option>
                                                                        <option value="06" <?php
                                                                        if ($array_edit['req_condition_date2'] == '06' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>06</option>
                                                                        <option value="07" <?php
                                                                        if ($array_edit['req_condition_date2'] == '07' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>07</option>
                                                                        <option value="08" <?php
                                                                        if ($array_edit['req_condition_date2'] == '08' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>08</option>
                                                                        <option value="09" <?php
                                                                        if ($array_edit['req_condition_date2'] == '09' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>09</option>
                                                                        <option value="10" <?php
                                                                        if ($array_edit['req_condition_date2'] == '10' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>10</option>
                                                                        <option value="11" <?php
                                                                        if ($array_edit['req_condition_date2'] == '11' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>11</option>
                                                                        <option value="12" <?php
                                                                        if ($array_edit['req_condition_date2'] == '12' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>12</option>
                                                                        <option value="13" <?php
                                                                        if ($array_edit['req_condition_date2'] == '13' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>13</option>
                                                                        <option value="14" <?php
                                                                        if ($array_edit['req_condition_date2'] == '14' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>14</option>
                                                                        <option value="15" <?php
                                                                        if ($array_edit['req_condition_date2'] == '15' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>15</option>
                                                                        <option value="16" <?php
                                                                        if ($array_edit['req_condition_date2'] == '16' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>16</option>
                                                                        <option value="17" <?php
                                                                        if ($array_edit['req_condition_date2'] == '17' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>17</option>
                                                                        <option value="18" <?php
                                                                        if ($array_edit['req_condition_date2'] == '18' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>18</option>
                                                                        <option value="19" <?php
                                                                        if ($array_edit['req_condition_date2'] == '19' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>19</option>
                                                                        <option value="20" <?php
                                                                        if ($array_edit['req_condition_date2'] == '20' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>20</option>
                                                                        <option value="21" <?php
                                                                        if ($array_edit['req_condition_date2'] == '21' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>21</option>
                                                                        <option value="22" <?php
                                                                        if ($array_edit['req_condition_date2'] == '22' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>22</option>
                                                                        <option value="23" <?php
                                                                        if ($array_edit['req_condition_date2'] == '23' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>23</option>
                                                                        <option value="24" <?php
                                                                        if ($array_edit['req_condition_date2'] == '24' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>24</option>
                                                                        <option value="25" <?php
                                                                        if ($array_edit['req_condition_date2'] == '25' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>25</option>
                                                                        <option value="26" <?php
                                                                        if ($array_edit['req_condition_date2'] == '26' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>26</option>
                                                                        <option value="27" <?php
                                                                        if ($array_edit['req_condition_date2'] == '27' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>27</option>
                                                                        <option value="28" <?php
                                                                        if ($array_edit['req_condition_date2'] == '28' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>28</option>
                                                                        <option value="29" <?php
                                                                        if ($array_edit['req_condition_date2'] == '29' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>29</option>
                                                                        <option value="30" <?php
                                                                        if ($array_edit['req_condition_date2'] == '30' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>30</option>
                                                                        <option value="31" <?php
                                                                        if ($array_edit['req_condition_date2'] == '31' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>31</option>
                                                                    </select>
                                                                </div>   
                                                                <label class="col-md-1 control-label" style="text-align:left;">เดือน</label>
                                                                <div class="col-md-2">
                                                                    <select class="form-control frmdis4" name="req_condition_month2" id="req_condition_month7" required="">
                                                                        <option style="display:none;">-</option>
                                                                        <option value="มกราคม" <?php
                                                                        if ($array_edit['req_condition_month1'] == 'มกราคม' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>มกราคม</option>
                                                                        <option value="กุมภาพันธ์" <?php
                                                                        if ($array_edit['req_condition_month1'] == 'กุมภาพันธ์' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>กุมภาพันธ์</option>
                                                                        <option value="มีนาคม" <?php
                                                                        if ($array_edit['req_condition_month1'] == 'มีนาคม' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>มีนาคม</option>
                                                                        <option value="เมษายน" <?php
                                                                        if ($array_edit['req_condition_month1'] == 'เมษายน' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>เมษายน</option>
                                                                        <option value="พฤษภาคม" <?php
                                                                        if ($array_edit['req_condition_month1'] == 'พฤษภาคม' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>พฤษภาคม</option>
                                                                        <option value="มิถุนายน" <?php
                                                                        if ($array_edit['req_condition_month1'] == 'มิถุนายน' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>มิถุนายน</option>
                                                                        <option value="กรกฎาคม" <?php
                                                                        if ($array_edit['req_condition_month1'] == 'กรกฎาคม' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>กรกฎาคม</option>
                                                                        <option value="สิงหาคม" <?php
                                                                        if ($array_edit['req_condition_month1'] == 'สิงหาคม' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>สิงหาคม</option>
                                                                        <option value="กันยายน" <?php
                                                                        if ($array_edit['req_condition_month1'] == 'กันยายน' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>กันยายน</option>
                                                                        <option value="ตุลาคม" <?php
                                                                        if ($array_edit['req_condition_month1'] == 'ตุลาคม' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>ตุลาคม</option>
                                                                        <option value="พฤศจิกายน" <?php
                                                                        if ($array_edit['req_condition_month1'] == 'พฤศจิกายน' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>พฤศจิกายน</option>
                                                                        <option value="ธันวาคม" <?php
                                                                        if ($array_edit['req_condition_month1'] == 'ธันวาคม' && $array_edit['req_condition'] == '4') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>ธันวาคม</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div><br><br><br>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="col-md-1"></div>
                                                                    <label class="col-md-5 control-label" style="text-align:left;">(3) ผู้รับประโยชน์กรณีสมาชิกถึงแก่กรรมข้าพเจ้ามอบให้ <b style="color:red;">*</b></label>
                                                                    <div class="col-md-2">
                                                                        <input type="text" class="form-control" name="req_beneficiary" value="<?= $array_edit['req_beneficiary'] ?>" id="req_beneficiary" required=""/>
                                                                    </div>
                                                                    <label class="col-md-1 control-label" style="text-align:left;">อายุ <b style="color:red;">*</b></label>
                                                                    <div class="col-md-2">
                                                                        <input type="number" class="form-control" name="req_beneficiary_age" value="<?= $array_edit['req_beneficiary_age'] ?>" id="req_beneficiary_age" required=""/>
                                                                    </div>
                                                                    <label class="col-md-1 control-label" style="text-align:left;">ปี</label>
                                                                </div>
                                                            </div>
                                                        </div><br>

                                                        <div class="form-group">
                                                            <div class="col-md-1"></div>
                                                            <label class="col-md-2 control-label" style="text-align:left;">ความสัมพันธ์เป็น <b style="color:red;">*</b></label>
                                                            <div class="col-md-2">
                                                                <input type="text" class="form-control" name="req_beneficiary_relation" value="<?= $array_edit['req_beneficiary_relation'] ?>" id="req_beneficiary_relation" required=""/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <?php
                                                        if (isset($_GET['reg_id']) != "") {
                                                            ?>
                                                            <div class="form-group">
                                                                <label class="col-md-2 control-label">ที่อยู่ <b style="color:red;">*</b></label>
                                                                <div class="col-md-10 col-xs-12">                                            
                                                                    <textarea class="form-control" name="req_beneficiary_address" rows="2" required=""><?= $array_edit['req_beneficiary_address'] ?></textarea>
                                                                </div>
                                                            </div>
                                                        <?php } else { ?>
                                                            <div class="form-group">
                                                                <div class="col-md-1"></div>
                                                                <label class="col-md-2 control-label" style="text-align:left;">อยู่บ้านเลขที่ <b style="color:red;">*</b></label>
                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control" name="req_beneficiary_address" id="req_beneficiary_address" required=""/>
                                                                </div>
                                                                <label class="col-md-1 control-label" style="text-align:left;">ถนน <b style="color:red;">*</b></label>
                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control" name="req_beneficiary_address2" id="req_beneficiary_address2" required=""/>
                                                                </div>
                                                                <label class="col-md-1 control-label" style="text-align:left;">ตำบล <b style="color:red;">*</b></label>
                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control" name="req_beneficiary_address3" id="req_beneficiary_address3" required=""/>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-md-1"></div>
                                                                <label class="col-md-1 control-label" style="text-align:left;">อำเภอ <b style="color:red;">*</b></label>
                                                                <div class="col-md-3">
                                                                    <input type="text" class="form-control" name="req_beneficiary_address4" id="req_beneficiary_address4" required=""/>
                                                                </div>
                                                                <label class="col-md-2 control-label" style="text-align:left;">จังหวัด <b style="color:red;">*</b></label>
                                                                <div class="col-md-3">
                                                                    <input type="text" class="form-control" name="req_beneficiary_address5" id="req_beneficiary_address5" required=""/>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-md-1"></div>
                                                            <label class="col-md-11 control-label" style="text-align:left;">(4) เมื่อข้าพเจ้าได้เป็นสมาชิกจะปฎิบัติตามระเบียบข้อบังคับกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธรทุกประการ</label>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-md-1"></div>
                                                            <label class="col-md-11 control-label" style="text-align:center;">(ลงชื่อ) <b><span id="output_reg_name"></span>  <span id="output_reg_lastname"></span></b></label>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-md-1"></div>
                                                            <label class="col-md-11 control-label" style="text-align:center;">(<b><span id="output_reg_title"></span><span id="output_reg_name2"></span>  <span id="output_reg_lastname2"></span></b>)</label>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-md-1"></div>
                                                            <label class="col-md-11 control-label" style="text-align:center;">ผู้สมัคร</label>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-md-1"></div>
                                                            <label class="col-md-11 control-label" style="text-align:left;">คณะกรรมการบริหารกองทุน พิจารณาอนุมัติให้เป็นสมาชิก</label>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-md-1"></div>
                                                            <label class="col-md-11 control-label" style="text-align:left;">วันที่.............เดือน....................พ.ศ.......................</label>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-md-1"></div>
                                                            <label class="col-md-11 control-label" style="text-align:center;">(...............................................)</label>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-md-1"></div>
                                                            <label class="col-md-11 control-label" style="text-align:center;">ประธานกรรมการบริหารกองทุน</label>
                                                        </div>
                                                    </div>
                                                </div><br>

                                                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>


                                            </div>

                                        </div>
                                    </div></div></div></div>
                        <div id="step-8">
                            <?php
                            if (isset($_GET['reg_id']) != "") {
                                ?>
                                <div class="form-group">
                                    <h3 style="text-align:center;">ใบสมัครเข้าเป็นสมาชิกกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร <b style="color:#1caf9a;">(กองทุนวันละบาท)</b><br>เทศบาลเมืองยโสธร</h3>
                                    <center><b>********************************</b></center>
                                    <p style="text-align:right;">เลขทะเบียนสมาชิก.....<b><?= $newid ?></b>.....</p>
                                    <p style="text-align:center;">วันที่.....<b><?= changedate($array_edit['reg_date']) ?></b>.....</p><br>
                                    <p style="text-align:left;">เรียน คณะกรรมการบริหารกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร</p>
                                    <p style="text-align:left;">&emsp;&emsp;&emsp;ข้าพเจ้าขอสมัครเป็นสมาชิกกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร และขอให้ถ้อยคำเป็นหลักฐานดังต่อไปนี้</p>
                                    <p style="text-align:left;">&emsp;&emsp;&emsp;
                                        (1) ข้าพเจ้า.....<b><?= $array_edit['reg_title'] ?><?= $array_edit['reg_name'] ?>  <?= $array_edit['reg_lastname'] ?></b>.....
                                        เลขประจำตัวประชาชน.....<b><?= $array_edit['reg_card'] ?></b>..... 
                                        เกิดวันที่ .....<b><?= $array_edit['reg_birthday'] ?></b>..... 
                                        อายุ .....<b><?= $array_edit['reg_age'] ?></b>..... 
                                        อาชีพ.....<b><?= $array_edit['reg_work'] ?></b>.....
                                        สถานภาพ.....<b><?= $array_edit['req_status'] ?></b>.....
                                        สัญชาติ.....<b><?= $array_edit['req_nationality'] ?></b>.....
                                        ที่อยู่ .....<b><?= $array_edit['req_address'] ?></b>..... 
                                        โทรศัพท์.....<b><?= $array_edit['req_tel'] ?></b>.....ได้รับทราบข้อความในระเบียบข้อบังคับกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร เข้าใจและเห็นชอบในวัตถุประสงค์ของกองทุนสวัสดิการ</p>        
                                    <p style="text-align:left;">&emsp;&emsp;&emsp;(2) ข้าพเจ้าสมัครใจส่งเงินสัจจะวันละ 1 บาท เข้ากองทุนสวัสดิการชุมชน ดังนี้</p>
                                    <p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;<b>
                                            <?php
                                            if ($array_edit['req_condition'] == '1') {
                                                echo 'ครั้งละ 1 บาท ส่งเงินทุกวัน ครั้งละ 30 บาท (30วัน) ส่งเงินวันที่ ' . $array_edit['req_condition_date1'] . ' ของทุกเดือน';
                                            } elseif ($array_edit['req_condition'] == 2) {
                                                echo 'ครั้งละ 90 บาท (90 วัน หรือ 3 เดือน) ส่งเงินวันที่ ' . $array_edit['req_condition_date1'] . ' เดือน ' . $array_edit['req_condition_month1'] . ' และวันที่ ' . $array_edit['req_condition_date2'] . ' เดือน ' . $array_edit['req_condition_month2'] . '';
                                            } elseif ($array_edit['req_condition'] == 3) {
                                                echo 'ครั้งละ 180 บาท (180 วัน หรือ 6 เดือน) ส่งเงินวันที่ ' . $array_edit['req_condition_date1'] . ' เดือน ' . $array_edit['req_condition_month1'] . ' และวันที่ ' . $array_edit['req_condition_date2'] . ' เดือน ' . $array_edit['req_condition_month2'] . '';
                                            } elseif ($array_edit['req_condition'] == 4) {
                                                echo 'ครั้งละ 360 บาท (360 วัน หรือ 1 ปี) ส่งเงินวันที่ ' . $array_edit['req_condition_date1'] . ' เดือน ' . $array_edit['req_condition_month1'] . ' และวันที่ ' . $array_edit['req_condition_date2'] . ' เดือน ' . $array_edit['req_condition_month2'] . '';
                                            }
                                            ?>
                                        </b></p>
                                    <p style="text-align:left;">&emsp;&emsp;&emsp;(3) หลักฐานการสมัคร</p>
                                    <p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;1.ค่าสมัคร 10 บาท</p>
                                    <p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;2.เงินสัจจะ (30 วัน) 30 บาท</p>
                                    <p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;3.สำเนาบัตรประจำตัวประชาชน</p>
                                    <p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;4.สำเนาทะเบียนบ้าน</p>
                                    <p style="text-align:left;">&emsp;&emsp;&emsp;
                                        (4) ผู้รับประโยชน์ กรณีสมาชิกถึงแก่กรรมข้าพเจ้าขอมอบให้.....<b><?= $array_edit['req_beneficiary'] ?></b>.....
                                        อายุ.....<b><?= $array_edit['req_beneficiary_age'] ?></b>.....ปี
                                        ความสัมพันธ์เป็น.....<b><?= $array_edit['req_beneficiary_relation'] ?></b>.....
                                        ที่อยู่.....<b><?= $array_edit['req_beneficiary_address'] ?></b>.....</p>
                                    <p style="text-align:left;">&emsp;&emsp;&emsp;(5) เมื่อข้าพเจ้าได้เป็นสมาชิกจะปฎิบัติตามระเบียบข้อบังคับของกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธรทุกประการ</p>
                                </div>
                            <?php } else { ?>
                                <div class="form-group">
                                    <h3 style="text-align:center;">ใบสมัครเข้าเป็นสมาชิกกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร <b style="color:#1caf9a;">(กองทุนวันละบาท)</b><br>เทศบาลเมืองยโสธร</h3>
                                    <center><b>********************************</b></center>
                                    <p style="text-align:right;">เลขทะเบียนสมาชิก.....<b><?= $newid ?></b>.....</p>
                                    <p style="text-align:center;">วันที่.....<b><?= changedate(date("Y-m-d")); ?></b>.....</p><br>
                                    <p style="text-align:left;">เรียน คณะกรรมการบริหารกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร</p>
                                    <p style="text-align:left;">&emsp;&emsp;&emsp;ข้าพเจ้าขอสมัครเป็นสมาชิกกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร และขอให้ถ้อยคำเป็นหลักฐานดังต่อไปนี้</p>
                                    <p style="text-align:left;">&emsp;&emsp;&emsp;
                                        (1) ข้าพเจ้า.....<b><span id="output_reg_title2"></span><span id="output_reg_name3"></span>  <span id="output_reg_lastname3"></span></b>.....
                                        เลขประจำตัวประชาชน.....<b><span id="output_reg_card"></span></b>..... 
                                        อาชีพ.....<b><span id="output_reg_work"></span></b>.....
                                        สถานภาพ.....<b><span id="output_req_status"></span></b>.....
                                        สัญชาติ.....<b><span id="output_req_nationality"></span></b>.....
                                        บ้านเลขที่ .....<b><span id="output_req_address1"></span></b>..... 
                                        ถนน.....<b><span id="output_req_address2"></span></b>.....
                                        ตำบล.....<b><span id="output_req_address3"></span></b>.....
                                        อำเภอ.....<b><span id="output_req_address4"></span></b>.....
                                        จังหวัด.....<b><span id="output_req_address5"></span></b>.....
                                        รหัสไปรษณีย์.....<b><span id="output_req_address6"></span></b>.....
                                        โทรศัพท์.....<b><span id="output_req_tel"></span></b>.....ได้รับทราบข้อความในระเบียบข้อบังคับกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร เข้าใจและเห็นชอบในวัตถุประสงค์ของกองทุนสวัสดิการ</p>        
                                    <p style="text-align:left;">&emsp;&emsp;&emsp;(2) ข้าพเจ้าสมัครใจส่งเงินสัจจะวันละ 1 บาท เข้ากองทุนสวัสดิการชุมชน ดังนี้</p>
                                    <p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;<b><span id="output_req_condition"></span></b></p>
                                    <p style="text-align:left;">&emsp;&emsp;&emsp;(3) หลักฐานการสมัคร</p>
                                    <p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;1.ค่าสมัคร 10 บาท</p>
                                    <p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;2.เงินสัจจะ (30 วัน) 30 บาท</p>
                                    <p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;3.สำเนาบัตรประจำตัวประชาชน</p>
                                    <p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;4.สำเนาทะเบียนบ้าน</p>
                                    <p style="text-align:left;">&emsp;&emsp;&emsp;
                                        (4) ผู้รับประโยชน์ กรณีสมาชิกถึงแก่กรรมข้าพเจ้าขอมอบให้.....<b><span id="output_req_beneficiary"></span></b>.....
                                        อายุ.....<b><span id="output_req_beneficiary_age"></span></b>.....ปี
                                        ความสัมพันธ์เป็น.....<b><span id="output_req_beneficiary_relation"></span></b>.....
                                        อยู่บ้านเลขที่.....<b><span id="output_req_beneficiary_address"></span></b>.....
                                        ถนน.....<b><span id="output_req_beneficiary_address2"></span></b>.....
                                        ตำบล.....<b><span id="output_req_beneficiary_address3"></span></b>.....
                                        อำเภอ.....<b><span id="output_req_beneficiary_address4"></span></b>.....
                                        จังหวัด.....<b><span id="output_req_beneficiary_address5"></span></b>.....</p>
                                    <p style="text-align:left;">&emsp;&emsp;&emsp;(5) เมื่อข้าพเจ้าได้เป็นสมาชิกจะปฎิบัติตามระเบียบข้อบังคับของกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธรทุกประการ</p>
                                </div>
                            <?php } ?>

                        </div>  
                    </div>  
                </form>
            </div>        
        </div>
        <script>
            $(document).ready(function () {
                $("#reg_title").change(function () {
                    var reg_title = this.value;
                    $('#output_reg_title').html(reg_title);
                    $('#output_reg_title2').html(reg_title);
                });
                $("#reg_name").keyup(function () {
                    var reg_name = this.value;
                    $('#output_reg_name').html(reg_name);
                    $('#output_reg_name2').html(reg_name);
                    $('#output_reg_name3').html(reg_name);
                });
                $("#reg_lastname").keyup(function () {
                    var reg_lastname = this.value;
                    $('#output_reg_lastname').html(reg_lastname);
                    $('#output_reg_lastname2').html(reg_lastname);
                    $('#output_reg_lastname3').html(reg_lastname);
                });
                $("#reg_card").keyup(function () {
                    var reg_card = this.value;
                    $('#output_reg_card').html(reg_card);
                });

                $("#reg_birthday").change(function () {
                    var d1 = new Date(this.value);
                    var d2 = new Date();
                    var years = d2.getFullYear() - d1.getFullYear();
                    $('#reg_age_new').val(years);
                    $('#output_reg_age').val(years);
                    $('#output_reg_birthday').val(d1);
                    

                });


                $("#reg_work").keyup(function () {
                    var reg_work = this.value;
                    $('#output_reg_work').html(reg_work);
                });
                $("#req_status").change(function () {
                    var req_status = this.value;
                    $('#output_req_status').html(req_status);
                });
                $("#req_nationality").keyup(function () {
                    var req_nationality = this.value;
                    $('#output_req_nationality').html(req_nationality);
                });
                $("#req_address1").keyup(function () {
                    var req_address1 = this.value;
                    $('#output_req_address1').html(req_address1);
                });
                $("#req_address2").keyup(function () {
                    var req_address2 = this.value;
                    $('#output_req_address2').html(req_address2);
                });
                $("#req_address3").keyup(function () {
                    var req_address3 = this.value;
                    $('#output_req_address3').html(req_address3);
                });
                $("#req_address4").keyup(function () {
                    var req_address4 = this.value;
                    $('#output_req_address4').html(req_address4);
                });
                $("#req_address5").keyup(function () {
                    var req_address5 = this.value;
                    $('#output_req_address5').html(req_address5);
                });
                $("#req_address6").keyup(function () {
                    var req_address6 = this.value;
                    $('#output_req_address6').html(req_address6);
                });
                $("#req_tel").keyup(function () {
                    var req_tel = this.value;
                    $('#output_req_tel').html(req_tel);
                });

                $("#req_beneficiary").change(function () {
                    var req_beneficiary = this.value;
                    $('#output_req_beneficiary').html(req_beneficiary);
                });
                $("#req_beneficiary_age").keyup(function () {
                    var req_beneficiary_age = this.value;
                    $('#output_req_beneficiary_age').html(req_beneficiary_age);
                });
                $("#req_beneficiary_relation").keyup(function () {
                    var req_beneficiary_relation = this.value;
                    $('#output_req_beneficiary_relation').html(req_beneficiary_relation);
                });
                $("#req_beneficiary_address").keyup(function () {
                    var req_beneficiary_address = this.value;
                    $('#output_req_beneficiary_address').html(req_beneficiary_address);
                });
                $("#req_beneficiary_address2").keyup(function () {
                    var req_beneficiary_address2 = this.value;
                    $('#output_req_beneficiary_address2').html(req_beneficiary_address2);
                });
                $("#req_beneficiary_address3").keyup(function () {
                    var req_beneficiary_address3 = this.value;
                    $('#output_req_beneficiary_address3').html(req_beneficiary_address3);
                });
                $("#req_beneficiary_address4").keyup(function () {
                    var req_beneficiary_address4 = this.value;
                    $('#output_req_beneficiary_address4').html(req_beneficiary_address4);
                });
                $("#req_beneficiary_address5").keyup(function () {
                    var req_beneficiary_address5 = this.value;
                    $('#output_req_beneficiary_address5').html(req_beneficiary_address5);
                });


                $("#req_condition").change(function () {
                    if ($('#req_condition').val() === '1') {
                        $("#req_condition_date1").change(function () {
                            var req_condition_date1 = this.value;
                            var req_condition = 'ครั้งละ 1 บาท ส่งเงินทุกวัน ครั้งละ 30 บาท (30วัน) ส่งเงินวันที่ ' + req_condition_date1 + ' ของทุกเดือน';
                            $('#output_req_condition').html(req_condition);
                        });
                    }
                });
                $("#req_condition2").change(function () {
                    if ($('#req_condition2').val() === '2') {
                        $("#req_condition_date2").change(function () {
                            var req_condition_date2 = this.value;
                            $("#req_condition_month2").change(function () {
                                var req_condition_month2 = this.value;
                                $("#req_condition_date3").change(function () {
                                    var req_condition_date3 = this.value;
                                    $("#req_condition_month3").change(function () {
                                        var req_condition_month3 = this.value;
                                        var req_condition2 = 'ครั้งละ 90 บาท (90 วัน หรือ 3 เดือน) ส่งเงินวันที่ ' + req_condition_date2 + ' เดือน ' + req_condition_month2 + ' และวันที่ ' + req_condition_date3 + ' เดือน ' + req_condition_month3 + '';
                                        $('#output_req_condition').html(req_condition2);
                                    });
                                });
                            });
                        });
                    }
                });
                $("#req_condition3").change(function () {
                    if ($('#req_condition3').val() === '3') {
                        $("#req_condition_date4").change(function () {
                            var req_condition_date4 = this.value;
                            $("#req_condition_month4").change(function () {
                                var req_condition_month4 = this.value;
                                $("#req_condition_date5").change(function () {
                                    var req_condition_date5 = this.value;
                                    $("#req_condition_month5").change(function () {
                                        var req_condition_month5 = this.value;
                                        var req_condition3 = 'ครั้งละ 180 บาท (180 วัน หรือ 6 เดือน) ส่งเงินวันที่ ' + req_condition_date4 + ' เดือน ' + req_condition_month4 + ' และวันที่ ' + req_condition_date5 + ' เดือน ' + req_condition_month5 + '';
                                        $('#output_req_condition').html(req_condition3);
                                    });
                                });
                            });
                        });
                    }
                });
                $("#req_condition4").change(function () {
                    if ($('#req_condition4').val() === '4') {
                        $("#req_condition_date6").change(function () {
                            var req_condition_date6 = this.value;
                            $("#req_condition_month6").change(function () {
                                var req_condition_month6 = this.value;
                                $("#req_condition_date7").change(function () {
                                    var req_condition_date7 = this.value;
                                    $("#req_condition_month7").change(function () {
                                        var req_condition_month7 = this.value;
                                        var req_condition4 = 'ครั้งละ 360 บาท (360 วัน หรือ 1 ปี) ส่งเงินวันที่ ' + req_condition_date6 + ' เดือน ' + req_condition_month6 + ' และวันที่ ' + req_condition_date7 + ' เดือน ' + req_condition_month7 + '';
                                        $('#output_req_condition').html(req_condition4);
                                    });
                                });
                            });
                        });
                    }
                });


                $('.frmdis').attr('disabled', true);
                $('#req_condition').click(function () {
                    if ($(this).is(':checked')) {
                        $('.frmdis').attr('disabled', false);
                        $('.frmdis2').attr('disabled', true);
                        $('.frmdis3').attr('disabled', true);
                        $('.frmdis4').attr('disabled', true);
                    } else {
                        $('.frmdis').attr('disabled', true);
                    }
                });
                $('.frmdis2').attr('disabled', true);
                $('#req_condition2').click(function () {
                    if ($(this).is(':checked')) {
                        $('.frmdis2').attr('disabled', false);
                        $('.frmdis').attr('disabled', true);
                        $('.frmdis3').attr('disabled', true);
                        $('.frmdis4').attr('disabled', true);
                    } else {
                        $('.frmdis2').attr('disabled', true);
                    }
                });
                $('.frmdis3').attr('disabled', true);
                $('#req_condition3').click(function () {
                    if ($(this).is(':checked')) {
                        $('.frmdis3').attr('disabled', false);
                        $('.frmdis').attr('disabled', true);
                        $('.frmdis2').attr('disabled', true);
                        $('.frmdis4').attr('disabled', true);
                    } else {
                        $('.frmdis3').attr('disabled', true);
                    }
                });
                $('.frmdis4').attr('disabled', true);
                $('#req_condition4').click(function () {
                    if ($(this).is(':checked')) {
                        $('.frmdis4').attr('disabled', false);
                        $('.frmdis2').attr('disabled', true);
                        $('.frmdis3').attr('disabled', true);
                        $('.frmdis').attr('disabled', true);
                    } else {
                        $('.frmdis4').attr('disabled', true);
                    }
                });
            });
        </script>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->

        <!-- END WIZARD WITH VALIDATION -->
        <!-- START PRELOADS -->
        <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->                

        <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>                
        <!-- END PLUGINS -->

        <!-- THIS PAGE PLUGINS -->    
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>

        <script type="text/javascript" src="js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>        
        <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.js"></script>
        <!-- END PAGE PLUGINS -->

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="js/settings.js"></script>

        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>        
        <!-- END TEMPLATE -->
        <!-- END SCRIPTS -->    

    </body>
</html>




