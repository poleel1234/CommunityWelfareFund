<?php
session_start();
include "connect_db.php";

$sql_basic2 = "select * from get_benefits d "
        . "join member m on m.mem_id = d.mem_id "
        . "join benefits b on b.ben_id = d.ben_id "
        . "where d.get_id = '" . $_GET['mem_id'] . "' and d.get_id not in(select get_id from give_money)";
$query_basic2 = mysqli_query($connect, $sql_basic2);
$array_basic2 = mysqli_fetch_array($query_basic2);
?>
<div class="form-group">
    <label class="col-md-3 control-label">วันที่ขอรับ</label>
    <div class="col-md-9">     
        <input type="hidden" name="get_id" value="<?= $array_basic2['get_id'] ?>" readonly="" class="form-control"/>
        <input type="text" value="<?= changedate($array_basic2['get_date']) ?>" readonly="" class="form-control"/>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label">ประเภทสวัสดิการ</label>
    <div class="col-md-9">                                                                                            
        <input type="text" value="<?= $array_basic2['ben_category'] ?>" readonly="" class="form-control"/>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label">จำนวน/วัน</label>
    <div class="col-md-9">                                                                                            
        <input type="text" value="<?= number_format($array_basic2['get_condition2'],0) ?>" readonly="" class="form-control"/>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label">ได้รับเงิน/วัน</label>
    <div class="col-md-9">                                                                                            
        <input type="text" value="<?= number_format($array_basic2['ben_condition1'],2) ?>" readonly="" class="form-control"/>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label">ยอดสุทธิที่ได้รับ</label>
    <div class="col-md-9">                
        <?php
        $total = $array_basic2['ben_condition1'];
        if($array_basic2['ben_id'] == 'BEN-000016'){
            $total += $array_basic2['ben_condition1']+($array_basic2['ben_condition5']*$array_basic2['get_condition2']);
        }else{
            $total += $array_basic2['ben_condition1']*$array_basic2['get_condition2'];
        }
        ?>
        <input type="text" name="give_money" value="<?= number_format($total,2) ?>" readonly="" class="form-control"/>
    </div>
</div>