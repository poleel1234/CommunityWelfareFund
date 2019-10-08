<?php
session_start();
include "connect_db.php";

$targetfolder = "../CommunityWelfareFund/img/file/";
if($_FILES['Copy1']['name'] != ''){
$type = substr($_FILES['Copy1']['name'],-4);
$new_name=date('YmdHis').'1'.$type;
$targetfolder = $targetfolder . $new_name ;
$file_type=$_FILES['Copy1']['type'];
if ($file_type=="application/pdf" || $file_type=="image/gif" || $file_type=="image/png") {
 if(move_uploaded_file($_FILES['Copy1']['tmp_name'], $targetfolder)){
 }else {
    echo "<script>alert('Problem uploading file');</script>";
 }
}}
$targetfolder2 = "../CommunityWelfareFund/img/file/";
if($_FILES['Copy2']['name'] != ''){
$type2 = substr($_FILES['Copy2']['name'],-4);
$new_name2=date('YmdHis').'2'.$type2;
$targetfolder2 = $targetfolder2 . $new_name2 ;
$file_type2=$_FILES['Copy2']['type'];
if ($file_type2=="application/pdf" || $file_type2=="image/gif" || $file_type2=="image/png") {
 if(move_uploaded_file($_FILES['Copy2']['tmp_name'], $targetfolder2)){
 }else {
    echo "<script>alert('Problem uploading file');</script>";
 }
}}
$targetfolder3 = "../CommunityWelfareFund/img/file/";
if($_FILES['Copy3']['name'] != ''){
$type3 = substr($_FILES['Copy3']['name'],-4);
$new_name3=date('YmdHis').'3'.$type3;
$targetfolder3 = $targetfolder3 . $new_name3 ;
$file_type3=$_FILES['Copy3']['type'];
if ($file_type3=="application/pdf" || $file_type3=="image/gif" || $file_type3=="image/png") {
 if(move_uploaded_file($_FILES['Copy3']['tmp_name'], $targetfolder3)){
 }else {
    echo "<script>alert('Problem uploading file');</script>";
 }
}}
$targetfolder4 = "../CommunityWelfareFund/img/file/";
if($_FILES['Copy4']['name'] != ''){
$type4 = substr($_FILES['Copy4']['name'],-4);
$new_name4=date('YmdHis').'4'.$type4;
$targetfolder4 = $targetfolder4 . $new_name4 ;
$file_type4=$_FILES['Copy4']['type'];
if ($file_type4=="application/pdf" || $file_type4=="image/gif" || $file_type4=="image/png") {
 if(move_uploaded_file($_FILES['Copy4']['tmp_name'], $targetfolder4)){
 }else {
    echo "<script>alert('Problem uploading file');</script>";
 }
}}
$targetfolder5 = "../CommunityWelfareFund/img/file/";
if($_FILES['Copy5']['name'] != ''){
$type5 = substr($_FILES['Copy5']['name'],-4);
$new_name5=date('YmdHis').'5'.$type5;
$targetfolder5 = $targetfolder5 . $new_name5 ;
$file_type5=$_FILES['Copy5']['type'];
if ($file_type5=="application/pdf" || $file_type5=="image/gif" || $file_type5=="image/png") {
 if(move_uploaded_file($_FILES['Copy5']['tmp_name'], $targetfolder5)){
 }else {
    echo "<script>alert('Problem uploading file');</script>";
 }
}}
$targetfolder6 = "../CommunityWelfareFund/img/file/";
if($_FILES['Copy6']['name'] != ''){
$type6 = substr($_FILES['Copy6']['name'],-4);
$new_name6=date('YmdHis').'6'.$type6;
$targetfolder6 = $targetfolder6 . $new_name6 ;
$file_type6=$_FILES['Copy6']['type'];
if ($file_type6=="application/pdf" || $file_type6=="image/gif" || $file_type6=="image/png") {
 if(move_uploaded_file($_FILES['Copy6']['tmp_name'], $targetfolder6)){
 }else {
    echo "<script>alert('Problem uploading file');</script>";
 }
}}
$targetfolder7 = "../CommunityWelfareFund/img/file/";
if($_FILES['Copy7']['name'] != ''){
$type7 = substr($_FILES['Copy7']['name'],-4);
$new_name7=date('YmdHis').'7'.$type7;
$targetfolder7 = $targetfolder7 . $new_name7 ;
$file_type7=$_FILES['Copy7']['type'];
if ($file_type7=="application/pdf" || $file_type7=="image/gif" || $file_type7=="image/png") {
 if(move_uploaded_file($_FILES['Copy7']['tmp_name'], $targetfolder7)){
 }else {
    echo "<script>alert('Problem uploading file');</script>";
 }
}}
$targetfolder8 = "../CommunityWelfareFund/img/file/";
if($_FILES['Copy8']['name'] != ''){
$type8 = substr($_FILES['Copy8']['name'],-4);
$new_name8=date('YmdHis').'8'.$type8;
$targetfolder8 = $targetfolder8 . $new_name8 ;
$file_type8=$_FILES['Copy8']['type'];
if ($file_type8=="application/pdf" || $file_type8=="image/gif" || $file_type8=="image/png") {
 if(move_uploaded_file($_FILES['Copy8']['tmp_name'], $targetfolder8)){
 }else {
    echo "<script>alert('Problem uploading file');</script>";
 }
}}
$targetfolder9 = "../CommunityWelfareFund/img/file/";
if($_FILES['Copy9']['name'] != ''){
$type9 = substr($_FILES['Copy9']['name'],-4);
$new_name9=date('YmdHis').'9'.$type9;
$targetfolder9 = $targetfolder9 . $new_name9 ;
$file_type9=$_FILES['Copy9']['type'];
if ($file_type9=="application/pdf" || $file_type9=="image/gif" || $file_type9=="image/png") {
 if(move_uploaded_file($_FILES['Copy9']['tmp_name'], $targetfolder9)){
 }else {
    echo "<script>alert('Problem uploading file');</script>";
 }
}}

$sql_insert = "insert into get_benefits(get_id,mem_id,get_date,ben_id,aut_id,get_proxy,get_condition1,get_condition2,Copy1,Copy2,Copy3,Copy4,Copy5,Copy6,Copy7,Copy8,Copy9,get_date_ap,get_state,get_reason,name_other) values"
        . "('" . $_POST['get_id'] . "','" . $_SESSION['login_reg_id'] . "',NOW(),"
        . "'" . $_POST['ben_id'] . "','','" . $_POST['get_proxy'] . "',"
        . "'" . $_POST['get_condition1'] . "','" . $_POST['get_condition2'] . "',"
        . "'".$targetfolder."','".$targetfolder2."','".$targetfolder3."','".$targetfolder4."','".$targetfolder5."','".$targetfolder6."','".$targetfolder7."','".$targetfolder8."','".$targetfolder9."','0000-00-00',0,'-','" . $_POST['name_other'] . "')";
$query_insert = mysqli_query($connect, $sql_insert);

        echo "<script>alert('บันทึกคำร้องขอรับสวัสดิการเรียบร้อยแล้ว ');</script>";
        echo "<META http-equiv='refresh' Content='0; URL=get_benefits_show.php'> ";
?>