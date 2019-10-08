<?php
session_start();
$pagename = 'approve_get_benefits';
include "connect_db.php";
$sql_register = "SELECT * FROM get_benefits g 
JOIN member m on m.mem_id = g.mem_id 
JOIN benefits b on b.ben_id = g.ben_id 
LEFT JOIN authorities a on a.aut_id = g.aut_id 
WHERE g.get_id = '" . $_GET['get_id'] . "'";
$query_register = mysqli_query($connect, $sql_register);
$array_register = mysqli_fetch_array($query_register);

$memdate2 = $array_register['mem_birthday'];
$YearStart2 = date("Y");
$YearEnd2 = date("Y", strtotime($memdate2));
$DateNum2 = $YearStart2 - $YearEnd2;
if ($_GET['get_id'] != '') {
    $_SESSION['ss_get_id'] = $_GET['get_id'];
}
?>
<style>
/* unvisited link */
a:link {
    color: #000099;
}

/* visited link */
a:visited {
    color: #00FF99;
}

/* mouse over link */
a:hover {
    color: #003399;
}

/* selected link */
a:active {
    color: blue;
}
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
<div class="form-group">
    <h4 style="text-align:center;"><b>แบบคำขอรับเงินค่าสวัสดิการสมาชิกกองทุนสวัสดิการชุมชน</b> <b style="color:#330099;">(กองสวัสดิการสังคม)</b><br><b>เทศบาลเมืองยโสธร</b></h4>
    <center><b style="color: black;">********************************</b></center>
    <input type="hidden" id="get_id" value="<?=$_GET['get_id']?>">
                                <p style="text-align:right;">เลขที่.....<b><?=$array_register['get_id']?></b>.....</p>
                                <p style="text-align:center;">วันที่.....<b><?=changedate($array_register['get_date'])?></b>.....</p><br>
                                <p style="text-align:left;">&emsp;&emsp;&emsp;ด้วยข้าพเจ้า ชื่อ.....<b><?=$array_register['mem_name']?>  <?=$array_register['mem_lastname']?></b>.....
                                    เกิดวันที่ .....<b><?=$array_register['mem_birthday']?></b>..... 
                                    อายุ .....<b><?=$DateNum2?></b>..... 
                                    สัญชาติ.....<b><?=$array_register['mem_nationality']?></b>.....
                                    มีชื่อที่อยู่ในสำเนาทะเบียนบ้านเลขที่.....<b><?=$array_register['mem_address']?></b>.....
                                    โทรศัพท์.....<b><?=$array_register['mem_tel']?></b>.....
                                    เลขประจำตัวประชาชน .....<b><?=$array_register['mem_card']?></b>..... 
                                    เป็นสมาชิกกองสวัสดิการชุมชนเมื่อวันที่.....<b><?=changedate($array_register['mem_date'])?></b>..... 
                                    เลขที่สมาชิก.....<b><?=$array_register['mem_id']?></b>.....</p>    <br>    
                                <p style="text-align:left;">&emsp;&emsp;&emsp;มีความประสงค์ขอรับเงิน สวัสดิการสมาชิกกองทุนสวัสดิการชุมชน .....<b><?=$array_register['ben_category']?></b>.....</p>
                                <?php if($array_register['get_condition2'] != '0.00'){ ?><p style="text-align:left;">&emsp;&emsp;&emsp;เงินสวัสดิการในการนอนรักษาพยาบาล ตั้งแต่ .....<b><?=$array_register['get_condition1']?></b>.....จำนวน.....<b><?= number_format($array_register['get_condition2'],0)?></b>..วัน</p><?php } ?>
                                <p style="text-align:left;">&emsp;&emsp;&emsp;พร้อมคำขอนี้ข้าพเจ้าได้ยื่นเอกสารประกอบด้วย</p>
                                <?php if($array_register['Copy1'] != '../CommunityWelfareFund/img/file/'){ ?><p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<a href="<?= $array_register['Copy1'] ?>" target="_blank"><b>- สำเนาบัตรประจำตัวประชาชน</b></a></p><?php } ?>
                                <?php if($array_register['Copy2'] != '../CommunityWelfareFund/img/file/'){ ?><p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<a href="<?= $array_register['Copy2'] ?>" target="_blank"><b>- สำเนาทะเบียนบ้าน</b></a></p><?php } ?>
                                <?php if($array_register['Copy3'] != '../CommunityWelfareFund/img/file/'){ ?><p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<a href="<?= $array_register['Copy3'] ?>" target="_blank"><b>- สมุดการเป็นสมาชิกกองทุน</b></a></p><?php } ?>
                                <?php if($array_register['Copy4'] != '../CommunityWelfareFund/img/file/'){ ?><p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<a href="<?= $array_register['Copy4'] ?>" target="_blank"><b>- สำเนาใบแจ้งเกิดลูก</b></a></p><?php } ?>
                                <?php if($array_register['Copy5'] != '../CommunityWelfareFund/img/file/'){ ?><p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<a href="<?= $array_register['Copy5'] ?>" target="_blank"><b>- สำเนาสูติบัตรลูก</b></a></p><?php } ?>
                                <?php if($array_register['Copy6'] != '../CommunityWelfareFund/img/file/'){ ?><p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<a href="<?= $array_register['Copy6'] ?>" target="_blank"><b>- ใบรับรองการนอนรักษาตัวในโรงพยาบาล</b></a></p><?php } ?>
                                <?php if($array_register['Copy7'] != '../CommunityWelfareFund/img/file/'){ ?><p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<a href="<?= $array_register['Copy7'] ?>" target="_blank"><b>- สำเนาใบมรณะบัตร</b></a></p><?php } ?>
                                <?php if($array_register['Copy8'] != '../CommunityWelfareFund/img/file/'){ ?><p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<a href="<?= $array_register['Copy8'] ?>" target="_blank"><b>- กรณีมอบฉันทะ สำเนาบัตรประจำตัวประชาชน</b></a></p><br><?php } ?>
                                <?php if($array_register['Copy9'] != '../CommunityWelfareFund/img/file/'){ ?><p style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<a href="<?= $array_register['Copy9'] ?>" target="_blank"><b>- กรณีมอบฉันทะ สำเนาทะเบียนบ้าน</b></a></p><br><?php } ?>
                                <p style="text-align:left;">&emsp;&emsp;&emsp;ข้าพเจ้าขอรับรองว่าข้าพเจ้าเป็นผู้มีสิทธิ์ได้รับเงินสวัสดิการชุมชนเทศบาลเมืองยโสธร และขอรับรองว่าข้อความดังกล่าวข้างต้น เป็นความจริงทุกประการ</p>
</div>
<?php
if($_GET['get_state'] == 0 && $_SESSION['login_reg_id'] == ''){
?>
<a href="approve_get_benefits_save.php?get_id=<?=$array_register['get_id']?>"><button type="button" class="btn btn-primary btn-lg">อนุมัติ</button></a>
    <a class="senddatamodal_warning data-detail_warning"
       data-box="#message-box-warning" data-url="approve_get_benefits2.php?get_id=<?= $_SESSION['ss_get_id'] ?>&mode=fail">
       <button type="button" class="btn btn-primary btn-lg">ไม่อนุมัติ</button> 
        </a>
<?php } ?>   
    <script>
    $(".data-detail_warning").click(function () {
        $('#message-box-warning').addClass('open');
    });
</script>
<div class="message-box message-box-warning animated fadeIn" id="message-box-warning">
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