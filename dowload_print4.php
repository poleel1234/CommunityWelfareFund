<?php
@session_start();
include "connect_db.php";
ob_start();
require_once('mpdf/mpdf.php');
?>
<table width="100%" border="0" align="center" cellspacing="0">
     <tr>
        <td colspan="2" style="text-align: left;"><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;ข้อ ๕. ข้าพเจ้ายอมรับผูกพันตามข้อบังคับสถาบันการเงินว่า ถ้าข้าพเจ้าได้ออกหรือย้ายจากพื้นที่เขตเทศบาลเมือง<br>
            ยโสธร ข้าพเจ้าต้องแจ้งเป็นหนังสือให้สถาบันการเงินทราบ และจัดการชำระหนี้เงินกู้เพื่อพัฒนาคุณภาพชีวิต ซึ่งข้าพเจ้ามีอยู่<br>
            ต่อสถาบันการเงินให้เสร็จสิ้นเสียก่อน<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;ถ้าข้าพเจ้าไม่จัดการชำระหนี้สินให้เสร็จสิ้นตามที่กล่าวในวรรคก่อน ข้าพเจ้ายินยอมให้เจ้าหน้าที่ผู้จ่ายเงินเบี้ยยังชีพ<br>
            ที่ทางราชการจ่ายให้แก่ข้าพเจ้า หักเงินดังกล่าว เพื่อชำระหนี้ต่อสถาบันการเงินให้เสร็จสิ้นเสียก่อน<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;ข้อ ๖. หากข้าพเจ้าได้ย้ายที่อยู่จากที่ได้แจ้งไว้ในหนังสือนี้ ข้าพเจ้าจะแจ้งให้สถาบันการเงินทราบเป็นหนังสือโดย<br>
            ทันที ถ้าข้าพเจ้ามิได้แจ้งให้สถาบันการเงินทราบ และหากมีการดำเนินคดีเกี่ยวกับหนี้สินตามสัญญาเงินกู้เพื่อพัฒนาคุณภาพ<br>
            ชีวิตนี้ ให้ถือว่าข้าพเจ้ายังคงมีภูมิลำเนาอยุ่ตามที่ระบุไว้ในหนังสือนี้ทุกประการ<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;ข้อ ๗. ผู้กู้ได้รับสำเนาคู่สำเนาคู่ฉบับหนังสือกู้นี้ไว้แล้วตั้งแต่วันที่ลงนามในหนังสือกู้<br>
	ผู้กู้ได้อ่านข้อความในหนังสือกู้นี้โดยตลอดแล้วเห็นว่าถูกต้อง จึงได้ลงลายมือชื่อไว้เป็นสำคัญต่อหน้าพยาน
        </td>  
    </tr>
    
     <tr>
         <td colspan="2" style="text-align: center;"><br>ลงชื่อ...................................ผู้กู้<br>(.....................................)</td><br><br>
    </tr>
      <tr>
         <td colspan="1" style="text-align: left;"><br>ลงชื่อ...................................พยาน<br>(.....................................)</td>
      <td colspan="1" style="text-align: right;"><br>ลงชื่อ...................................พยาน<br>(.....................................)</td>
    </tr>
	</table>
<table width="100%"  border="2" align="center" cellspacing="0" style="border:2px solid #000000">
      <tr>
          <td colspan="2" style="text-align: center;"><br><br><h3>คำยินยอมของคู่สมรส</h3></td>
    </tr>
          <tr>
   <td colspan="2" style="text-align: center;"><h3>(ใช้ในกรณีที่ผู้กู้มีคู่สมรส)</h3></td><br><br>
    </tr>
     <tr>
          <td colspan="2" style="text-align: right;">
              เขียนที่ <b>..................................  
  
        <tr>
          <td colspan="2" style="text-align: right;">
              วันที่ <b>.................................................  
                      </tr>
                       <tr>
        <td colspan="2" style="text-align: left;"><br>
            ข้าพเจ้า นาย/นาง.....................................เป็นคู่สมรสของ นาย/นาง................................................................<br>
        ได้ยินยอมให้ นาย/นาง................................................กู้เงินเพื่อพัฒนาคุณภาพชีวิต ของสถาบันการเงินชุมชน<br>
        เทศบาลเมืองยโสธร ตามหนังสือเงินกู้เพื่อพัฒนาคุณภาพชีวิตข้างต้นนี้ และข้าพเจ้าได้ลงลายมือไว้เป็นสำคัญต่อหน้า<br>
        คู่สมรส<br>
        </td> 
      <tr>
          <td colspan="2" style="text-align: right;">
             ลงชื่อ..............................คู่สมรสผู้ให้คำยินยอม
  
        <tr>
          <td colspan="2" style="text-align: center;">
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            &emsp;&emsp;&emsp;ลงชื่อ...............................ผู้กู้ 
                      </tr>
    </tr>
    </table>
<table width="100%"  border="0" align="center" cellspacing="0"> 
 <tr>
        <td colspan="2" style="text-align: left;"><br><br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;ข้าพเจ้า...............................................ได้รับเงินกู้เพื่อพัฒนาคุณภาพชีวิต จำนวน................................บาท<br>
            (........................................................) ตามหนังสือกู้นี้เป็นการถูกต้องแล้ว ณ วันที่............................................<br>
           
        </td>  
    </tr>
        <tr>
          <td colspan="2" style="text-align: center;">
             <br> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            &nbsp;&nbsp;&nbsp;ลงชื่อ..................................ผู้รับเงิน
   </tr>
        <tr>
          <td colspan="2" style="text-align: center;">
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            &emsp;&emsp;&emsp;ลงชื่อ...............................เจ้าหน้าที่ผู้จ่ายเงิน 
                      </tr>
                     <tr>
          <td colspan="2" style="text-align: center;">
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            &emsp;&emsp;&emsp;ลงชื่อ...............................เจ้าหน้าที่ผู้จ่ายเงิน 
                      </tr>  
   
</table>
<?Php
$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A4', '10', 'THSaraban'); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>