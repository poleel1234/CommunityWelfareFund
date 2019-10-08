<?php
@session_start();
include "connect_db.php";
ob_start();
require_once('mpdf/mpdf.php');
?>
<table width="100%" border="2" align="center" cellspacing="0"  style="border:2px solid #000000">
        <tr>
          <td colspan="2" style="text-align: center;"><br><br><h3>คำยินยอมของคู่สมรส</h3></td>
    </tr>
          <tr>
   <td colspan="2" style="text-align: center;"><h3>(ใช้เฉพราะกรณีที่ผู้ค้ำประกันมีคู่สมรส)</h3></td><br><br>
    </tr>
     <tr>
          <td colspan="2" style="text-align: right;">
              เขียนที่ <b>..................................  </td>
  
        <tr>
          <td colspan="2" style="text-align: right;">
              วันที่ <b>.................................................  </td>
                      </tr>
                       <tr>
        <td colspan="2" style="text-align: left;"><br>
            ข้าพเจ้า นาย/นาง.....................................เป็นคู่สมรสของ นาย/นาง................................................................<br>
        ได้ยินยอมให้ นาย/นาง................................................เป็นผู้ค้ำประกันสัญญาเงินกู้เพื่อพัฒนาคุณภาพชีวิต <br>
        ของ สถาบันการเงินชุมชนเทศบาลเมืองยโสธร  ตามหนังสือค้ำประกันข้างต้นนี้ และข้าพเจ้าได้ลงลายมือไว้เป็นสำคัญ<br>
        ต่อหน้าคู่สมรส<br>
        </td> 
      <tr>
          <td colspan="2" style="text-align: right;">
             ลงชื่อ..............................คู่สมรสผู้ให้คำยินยอม
          </td>
      </tr>
        <tr>
          <td colspan="2" style="text-align: center;">
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;ลงชื่อ...............................ผู้กู้ </td>
        </tr>
    </table>
<table width="100%" border="0" align="center" cellspacing="0">
    <tr>
   <td colspan="2" style="text-align: center;"><br>(รับรองว่าได้ตรวจบัตรและลายมือชื่อผู้ค้ำประกัน และเห็นว่าหนังสือค้ำประกันนี้ได้ทำขึ้นโดยถูกต้องแล้ว)</td><br><br>
    </tr>
           <tr>
   <td colspan="2" style="text-align: center;"><br>คำเตือนสำหรับผู้ค้ำประกัน</td><br><br>
    </tr>
 <tr>
        <td colspan="2" style="text-align: left;"><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;ก่อนที่จะลงนามในสัญญาค้ำประกันเงินกู้เพื่อพัฒนาคุณภาพชีวิต ผู้ค้ำประกันควรอ่านและตรวจสอบรายละเอียดของสัญญา<Br>
ค้ำประกันให้เข้าใจโดยชัดเจน หากผู้ค้ำประกันมีข้อสงสัยใด ควรปรึกษาผู้มีความรู้ก่อนที่จะทำสัญญาค้ำประกัน<Br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;การที่ผู้ค้ำประกันลงนามในสัญญาค้ำประกัน กับ สถาบันการเงินชุมชนเทศบาลเมืองยโสธร เพื่อค้ำประกันหนี้ตามสัญญา<Br>
เงินกู้เพื่อพัฒนาคุณภาพชีวิต เลขที่................../.......................ลงวันที่.....................................ระหว่าง สถาบันการเงินชุมชนเทศบาล<Br>
เมืองยโสธร (ผู้ให้กู้) กับ นาย/นาง/นางสาว......................................................................(ผู้กู้) ผู้ค้ำประกันจะมีความรับผิดชอบต่อผู้ให้กู้ใน<Br>
สาระสำคัญ ดังนี้<Br>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;๑. ผู้ค้ำประกันจะต้องรับผิดอย่างจำกัด ไม่เกินวงเงินตามที่กำหนดในสัญญาเงินกู้เพื่อพัฒนาคุณภาพชีวิต<Br>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;๒. ผู้ค้ำประกันจะรับผิดต่อผู้ให้กู้ภายในวงเงินที่ผู้กู้ค้างชำระกับผู้ให้กู้ตามสัญญาเงินกู้เพื่อพัฒนาคุณภาพชีวิต และอาจต้อง<Br>
	    รับชดใช้ดอกเบี้ยหรือค่าสินไหมทดแทนอื่นๆ อีกด้วย<Br>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;๓. ผู้ค้ำประกันจะรับผิดในวงเงินกู้ตามสัญญาเงินกู้เพื่อพัฒนาคุณภาพชีวิต<Br>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;๔. ผู้ค้ำประกันต้องรับผิดร่วมกับผู้กู้<Br>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;๕. เมือผู้กู้ผิดนัดชำระหนี้เงินกู้เพื่อพัฒนาคุณภาพชีวิต ผู้ให้กู้มีสิทธิเรียกร้องและบังคับให้ผู้ค้ำประกันชำระหนี้แทนทั้งหมด<Br>
	    ที่ผู้กู้ค้างชำระโดยผู้ให้กู้ไม่จำเป็นต้องเรียกร้อง หรือบังคับเอาจากผู้กู้ก่อน<Br>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;๖. เป็นสัญญาค้ำประกันเพื่อกิจการเนื่องกันไปหลายคราว ไม่จำกัดเวลาที่ผู้ค้ำประกันไม่สามารถยกเลิกเพิกถอนได้<Br>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;๗. ผู้ค้ำประกันไม่หลุดพ้นจากความรับผิด แม้ผู้ให้กู้ยอมผ่อนเวลาให้แก่ผู้กู้<Br>
	     นอกจากที่กล่าวไว้ข้างต้นแล้ว ผู้ค้ำประกันเงินกู้เพื่อพัฒนาคุณภาพชีวิตยังมีหน้าที่และความรับผิดต่างๆ ตามที่ระบุไว้ใน<Br>
	     สัญญาค้ำประกัน ข้าพเจ้าได้ทราบบคำเตือนนี้แล้ว จึงลงลายมือชื่อไว้เป็นหลักฐาน
			
        </td>  
    </tr>
     <tr>
         <td colspan="2" style="text-align: center;"><br>
              &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            &emsp;&emsp;ลงชื่อ...................................ผู้ค้ำประกัน<br> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
             &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;(......................................)</td><br><br>
    </tr>
      <tr>
          <td colspan="1" style="text-align: center;">
               &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;ลงชื่อ...................................เจ้าหน้าที่สถาบันการเงิน<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;(......................................)<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;ตำแหน่ง.................................</td>
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