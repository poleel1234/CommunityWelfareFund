<?php
session_start();
$pagename = 'approve_get_benefits';
include "connect_db.php";
$ses_userid = $_SESSION['ses_userid'];
if ($ses_userid <> session_id()) {
    echo "<script>alert('กรุณาทำการ Login ก่อนใช้งานระบบ');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=login.php' />";
    exit();
}
if ($array_login['aut_position'] != "ผู้ดูแลระบบ" && $array_login['aut_position'] != "ผู้บริหาร" && $array_login['aut_position'] != "เจ้าหน้าที่") {
    echo "<script>alert('You have no permission to access this page.');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=logout.php' />";
    exit();
}
include 'header.php';
?>
<style>
.message-box3 {
  display: none;
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  z-index: 9999;
}
.message-box3.open {
  display: block;
}    
.message-box3 .mb-container3 {
      /* position: absolute; */
    left: 0px;
    top: 5%;
    background: rgba(0, 0, 0, 0.9);
    padding: 20px;
    width: 100%;
    height: 90%;
}
.message-box3 .mb-container3 .mb-middle3 {
  width: 50%;
  left: 25%;
  position: relative;
  color: #FFF;
}
.message-box3 .mb-container3 .mb-middle3 .mb-title3 {
  width: 100%;
  float: left;
  padding: 10px 0px 0px;
  font-size: 31px;
  font-weight: 400;
  line-height: 36px;
}
.message-box3 .mb-container3 .mb-middle3 .mb-title3 .fa,
.message-box3 .mb-container3 .mb-middle3 .mb-title3 .glyphicon {
  font-size: 38px;
  float: left;
  margin-right: 10px;
}
.message-box3 .mb-container3 .mb-middle3 .mb-content3 {
  width: 100%;
  float: left;
  padding: 10px 0px 0px;
}
.message-box3 .mb-container3 .mb-middle3 .mb-content3 p {
  margin-bottom: 0px;
}
.message-box3 .mb-container3 .mb-middle3 .mb-footer3 {
  width: 100%;
  float: left;
  padding: 10px 0px;
}
.message-box3.message-box-warning3 .mb-container3 {
  background: rgba(255,255,255, 0.9);
}
.message-box3.message-box-danger3 .mb-container3 {
  background: rgba(255,255,255, 0.9);
}
.message-box3.message-box-info3 .mb-container3 {
  background: rgba(255,255,255, 0.9);
}
.message-box3.message-box-success3 .mb-container3 {
  background: rgba(255,255,255, 0.9);
}
</style>
<ul class="breadcrumb">
    <li><a href="dashboard.php">Home</a></li>                    
    <li class="active">อนุมัติการขอรับสวัสดิการ</li>
</ul>
<div class="page-title">                    
    <h2><i class="fa fa-info-circle"></i> อนุมัติการขอรับสวัสดิการ</h2>
</div>
<div class="page-content-wrap">                

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">                   
                    <h3 class="panel-title">ข้อมูลการขอรับสวัสดิการ</h3>                              
                </div>
                <div class="panel-body">
                    <table class="table datatable">
                       <thead>
                            <tr>
                                <!--<th>รหัสขอรับสวัสดิการ</th>-->
                                <th>วันที่ขอรับสวัสดิการ</th>
                                <th>รหัสสมาชิก</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th>การขอรับสวัสดิการ</th>
                                <th>ผู้อนุมัติ</th>
                                <th>สถานะ</th>
                                <th>ไม่อนุมัติเนื่องจาก</th>
                                 <th>ชื่อกรณีมอบฉันทะ</th>
                                <th colspan="2">จัดการข้อมูล</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
//                            $mem_get_benefits = 0;
                            $sql_basic1 = "select * from get_benefits d "
                                    . "join member m on m.mem_id = d.mem_id join benefits b on b.ben_id = d.ben_id "
                                    . "left join authorities a on a.aut_id = d.aut_id "
                                    . "order by d.get_id asc";
                            $query_basic1 = mysqli_query($connect, $sql_basic1);
                            while ($array_basic1 = mysqli_fetch_array($query_basic1)) {
                                ?>
                                <tr>
                                    <!--<td><?= $array_basic1['get_id'] ?></td>-->
                                    <td><?=changedate( $array_basic1['get_date'] ) ?></td>
                                    <td><?= $array_basic1['mem_id'] ?></td>
                                    <td><?= $array_basic1['mem_name'] ?> <?= $array_basic1['mem_lastname'] ?></td>
                                    <td><?= $array_basic1['ben_category'] ?></td>
                                    <td><?= $array_basic1['aut_name'] ?> <?= $array_basic1['aut_lastname'] ?></td>
                                    <td><?php
                                    if ($array_basic1['get_state'] == 0) {
                                            echo 'รออนุมัติ';
                                        } else if ($array_basic1['get_state'] == 1) { 
                                            echo 'อนุมัติแล้ว';
                                        } else if ($array_basic1['get_state'] == 2) { 
                                            echo 'ไม่อนุมัติ';
                                        }
                                         ?></td>
                                    <td><?= $array_basic1['get_reason'] ?></td>
                                     <td><?= $array_basic1['name_other'] ?></td>
                                    <td>
                                        <a class="btn btn-info mb-control senddatamodal data-detail" data-box="#message-box-info" data-url="approve_get_benefits.php?get_id=<?=$array_basic1['get_id']?>&aut_id=<?=$array_basic1['aut_id']?>&get_state=<?=$array_basic1['get_state']?>">ดูรายละเอียด</a>
                                    </td>
                                    <td class="center" style="text-align: center;"><a class="btn btn-info" href="get_benefits_print.php?get_id=<?= $array_basic1['get_id'] ?>" target="_blank"><i class="fa fa-file-pdf-o fa-fw" title="พิมพ์"></i>พิมพ์</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    
</div>
<script>
    $(".data-detail").click(function () {
       $('#message-box-info').addClass('open');
    });
</script>
<!-- info -->
        <div class="message-box3 message-box-info3 animated fadeIn" id="message-box-info">
            <div class="mb-container3">
                <div class="mb-middle3">
                    <div class="mb-title3"><span class="fa fa-info"></span> Information</div>
                    <div class="mb-content3">
                        
                    </div>
                    <div class="mb-footer3">
                        
                        <a href="approve_get_benefits_show.php"><button type="button" class="btn btn-default btn-lg">Close</button></a>
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- end info -->
<!-- PAGE CONTENT WRAPPER -->                                
</div>    
<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->     
<script>
    $(".senddatamodal").click(function () {
        var url = $(this).attr('data-url');
        $.ajax({
            url: url,
            type: "GET",
            success: function (data) { //Complete
                $(".mb-content3").empty();
                $(".mb-content3").html(data);
            }
        });
    });
</script>
<?php
include 'footer.php';
?>