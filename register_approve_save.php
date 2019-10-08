<?php
session_start();
include "connect_db.php";
if($_GET['mode'] == 'fail'){
$sql_update = "update register set req_state='2',req_disapproval='" . $_POST['disapproval'] . "' where reg_id='" . $_POST['reg_id'] . "'";
$query_update = mysqli_query($connect, $sql_update);    

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
        <div class="message-box message-box-warning animated fadeIn open" id="message-box-warning">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-check"></span> Success</div>
                    <div class="mb-content">
                        <p>ยกเลิกใบสมัครเรียบร้อยแล้ว</p>
                    </div>
                    <div class="mb-footer">
                        <a href="register_approve.php" class="btn btn-default btn-lg pull-right">Close</a>
                    </div>
                </div>
            </div>
        </div>


<?php
}else{
$sql_newid = "Select Max(substr(mem_id,-6))+1 as MaxID from member";
    $query_newid = mysqli_query($connect, $sql_newid);
    $array_newid = mysqli_fetch_array($query_newid);
    if ($array_newid['MaxID'] == '') {
        $newid = "MEM-000001";
    } else {
        $newid = "MEM-" . sprintf("%06d", $array_newid['MaxID']);
    }
$sql_update = "update register set req_state='1' where reg_id='" . $_GET['reg_id'] . "'";
$query_update = mysqli_query($connect, $sql_update);
    
$sql_insert = "select * from register where reg_id='" . $_GET['reg_id'] . "'";
$query_insert = mysqli_query($connect, $sql_insert);
$array_insert = mysqli_fetch_array($query_insert);
    $sql_update2 = "insert into member(mem_id,mem_title,mem_name,mem_lastname,mem_address,mem_card,mem_birthday,mem_work,mem_status,mem_nationality,mem_tel,reg_id,mem_deposit,mem_date) values"
            . "('" . $newid . "','" . $array_insert['req_title'] . "','" . $array_insert['reg_name'] . "','" . $array_insert['reg_lastname'] . "',"
            . "'" . $array_insert['req_address'] . "','" . $array_insert['reg_card'] . "','" . $array_insert['reg_birthday'] . "','" . $array_insert['reg_work'] . "',"
            . "'" . $array_insert['req_status'] . "','" . $array_insert['req_nationality'] . "','" . $array_insert['req_tel'] . "','" . $array_insert['reg_id'] . "',0,NOW())";
 $query_update2 = mysqli_query($connect, $sql_update2);
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
                        <p>อนุมัติการสมัครสมาชิกเรียบร้อยแล้ว</p>
                    </div>
                    <div class="mb-footer">
                        <a href="register_approve.php" class="btn btn-default btn-lg pull-right">Close</a>
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