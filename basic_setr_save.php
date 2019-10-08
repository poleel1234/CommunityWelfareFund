<?php
session_start();
include "connect_db.php";
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
        echo "<META http-equiv='refresh' Content='0; URL=logout.php'> ";
    

?>