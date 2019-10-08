<?php
session_start();
include "connect_db.php";
ob_start();
require_once('mpdf/mpdf.php');
?>
<?php
$sql_print = "select * from petition r join member m on m.mem_id = r.mem_id  where r.pet_id='" . $_GET['pet_id'] . "'";
$query_print = mysqli_query($connect, $sql_print);
$array_print = mysqli_fetch_array($query_print);
?>
<table width="100%" border="0" align="center" cellspacing="0">
    <tr>
        <td colspan="2" style="text-align: center;"><h3>ใบคำร้องขอกู้เงินเพื่อพัฒนาคุณภาพชีวิต</h3></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: right;"><br><br>
            เขียนที่ <b><?= $array_print['pet_type'] ?>-<?= $array_print['mem_id'] ?></b><br><br>
            วันที่ <b><?php echo DateThai2($array_print['pet_date']); ?></b><br>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: left;">
            <br>เรื่อง     ขอกู้เงินประเภทเงินกู้เพื่อพัฒนาคุณภาพชีวิต <b><?= $array_print['pet_type'] ?></b>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: left;">
            <br>เรียน     ผู้จัดการสถาบันการเงินชุมชนเทศบาลเมืองยโสธร
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: left;">
            <br>
            &nbsp;&nbsp;&nbsp;&nbsp;ด้วยข้าพเจ้า <b><?= $array_print['mem_name'] ?>  <?= $array_print['mem_lastname'] ?></b> อายุ <b><?= $array_print['pet_age'] ?></b> ปี สมาชิกทะเบียนเลขที่ <b><?= $array_print['mem_id'] ?></b> ที่อยู่บ้านเลขที่ <b><?= $array_print['mem_address'] ?></b> 
            มีความประสงค์จะขอกู้เงินประเภทเงินกู้เพื่อพัฒนาคุณภาพชีวิต จากสถาบันการเงินชุมชนเทศบาลเมืองยโสธร เป็นจำนวนเงิน <b><?= number_format($array_print['amount'], 2) ?></b> บาท (<b><?php echo Convert($array_print['amount']); ?></b>) โดยมีวัตถุประสงค์แห่งการกู้เพื่อ <b><?= $array_print['cause'] ?></b>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: left;">
            <br>
            ปัจจุบันข้าพเจ้า มีหุ้นในสถาบันการเงิน <b><?= number_format($array_print['share'], 2) ?></b> บาท<br><br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;มีรายได้อื่นๆ เดือนละ <b><?= number_format($array_print['income'], 2) ?></b> บาท<br><br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;เบี้ยยังชีพ เดือนละ <b><?= number_format($array_print['allowance'], 2) ?></b> บาท<br><br>
            <br>จึงเรียนมาเพื่อโปรดพิจารณา
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center;">
            <br>
            ขอแสดงความนับถือ<br>
            <br><br>(ลงชื่อ) <?= $array_print['mem_name'] ?>  <?= $array_print['mem_lastname'] ?> <br><br>
            (<?= $array_print['mem_title'] ?><?= $array_print['mem_name'] ?>  <?= $array_print['mem_lastname'] ?>)<br><br>
            ผู้ขอกู้<br><br><br>
        </td>
    </tr>
<!--    <tr>
        <td style="text-align: center;">
            <table border="1">
                <tr>
                    <td style="text-align: left;">เรียน ประธานอนุกรรมการพิจารณาเงินกู้เพื่อพัฒนาคุณภาพชีวิต<br><br>
                        - ได้ตรวจสอบคำขอกู้ สัญญากู้เงิน สัญญาค้ำประกัน และเอกสารประกอบสัญญาต่าง ๆ ครบถ้วน ถูกต้อง เรียบร้อยแล้ว<br>
                        <br><br>(&emsp;&emsp;) ควรพิจารณาอนุมัติ<br><br>
                        (&emsp;&emsp;) ความเห็นอื่นๆ ......................................
                        </td>
                </tr>
                <tr>
                    <td style="text-align: center;">
                        <br><br>ลงชื่อ......................ผู้ขออนุมัติ
                        <br><br>(นายบุญหลาย มารักษ์)<br><br>
                        ผู้จัดการ<br><br><br>
                        </td>
                </tr>
            </table>
        </td>
        <td style="text-align: center;">
            <table border="1" style="padding: 5px;" cellspacing="0">
                <tr>
                    <td style="text-align: center;">
             ผลการพิจารณา<br><br>
                        คณะอนุกรรมการพิจารณาเงินกู้เพื่อพัฒนาคุณภาพชีวิต<br><br>
                        (    ) อนุมัติ (    ) ไม่อนุมัติ ลงชื่อ............................<br><br>
                        (.........................................................)<br><br>
                        (    ) อนุมัติ (    ) ไม่อนุมัติ ลงชื่อ............................<br><br>
                        (.........................................................)<br><br>
                        (    ) อนุมัติ (    ) ไม่อนุมัติ ลงชื่อ............................<br><br>
                        (.........................................................)<br><br><br><br><br><br>
                        </td>
                </tr>
            </table>
        </td>
    </tr>-->
</table>   
<table border='1' width='100%'>
    <tr>
        <td style="width: 50%">
            <table border='0' width='100%'>
                <tr>
                    <td>เรียน ประธานอนุกรรมการพิจารณาเงินกู้เพื่อพัฒนาคุณภาพชีวิต</td>
                </tr>
                <tr>
                    <td>- ได้ตรวจสอบคำขอกู้ สัญญากู้เงิน สัญญาค้ำประกัน และเอกสารประกอบสัญญาต่าง ๆ ครบถ้วน ถูกต้อง เรียบร้อยแล้ว</td>
                </tr>
                <tr>
                    <td>(&emsp;&emsp;) ควรพิจารณาอนุมัติ</td>
                </tr>
                <tr>
                    <td>(&emsp;&emsp;) ความเห็นอื่นๆ .............................................</td>
                </tr>
                <tr>
                    <td style="text-align: center;">ลงชื่อ......................ผู้ขออนุมัติ</td>
                </tr>
                <tr>
                    <td style="text-align: center;">(นายบุญหลาย มารักษ์)</td>
                </tr>
                <tr>
                    <td style="text-align: center;">ผู้จัดการ</td>
                </tr>
            </table>
        </td>
        <td style="width: 50%">
            <table border='0' width='100%'>
                <tr>
                    <td style="text-align: center;">ผลการพิจารณา</td>
                </tr>
                <tr>
                    <td style="text-align: center;">คณะอนุกรรมการพิจารณาเงินกู้เพื่อพัฒนาคุณภาพชีวิต</td>
                </tr>
                <tr>
                    <td style="text-align: left;">(&emsp;) อนุมัติ (&emsp;) ไม่อนุมัติ ลงชื่อ..............................</td>
                </tr>
                <tr>
                    <td style="text-align: right;">(...................................)</td>
                </tr>
                <tr>
                    <td style="text-align: left;">(&emsp;) อนุมัติ (&emsp;) ไม่อนุมัติ ลงชื่อ..............................</td>
                </tr>
                <tr>
                    <td style="text-align: right;">(...................................)</td>
                </tr>
                <tr>
                    <td style="text-align: left;">(&emsp;) อนุมัติ (&emsp;) ไม่อนุมัติ ลงชื่อ..............................</td>
                </tr>
                <tr>
                    <td style="text-align: right;">(...................................)</td>
                </tr>
            </table>
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