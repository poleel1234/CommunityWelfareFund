<?php
session_start();
$pagename = 'deposit';
include "connect_db.php";
$ses_userid = $_SESSION['ses_userid'];
if ($ses_userid <> session_id()) {
    echo "<script>alert('กรุณาทำการ Login ก่อนใช้งานระบบ');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=login.php' />";
    exit();
}
if ($array_login['aut_position'] != "ผู้ดูแลระบบ" && $array_login['aut_position'] != "ผู้บริหาร" && $array_login['aut_position'] != "เจ้าหน้าที่") {
    echo "<script>alert('You have no permission to access this page.');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=logout.php' />";
    exit();
}
include 'header.php';
?>
<ul class="breadcrumb">
    <li><a href="dashboard.php">Home</a></li>                    
    <li class="active">ฝากเงินกองทุน</li>
</ul>
<div class="page-title">                    
    <h2><i class="fa fa-info-circle"></i> ฝากเงินกองทุน</h2>
</div>
<div class="page-content-wrap">  
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">                   
                    <h3 class="panel-title">ข้อมูลฝากเงินกองทุน</h3>    
                    <ul class="panel-controls">
                        <li style="margin-right: 120px;"><a href="dep.php"><button type="button" class="btn btn-info">เพิ่มรายการฝากเงินใหม่</button></a></li>
                        <li style="margin-right: 80px;"><a href="#" class="panel-collapse"><button type="button" class="btn btn-warning"><span class="fa fa-angle-down"></span> Hide/Show</button></a></li>
                    </ul>  
                </div>
                <div class="panel-body">
                    <table class="table">
                        
                        <thead>
                            <tr>
                                <th>ชื่อ-นามสกุล</th>
                                <th>วันที่รับเงินฝาก</th>
                                <th>เดือน/ปี ที่ฝากเงิน</th>
                                <th>ยอดฝากรวม</th>
                                <th>เจ้าหน้าที่</th>
                                <th>ใบเสร็จ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_basic1 = "select 
d.dep_main_id,m.mem_title,m.mem_name,m.mem_lastname,d.dep_date,SUM(d.dep_amount) as dep_amount,a.aut_name,a.aut_lastname,group_concat(d.dep_month, '/', d.dep_year) as dep_monthyear
from deposit d 
join member m on m.mem_id = d.mem_id 
join authorities a on a.aut_id = d.aut_id 
GROUP by d.dep_main_id,m.mem_title,m.mem_name,m.mem_lastname,d.dep_date,a.aut_name,a.aut_lastname
order by d.dep_date desc";
                            $query_basic1 = mysqli_query($connect, $sql_basic1);
                            while ($array_basic1 = mysqli_fetch_array($query_basic1)) {
                                ?>
                                <tr>
                                    <td><?= $array_basic1['mem_name'] ?> <?= $array_basic1['mem_lastname'] ?></td>
                                    <td><?= changedatetime($array_basic1['dep_date']) ?></td>
                                    <td><?= $array_basic1['dep_monthyear'] ?></td>
                                    <td style="text-align: right;"><?= number_format($array_basic1['dep_amount'], 2) ?></td>
                                    <td><?= $array_basic1['aut_name'] ?> <?= $array_basic1['aut_lastname'] ?></td>
                                    <td class="center" style="text-align: center;"><a class="btn btn-info" href="dep_print.php?dep_main_id=<?= $array_basic1['dep_main_id'] ?>" target="_blank"><i class="fa fa-file-pdf-o fa-fw" title="พิมพ์"></i>พิมพ์</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>  
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">                   
                    <h3 class="panel-title">ข้อมูลฝากเงินกองทุน2</h3>    
                    <ul class="panel-controls">
                    </ul>  
                </div>
            <div class="panel-body">
                    <table class="table"> 
                        <thead>
                            <tr>
                                <th>ชื่อ-นามสกุล</th>
                                <th>เริ่มเป็นสมาชิก</th>
                                <!--<th>การฝากเงิน</th>-->
                                <th>ค้างจ่าย (บาท)</th>
                                <th>จ่ายแล้ว (บาท)</th>
                                <th>จ่ายล่วงหน้า (บาท)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_bas = "SELECT m.mem_id,m.mem_title,m.mem_name,m.mem_lastname,m.mem_date,DATE(NOW()) AS datenow
FROM member m 
ORDER BY m.mem_id";
                            $query_bas = mysqli_query($connect, $sql_bas);
                            while ($array_bas = mysqli_fetch_array($query_bas)) {
                                $total1 = 0;
                                $total2 = 0;
                                $total3 = 0;
                                ?>
                                <tr>
                                    <td><?= $array_bas['mem_name'] ?> <?= $array_bas['mem_lastname'] ?></td>
                                    <td><?= $array_bas['mem_date'] ?></td>
    <!--                                    <td>
                                        <table class="table" border="1">
                                            <tr>
                                                <td>เดือน</td>
                                                <td>ปี</td>
                                                <td>สถานะ</td>
                                            </tr>-->
                                    <?php
                                    $THAI_MOUTH = array(1 => "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
                                        "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

                                    $date_1 = strtotime($array_bas['datenow']);
                                    $m_1 = date("n", $date_1);
                                    $Y_1 = date("Y", $date_1);

                                    $date_2 = strtotime($array_bas['mem_date']);
                                    $m_2 = date("n", $date_2);
                                    $Y_2 = date("Y", $date_2);
                                    $YY_2 = date("Y", $date_2);

                                    $sql_max = "SELECT max(dep_year) as maxs from deposit where mem_id = '" . $array_bas['mem_id'] . "' ";
                                    $query_max = mysqli_query($connect, $sql_max);
                                    $array_max = mysqli_fetch_array($query_max);
                                    if ($array_max['maxs'] > 0) {
                                        $Y_3 = $array_max['maxs'];
                                    } else {
                                        $Y_3 = $Y_1;
                                    }
                                    for ($i = $Y_2; $i <= $Y_3; $i++) {
                                        $mw = 1;
                                        foreach ($THAI_MOUTH as $m) {
                                            $sql_deposit = "select * from deposit where mem_id = '" . $array_bas['mem_id'] . "' and dep_month = '$m' and dep_year = " . $i . " ";
                                            $query_deposit = mysqli_query($connect, $sql_deposit);
                                            $array_deposit = mysqli_fetch_array($query_deposit);
                                            $memM2 = $array_deposit['dep_month'];
                                            $memY2 = $array_deposit['dep_year'];
                                            if ($memM2 == $m && $memY2 == $i) {
                                                if ($Y_3 > $i) {
                                                    $total1 += 30;
                                                    $text = "<b style='color:white;background-color:green;padding:5px;'>ชำระแล้ว1</b>";
                                                } else {
                                                    $total3 += 30;
                                                    $text = "<b style='color:white;background-color:green;padding:5px;'>ชำระแล้ว2</b>";
                                                }
                                            } else {
                                                if ($i < $Y_1) {
                                                    if ($i < $Y_2) {
                                                        $text = "";
                                                    } else if ($i == $Y_2 && $mw < $m_2) {
                                                        $text = "";
                                                    } else {
                                                        $total2 += 30;
                                                        $text = "<b style='color:white;background-color:red;padding:5px;'>ค้างชำระ</b>";
                                                    }
                                                } else if ($mw < $m_1 && $i <= $Y_1) {
                                                    if ($i == $Y_2 && $mw < $m_2) {
                                                        $text = "";
                                                    } else {
                                                        $total2 += 30;
                                                        $text = "<b style='color:white;background-color:red;padding:5px;'>ค้างชำระ</b>";
                                                    }
                                                } else if ($i < $memY2) {
                                                    $text = "-";
                                                } else {
                                                    $text = "-";
                                                }
                                            }
                                            ?>
            <!--                                                    <tr>
                                                                <td><?= $i ?>,<?= $Y_2 ?>,<?= $Y_3 ?>/// <?= $m ?></td>
                                                                <td><?= $i ?></td>
                                                                <td><?= $text ?></td>
                                                            </tr>-->
                                            <?php
                                            $mw++;
                                        }
                                    }
                                    ?>

                                    <!--                                        </table>
                                    
                                                                        </td>-->
                                    <td style="text-align: right;"><?= number_format($total2, 2); ?></td>
                                    <td style="text-align: right;"><?= number_format($total1, 2); ?></td>
                                    <td style="text-align: right;"><?= number_format($total3, 2); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 



      
</div>
    
<div class="page-content-wrap">                
    <div class="row">
        
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-5 control-label">ตรวจสอบรายการนำฝากของปี</label>
                <div class="col-md-9">                                                                                
                    <select class="form-control" data-live-search="true" name="year2" id="year2" required="">
                        <option style="display: none;"></option>
                        <?php
                        $time = strtotime("now");
                        $pyear = date("Y", $time);
                        $year = date("Y", $time) - 10;
                        for ($index = 0; $index < 21; $index++) {
                            $THAI_YEAR = $year + 543;
                            ?>
                            <option value="<?= $year ?>" <?php
                            if ($year == $pyear) {
                                echo "selected=selected";
                            } else {
                                echo "";
                            }
                            ?>><?= $THAI_YEAR ?></option>
                                    <?php
                                    $year++;
                                }
                                ?>
                    </select><br><br>
                </div>
            </div>
        </div>
    </div>
    <div id='show-data'></div> 
</div>     
<!-- PAGE CONTENT WRAPPER -->                                
</div>    
<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->     
<script>
    var d = new Date();
    var year = d.getFullYear();
    $.ajax({
        type: "GET",
        url: 'dep_show_view.php',
        data: {year},
        success: function (data) {
            $('#show-data').html(data);
        }
    });
    $('#year2').change(function () {
        var year = $(this).val();
        $.ajax({
            type: "GET",
            url: 'dep_show_view.php',
            data: {year},
            success: function (data) {
                $('#show-data').html(data);
            }
        });
    });
</script>
<?php
include 'footer.php';
?>