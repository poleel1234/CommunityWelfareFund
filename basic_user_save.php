<?php
session_start();
include "connect_db.php";
switch ($_GET['mode']) {
    case "add":
        if ($_FILES['aut_img']['tmp_name'] == '') {
            $dir = "";
        } else {
            $dir = "../CommunityWelfareFund/img/authorities/" . date('YmdHis') . ".png";
        }
        if (is_uploaded_file($_FILES['aut_img']['tmp_name'])) {
            copy($_FILES['aut_img']['tmp_name'], "$dir");
        }
        $sql_insert = "insert into authorities(aut_id,aut_name,aut_lastname,aut_address,aut_tel,aut_img,aut_position,aut_username,aut_password) values"
                . "('" . $_POST['aut_id'] . "','" . $_POST['aut_name'] . "','" . $_POST['aut_lastname'] . "',"
                . "'" . $_POST['aut_address'] . "','" . $_POST['aut_tel'] . "','" . $dir . "',"
                . "'" . $_POST['aut_position'] . "','" . $_POST['aut_username'] . "','" . $_POST['aut_password'] . "')";
        $query_insert = mysqli_query($connect, $sql_insert);
        echo "<script>alert('เพิ่มข้อมูลเรียบร้อยแล้ว ');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=basic_user.php'> ";
        break;
    case "edit":
        if (is_uploaded_file($_FILES['aut_img']['tmp_name'])) {
            $dir = "../CommunityWelfareFund/img/authorities/" . date('YmdHis') . ".png";
            copy($_FILES['aut_img']['tmp_name'], "$dir");
        } else {
            $sql = "select * from authorities where aut_id='" . $_POST['aut_id'] . "'";
            $query = mysqli_query($connect, $sql);
            $array = mysqli_fetch_array($query);
            $dir = $array['aut_img'];
        }
        $sql_update = "update authorities set aut_name='" . $_POST['aut_name'] . "',aut_lastname='" . $_POST['aut_lastname'] . "',"
                . "aut_address='" . $_POST['aut_address'] . "',aut_tel='" . $_POST['aut_tel'] . "',"
                . "aut_img='" . $dir . "',aut_position='" . $_POST['aut_position'] . "',"
                . "aut_password='" . $_POST['aut_password'] . "' where aut_id='" . $_POST['aut_id'] . "'";
        $query_update = mysqli_query($connect, $sql_update);
        echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว ');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=basic_user.php'> ";
        break;
    case "del":
        $sql = "delete from authorities where aut_id='" . $_GET['aut_id'] . "'";
        $query = mysqli_query($connect, $sql);
        echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว ');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=basic_user.php'> ";
        break;
}
?>