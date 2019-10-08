<?php
session_start();
$pagename = 'register_approve';
include "connect_db.php";
$sql_register = "select * from register where reg_id = '" . $_GET['reg_id'] . "' order by reg_id desc";
$query_register = mysqli_query($connect, $sql_register);
$array_register = mysqli_fetch_array($query_register);
if ($array_register['req_condition'] == '1') {
    $req_condition_output = 'ครั้งละ 1 บาท ส่งเงินทุกวัน ครั้งละ 30 บาท (30วัน) ส่งเงินวันที่ ' . $array_register['req_condition_date1'] . ' ของทุกเดือน';
} elseif ($array_register['req_condition'] == '2') {
    $req_condition_output = 'ครั้งละ 90 บาท (90 วัน หรือ 3 เดือน) ส่งเงินวันที่ ' . $array_register['req_condition_date1'] . ' เดือน ' . $array_register['req_condition_month1'] . ' และวันที่ ' . $array_register['req_condition_date2'] . ' เดือน ' . $array_register['req_condition_month2'] . '';
} elseif ($array_register['req_condition'] == '3') {
    $req_condition_output = 'ครั้งละ 180 บาท (180 วัน หรือ 6 เดือน) ส่งเงินวันที่ ' . $array_register['req_condition_date1'] . ' เดือน ' . $array_register['req_condition_month1'] . ' และวันที่ ' . $array_register['req_condition_date2'] . ' เดือน ' . $array_register['req_condition_month2'] . '';
} elseif ($array_register['req_condition'] == '4') {
    $req_condition_output = 'ครั้งละ 360 บาท (360 วัน หรือ 1 ปี) ส่งเงินวันที่ ' . $array_register['req_condition_date1'] . ' เดือน ' . $array_register['req_condition_month1'] . ' และวันที่ ' . $array_register['req_condition_date2'] . ' เดือน ' . $array_register['req_condition_month2'] . '';
}
if ($_GET['reg_id'] != '' || $_GET['reg_id'] != null) {
    $_SESSION['ss_reg_id'] = $_GET['reg_id'];
    $_SESSION['ss_req_state'] = $_GET['req_state'];
}
?>
<style>
    p {
        color: black;
    }
    .message-box.message-box-info .mb-container2 {
        background: rgba(228, 146, 63, 0.9);
    }
    .message-box .mb-container2 {
        /* position: absolute; */
        left: 0px;
        top: 5%;
        background: rgba(0, 0, 0, 0.9);
        padding: 20px;
        width: 100%;
        height: 100%;
    }
    .message-box.message-box-warning .mb-container_warning {
        background: rgba(255, 69, 0, 0.9);
    }
    .message-box .mb-container_warning {
        /* position: absolute; */
        left: 25px;
        top: 25%;
        background: rgba(255, 69, 0, 0.9);
        padding: 20px;
        width: 50%;
        height: 50%;
    }
</style>
<div>
    <h4 style="text-align:center;"><b>ใบสมัครเข้าเป็นสมาชิกกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร</b> <b style="color:#330099;">(กองทุนวันละบาท)</b><br><b>เทศบาลเมืองยโสธร</b></h4>
    <center><b style="color: black;">********************************</b></center>
    <input type="hidden" id="req_id" value="<?= $_GET['reg_id'] ?>">
    <p style="text-align:right;">เลขทะเบียนสมาชิก.....<b><?= $_SESSION['ss_reg_id'] ?></b>.....</p>
    <p style="text-align:center;">เขียนที่.....<b><?= $array_register['reg_write'] ?></b>.....</p>
    <p style="text-align:center;">วันที่.....<b><?= changedate(date("Y-m-d")); ?></b>.....</p><br>
    <p style="text-align:left;">เรียน คณะกรรมการบริหารกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร</p>
    <p style="text-align:left;">&emsp;&emsp;&emsp;ข้าพเจ้าขอสมัครเป็นสมาชิกกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร และขอให้ถ้อยคำเป็นหลักฐานดังต่อไปนี้</p>
    <p style="text-align:left;">&emsp;&emsp;&emsp;
        (1) ข้าพเจ้า.....<b><?= $array_register['req_title'] ?><?= $array_register['reg_name'] ?>  <?= $array_register['reg_lastname'] ?></b>.....
        เลขประจำตัวประชาชน.....<b><?= $array_register['reg_card'] ?></b>..... 
        เกิดวันที่ .....<b><?= $array_register['reg_birthday'] ?></b>..... 
        อายุ .....<b><?= $array_register['reg_age'] ?></b>..... 
        อาชีพ.....<b><?= $array_register['reg_work'] ?></b>.....
        สถานภาพ.....<b><?= $array_register['req_status'] ?></b>.....
        สัญชาติ.....<b><?= $array_register['req_nationality'] ?></b>.....
        ที่อยู่ .....<b><?= $array_register['req_address'] ?></b>..... 
        โทรศัพท์.....<b><?= $array_register['req_tel'] ?></b>.....ได้รับทราบข้อความในระเบียบข้อบังคับกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร เข้าใจและเห็นชอบในวัตถุประสงค์ของกองทุนสวัสดิการ</p>        
    <p style="text-align:left;">&emsp;&emsp;&emsp;(2) ข้าพเจ้าสมัครใจส่งเงินสัจจะวันละ 1 บาท เข้ากองทุนสวัสดิการชุมชน ดังนี้</p>
    <p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;<b><?= $req_condition_output ?></b></p>
    <p style="text-align:left;">&emsp;&emsp;&emsp;(3) หลักฐานการสมัคร</p>
    <p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;1.ค่าสมัคร 10 บาท</p>
    <p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;2.เงินสัจจะ (30 วัน) 30 บาท</p>
    <p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;3.สำเนาบัตรประจำตัวประชาชน</p>
    <p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;4.สำเนาทะเบียนบ้าน</p>
    <p style="text-align:left;">&emsp;&emsp;&emsp;
        (4) ผู้รับประโยชน์ กรณีสมาชิกถึงแก่กรรมข้าพเจ้าขอมอบให้.....<b><?= $array_register['req_beneficiary'] ?></b>.....
        อายุ.....<b><?= $array_register['req_beneficiary_age'] ?></b>.....ปี
        ความสัมพันธ์เป็น.....<b><?= $array_register['req_beneficiary_relation'] ?></b>.....
        ที่อยู่.....<b><?= $array_register['req_beneficiary_address'] ?></b>.....
    </p>
    <p style="text-align:left;">&emsp;&emsp;&emsp;(5) เมื่อข้าพเจ้าได้เป็นสมาชิกจะปฎิบัติตามระเบียบข้อบังคับของกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธรทุกประการ</p>

<?php
if ($_GET['req_state'] == 0 && $_SESSION['login_reg_id'] == '') {
    ?>
    <a href="register_approve_save.php?reg_id=<?= $_SESSION['ss_reg_id'] ?>"><button type="button" class="btn btn-primary btn-lg">อนุมัติ</button></a>
    <a class="senddatamodal_warning data-detail_warning" data-box="#message-box-warning" data-url="register_approve_line2.php?reg_id=<?= $_SESSION['ss_reg_id'] ?>&mode=fail"><button type="button" class="btn btn-primary btn-lg">ไม่อนุมัติ</button> </a>
<?php } ?>   
</div>

<script>
    $(".data-detail_warning").click(function () {
        $('#message-box-warning').addClass('open');
    });
</script>
<div style="background-color:red;" class="message-box message-box-warning animated fadeIn" id="message-box-warning">
    <div class="mb-container_warning">
        <div class="mb-middle_warning">
            <div class="mb-title3"><span class="fa fa-info"></span> Information</div>
            <div class="mb-content_warning">

            </div>
        </div>
    </div>
</div>
<script>
    $(".senddatamodal_warning").click(function () {
        var url = $(this).attr('data-url');
        $.ajax({
            url: url,
            type: "GET",
            success: function (data) { //Complete
                $(".mb-content_warning").empty();
                $(".mb-content_warning").html(data);
            }
        });
    });
</script>