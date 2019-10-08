<?php
@session_start();
include "connect_db.php";
ob_start();
require_once('mpdf/mpdf.php');
?>
<?php
$sql_print = "select * from get_benefits d "
        . "join member m on m.mem_id = d.mem_id join benefits b on b.ben_id = d.ben_id "
        . "left join authorities a on a.aut_id = d.aut_id "
        . "where d.get_id='" . $_GET['get_id'] . "' order by d.get_id desc ";
$query_print = mysqli_query($connect, $sql_print);
$array_print = mysqli_fetch_array($query_print);
?>
<table width="100%" border="0" align="center" cellspacing="0">
    <tr>
        <td colspan="2" style="text-align: right;">
            เลขที่ <b><?= $array_print['get_id'] ?></b><br><br><br>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center;"><h3>แบบคำขอรับเงินค่าสวัสดิการสมาชิกกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร</h3></td>
    </tr>
    <tr>
        <td style="width: 50%;"></td>
        <td style="text-align: left;"><br>
            เขียนที่ กองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center;">
            <br>วันที่ <b><?php echo DateThai2($array_print['get_date']); ?></b>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: left;">
            <br>
            &nbsp;&nbsp;&nbsp;ด้วยข้าพเจ้า ชื่อ <b><?= $array_print['reg_name'] ?>  <?= $array_print['reg_lastname'] ?></b> เกิดวันที่ <b><?= DateThai2($array_print['reg_birthday']); ?></b> อายุ <b><?= $array_print['reg_age'] ?></b> สัญชาติ <b><?= $array_print['req_nationality'] ?></b>
            มีชื่ออยู่ในสำเนาทะเบียนบ้านเลขที่ <b><?= $array_print['req_address'] ?></b> โทรศัพท์ <b><?= $array_print['req_tel'] ?></b> หมายเลขบัตรประจำตัวประชาชน <b><?= $array_print['reg_card'] ?></b> 
            เป็นสมาชิกกองทุนสวัสดิการชุมชนเมื่อวันที่ <b><?= $array_print['mem_date'] ?></b> เลขที่สมาชิก <b><?= $array_print['mem_id'] ?></b>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: left;">
            <br>
            &nbsp;&nbsp;&nbsp;มีความประสงค์ขอรับเงิน สวัสดิการสมาชิกกองทุนสวัสดิการชุมชน 
            เงินสวัสดิการประเภท <b><?= $array_print['ben_category'] ?></b>
            ตั้งแต่ <b><?php if($array_print['get_condition1'] == '0000-00-00'){ echo ".......-.......";}else{ echo $array_print['get_condition1']; }  ?></b> จำนวน <b><?php if($array_print['get_condition2'] == '0.00'){ echo ".......-.......";}else{ echo $array_print['get_condition2']; }  ?></b> วัน<br>
            <br><br>พร้อมคำขอนี้ข้าพเจ้าได้ยื่นเอกสารประกอบด้วย<br><br>
            <?php
            $sql_basic2 = "select * from benefits where ben_id = '" . $array_print['ben_id'] . "'";
            $query_basic2 = mysqli_query($connect, $sql_basic2);
            $array_basic2 = mysqli_fetch_array($query_basic2);
                ?>
                <?php
                if ($array_basic2['ben_document1'] == 1) {
                    echo " - สำเนาบัตรประชาชน<br><br>";
                }
                if ($array_basic2['ben_document2'] == 1) {
                    echo " - สำเนาทะเบียนบ้าน<br><br>";
                }
                if ($array_basic2['ben_document3'] == 1) {
                    echo " - สมุดการเป็นสมาชิกกองทุน<br><br>";
                }
                if ($array_basic2['ben_document4'] == 1) {
                    echo " - สำเนาใบแจ้งเกิดลูก<br><br>";
                }
                if ($array_basic2['ben_document5'] == 1) {
                    echo " - สำเนาสูติบัตรลูก<br><br>";
                }
                if ($array_basic2['ben_document6'] == 1) {
                    echo " - ใบรับรองการนอนรักษาตัวในโรงพยาบาล<br><br>";
                }
                if ($array_basic2['ben_document7'] == 1) {
                    echo " - สำเนาใบมรณะบัตร<br><br>";
                }
                if ($array_basic2['ben_document8'] == 1) {
                    echo " - กรณีมอบฉันทะ สำเนาบัตรประจำตัวประชาชน<br><br>";
                }
                if ($array_basic2['ben_document9'] == 1) {
                    echo " - กรณีมอบฉันทะ สำเนาทะเบียนบ้าน<br><br>";
                }
                ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: left;">
            <br>
            &nbsp;&nbsp;&nbsp;ข้าพเจ้าขอรับรองว่าข้าพเจ้าเป็นผู้มีสิทธิ์ได้รับเงินสวัสดิการชุมชนเทศบาลเมืองยโสธร และขอรับรองว่าข้อความดังกล่าวข้างต้น เป็นความจริงทุกประการ

        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center;">
            <br><br>(ลายมือชื่อ)......<?= $array_print['mem_name'] ?>...<?= $array_print['mem_lastname'] ?>......ผู้ยื่นคำขอ<br><br>
            <br><br>(ลายมือชื่อ)......<?= $array_print['aut_name'] ?>...<?= $array_print['aut_lastname'] ?>......ผู้อนุมัติ<br><br>
        </td>
    </tr>
     <?php
        if($array_basic2['ben_id'] == 'BEN-000016'){
            $total = $array_basic2['ben_condition1']+($array_basic2['ben_condition5']*$array_basic2['get_condition2']);
        }else{
            $total = $array_basic2['ben_condition1'];
        }
        ?>
    <tr>
        <td colspan="2" style="text-align: left;">
            <br><br>ข้าพเจ้าได้รับเงินค่าสวัสดิการจากกองทุนสวัสดิการชุมชนจำนวน <b><?= number_format($total,2); ?></b> บาท (<?php echo Convert($total); ?>) เป็นการถูกต้องแล้ว<br><br>
            วันที่.........เดือน...............พ.ศ..................
        </td>
    </tr>
    <tr>
        <td style="text-align: center;">
            <br>ลงชื่อ..............................ผู้รับเงิน<br><br>
            (...............................)
        </td>
        <td style="text-align: center;">
            <br>ลงชื่อ..............................ผู้จ่ายเงิน<br><br>
            (...............................)
        </td>
    </tr>
</table>   
<?Php
$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A4', '0', 'THSaraban'); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>