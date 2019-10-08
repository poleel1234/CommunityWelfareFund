<?php
session_start();
include "connect_db.php";

$memdate2 = $array_login3['mem_birthday'];
$YearStart2 = date("Y");
$YearEnd2 = date("Y", strtotime($memdate2));
$DateNum2 = $YearStart2 - $YearEnd2;

$sql_basic2 = "select * from benefits where ben_type = '" . $_GET['pet_type'] . "' ";
$query_basic2 = mysqli_query($connect, $sql_basic2);
$amount = 0;
$Allowance = 0;
while ($array_basic2 = mysqli_fetch_array($query_basic2)) {
    if ($array_basic2['span_of_age_to'] == null) {
        $amount = $array_basic2['ben_condition2'];
        $Allowance = $array_basic2['ben_condition1'];
        $ben_id = $array_basic2['ben_id'];
    } else {
        if ($DateNum2 >= $array_basic2['span_of_age_to'] && $DateNum2 <= $array_basic2['span_of_age_from']) {
            $amount = $array_basic2['ben_condition2'];
            $Allowance = $array_basic2['ben_condition1'];
            $ben_id = $array_basic2['ben_id'];
        }
    }
}
$memdate = $array_login3['mem_date'];
$DateStart = date("d");
$MonthStart = date("m");
$YearStart = date("Y");
$DateEnd = date("d", strtotime($memdate));
$MonthEnd = date("m", strtotime($memdate));
$YearEnd = date("Y", strtotime($memdate));
$Start = mktime(0, 0, 0, $MonthStart, $DateStart, $YearStart);
$End = mktime(0, 0, 0, $MonthEnd, $DateEnd, $YearEnd);
$DateNum = ceil(($Start - $End) / 86400);

$Y = $YearStart - $YearEnd;
$M = $MonthStart - $MonthEnd;
$D = $DateStart - $DateEnd;
if ($DateNum2 < 60) {
    $alert = '<p style="color:red;">ไม่สามารถกู้ได้</p>';
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-1"></div>
            <label class="col-md-8 control-label" style="text-align:left;">มีความประสงค์จะขอกู้เงินประเภทเงินกู้เพื่อพัฒนาคุณภาพชีวิต จากสถาบันการเงินชุมชนเทศบาลเมืองยโสธร เป็นจำนวนเงิน</label>
            <div class="col-md-2">
                <input type="text" name="amount" id="amount" value="<?= $amount; ?>" readonly="" class="form-control"/>
            </div>
            <label class="col-md-1 control-label" style="text-align:left;">บาท</label>
        </div>
    </div>
</div><br>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-1"></div>
            <label class="col-md-2 control-label" style="text-align:left;">(<?php echo Convert($amount); ?>)</label>
            <label class="col-md-3 control-label" style="text-align:left;">โดยมีวัตถุประสงค์แห่งการกู้เพื่อ <b style="color:red;">*</b></label>
            <div class="col-md-6">
                <textarea class="form-control" name="cause" rows="3" required=""></textarea>
            </div>
        </div>
    </div>
</div><br>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-1"></div>
            <label class="col-md-3 control-label" style="text-align:left;">ปัจจุบันข้าพเจ้า มีหุ้นในสถาบันการเงิน <b style="color:red;">*</b></label>
            <div class="col-md-2">
                <input type="number" name="share" id="share" required="" value="0.00" class="form-control"/>
            </div>
            <label class="col-md-1 control-label" style="text-align:left;">บาท</label>
        </div>
    </div>
</div><br>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-1"></div>
            <label class="col-md-3 control-label" style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;มีรายได้อื่นๆ เดือนละ <b style="color:red;">*</b></label>
            <div class="col-md-2">
                <input type="number" name="income" id="income" required="" value="0.00" class="form-control"/>
            </div>
            <label class="col-md-1 control-label" style="text-align:left;">บาท</label>
        </div>
    </div>
</div><br>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-1"></div>
            <label class="col-md-3 control-label" style="text-align:left;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;เบี้ยยังชีพ เดือนละ</label>
            <div class="col-md-2">
                <input type="text" name="allowance" id="allowance" value="<?= $Allowance ; ?>" readonly="" class="form-control"/>
                <input type="hidden" value="<?= $ben_id ?>" name="ben_id" class="form-control"/>
            </div>
            <label class="col-md-1 control-label" style="text-align:left;">บาท</label>
        </div>
    </div>
</div><br>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-1"></div>
            <label class="col-md-11 control-label" style="text-align:left;">จึงเรียนมาเพื่อโปรดพิจารณา</label>
        </div>
    </div>
</div><br>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-1"></div>
            <label class="col-md-11 control-label" style="text-align:center;">ขอแสดงความนับถือ</label>
        </div>
    </div>
</div><br>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-1"></div>
            <label class="col-md-11 control-label" style="text-align:center;"><?= $array_login3['mem_name'] ?>  <?= $array_login3['mem_lastname'] ?></label>
        </div>
    </div>
</div><br>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-1"></div>
            <label class="col-md-11 control-label" style="text-align:center;">(<?= $array_login3['mem_title'] ?><?= $array_login3['mem_name'] ?>  <?= $array_login3['mem_lastname'] ?>)</label>
        </div>
    </div>
</div><br>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-1"></div>
            <label class="col-md-11 control-label" style="text-align:center;">ผู้ขอกู้</label>
        </div>
    </div>
</div><br>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-6">
                <table border="1" style="padding: 5px;" cellspacing="0"  width="100%">
                    <tr>
                        <td style="text-align: left;padding: 5px;">เรียน ประธานอนุกรรมการพิจารณาเงินกู้เพื่อพัฒนาคุณภาพชีวิต<br><br>
                            - ได้ตรวจสอบคำขอกู้ สัญญากู้เงิน สัญญาค้ำประกัน และเอกสารประกอบสัญญาต่าง ๆ ครบถ้วน ถูกต้อง เรียบร้อยแล้ว<br>
                            <br><br>(&emsp;&emsp;) ควรพิจารณาอนุมัติ<br><br>
                            (&emsp;&emsp;) ความเห็นอื่นๆ ......................................................................
                            <p align="center">
                                <br><br>ลงชื่อ......................ผู้ขออนุมัติ
                                <br><br>(นายบุญหลาย มารักษ์)<br><br>
                                ผู้จัดการ<br><br>
                            </p>

                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table border="1" style="padding: 5px;" cellspacing="0"  width="100%">
                    <tr>
                        <td style="text-align: center;padding: 5px;">
                            ผลการพิจารณา<br><br>
                            คณะอนุกรรมการพิจารณาเงินกู้เพื่อพัฒนาคุณภาพชีวิต<br><br>
                            (&emsp;&emsp;) อนุมัติ &emsp;&emsp;(&emsp;&emsp;) ไม่อนุมัติ &emsp;&emsp;ลงชื่อ.........................................................<br><br>
                            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;(.........................................................)<br><br>
                            (&emsp;&emsp;) อนุมัติ &emsp;&emsp;(&emsp;&emsp;) ไม่อนุมัติ &emsp;&emsp;ลงชื่อ.........................................................<br><br>
                            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;(.........................................................)<br><br>
                            (&emsp;&emsp;) อนุมัติ &emsp;&emsp;(&emsp;&emsp;) ไม่อนุมัติ &emsp;&emsp;ลงชื่อ.........................................................<br><br>
                            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;(.........................................................)<br><br><br><br>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div><br>
<?php
if ($DateNum >= 365) {
    ?>
    <h1>ท่านเป็นสมาชิกมาแล้ว <?= $Y ?> ปี <?= $M ?> เดือน <?= $D ?> วัน อายุ <?= $DateNum2 ?> ปี <?= $alert ?></h1> 
<?php } ?>
<div class="panel-footer">
    <button class="btn btn-default" type="reset">Clear Form</button>   
    <?php
    if ($DateNum2 >= 60) {
        ?>
        <button class="btn btn-primary pull-right Copy10" type="submit">ส่งใบคำร้องขอกู้เงินเพื่อพัฒนาคุณภาพชีวิต</button>
    <?php } ?>
</div>
<script>
    $('#amount').keyup(function () {
        var amount = Number($('#amount').val());
        var petiton = Number($('#petiton').val());

        console.log('amount: ' + amount);
        console.log('petiton: ' + petiton);
        if (amount > petiton) {
            $(".Copy10").addClass('hidden');
        } else {
            $(".Copy10").removeClass('hidden');
        }
    });
</script>
<?php
include 'footer.php';
?>