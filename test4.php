
<?php
session_start();
$pagemain = 'main_report';
$pagename = 'report5';
include "connect_db.php";
$ses_userid = $_SESSION['ses_userid'];
if ($ses_userid <> session_id()) {
    echo "<script>alert('กรุณาทำการ Login ก่อนใช้งานระบบ');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=login.php' />";
    exit();
}
if ($array_login['aut_position'] != "ผู้บริหาร") {
    echo "<script>alert('You have no permission to access this page.');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=logout.php' />";
    exit();
}
include 'header.php';
$sql_basic1 = "SELECT month(g.pay_date) as d,e.pet_type,SUM(g.pet_amount) as give_money
FROM payment g
JOIN petition e ON e.pet_id = g.pet_id WHERE e.pet_type = 'ผู้สูงอายุ'
GROUP BY d,e.pet_type != ''";
$query_basic1 = mysqli_query($connect, $sql_basic1);

$sql_basic2 = "SELECT year(g.pay_date) as d,e.pet_type,SUM(g.pet_amount) as give_money
FROM payment g
JOIN petition e ON e.pet_id = g.pet_id 
GROUP BY d,e.pet_type";
$query_basic2 = mysqli_query($connect, $sql_basic2);

$sql_basic4 = "SELECT month(g.pay_date) as d,e.pet_type,SUM(g.pet_amount) as give_money
FROM payment g
JOIN petition e ON e.pet_id = g.pet_id WHERE e.pet_type = 'ผู้พิการ' 
GROUP BY d,e.pet_type";
$query_basic4 = mysqli_query($connect, $sql_basic4);

$sql_basic3 = "SELECT YEAR(pet_date) as petyear,count(mem_id) as countid from petition GROUP BY petyear";
$query_basic3 = mysqli_query($connect, $sql_basic3);

$datetime = changedate(date("Y-m-d"));
?>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>    
<script>
    $(function () {
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                 text: 'ยอดเงินนำส่งผู้สูงอายุ รายเดือน'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                    type: 'pie',
                    name: 'service',
                    data: [
<?php
while ($array_basic1 = mysqli_fetch_array($query_basic1)) {
    $monthx = ChangMonth($array_basic1['d'])." ".$array_basic1['pet_type'];
    $valuex = $array_basic1['give_money'];
    $sss = "['" . $monthx . "'," . $valuex . "],";
    echo $sss;
}
?>
                    ]
                }]
        });
    });
</script>

<script>
    $(function () {
        $('#container2').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'ยอดเงินนำส่ง รายปี'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                    type: 'pie',
                    name: 'service',
                    data: [
<?php
while ($array_basic2 = mysqli_fetch_array($query_basic2)) {
    $monthx = $array_basic2['d']." ".$array_basic2['pet_type'];
    $valuex = $array_basic2['give_money'];
    $sss = "['" . $monthx . "'," . $valuex . "],";
    echo $sss;
}
?>
                    ]
                }]
        });
    });
</script>

<script>
    $(function () {
        $('#containerg3').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                 text: 'จำนวนสมาชิก รายปี'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                    type: 'pie',
                    name: 'service',
                    data: [
<?php
while ($array_basic3 = mysqli_fetch_array($query_basic3)) {
    $monthx = $array_basic3['petyear'];
    $valuex = $array_basic3['countid'];
    $sss = "['" . $monthx . "'," . $valuex . "],";
    echo $sss;
}
?>
                    ]
                }]
        });
    });
</script>
<script>
    $(function () {
        $('#containerg4').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                 text: 'ยอดเงินนำส่งผู้พิการ รายเดือน'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                    type: 'pie',
                    name: 'service',
                    data: [
<?php
while ($array_basic1 = mysqli_fetch_array($query_basic4)) {
    $monthx = ChangMonth($array_basic1['d'])." ".$array_basic1['pet_type'];
    $valuex = $array_basic1['give_money'];
    $sss = "['" . $monthx . "'," . $valuex . "],";
    echo $sss;
}
?>
                    ]
                }]
        });
    });
</script>

<div id="container2" style="min-width: 320px; height: 380px; margin: 0 auto"></div>
<div id="containerg4" style="min-width: 320px; height: 380px; margin: 0 auto"></div>
<div id="container" style="min-width: 320px; height: 380px; margin: 0 auto"></div>
<div id="containerg3" style="min-width: 320px; height: 380px; margin: 0 auto"></div>

<?php
include 'footer.php';
?>