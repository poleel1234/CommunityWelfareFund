<?php
session_start();
$pagename = 'deposit_money2';
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
    .message-box3 {
        display: none;
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
    }
    .message-box3.open {
        display: block;
    }    
    .message-box3 .mb-container3 {
        /* position: absolute; */
        left: 0px;
        top: 5%;
        background: rgba(0, 0, 0, 0.9);
        padding: 20px;
        width: 100%;
        height: 90%;
    }
    .message-box3 .mb-container3 .mb-middle3 {
        width: 50%;
        left: 25%;
        position: relative;
        color: #FFF;
    }
    .message-box3 .mb-container3 .mb-middle3 .mb-title3 {
        width: 100%;
        float: left;
        padding: 10px 0px 0px;
        font-size: 31px;
        font-weight: 400;
        line-height: 36px;
    }
    .message-box3 .mb-container3 .mb-middle3 .mb-title3 .fa,
    .message-box3 .mb-container3 .mb-middle3 .mb-title3 .glyphicon {
        font-size: 38px;
        float: left;
        margin-right: 10px;
    }
    .message-box3 .mb-container3 .mb-middle3 .mb-content3 {
        width: 100%;
        float: left;
        padding: 10px 0px 0px;
    }
    .message-box3 .mb-container3 .mb-middle3 .mb-content3 p {
        margin-bottom: 0px;
    }
    .message-box3 .mb-container3 .mb-middle3 .mb-footer3 {
        width: 100%;
        float: left;
        padding: 10px 0px;
    }
    .message-box3.message-box-warning3 .mb-container3 {
        background: rgba(255,255,255, 0.9);
    }
    .message-box3.message-box-danger3 .mb-container3 {
        background: rgba(255,255,255, 0.9);
    }
    .message-box3.message-box-info3 .mb-container3 {
        background: rgba(255,255,255, 0.9);
    }
    .message-box3.message-box-success3 .mb-container3 {
        background: rgba(255,255,255, 0.9);
    }
</style>
<ul class="breadcrumb">
    <li><a href="dashboard.php">Home</a></li>                    
    <li class="active">คำนวณเงินนำส่ง</li>
</ul>
<!-- START DEFAULT DATATABLE -->
<div class="panel panel-default">
    <div class="panel-heading">                   
        <div class="panel-title">
            <h2><i class="fa fa-info-circle"></i> คำนวณเงินนำส่ง</h2>
        </div>
        <div class="page-content-wrap">                

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">                   
                            <h3 class="panel-title">ข้อมูลคำนวณเงินนำส่ง</h3>                              
                        </div>
                        <div class="panel-body">
                            <!--<table class="table datatable">-->
                            <table class="table ">
                                <thead>
                                    <tr>
                                        
                                        <th>วันที่รับเงินนำส่ง</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>ประเภทเงินนำส่ง</th>
                                        <th>จำนวนเงินรวมดอกเบี้ย</th>
                                        <th>จำนวนเงินหักต่อเดิอน</th>
                                        <th>จำนวนคงเหลือ</th>

                                        <th> </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $mem_deposit = 0;
                                    $a = 0;
                                    $b = 0;
                                    $sum = 0;
                                    $sql_basic1 = "SELECT p.allowance,p.pet_id,p.pet_date,"
                                            . "m.mem_name,m.mem_lastname,p.pet_type,p.amount,p.pet_balance	 "
                                            . " FROM petition p"
                                            . " INNER JOIN member m ON p.mem_id = m.mem_id WHERE p.aut_id != ''"
                                            . " ORDER BY p.pet_date asc ";
                                    $query_basic1 = mysqli_query($connect, $sql_basic1);
                                    while ($array_basic1 = mysqli_fetch_array($query_basic1)) {

                                        $a = $array_basic1['amount'];
                                        $b = $array_basic1['allowance'];
                                        $sum = $a + $b
                                        ?>
                                        <tr>
                                       
                                            <td><?= changedate($array_basic1['pet_date']) ?></td> <!--เปลี่ยน ว/ด/ป-->
                                            <td><?= $array_basic1['mem_name'] ?> <?= $array_basic1['mem_lastname'] ?></td>
                                            <td><?= $array_basic1['pet_type'] ?></td>
                                            <td style="text-align: right;"><?= number_format($array_basic1['amount'] + $array_basic1['allowance'], 2) ?></td> <!--แปลงข้อความเป็นชนิดรูปแบบตัวเลขหลักร้อยหรือทศนิยม-->
                                            <td style="text-align: right;"><?= number_format($array_basic1['allowance'], 2) ?>
                                            <td style="text-align: right;"><?= number_format($array_basic1['pet_balance'], 2) ?></td>
                                            <td style="text-align: right;"> <a class="btn btn-info mb-control senddatamodal data-detail" data-box="#message-box-info" href="deposit_money1.php?pet_id=<?= $array_basic1['pet_id'] ?>">ดูรายละเอียด</a></td>

                                        </tr>


                                        <?php
                                    }
                                    $sql_chk = "SELECT month(pay_date) as pay_month,year(pay_date) as pay_year,SUM(pet_amount) as pay_amount FROM payment WHERE month(pay_date) = month(NOW()) AND year(pay_date) = year(NOW()) GROUP BY pay_month,pay_year";
                                    $query_chk = mysqli_query($connect, $sql_chk);
                                    $array_chk = mysqli_fetch_array($query_chk);
                                    $mem_deposit = $array_chk['pay_amount'];
                                    ?>
                                </tbody>
                            </table>
                            <h1 style="color: red;">ยอดเงินนำส่งสถาบันการเงินเดือน <?=ChangMonth(date("n", strtotime('m')));?> <?= $mem_deposit ?> บาท </h1><!-- strtotime() เพื่อรับค่า timestamp(วินาทีนับจาก 1 มกราคม 1970) ของวันเวลาตาม string ที่ใส่เป็นพารามิเตอร์ -->
                        </div>
                    </div>
                    <!-- END DEFAULT DATATABLE -->
                </div>
            </div> 
        </div>
        <?php
        include 'footer.php';
        ?> 