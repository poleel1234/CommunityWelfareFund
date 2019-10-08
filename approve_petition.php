<?php
session_start();
$pagename = 'approve_petition';
include "connect_db.php";
$sql_register = "select * from petition d "
. "join member m on m.mem_id = d.mem_id join benefits b on b.ben_id = d.ben_id "
. "left join authorities a on a.aut_id = d.aut_id WHERE d.pet_id = '" . $_GET['pet_id'] . "' "
. "order by d.pet_id desc";
$query_register = mysqli_query($connect, $sql_register);
$array_register = mysqli_fetch_array($query_register);
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
</style>
<div class="form-group">
    <h4 style="text-align:center;"><b>ใบคำร้องขอกู้เงินเพื่อพัฒนาคุณภาพชีวิต</b> <b style="color:#330099;">(กองสวัสดิการสังคม)</b><br><b>เทศบาลเมืองยโสธร</b></h4>
    <center><b style="color: black;">********************************</b></center>
    <input type="hidden" id="get_id" value="<?=$_GET['get_id']?>">
                                <p style="text-align:right;">เลขที่.....<b><?=$array_register['pet_id']?></b>.....</p>
                                <p style="text-align:center;">วันที่.....<b><?=changedate($array_register['pet_date'])?></b>.....</p><br>
                                <p style="text-align:left;">&emsp;&emsp;&emsp;เรื่อง ขอกู้เงินประเภทเงินกู้เพื่อพัฒนาคุณภาพชีวิต .......<b><?=$array_register['pet_type']?></b> ......</p>
                                <p style="text-align:left;">&emsp;&emsp;&emsp;เรียน ผู้จัดการสถาบันการเงินชุมชนเทศบาลเมืองยโสธร</p>
                                <p style="text-align:left;">&emsp;&emsp;&emsp;ด้วยข้าพเจ้า ชื่อ.....<b><?=$array_register['mem_name']?>  <?=$array_register['mem_lastname']?></b>.....
                                    เกิดวันที่ .....<b><?=$array_register['mem_birthday']?></b>..... 
                                    อายุ .....<b><?=$array_register['mem_age']?></b>..... 
                                    สัญชาติ.....<b><?=$array_register['mem_nationality']?></b>.....
                                    มีชื่อที่อยู่ในสำเนาทะเบียนบ้านเลขที่.....<b><?=$array_register['mem_address']?></b>.....
                                    โทรศัพท์.....<b><?=$array_register['mem_tel']?></b>.....
                                    เลขประจำตัวประชาชน .....<b><?=$array_register['mem_card']?></b>..... 
                                    เป็นสมาชิกกองสวัสดิการชุมชนเมื่อวันที่.....<b><?=changedate($array_register['mem_date'])?></b>..... 
                                    เลขที่สมาชิก.....<b><?=$array_register['mem_id']?></b>.....</p>    <br>    
                                <p style="text-align:left;">&emsp;&emsp;&emsp;มีความประสงค์จะขอกู้เงินประเภทเงินกู้เพื่อพัฒนาคุณภาพชีวิต จากสถาบันการเงินชุมชนเทศบาลเมืองยโสธร ประเภท  .....<b><?=$array_register['ben_category']?></b>..... เป็นจำนวนเงิน .....<b><?=$array_register['amount']?></b>.....บาท</p>
                                <p style="text-align:left;">&emsp;&emsp;&emsp;ปัจจุบันข้าพเจ้า มีหุ้นในสถาบันการเงิน .....<b><?=$array_register['share']?></b>.....บาท</p>
<p style="text-align:left;">&emsp;&emsp;&emsp;มีรายได้อื่นๆ เดือนละ .....<b><?=$array_register['income']?></b>.....บาท</p>
<p style="text-align:left;">&emsp;&emsp;&emsp;เบี้ยยังชีพ เดือนละ .....<b><?=$array_register['allowance']?></b>.....บาท</p>
                               
                                <p style="text-align:left;">&emsp;&emsp;&emsp;รายชื่อผู้กู้ร่วมดังนี้</p>
                                 <?php
    $n = 0;
    $sql_print2 = "select * from petition_detail r join member m on m.mem_id = r.mem_id  where r.pet_id='" . $_GET['pet_id'] . "'";
    $query_print2 = mysqli_query($connect, $sql_print2);
    while ($array_print2 = mysqli_fetch_array($query_print2)) {
        $n++;
        $me = $array_print2['mem_birthday'];
        $Y = date("Y");
        $YE2 = date("Y", strtotime($me));
        $D2 = $Y - $YE2;
        ?>
         <p style="text-align:left;">&emsp;&emsp;&emsp;
                         <?= $n ?>. <?= $array_print2['mem_id'] ?>  <?= $array_print2['mem_title'] ?><?= $array_print2['mem_name'] ?> <?= $array_print2['mem_lastname']?> อายุ <?=$D2;?> เป็นสมาชิกตั้งแต่ <?= changedate($array_print2['mem_date']); ?>
</p>                       
    <?php } ?>
</p>
</div>
<?php
if($_GET['aut_id'] == '' && $_SESSION['login_reg_id'] == ''){
?>
<a href="approve_petition_save.php?pet_id=<?=$array_register['pet_id']?>"><button type="button" class="btn btn-primary btn-lg">อนุมัติ</button></a>
<?php } ?>   