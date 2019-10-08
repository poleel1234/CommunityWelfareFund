<?php

@session_start();
include "connect_db.php";
if ($_GET['mode'] == "add") {
    $_SESSION['session1'] = $_POST['month'];
    $_SESSION['session2'] = $_POST['year'];
    $monthyear = $_POST['month'];
    $monthyear .= "/";
    $monthyear .= $_POST['year'];
    if (in_array($monthyear, $_SESSION['session_monthyear'])) {
        echo "<script>alert('$monthyear มีอยู่แล้วในตารางด้านล่าง');</script>";
    echo "<meta http-equiv='refresh' content = '0; URL =dep.php'>";
    }else{
    $_SESSION['session_monthyear'][] = $monthyear;
    $_SESSION['session_month'][] = $_POST['month'];
    $_SESSION['session_year'][] = $_POST['year'];
    echo "<meta http-equiv='refresh' content = '0; URL =dep.php'>";
    }
}
?>