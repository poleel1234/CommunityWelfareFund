<?php
session_start();
include "connect_db.php";
if($_GET[mode] == 'edit'){
    $sql_newid = "Select Max(substr(reg_id,-6))+1 as MaxID from register";
    $query_newid = mysqli_query($connect, $sql_newid);
    $array_newid = mysqli_fetch_array($query_newid);
    if ($array_newid['MaxID'] == '') {
        $newid = "REQ-000001";
    } else {
        $newid = "REQ-" . sprintf("%06d", $array_newid['MaxID']);
    }
    
   $req_address = "บ้านเลขที่ " . $_POST['req_address1'] . " ถนน " . $_POST['req_address2'] . " ตำบล " . $_POST['req_address3'] . " อำเภอ " . $_POST['req_address4'] . " จังหวัด " . $_POST['req_address5'] . " รหัสไปรษณีย์ " . $_POST['req_address6'] . "";
$req_beneficiary_address = "บ้านเลขที่ " . $_POST['req_beneficiary_address'] . " ถนน " . $_POST['req_beneficiary_address2'] . " ตำบล " . $_POST['req_beneficiary_address3'] . " อำเภอ " . $_POST['req_beneficiary_address4'] . " จังหวัด " . $_POST['req_beneficiary_address5'] . "";
$sql_insert = "insert into register(reg_id,reg_date,req_title,reg_name,reg_lastname,reg_card,reg_birthday,"
        . "reg_age,reg_work,req_status,req_nationality,req_address,req_tel,req_condition,req_condition_date1,"
        . "req_condition_month1,req_condition_date2,req_condition_month2,req_beneficiary,"
        . "req_beneficiary_age,req_beneficiary_relation,req_beneficiary_address,req_state) values"
                . "('" . $newid . "','" . $_POST['reg_date'] . "','" . $_POST['req_title'] . "',"
                . "'" . $_POST['reg_name'] . "','" . $_POST['reg_lastname'] . "','" . $_POST['reg_card'] . "',"
                . "'" . $_POST['reg_birthday'] . "','" . $_POST['reg_age'] . "','" . $_POST['reg_work'] . "',"
        . "'" . $_POST['req_status'] . "','" . $_POST['req_nationality'] . "','" . $req_address . "',"
        . "'" . $_POST['req_tel'] . "','" . $_POST['req_condition'] . "','" . $_POST['req_condition_date1'] . "',"
        . "'" . $_POST['req_condition_month1'] . "','" . $_POST['req_condition_date2'] . "','" . $_POST['req_condition_month2'] . "',"
        . "'" . $_POST['req_beneficiary'] . "','" . $_POST['req_beneficiary_age'] . "','" . $_POST['req_beneficiary_relation'] . "',"
        . "'" . $_POST['req_beneficiary_relation'] . "','0')";
        $query_insert = mysqli_query($connect, $sql_insert);   
        ?>
<!DOCTYPE html>
<html lang="en">
    <head>        
        <title>ระบบกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="favicon.ico" type="image/x-icon" />   
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
    </head>
    <body>
        <div class="message-box message-box-success animated fadeIn open" id="message-box-success">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-check"></span> Success</div>
                    <div class="mb-content">
                        <p>แก้ไขใบสมัครเรียบร้อยแล้ว, ใบสมัครของท่านจะถูกพิจารณาในขั้นตอนถัดไป</p>
                    </div>
                    <div class="mb-footer">
                        <a href="index.php" class="btn btn-default btn-lg pull-right">Close</a>
                    </div>
                </div>
            </div>
        </div>
<?php
}else{
	 $SQL_LOGINCHK3 = "SELECT * FROM member m LEFT JOIN register r on r.reg_id = m.reg_id WHERE m.mem_card='".$_POST['reg_card']."'";
     $QUERY_LOGINCHK3 = mysqli_query($connect, $SQL_LOGINCHK3);
     $NUM_LOGINCHK3 = mysqli_num_rows($QUERY_LOGINCHK3);
        if ($NUM_LOGINCHK3 > 0) {
			echo "<script>alert('เลขบัตรประชาชนซ้ำ');</script>";
            echo "<meta http-equiv='refresh' content='0; URL=register.php'>";
			exit();
		}else{	
		$SQL_LOGINCHK2 = "SELECT * FROM register WHERE reg_card='".$_POST['reg_card']."' and req_state != 1 limit 1 ";
        $QUERY_LOGINCHK2 = mysqli_query($connect, $SQL_LOGINCHK2);
        $NUM_LOGINCHK2 = mysqli_num_rows($QUERY_LOGINCHK2);
        if ($NUM_LOGINCHK2 > 0) {
			echo "<script>alert('เลขบัตรประชาชนซ้ำ');</script>";
            echo "<meta http-equiv='refresh' content='0; URL=register.php'>";
			exit();
		}else{
		
   $req_address = "บ้านเลขที่ " . $_POST['req_address1'] . " ถนน " . $_POST['req_address2'] . " ตำบล " . $_POST['req_address3'] . " อำเภอ " . $_POST['req_address4'] . " จังหวัด " . $_POST['req_address5'] . " รหัสไปรษณีย์ " . $_POST['req_address6'] . "";
$req_beneficiary_address = "บ้านเลขที่ " . $_POST['req_beneficiary_address'] . " ถนน " . $_POST['req_beneficiary_address2'] . " ตำบล " . $_POST['req_beneficiary_address3'] . " อำเภอ " . $_POST['req_beneficiary_address4'] . " จังหวัด " . $_POST['req_beneficiary_address5'] . "";
$sql_insert = "insert into register(reg_id,reg_date,req_title,reg_name,reg_lastname,reg_card,reg_birthday,"
        . "reg_age,reg_work,req_status,req_nationality,req_address,req_tel,req_condition,req_condition_date1,"
        . "req_condition_month1,req_condition_date2,req_condition_month2,req_beneficiary,"
        . "req_beneficiary_age,req_beneficiary_relation,req_beneficiary_address,req_state) values"
                . "('" . $_POST['reg_id'] . "','" . $_POST['reg_date'] . "','" . $_POST['req_title'] . "',"
                . "'" . $_POST['reg_name'] . "','" . $_POST['reg_lastname'] . "','" . $_POST['reg_card'] . "',"
                . "'" . $_POST['reg_birthday'] . "','" . $_POST['reg_age'] . "','" . $_POST['reg_work'] . "',"
        . "'" . $_POST['req_status'] . "','" . $_POST['req_nationality'] . "','" . $req_address . "',"
        . "'" . $_POST['req_tel'] . "','" . $_POST['req_condition'] . "','" . $_POST['req_condition_date1'] . "',"
        . "'" . $_POST['req_condition_month1'] . "','" . $_POST['req_condition_date2'] . "','" . $_POST['req_condition_month2'] . "',"
        . "'" . $_POST['req_beneficiary'] . "','" . $_POST['req_beneficiary_age'] . "','" . $_POST['req_beneficiary_relation'] . "',"
        . "'" . $req_beneficiary_address . "','0')";
        $query_insert = mysqli_query($connect, $sql_insert);
		}
		}
        ?>
<!DOCTYPE html>
<html lang="en">
    <head>        
        <title>ระบบกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="favicon.ico" type="image/x-icon" />   
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
    </head>
    <body>
        <div class="message-box message-box-success animated fadeIn open" id="message-box-success">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-check"></span> Success</div>
                    <div class="mb-content">
                        <p>สมัครสมาชิกเรียบร้อยแล้ว, ท่านสามารถเข้าสู่ระบบได้ทันที โดยกรอกเลขบัตรประจำตัวประชาชน ที่ช่อง Username และ Password การทำรายการอื่นๆต้องรอการอนุมัติใบสมัครของท่านก่อน</p>
                    </div>
                    <div class="mb-footer">
                        <a href="login.php" class="btn btn-default btn-lg pull-right">Close</a>
                    </div>
                </div>
            </div>
        </div>
<?php
}
?>
<audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
<audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>        
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>    
<script type="text/javascript" src="js/settings.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>        
<script type="text/javascript" src="js/actions.js"></script>        
<audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
<audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>              

<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>                
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="js/plugins/scrolltotop/scrolltopcontrol.js"></script>
<script type="text/javascript" src="js/plugins/morris/raphael-min.js"></script>
<script type="text/javascript" src="js/plugins/morris/morris.min.js"></script>       
<script type="text/javascript" src="js/plugins/rickshaw/d3.v3.js"></script>
<script type="text/javascript" src="js/plugins/rickshaw/rickshaw.min.js"></script>
<script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
<script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>                
<script type="text/javascript" src="js/plugins/owl/owl.carousel.min.js"></script>                 
<script type="text/javascript" src="js/plugins/moment.min.js"></script>
<script type="text/javascript" src="js/plugins/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="js/demo_dashboard.js"></script>    
</body>
</html>