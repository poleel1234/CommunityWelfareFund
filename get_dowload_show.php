<?php
session_start();
$pagemain = 'get_dowload';
include "connect_db.php";
$ses_userid = $_SESSION['ses_userid'];
if ($ses_userid <> session_id()) {
    echo "<script>alert('กรุณาทำการ Login ก่อนใช้งานระบบ');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=login.php' />";
    exit();
}
if ($array_login['aut_position'] == "ผู้ดูแลระบบ" || $array_login['aut_position'] == "ผู้บริหาร" || $array_login['aut_position'] == "เจ้าหน้าที่") {
    echo "<script>alert('You have no permission to access this page.');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=logout.php' />";
    exit();
}
include 'header.php';

$sql_newid2 = "Select sum(get_condition2) as get_condition2 from get_benefits where mem_id = '" . $array_login3['mem_id'] . "' and YEAR(get_condition1) = YEAR(NOW()) and ben_id = 'BEN-000012'";
$query_newid2 = mysqli_query($connect, $sql_newid2);
$array_newid2 = mysqli_fetch_array($query_newid2);
    $i = $array_newid2['get_condition2'];
?>        
<style>
    .message-box .mb-container {
        /* position: absolute; */
        left: 0px;
        top: 5%;
        background: rgba(0, 0, 0, 0.9);
        padding: 20px;
        width: 100%;
        height: 90%;
    }
</style>
<div class="page-content-wrap">                 
    <div class="row">
        <div class="col-md-12">
            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">                   
                    <h3 class="panel-title">ดาวน์โหลดเอกสารกู้ยิม</h3>
                    <ul class="panel-controls">
                        <?php
                        $memdate = $array_login3['mem_date'];
                        $DateStart = date("d");
                        $MonthStart = date("m");
                        $YearStart = date("Y");
                        $DateEnd = date("d", strtotime($memdate)); //การใช้งานรูปแบบวันที่และเวลาที่เป็นข้อความ
                        $MonthEnd = date("m", strtotime($memdate));
                        $YearEnd = date("Y", strtotime($memdate));
                        $Start = mktime(0, 0, 0, $MonthStart, $DateStart, $YearStart);
                        $End = mktime(0, 0, 0, $MonthEnd, $DateEnd, $YearEnd);
                        $DateNum = ceil(($Start - $End) / 86400);
                        if ($DateNum >= 365) {
                            ?>
                          
                        <?php } ?>
                        <li style="margin-right: 80px;"><a href="#" class="panel-collapse"><button type="button" class="btn btn-warning"><span class="fa fa-angle-down"></span> Hide/Show</button></a></li>
                    </ul>                                
                </div>
                <div class="panel-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <!--<th>รหัสขอรับสวัสดิการ</th>-->
                                <th>รายชื่อเอกสารที่ต้องดาวน์โหลด</th>
                                <th></th>
                                <th></th>
                    
                                    <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        
                                <tr>
                                   
                                    <td>เอกสาร1</td>
                                    <td>สัญญาค้ำประกันเงินกู้เพื่อพัฒนาคุณภาพชีวิต</td>
                                    <td></td>
                    
                              
                                
                                    <td class="center" style="text-align: center;"><a class="btn btn-info" href="dowload_print1.php?" target="_blank"><i class="fa fa-file-pdf-o fa-fw" title="พิมพ์"></i>พิมพ์</a></td>
                                </tr>
                                
                                        <tr>
                                   
                                    <td>เอกสาร2</td>
                                    <td>หนังสือยินยอมให้ส่วนราชการหักเงินชำระหนี้เงินกู้เพื่อพัฒนาคุณภาพชีวิต</td>
                                    <td></td>
                               
                             
                                
                                    <td class="center" style="text-align: center;"><a class="btn btn-info" href="dowload_print2.php?" target="_blank"><i class="fa fa-file-pdf-o fa-fw" title="พิมพ์"></i>พิมพ์</a></td>
                                </tr>
                                        <tr>
                                   
                                    <td>เอกสาร3</td>
                                    <td>สัญญาค้ำประกันเงินกู้เพื่อพัฒนาคุณภาพชีวิต</td>
                                    <td></td>
                                
                            
                                
                                    <td class="center" style="text-align: center;"><a class="btn btn-info" href="dowload_print3.php?" target="_blank"><i class="fa fa-file-pdf-o fa-fw" title="พิมพ์"></i>พิมพ์</a></td>
                                </tr>
                                        <tr>
                                   
                                    <td>เอกสาร4</td>
                                    <td>คำยินยอมของคู่สมรส</td>
                                    <td>(ใช้ในกรณีที่ผู้กู้มีคู่สมรส)</td>
                    
                                   
                                
                                    <td class="center" style="text-align: center;"><a class="btn btn-info" href="dowload_print4.php?" target="_blank"><i class="fa fa-file-pdf-o fa-fw" title="พิมพ์"></i>พิมพ์</a></td>
                                </tr>
                                        <tr>
                                   
                                    <td>เอกสาร5</td>
                                    <td>คำยินยอมของคู่สมรส</td>
                                    <td>(ใช้เฉพราะกรณีที่ผู้ค้ำประกันมีคู่สมรส)</td>
                             
                                
                                
                                    <td class="center" style="text-align: center;"><a class="btn btn-info" href="dowload_print5.php?" target="_blank"><i class="fa fa-file-pdf-o fa-fw" title="พิมพ์"></i>พิมพ์</a></td>
                                </tr>
                              
                        </tbody>
                    </table>
                    <!--<h1 style="color: red;">ยอดเงินฝาก <?= $mem_get_benefits ?> บาท</h1>-->
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->
        </div>
    </div> 
    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-md-12">             
            <b style="color:red;">***เงื่อนไขข้อจำกัดใช้เพื่อยินยันการกู้ยิน</b>
            <h3 style="color:red;">เอกสารนี้เป็นเอกสารยินยันก็ขอกู้ยินเงินเพื่อพัฒนาคุณภาพชีวิต</h3>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?> 