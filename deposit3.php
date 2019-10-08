<?php
session_start();
include "connect_db.php";

$sql_basic2 = "select * from member m join register r on r.reg_id = m.reg_id where m.mem_id = '" . $_GET['mem_id'] . "'";
$query_basic2 = mysqli_query($connect, $sql_basic2);
$array_basic2 = mysqli_fetch_array($query_basic2);
if ($array_basic2['req_condition'] == '1') {
    $req_condition_output = 'ครั้งละ 1 บาท ส่งเงินทุกวัน ครั้งละ 30 บาท (30วัน) ส่งเงินวันที่ ' . $array_basic2['req_condition_date1'] . ' ของทุกเดือน';
    $dep_amount = 1;
} elseif ($array_basic2['req_condition'] == '2') {
    $req_condition_output = 'ครั้งละ 90 บาท (90 วัน หรือ 3 เดือน) ส่งเงินวันที่ ' . $array_basic2['req_condition_date1'] . ' เดือน ' . $array_basic2['req_condition_month1'] . ' และวันที่ ' . $array_basic2['req_condition_date2'] . ' เดือน ' . $array_basic2['req_condition_month2'] . '';
    $dep_amount = 90;
} elseif ($array_basic2['req_condition'] == '3') {
    $req_condition_output = 'ครั้งละ 180 บาท (180 วัน หรือ 6 เดือน) ส่งเงินวันที่ ' . $array_basic2['req_condition_date1'] . ' เดือน ' . $array_basic2['req_condition_month1'] . ' และวันที่ ' . $array_basic2['req_condition_date2'] . ' เดือน ' . $array_basic2['req_condition_month2'] . '';
    $dep_amount = 180;
} elseif ($array_basic2['req_condition'] == '4') {
    $req_condition_output = 'ครั้งละ 360 บาท (360 วัน หรือ 1 ปี) ส่งเงินวันที่ ' . $array_basic2['req_condition_date1'] . ' เดือน ' . $array_basic2['req_condition_month1'] . ' และวันที่ ' . $array_basic2['req_condition_date2'] . ' เดือน ' . $array_basic2['req_condition_month2'] . '';
    $dep_amount = 360;
}
?>
<form class="form-horizontal" action="deposit_add.php?mode=add" method="POST" autocomplete="off" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3 control-label">เดือนที่ต้องการฝาก</label>
                <div class="col-md-9">                                                                                
                    <select class="form-control" data-live-search="true" name="month" id="month" required="">
                        <?php
                        $THAI_MOUTH = array(1 => "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
                            "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

                        foreach ($THAI_MOUTH as $m) {
                            ?>
                            <option value="<?= $m ?>"><?= $m ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3 control-label">ปี</label>
                <div class="col-md-9">                                                                                
                    <select class="form-control" data-live-search="true" name="year" id="year" required="">
                        <?php
                        $time = strtotime("now");
                        $pyear = date("Y", $time);
                        $year = date("Y", $time) - 10;
                        for ($index = 0; $index < 21; $index++) {
                            $THAI_YEAR = $year + 543;
                            ?>
                            <option value="<?= $year ?>" <?php
                            if ($year == $pyear) {
                                echo "selected";
                            }
                            ?>><?= $THAI_YEAR ?></option>
    <?php $year++;
}
?>
                    </select>
                </div>
            </div>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3 control-label">ยอดฝากต่อเดือน</label>
                <div class="col-md-9">                                                                                
                    <input type="number" name="dep_amount" value="30" readonly="" class="form-control"/>
                </div>
            </div>
            <center><button class="btn btn-primary" type="submit">เพิ่มรายการ</button></center>
        </div>
    </div><br>
</form>
<!--<div class="row">
    <div class="col-md-6">
<div class="form-group">
    <label class="col-md-3 control-label">จำนวนเงินฝาก</label>
    <div class="col-md-9">                                                                                            
        <input type="number" name="dep_amount2" class="form-control" required=""/>
        <select class="form-control select" name="aut_position" required="">
<?php
$m = 30;
$a = 1;
for ($index = 0; $index < 12; $index++) {
    ?>
                    <option><?= $m; ?> บาท (สำหรับ <?= $a; ?> เดือน)</option>
    <?php
    $m = $m + 30;
    $a++;
}
?>
        </select>        
    </div>
</div>
    </div>
</div>-->
<div class="form-group">
    <div class="col-md-1"></div>
    <label class="col-md-12 control-label" style="text-align:left;color: red;">เงื่อนไขการฝากเงินที่สมาชิกท่านนี้เลือก : <?php echo $req_condition_output; ?></label>
</div>
<?php
include 'footer.php';
?>