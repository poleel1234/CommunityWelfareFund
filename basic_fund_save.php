<?php
session_start();
include "connect_db.php";
switch ($_GET['mode']) {
    case "add":
        $dir = "../CommunityWelfareFund/img/fund/" . date('YmdHis') . ".png";
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            copy($_FILES['file']['tmp_name'], "$dir");
        }
        $id= '1';
        $sql_insert = "insert into fund(fund_id,fund_name,fund_address,fund_objective,fund_property,fund_logo) values('" . $id . "','" . $_POST['fund_name'] . "','" . $_POST['fund_address'] . "','" . $_POST['fund_objective'] . "','" . $_POST['fund_property'] . "','" . $dir . "')";
        $query_insert = mysqli_query($connect, $sql_insert);
        echo "<script>alert('เพิ่มข้อมูลเรียบร้อยแล้ว ');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=basic_fund.php'> ";
        break;
    case "edit":
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $dir = "../CommunityWelfareFund/img/fund/" . date('YmdHis') . ".png";
            copy($_FILES['file']['tmp_name'], "$dir");
        } else {
            $sql = "select * from fund";
            $query = mysqli_query($connect, $sql);
            $array = mysqli_fetch_array($query);
            $dir = $array['fund_logo'];
        }
        
        $sql_update = "update fund set fund_name='" . $_POST['fund_name'] . "',fund_address='" . $_POST['fund_address'] . "',fund_objective='" . $_POST['fund_objective'] . "',fund_property='" . $_POST['fund_property'] . "',fund_logo='" . $dir . "' where fund_id='1'";
        $query_update = mysqli_query($connect, $sql_update);
        echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว ');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=basic_fund.php'> ";
        break;
    case "del":
        $sql = "delete from fund where fund_id='" . $_GET['fund_id'] . "'";
        $query = mysqli_query($connect, $sql);
        echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว ');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=basic_fund.php'> ";
        break;
}
?>