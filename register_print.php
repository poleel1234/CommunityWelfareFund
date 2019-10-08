<?php
@session_start();
include "connect_db.php";
ob_start();
require_once('mpdf/mpdf.php');
?>
<?php
$sql_print = "select * from register r  where r.reg_id='" . $_GET['reg_id'] . "'";
$query_print = mysqli_query($connect, $sql_print);
$array_print = mysqli_fetch_array($query_print);
if ($array_print['req_condition'] == '1') {
    $req_condition_output = 'ครั้งละ 1 บาท ส่งเงินทุกวัน ครั้งละ 30 บาท (30วัน) ส่งเงินวันที่ ' . $array_print['req_condition_date1'] . ' ของทุกเดือน';
} elseif ($array_print['req_condition'] == 2) {
    $req_condition_output = 'ครั้งละ 90 บาท (90 วัน หรือ 3 เดือน) ส่งเงินวันที่ ' . $array_print['req_condition_date1'] . ' เดือน ' . $array_print['req_condition_month1'] . ' และวันที่ ' . $array_print['req_condition_date2'] . ' เดือน ' . $array_print['req_condition_month2'] . '';
} elseif ($array_print['req_condition'] == 3) {
    $req_condition_output = 'ครั้งละ 180 บาท (180 วัน หรือ 6 เดือน) ส่งเงินวันที่ ' . $array_print['req_condition_date1'] . ' เดือน ' . $array_print['req_condition_month1'] . ' และวันที่ ' . $array_print['req_condition_date2'] . ' เดือน ' . $array_print['req_condition_month2'] . '';
} elseif ($array_print['req_condition'] == 4) {
    $req_condition_output = 'ครั้งละ 360 บาท (360 วัน หรือ 1 ปี) ส่งเงินวันที่ ' . $array_print['req_condition_date1'] . ' เดือน ' . $array_print['req_condition_month1'] . ' และวันที่ ' . $array_print['req_condition_date2'] . ' เดือน ' . $array_print['req_condition_month2'] . '';
}
?>
<table width="100%" border="0" align="center" cellspacing="0">
    <tr>
        <td colspan="2" style="text-align: center;"><h3>ใบสมัครเข้าเป็นสมาชิกกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร (กองทุนวันละบาท)<br><br>เทศบาลเมืองยโสธร<br>********************</h3></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: right;">
            เลขทะเบียนสมาชิก <b><?= $array_print['reg_id'] ?></b><br>(เจ้าหน้าที่กรอก)
        </td>
    </tr>
    <tr>
        <td style="width: 50%;"></td>
        <td style="text-align: left;"><br>
            เขียนที่ กองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center;">
            <br>วันที่ <b><?php echo DateThai2($array_print['reg_date']); ?></b>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: left;">
            <br>เรียน คณะกรรมการบริหารกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: left;">
            <br>
            &nbsp;&nbsp;&nbsp;ข้าพเจ้าขอสมัครเป็นสมาชิกกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร และขอให้ถ้อยคำเป็นหลักฐานดังต่อไปนี้
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: left;">
            <br>
            &nbsp;&nbsp;&nbsp;(1) ข้าพเจ้า <b><?= $array_print['reg_name'] ?>  <?= $array_print['reg_lastname'] ?></b> เลขประจำตัวประชาชน <b><?= $array_print['reg_card'] ?></b> เกิดวันที่ <b><?= DateThai2($array_print['reg_birthday']); ?></b>
            อายุ <b><?= $array_print['reg_age'] ?></b> อาชีพ <b><?= $array_print['reg_work'] ?></b> สถานภาพ <b><?= $array_print['req_status'] ?></b> สัญชาติ <b><?= $array_print['req_nationality'] ?></b> บ้านเลขที่ <b><?= $array_print['req_address'] ?></b> โทรศัพท์ <b><?= $array_print['req_tel'] ?></b> 
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: left;">
            <br>
            ได้รับทราบข้อความในระเบียบข้อบังคับกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร เข้าใจและเห็นชอบใน<br>วัตถุประสงค์ของกองทุนสวัสดิการ
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: left;">
            <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(2) ข้าพเจ้าสมัครใจส่งเงินสัจจะวันละ 1 บาท เข้ากองทุนสวัสดิการชุมชน ดังนี้
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: left;">
            <br>&emsp;&emsp;&emsp;* <?= $req_condition_output ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: left;">
            <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(3) หลักฐานการสมัคร
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: left;">
            <br>&emsp;&emsp;&emsp;1.ค่าสมัคร 10 บาท
            <br>&emsp;&emsp;&emsp;2.เงินสัจจะ (30 วัน) 30 บาท
            <br>&emsp;&emsp;&emsp;3.สำเนาบัตรประจำตัวประชาชน
            <br>&emsp;&emsp;&emsp;4.สำเนาทะเบียนบ้าน
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: left;">
            <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(4) ผู้รับประโยชน์ กรณีสมาชิกถึงแก่กรรมข้าพเจ้าขอมอบให้ <b><?= $array_print['req_beneficiary'] ?></b> อายุ <b><?= $array_print['req_beneficiary_age'] ?></b> ปี ความสัมพันธ์เป็น <b><?= $array_print['req_beneficiary_relation'] ?></b> ที่อยู่ <b><?= $array_print['req_beneficiary_address'] ?></b> 
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: left;">
            <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(5) เมื่อข้าพเจ้าได้เป็นสมาชิกจะปฎิบัติตามระเบียบข้อบังคับของกองทุนสวัสดิการชุมชนเทศบาลเมือง<br>ยโสธรทุกประการ
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center;">
            <br><br>(ลงชื่อ)......<?= $array_print['reg_name'] ?>...<?= $array_print['reg_lastname'] ?>......<br><br>
            (<?= $array_print['reg_name'] ?>  <?= $array_print['reg_lastname'] ?>)<br>
            ผู้สมัคร
        </td>
    </tr>
       <tr>
        <td colspan="2" style="text-align: left;">
            <br><br>คณะกรรมการบริหารกองทุน พิจารณาอนุมัติให้เป็นสมาชิก<br>
            วันที่.........เดือน...............พ.ศ..................
        </td>
    </tr>
     <tr>
        <td colspan="2" style="text-align: center;">
            <br>(........................................)<br><br>
            ประธานกรรมการบริหารกองทุน
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