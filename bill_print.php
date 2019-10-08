<?php
@session_start();
include "connect_db.php";
ob_start();
require_once('mpdf/mpdf.php');
?>
<table width="100%" border="0" align="center" cellspacing="0">
    <tr>
        <td colspan="2" style="text-align: center;"><br><h3> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;ใบเสร็จ</h3></td><br>
    </tr>
    <tr>    
        <td colspan="2" style="text-align: left;">กองทุนสวัสดิการเทศบาลเมืองยโสธร</td>
    </tr>
    <tr>    
        <td colspan="2" style="text-align: left;"><h6>ข่าวสาร www.govesite.com/sasukyaso</h6></td>
    </tr><br>
    <tr>
        <td colspan="1" style="text-align: left;">รายละเอียดสมาชิก</td></tr>
    <tr> 
         <td colspan="2" style="text-align: left;"><br><h6>ชื่อ..............นามสกุล................</h6></td>  <br>  <td colspan="1" style="text-align: right;"><h6>เจ้าหน้าที่ผู้ออกใบเสร็จ..........................</h6></td>
    </tr>    
      <tr>    
          <td colspan="2" style="text-align: left;"><h6>รหัสรับเงินฝาก....................</h6></td>  <br>  <td colspan="1" style="text-align: right;"><h6>วันที่ออกบิล.......................</h6></td>
    </tr>
	</table>
<div class="page-content-wrap">                
    <div class="row">
        <div class="col-md-12">
            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">                   
                    <ul class="panel-controls">
                    </ul>                                
                </div>
                <div class="panel-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th><h6>ลำดับ</h6></th>
                                <th><font color="#ffffff">-------</font></th>
                                <th><h6>รายการ</h6></th>
                                <th><font color="#ffffff">--------</font></th>
                                <th><h6>ราคา</h6></th>
                            </tr>
                        </thead>
                        <tbody>
                          
                                <tr>
                                    <td>..........</td>
                                    <td></td>
                                    <td>...........</td>
                                    <td></td>
                                    <td>............</td>
                                </tr>
                               
                        </tbody>
                    </table>
                           <table class="table datatable">
                        <thead>
                            <tr>
                                <th></th>
                                <th><font color="#ffffff">-------</font></th>
                                <th></th>
                                <th><font color="#ffffff">--------</font></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                          
                                <tr>
                                    <td><h6>&emsp;&emsp;เงินสะสม</h6></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>&emsp;............</td>
                                </tr>
                               
                        </tbody>
                    </table>
                </div>
            </div>
    
        </div>
    </div>    
</div>
<br><br><br><br>
 <table width="100%" border="0" align="center" cellspacing="0" style="display: block; text-align: center;">
    <tr>   
        <hr wight="50%">
    <br><br><br> <td colspan="2" style="text-align: center;"><br><h6>ขอบคุณที่ใช้บริการ (Thank you)</h6></td><br></tr>
    </table>

<?Php
$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A6', '0', 'THSaraban'); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>