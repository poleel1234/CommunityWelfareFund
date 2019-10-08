<?php
session_start();
include "connect_db.php";
$sql_newid2 = "Select Max(substr(dep_main_id,-6))+1 as MaxID from deposit_main";
$query_newid2 = mysqli_query($connect, $sql_newid2);
$array_newid2 = mysqli_fetch_array($query_newid2);
if ($array_newid2['MaxID'] == '') {
    $newid2 = "DEM-000001";
} else {
    $newid2 = "DEM-" . sprintf("%06d", $array_newid2['MaxID']);
}
$sql_insert2 = "insert into deposit_main(dep_main_id) values('" . $newid2 . "')";
$query_insert2 = mysqli_query($connect, $sql_insert2);

foreach ($_SESSION['session_monthyear'] as $key => $value) {
$sql_newid = "Select Max(substr(dep_id,-6))+1 as MaxID from deposit";
$query_newid = mysqli_query($connect, $sql_newid);
$array_newid = mysqli_fetch_array($query_newid);
if ($array_newid['MaxID'] == '') {
    $newid = "DEP-000001";
} else {
    $newid = "DEP-" . sprintf("%06d", $array_newid['MaxID']);
}
$sql_insert = "insert into deposit(dep_main_id,dep_id,dep_date,dep_month,dep_year,dep_amount,mem_id,aut_id) values"
        . "('" . $newid2 . "','" . $newid . "',NOW(),'" . $_SESSION['session_month'][$key] . "','" . $_SESSION['session_year'][$key] . "',30,"
        . "'" . $_SESSION['session_mem_id'] . "',"
        . "'" . $_SESSION['login_aut_id'] . "')";
$query_insert = mysqli_query($connect, $sql_insert);

$sql_update = "update member set mem_deposit = mem_deposit + 30 where mem_id='" . $_SESSION['session_mem_id'] . "'";
$query_update = mysqli_query($connect, $sql_update);
}
unset($_SESSION["session_mem_id"]);
unset($_SESSION["session_year_ses"]);
unset($_SESSION["session1"]);
unset($_SESSION["session2"]);
unset($_SESSION["session_monthyear"]);
unset($_SESSION["session_month"]);
unset($_SESSION["session_year"]);
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
                        <p>บันทึกรับฝากเงินเรียบร้อยแล้ว</p>
                    </div>
                    <div class="mb-footer">
                        <a href="dep_show.php" class="btn btn-default btn-lg pull-right">Close</a>
                    </div>
                </div>
            </div>
        </div>
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