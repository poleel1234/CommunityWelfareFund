<?php
session_start();
include "connect_db.php";
switch ($_GET['mode']) {
    case "add":
        $sql_insert = "insert into benefits(ben_id,ben_category,Ben_condition,ben_evidence,ben_condition1,ben_condition2,ben_condition3,ben_condition4,ben_condition5,ben_condition6,ben_document1,ben_document2,ben_document3,ben_document4,ben_document5,ben_document6,ben_document7,ben_document8,ben_document9,interest,interest_type,span_of_age_to,span_of_age_from,ben_type,ben_sex) values"
                . "('" . $_POST['ben_id'] . "','" . $_POST['ben_category'] . "','" . $_POST['ben_condition'] . "','" . $_POST['ben_evidence'] . "','" . $_POST['ben_condition1'] . "','" . $_POST['ben_condition2'] . "','" . $_POST['ben_condition3'] . "','" . $_POST['ben_condition4'] . "','" . $_POST['ben_condition5'] . "','" . $_POST['ben_condition6'] . "','" . $_POST['ben_document1'] . "','" . $_POST['ben_document2'] . "','" . $_POST['ben_document3'] . "','" . $_POST['ben_document4'] . "','" . $_POST['ben_document5'] . "','" . $_POST['ben_document6'] . "','" . $_POST['ben_document7'] . "','" . $_POST['ben_document8'] . "','" . $_POST['ben_document9'] . "','" . $_POST['interest'] . "','" . $_POST['interest_type'] . "','" . $_POST['span_of_age_to'] . "','" . $_POST['span_of_age_from'] . "','" . $_POST['ben_type'] . "','" . $_POST['ben_sex'] . "')";
        $query_insert = mysqli_query($connect, $sql_insert);
        echo "<script>alert('เพิ่มข้อมูลเรียบร้อยแล้ว ');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=basic_benefits.php'> ";
        break;
    case "edit":
        $sql_update = "update benefits set ben_category='" . $_POST['ben_category'] . "',ben_condition='" . $_POST['ben_condition'] . "',ben_evidence='" . $_POST['ben_evidence'] . "',ben_condition1='" . $_POST['ben_condition1'] . "',ben_condition2='" . $_POST['ben_condition2'] . "',ben_condition3='" . $_POST['ben_condition3'] . "',ben_condition4='" . $_POST['ben_condition4'] . "',ben_condition5='" . $_POST['ben_condition5'] . "',ben_condition6='" . $_POST['ben_condition6'] . "',ben_document1='" . $_POST['ben_document1'] . "',ben_document2='" . $_POST['ben_document2'] . "',ben_document3='" . $_POST['ben_document3'] . "',ben_document4='" . $_POST['ben_document4'] . "',ben_document5='" . $_POST['ben_document5'] . "',ben_document6='" . $_POST['ben_document6'] . "',ben_document7='" . $_POST['ben_document7'] . "',ben_document8='" . $_POST['ben_document8'] . "',ben_document9='" . $_POST['ben_document9'] . "',interest='" . $_POST['interest'] . "',interest_type='" . $_POST['interest_type'] . "',span_of_age_to='" . $_POST['span_of_age_to'] . "',span_of_age_from='" . $_POST['span_of_age_from'] . "',ben_type='" . $_POST['ben_type'] . "',ben_sex='" . $_POST['ben_sex'] . "' where ben_id='" . $_POST['ben_id'] . "'";
        $query_update = mysqli_query($connect, $sql_update);
        echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว ');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=basic_benefits.php'> ";
        break;
    case "del":
        $sql = "delete from benefits where ben_id='" . $_GET['ben_id'] . "'";
        $query = mysqli_query($connect, $sql);
        echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว ');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=basic_benefits.php'> ";
        break;
}
?>