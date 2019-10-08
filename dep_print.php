<?php
@session_start();
include "connect_db.php";
ob_start();
require_once('mpdf/mpdf.php');
?>
<?php
$sql_print = "select m.mem_address,m.mem_tel,m.mem_card,
d.dep_main_id,m.mem_title,m.mem_name,m.mem_lastname,d.dep_date,SUM(d.dep_amount) as dep_amount,a.aut_name,a.aut_lastname,group_concat(d.dep_month, '/', d.dep_year) as dep_monthyear
from deposit d 
join member m on m.mem_id = d.mem_id 
join authorities a on a.aut_id = d.aut_id 
where d.dep_main_id='" . $_GET['dep_main_id'] . "'
GROUP by d.dep_main_id,m.mem_title,m.mem_name,m.mem_lastname,d.dep_date,a.aut_name,a.aut_lastname
order by d.dep_date desc ";
$query_print = mysqli_query($connect, $sql_print);
$array_print = mysqli_fetch_array($query_print);
?>
<table width="100%" border="0" align="center" cellspacing="0">
    <tr>
        <td colspan="2" style="text-align: right;"><h2>ใบเสร็จรับเงิน<br>RECEIPT</h2></td>
    </tr>
    <tr>
        <td></td>
        <td style="text-align: left;">
            <b>วันที่:</b> <?= changedatetime($array_print['dep_date']) ?>
        </td>
    </tr>
    <tr>
        <td></td>
        <td style="text-align: left;">
            <b>หมายเลขเอกสาร:</b> <?= $array_print['dep_main_id'] ?>
        </td>
    </tr>
    <tr>
        <td></td>
        <td style="text-align: left;">
            <b>เจ้าหน้าที่:</b><?= $array_print['aut_name'] ?> <?= $array_print['aut_lastname'] ?>
        </td>
    </tr>
<tr>
    <td></td>
        <td style="text-align: left;">
            <b>เดือน/ปี ที่ฝากเงิน:</b> <?= $array_print['dep_monthyear'] ?>
        </td>
    </tr>    <tr><td colspan="2"><br></td></tr>
    <tr>
        <td style="text-align: left;width: 50%;">
            <b>ชื่อ-นามสกุล ผู้ฝาก:</b> <?= $array_print['mem_name'] ?> <?= $array_print['mem_lastname'] ?>
        </td>
        <td style="text-align: left;width: 50%;" valign="top" rowspan="3">
            <b>ที่อยู่:</b><?= $array_print['mem_address'] ?>
        </td>
    </tr>
    <tr>
        <td style="text-align: left;">
            <b>เลขประจำตัวประชาชน:</b><?= $array_print['mem_card'] ?>
        </td>
    </tr>
    <tr>
        <td style="text-align: left;">
            <b>โทรศัพท์:</b><?= $array_print['mem_tel'] ?>
        </td>
    </tr>
</table>   
<br><br>
<table width="100%" border="1" align="center" cellspacing="0">
    <tr>
        <th style="padding: 5px;">ลำดับ<br>No.</th>
        <th style="padding: 5px;">เดือน<br>Month</th>
        <th style="padding: 5px;">ปี<br>Year</th>
        <th style="padding: 5px;">มูลค่า (บาท)<br>Amount (THB)</th>
    </tr>
    <?php
    $n=0;
    $sum=0;
                            $sql_basic1 = "select * from deposit d where d.dep_main_id = '".$_GET['dep_main_id']."' order by d.dep_id asc";
                            $query_basic1 = mysqli_query($connect, $sql_basic1);
                            while ($array_basic1 = mysqli_fetch_array($query_basic1)) {
                                $n++;
                                ?>
    <tr>
        <td style="padding: 5px;"><?=$n?></td>
        <td style="padding: 5px;"><?=$array_basic1['dep_month']?></td>
        <td style="padding: 5px;"><?=$array_basic1['dep_year']?></td>
        <td style="text-align: right;padding: 5px;"><?= number_format($array_basic1['dep_amount'],2);?></td>
    </tr>
                            <?php $sum += $array_basic1['dep_amount'];} ?>
    <tr>
        <td colspan="2" style="text-align: right;padding: 5px;">รวม/Total</td>
        <td style="text-align: right;padding: 5px;"><?= number_format($sum,2);?></td>
        <td>บาท</td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: right;padding: 5px;">รวม/Total</td>
        <td colspan="2" style="text-align: center;padding: 5px;"><?= convert($sum);?></td>
    </tr>
</table>
<?Php
$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A5-L', '0', 'THSaraban'); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>