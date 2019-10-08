<?php
session_start();
$pagemain = 'deposit_money';
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
$total = 0;
$sql_basic1 = "SELECT p.pet_balance,p.pet_id, CONCAT(m.mem_title, ' ', m.mem_name, ' ', m.mem_lastname) AS name,p.pet_date,b.ben_category,p.amount,b.interest,b.interest_type,p.allowance,CONCAT(a.aut_name, ' ', a.aut_lastname, ' [', a.aut_position, '] ') AS aut,p.pet_type FROM petition p JOIN member m ON m.mem_id = p.mem_id JOIN benefits b ON b.ben_id = p.ben_id JOIN authorities a ON a.aut_id = p.aut_id WHERE p.pet_id = '" . $_GET['pet_id'] . "'";
$query_basic1 = mysqli_query($connect, $sql_basic1);
$array_basic1 = mysqli_fetch_array($query_basic1);
$total = $array_basic1['amount'] + $array_basic1['interest'];  //การคำนวนเงิน 
$m = $total / $array_basic1['allowance']; // 11 เดือน
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
    <li class="active">รายการนำส่งเงิน</li>
</ul>
<!-- START DEFAULT DATATABLE -->
<div class="panel panel-default">
    <div class="panel-heading">                   
        <div class="panel-title">
            <h2><i class="fa fa-info-circle"></i> รายการนำส่งเงิน (หักจากเบี้ยยังชีพ)</h2>
        </div>            <a href="deposit_money.php" style="float:right;"><button type="button" class="btn btn-danger"><span class="fa fa-reply"></span> ย้อนกลับ</button></a>

        <div class="panel panel-default">
            <div class="panel-body">                                                                        
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-2 control-label">เลขที่กู้ยืม</label>
                            <div class="col-md-4">                                            
                                <div class="input-group">
                                    <input type="text" value="<?= $array_basic1['pet_id'] ?>" readonly="" class="form-control"/>
                                </div>                                            
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="col-md-2 control-label">ผู้ขอกู้ยืม</label>
                            <div class="col-md-4">                                            
                                <div class="input-group">
                                    <input type="text" value="<?= $array_basic1['name'] ?>" readonly="" class="form-control"/>
                                </div>                                            
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="col-md-2 control-label">วันที่ขอกู้ยืม</label>
                            <div class="col-md-4">                                            
                                <div class="input-group">
                                    <input type="text" value="<?= changedate($array_basic1['pet_date']); ?>" readonly="" class="form-control"/>
                                </div>                                            
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-md-2 control-label">ประเภทเงินกู้</label>
                            <div class="col-md-4">                                            
                                <div class="input-group">
                                    <input type="text" value="<?= $array_basic1['pet_type'] ?>" readonly="" class="form-control"/>
                                </div>                                            
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="col-md-2 control-label">ผู้อนุมัติ</label>
                            <div class="col-md-4">                                            
                                <div class="input-group">
                                    <input type="text" value="<?= $array_basic1['aut'] ?>" readonly="" class="form-control"/>
                                </div>                                            
                            </div>
                        </div><br>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label">ยอดที่กู้</label>
                            <div class="col-md-4">                                            
                                <div class="input-group">
                                    <input type="text" value="<?= number_format($array_basic1['amount'], 2) ?>" readonly="" class="form-control"/>
                                </div>                                            
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="col-md-3 control-label">ดอกเบี้ย/<?= $array_basic1['interest_type'] ?></label>
                            <div class="col-md-4">                                            
                                <div class="input-group">
                                    <input type="text" value="<?= number_format($array_basic1['interest'], 2) ?>" readonly="" class="form-control"/>
                                </div>                                            
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="col-md-3 control-label">หักเบี้ยยังชีพ/เดือน</label>
                            <div class="col-md-4">                                            
                                <div class="input-group">
                                    <input type="text" value="<?= number_format($array_basic1['allowance'], 2) ?>" readonly="" class="form-control"/>
                                </div>                                            
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="col-md-3 control-label">ยอดหนี้</label>
                            <div class="col-md-4">                                            
                                <div class="input-group">
                                    <input type="text" value="<?= number_format($array_basic1['pet_balance'], 2) ?>" readonly="" class="form-control"/>
                                </div>                                            
                            </div>
                        </div><br>
                    </div>
                </div>
                <!--ประเภทกู้ยืม : <?= $array_basic1['ben_category'] ?> -->
                <br>
                <?php
                $date = date($array_basic1['pet_date']); // วันทีกู้
                $curDate = date('Y-m-d'); //วันเดือนปี
                $currentDate = date('Y-m-d', strtotime($date . " +1 month")); //บวก + 1 เดือน
                $nextDate = date('Y-m-d', strtotime($date . " +$m month")); // เดือนทั้งหมด 11 เดือน
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label">ระยะเวลาชำระ/เดือน</label>
                            <div class="col-md-4">                                            
                                <div class="input-group">
                                    <input type="text" value="<?= $m ?>" readonly="" class="form-control"/>
                                </div>                                            
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="col-md-2 control-label">เริ่มหักเบี้ยยังชีพ</label>
                            <div class="col-md-4">                                            
                                <div class="input-group">
                                    <input type="text" value="<?= changedate($currentDate); ?>" readonly="" class="form-control"/>
                                </div>                                            
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="col-md-2 control-label">สิ้นสุด</label>
                            <div class="col-md-4">                                            
                                <div class="input-group">
                                    <input type="text" value="<?= changedate($nextDate); ?>" readonly="" class="form-control"/>
                                </div>                                            
                            </div>
                        </div><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content-wrap">                

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">                   
                        <h3 class="panel-title">ตารางการหักเบี้ยยังชีพ</h3>                              
                    </div>
                    <div class="panel-body">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <?php
                                    $n = 0;
                                    for ($i = 1; $i < $m + 1; $i++) { //ถ้า i=0 i< $m + 1 ทำงานจนกว่า ถึง 11 
                                        $n++;
                                        ?>
                                        <th><?= changedate(date('Y-m-d', strtotime($date . " +$n month"))) ?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <?php
                                    $n1 = $m + 1; //ใช้เดือน 11 
                                    $nextDate1 = date('Y-m-d', strtotime($date . " +$n1 month"));
                                    $pet_balance = $array_basic1['amount'] + $array_basic1['allowance'];
                                    if ($curDate >= $nextDate1) {


                                        $sql_update = "update petition set pet_state = 1 where pet_id='" . $_GET['pet_id'] . "'"; //อัพเดตสถานะชำระแล้วกับยังไม่ชำระ
                                        $query_update = mysqli_query($connect, $sql_update);
                                    } else {
                                        
                                    }
                                    ?>

                                    <?php
                                    $n = 0; //ใช้ตำนวนเดือนหักลบเงิน โชว์ชำระเงิน
                                    $pet_balance1 = 0;
                                    $pet_balance2 = 0;
                                    for ($i = 1; $i < $m + 1; $i++) {
                                        $n++;
                                        if ($curDate >= date('Y-m-d', strtotime($date . " +$n month"))) { //วันที่ตั้งแต่เริ่มจนถึงปัจจุบัน
                                            $pet_balance1 += $array_basic1['allowance']; //ให้เบี้ยงยังชัพ+เข้าไปใน ยอดหนี้คงค้าง
                                            $pet_balance2 = $array_basic1['allowance']; //ให้เบี้ยงยังชัพ+เข้าไปใน ยอดหนี้คงค้าง

                                            $sql_newid = "Select Max(substr(pay_id,-6))+1 as MaxID from payment";
                                            $query_newid = mysqli_query($connect, $sql_newid);
                                            $array_newid = mysqli_fetch_array($query_newid);
                                            if ($array_newid['MaxID'] == '') {
                                                $newid = "PAY-000001";
                                            } else {
                                                $newid = "PAY-" . sprintf("%06d", $array_newid['MaxID']);
                                            }

                                            $sql_chk = "SELECT COUNT(*) AS NUM FROM payment WHERE month(pay_date) = month(NOW()) and year(pay_date) = year(NOW()) and pet_id = '" . $_GET['pet_id'] . "' ";
                                            $query_chk = mysqli_query($connect, $sql_chk);
                                            $array_chk = mysqli_fetch_array($query_chk);

                                            if ($array_chk['NUM'] == 0 && date('Y-m', strtotime($date . " +$n month")) == date('Y-m')) {
                                                $sql_insert = "insert into payment(pay_id,pay_date,pet_id,pet_amount) values"
                                                        . "('" . $newid . "','" . date('Y-m-d', strtotime($date . " +$n month")) . "','" . $_GET['pet_id'] . "',"
                                                        . "'" . $pet_balance2 . "')";
                                                $query_insert = mysqli_query($connect, $sql_insert);
                                            }
                                            ?>
                                            <td>ชำระแล้ว</td>
                                        <?php } else {
                                            ?>
                                            <td>-</td>
                                            <?php
                                        }
                                    }

                                    $sql_update_pet_balance = "update petition set pet_balance = ($pet_balance-$pet_balance1) where pet_id='" . $_GET['pet_id'] . "'";
                                    $query_update_balance = mysqli_query($connect, $sql_update_pet_balance); //อัตเดต ยอดหนี้คงเหลือ
                                    ?>
                                </tr>
                                <?php ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END DEFAULT DATATABLE -->
            </div>
        </div> 
    </div>
    <?php
    include 'footer.php';
    ?> 