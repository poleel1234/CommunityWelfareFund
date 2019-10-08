<?php

session_start();
include "connect_db.php";
if ($_POST['username'] != '' && $_POST['password'] != '') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $SQL_LOGINCHK = "SELECT * FROM authorities WHERE aut_username='$username' AND aut_password='$password' ";
    $QUERY_LOGINCHK = mysqli_query($connect, $SQL_LOGINCHK);
    $NUM_LOGINCHK = mysqli_num_rows($QUERY_LOGINCHK);
    $position = "SELECT * FROM authorities WHERE aut_position";

    if ($NUM_LOGINCHK > 0) {
        while ($ARRAY_LOGINCHK = mysqli_fetch_array($QUERY_LOGINCHK)) {
            $_SESSION['ses_userid'] = session_id();
            $_SESSION['login_aut_id'] = $ARRAY_LOGINCHK['aut_id'];
            $_SESSION['login_aut_position'] = $ARRAY_LOGINCHK['aut_position'];
            echo "<script>alert('ยินดีต้อนรับเข้าสู่ระบบคุณ " . $ARRAY_LOGINCHK['aut_name'] . " " . $ARRAY_LOGINCHK['aut_lastname'] . "');</script>";

            if ($position = "เจ้าหน้าที่") {
                echo "<meta http-equiv='refresh' content='0; URL=dashboard.php'>";
            }
            if ($position = "ผู้บริหาร") {
                echo "<meta http-equiv='refresh' content='0; URL=dashboard1.php'>";
            }
        }
        exit();
    }

    $SQL_LOGI = "SELECT * FROM member m  WHERE m.mem_card='$username'";
    $QUERY_LOGI = mysqli_query($connect, $SQL_LOGI);
    $ARRAY_LOGI = mysqli_fetch_array($QUERY_LOGI);
    if (isset($ARRAY_LOGI['mem_pass']) && !empty($ARRAY_LOGI['mem_pass'])) { 
        $SQL_LOGINCHK3 = "SELECT * FROM member m LEFT JOIN register r on r.reg_id = m.reg_id WHERE m.mem_card='$username' AND m.mem_pass='$password'";
        $QUERY_LOGINCHK3 = mysqli_query($connect, $SQL_LOGINCHK3);
        $NUM_LOGINCHK3 = mysqli_num_rows($QUERY_LOGINCHK3);
        if ($NUM_LOGINCHK3 > 0) {
            while ($ARRAY_LOGINCHK3 = mysqli_fetch_array($QUERY_LOGINCHK3)) {
                $_SESSION['ses_userid'] = session_id();
                $_SESSION['login_reg_id'] = $ARRAY_LOGINCHK3['mem_id'];
                $_SESSION['login_req_state'] = $ARRAY_LOGINCHK3['req_state'];
                $_SESSION['login_reg_card3'] = $ARRAY_LOGINCHK3['mem_card'];
                echo "<script>alert('ยินดีต้อนรับเข้าสู่ระบบคุณ " . $ARRAY_LOGINCHK3['mem_name'] . " " . $ARRAY_LOGINCHK3['mem_lastname'] . "');</script>";
                echo "<meta http-equiv='refresh' content='0; URL=index.php'>";
            }
            exit();
        }
    } else {
        $SQL_LOGINCHK3 = "SELECT * FROM member m LEFT JOIN register r on r.reg_id = m.reg_id WHERE m.mem_card='$username' AND m.mem_card='$password'";
        $QUERY_LOGINCHK3 = mysqli_query($connect, $SQL_LOGINCHK3);
        $NUM_LOGINCHK3 = mysqli_num_rows($QUERY_LOGINCHK3);
        if ($NUM_LOGINCHK3 > 0) {
            while ($ARRAY_LOGINCHK3 = mysqli_fetch_array($QUERY_LOGINCHK3)) {
                $_SESSION['ses_userid'] = session_id();
                $_SESSION['login_reg_id'] = $ARRAY_LOGINCHK3['mem_id'];
                $_SESSION['login_req_state'] = $ARRAY_LOGINCHK3['req_state'];
                $_SESSION['login_reg_card3'] = $ARRAY_LOGINCHK3['mem_card'];
                echo "<script>alert('ยินดีต้อนรับเข้าสู่ระบบคุณ " . $ARRAY_LOGINCHK3['mem_name'] . " " . $ARRAY_LOGINCHK3['mem_lastname'] . "');</script>";
                echo "<meta http-equiv='refresh' content='0; URL=index.php'>";
            }
            exit();
        }
    }



    $SQL_LOGINCHK2 = "SELECT * FROM register WHERE reg_card='$username' AND reg_card='$password' and req_state = 0 limit 1 ";
    $QUERY_LOGINCHK2 = mysqli_query($connect, $SQL_LOGINCHK2);
    $NUM_LOGINCHK2 = mysqli_num_rows($QUERY_LOGINCHK2);
    if ($NUM_LOGINCHK2 > 0) {
        while ($ARRAY_LOGINCHK2 = mysqli_fetch_array($QUERY_LOGINCHK2)) {
            $_SESSION['ses_userid'] = session_id();
            $_SESSION['login_reg_id'] = $ARRAY_LOGINCHK2['reg_id'];
            $_SESSION['login_req_state'] = $ARRAY_LOGINCHK2['req_state'];
            $_SESSION['login_reg_card'] = $ARRAY_LOGINCHK2['reg_card'];
            echo "<script>alert('ยินดีต้อนรับเข้าสู่ระบบคุณ " . $ARRAY_LOGINCHK2['reg_name'] . " " . $ARRAY_LOGINCHK2['reg_lastname'] . "');</script>";
            echo "<meta http-equiv='refresh' content='0; URL=index.php'>";
        }
        exit();
    }
    echo "<script>alert('Username and Password Incorrect!');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=login.php' />";
    exit();
}
?>