
 <?php
session_start();
$pagemain = 'main_report';
$pagename = 'report6';
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
$datetime = changedate(date("Y-m-d"));
?>
<?php

 /*
$query = "SELECT SUM(p.allowance) AS mem_deposit, DATE_FORMAT(p.pet_date, '%M') AS $mem_deposit
FROM petition p";*/

$query = "SELECT e.pet_type,SUM(g.pet_amount) as mem_deposit,DATE_FORMAT(g.pay_date,'%M') as mem_date
FROM payment g
JOIN petition e ON e.pet_id = g.pet_id WHERE e.pet_type = 'ผู้พิการ'
GROUP BY mem_date,e.pet_type != ''";

$result = mysqli_query($connect, $query);
$resultchart = mysqli_query($connect, $query);  
 
 
 //for chart
$mem_date = array();
$mem_deposit = array();
 
while($rs = mysqli_fetch_array($resultchart)){ 
  $mem_date[] = "\"".$rs['mem_date']."\""; 
  $mem_deposit[] = "\"".$rs['mem_deposit']."\""; 
}
$mem_date = implode(",", $mem_date); 
$mem_deposit = implode(",", $mem_deposit); 
 
?>

<ul class="breadcrumb">
    <li><a href="dashboard.php">Home</a></li>                    
    <li><a href="#">รายงาน</a></li>
    <li class="active">รายงานข้อมูลผู้พิการยอดเงินสถาบัน</li>
</ul>

<!-- END BREADCRUMB -->

<div class="page-title">                    
    <h2><i class="fa fa-info-circle"></i> รายงานข้อมูลยอดผู้พิการเงินส่งสถาบัน </h2>
</div>

<?php mysqli_close($connect);?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
<hr>
<p align="center">
 
 <!--devbanban.com-->
 
<canvas id="myChart" width="800px" height="300px"></canvas>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $mem_date;?>
    
        ],
        datasets: [{
            label: 'รายงานภาพรวม แยกตามเดือน (บาท)',
            data: [<?php echo $mem_deposit;?>/*<?php echo ChangMonth(date("n", strtotime('m')));?>*/
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>  
</p> 

  <?php
include 'footer.php';
?>
