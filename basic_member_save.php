<?php
session_start();
include "connect_db.php";
switch ($_GET['mode']) {
    case "add":
            if ($_FILES['mem_img']['tmp_name'] == '') {
            $dir = "";
        } else {
            $dir = "../CommunityWelfareFund/img/authorities/" . date('YmdHis') . ".png";
        }
        if (is_uploaded_file($_FILES['mem_img']['tmp_name'])) {
            copy($_FILES['mem_img']['tmp_name'], "$dir");
        }
        $sql_insert = "insert into member(mem_id,mem_title,mem_name,mem_lastname,mem_address,mem_card,mem_birthday,mem_work,mem_status,mem_nationality,mem_pass,mem_img,mem_tel,reg_id,mem_deposit,mem_deposit2,mem_date) values"
                . "('" . $_POST['mem_id'] . "','" . $_POST['mem_title'] . "','" . $_POST['mem_name'] . "','" . $_POST['mem_lastname'] . "',"
                . "'" . $_POST['mem_address'] . "','" . $_POST['mem_card'] . "','" . $_POST['mem_birthday'] . "',"
            . "'" . $_POST['mem_work'] . "','" . $_POST['mem_status'] . "','" . $_POST['mem_nationality'] . "','" . $_POST['mem_pass'] . "','" . $_POST['mem_tel'] . "','',0,0,'0000-00-00')";
        $query_insert = mysqli_query($connect, $sql_insert);
        echo "<script>alert('เพิ่มข้อมูลเรียบร้อยแล้ว ');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=basic_member.php'> ";
        break;
    case "edit":
         if (is_uploaded_file($_FILES['mem_img']['tmp_name'])) {
            $dir = "../CommunityWelfareFund/img/authorities/" . date('YmdHis') . ".png";
            copy($_FILES['mem_img']['tmp_name'], "$dir");
        } else {
            $sql = "select * from member where mem_id='" . $_POST['mem_id'] . "'";
            $query = mysqli_query($connect, $sql);
            $array = mysqli_fetch_array($query);
            $dir = $array['mem_img'];
        }
        $sql_update = "update member set mem_name='" . $_POST['mem_name'] . "',mem_lastname='" . $_POST['mem_lastname'] . "',"
                . "mem_address='" . $_POST['mem_address'] . "',"
                . "mem_card='" . $_POST['mem_card'] . "',mem_birthday='" . $_POST['mem_birthday'] . "',"
            . "mem_work='" . $_POST['mem_work'] . "',mem_status='" . $_POST['mem_status'] . "',mem_pass='"
                . $_POST['mem_pass'] . "',"
                . "mem_img='" . $dir . "',mem_nationality='" . $_POST['mem_nationality'] . "',mem_tel='" . $_POST['mem_tel'] . "'"
                . " where mem_id='" . $_POST['mem_id'] . "'";
        $query_update = mysqli_query($connect, $sql_update);
        echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว ');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=basic_member.php'> ";
        break;
    case "del":
        $sql = "delete from member where mem_id='" . $_GET['mem_id'] . "'";
        $query = mysqli_query($connect, $sql);
        echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว ');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=basic_member.php'> ";
        break;
}
?>