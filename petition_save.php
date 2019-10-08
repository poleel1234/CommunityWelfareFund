<?php
session_start();
include "connect_db.php";
$sql_newid = "Select Max(substr(pet_id,-6))+1 as MaxID from petition";
$query_newid = mysqli_query($connect, $sql_newid);
$array_newid = mysqli_fetch_array($query_newid);
if ($array_newid['MaxID'] == '') {
    $newid = "PET-000001";
} else {
    $newid = "PET-" . sprintf("%06d", $array_newid['MaxID']);
}
$balance = $_POST['amount']+$_POST['allowance'];
$sql_insert = "insert into petition(pet_id,aut_id,mem_id,pet_date,ben_id,amount,cause,share,income,allowance,pet_type,pet_age,pet_state,pet_balance) values"
        . "('" . $newid . "','','" . $array_login3['mem_id'] . "',NOW(),'" . $_POST['ben_id'] . "','" . $_POST['amount'] . "','" . $_POST['cause'] . "','" . $_POST['share'] . "','" . $_POST['income'] . "',"
        . "'" . $_POST['allowance'] . "','" . $_POST['pet_type'] . "','" . $_POST['pet_age'] . "',0,'" . $balance . "')";
$query_insert = mysqli_query($connect, $sql_insert);
echo "<script>alert('บันทึกคำร้องขอเอกสารการกู้ยืมเรียบร้อยแล้ว ');</script>";
echo "<META http-equiv='refresh' Content='0; URL=petition_show.php'> ";
?>