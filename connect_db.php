<?php

error_reporting(error_reporting() & ~E_NOTICE);
date_default_timezone_set("Asia/Bangkok");
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$dbname = "communitywelfarefund";
$charset = "utf8";
$connect = mysqli_connect($db_server, $db_user, $db_pass, $dbname) or die("CAN NOT CONNECT DATABASE!");
if (!$connect->set_charset($charset)) {
    printf("Error loading character set utf8: %sn", $connect->error);
}
session_start();
$limit = 10;

$sql_login = "select * from authorities where aut_id='" . $_SESSION['login_aut_id'] . "'";
$query_login = mysqli_query($connect, $sql_login);
$array_login = mysqli_fetch_array($query_login);

$sql_login3 = "select m.*,r.req_beneficiary from member m join register r on r.reg_id = m.reg_id where m.mem_card='" . $_SESSION['login_reg_card3'] . "' order by m.mem_id";
$query_login3 = mysqli_query($connect, $sql_login3);
$array_login3 = mysqli_fetch_array($query_login3);

$sql_login2 = "select * from register where reg_card='" . $_SESSION['login_reg_card'] . "' order by reg_id desc limit 1";
$query_login2 = mysqli_query($connect, $sql_login2);
$array_login2 = mysqli_fetch_array($query_login2);

$sql_login4 = "SELECT COUNT(*) as c FROM get_benefits g JOIN benefits b ON b.ben_id = g.ben_id AND b.ben_category like '%เสียชีวิต%' WHERE g.mem_id = '" . $array_login3['mem_id'] . "'";
$query_login4 = mysqli_query($connect, $sql_login4);
$array_login4 = mysqli_fetch_array($query_login4);

$sql_login5 = "select * from petition d "
        . "left join petition_detail d2 on d2.pet_id = d.pet_id "
        . "join member m on (m.mem_id = d.mem_id or m.mem_id = d2.mem_id) "
        . "join benefits b on b.ben_id = d.ben_id "
        . "left join authorities a on a.aut_id = d.aut_id "
        . "where m.mem_id = '" . $array_login3['mem_id'] . "' "
        . "order by d.pet_id desc";
$query_login5 = mysqli_query($connect, $sql_login5);
$array_login5 = mysqli_fetch_array($query_login5);
$num5 = mysqli_num_rows($query_login5);

function changedate($data) {
    $d = explode("-", $data);
    $date = $d[2] . "/" . $d[1] . "/" . ($d[0] + 543);
    return $date;
}

function changedate2($data) {
    $d = explode("-", $data);
    $date = $d[2] . "/" . $d[1] . "/" . ($d[0]);
    return $date;
}

function changedatetime($data) {
    $d = explode("-", $data);
    $d2 = explode(" ", $d[2]);
    $date = $d2[0] . "/" . $d[1] . "/" . ($d[0] + 543);
    $date2 = $d2[1];
    return $date . " " . $date2;
}

function DateThai($date) {
    $strYear = date("Y", strtotime($date)) + 543;
    $strMonth = date("n", strtotime($date));
    $strDay = date("j", strtotime($date));
    $thaiweek = date("w", strtotime($date));
    $strMonthCut = Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
    $strMonthThai = $strMonthCut[$strMonth];
    $thaiweekCut = array("วัน อาทิตย์", "วัน จันทร์", "วัน อังคาร", "วัน พุธ", "วัน พฤหัส", "วัน ศุกร์", "วัน เสาร์");
    $strweekThai = $thaiweekCut[$thaiweek];
    return "วันที่ $strDay เดือน $strMonthThai พ.ศ. $strYear";
}

function DateThai2($date) {
    $strYear = date("Y", strtotime($date)) + 543;
    $strMonth = date("n", strtotime($date));
    $strDay = date("j", strtotime($date));
    $thaiweek = date("w", strtotime($date));
    $strMonthCut = Array("", "ม.ค", "ก.พ", "มี.ค", "เม.ย", "พ.ค", "มิ.ย", "ก.ค", "ส.ค", "ก.ย", "ต.ค", "พ.ย", "ธ.ค");
    $strMonthThai = $strMonthCut[$strMonth];
    $thaiweekCut = array("วัน อาทิตย์", "วัน จันทร์", "วัน อังคาร", "วัน พุธ", "วัน พฤหัส", "วัน ศุกร์", "วัน เสาร์");
    $strweekThai = $thaiweekCut[$thaiweek];
    return "$strDay / $strMonthThai / $strYear";
}

function Convert($amount_number) {
    $amount_number = number_format($amount_number, 2, ".", "");
    $pt = strpos($amount_number, ".");
    $number = $fraction = "";
    if ($pt === false)
        $number = $amount_number;
    else {
        $number = substr($amount_number, 0, $pt);
        $fraction = substr($amount_number, $pt + 1);
    }

    $ret = "";
    $baht = ReadNumber($number);
    if ($baht != "")
        $ret .= $baht . "บาท";

    $satang = ReadNumber($fraction);
    if ($satang != "")
        $ret .= $satang . "สตางค์";
    else
        $ret .= "ถ้วน";
    return $ret;
}

function ReadNumber($number) {
    $position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
    $number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
    $number = $number + 0;
    $ret = "";
    if ($number == 0)
        return $ret;
    if ($number > 1000000) {
        $ret .= ReadNumber(intval($number / 1000000)) . "ล้าน";
        $number = intval(fmod($number, 1000000));
    }

    $divider = 100000;
    $pos = 0;
    while ($number > 0) {
        $d = intval($number / $divider);
        $ret .= (($divider == 10) && ($d == 2)) ? "ยี่" :
                ((($divider == 10) && ($d == 1)) ? "" :
                ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
        $ret .= ($d ? $position_call[$pos] : "");
        $number = $number % $divider;
        $divider = $divider / 10;
        $pos++;
    }
    return $ret;
}

function ChangMonth($date) {
    $strMonth = $date;
    $strMonthCut = Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
    $strMonthThai = $strMonthCut[$strMonth];
    return $strMonthThai;
}

?>
