<?php
session_start();
include "connect_db.php";
$sql_insert = "insert into give_money(give_id,aut_id,get_id,give_money,give_date,give_chk,give_name) values"
        . "('" . $_POST['give_id'] . "','" . $_SESSION['login_aut_id'] . "','" . $_POST['get_id'] . "','" . $_POST['give_money'] . "',NOW(),'" . $_POST['give_chk'] . "','" . $_POST['give_name'] . "')";
$query_insert = mysqli_query($connect, $sql_insert);

echo "<script>alert('บันทึกการมอบเงินเรียบร้อยแล้ว ');</script>";
echo "<META http-equiv='refresh' Content='0; URL=give_money_show.php'> ";
?>