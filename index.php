<?php
session_start();
$pagemain = 'index';
include "connect_db.php";
$ses_userid = $_SESSION['ses_userid'];
if ($ses_userid <> session_id()) {
    echo "<script>alert('กรุณาทำการ Login ก่อนใช้งานระบบ');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=login.php' />";
    exit();
}
if ($array_login['aut_position'] == "ผู้ดูแลระบบ" || $array_login['aut_position'] == "ผู้บริหาร" || $array_login['aut_position'] == "เจ้าหน้าที่") {
    echo "<script>alert('You have no permission to access this page.');</script>";
   echo "<meta http-equiv='refresh' content='0;URL=logout.php' />";
    exit();
}
include 'header.php';
?>        
<style>
    .message-box .mb-container {
    /* position: absolute; */
    left: 0px;
    top: 5%;
    background: rgba(255, 255, 255, 0.9);
    padding: 20px;
    width: 100%;
    height: 90%;
    
    
}
</style>
<div class="page-content-wrap">                 
      <div class="row">
        <div class="col-md-12">
            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">                   
                    <h3 class="panel-title">ใบสมัครสมาชิก</h3>
                    <ul class="panel-controls">
                        <li style="margin-right: 80px;"><a href="#" class="panel-collapse"><button type="button" class="btn btn-warning"><span class="fa fa-angle-down"></span> Hide/Show</button></a></li>
                    </ul>                                
                </div>
                <div class="panel-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>รหัสสมัครสมาชิก</th>
                                <th>วันที่สมัคร</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th>เลขบัตรประจำตัวประชาชน</th>
                                <th>วันเดือนปีเกิด</th>
                                <th>อายุ</th>
                                <th>อาชีพ</th>
                                <th>สถานภาพ</th>
                                <th>สัญชาติ</th>
                                <th>เบอร์โทรศัพท์</th>
                                <th>ที่อยู่</th>
                                <th>สถานะ</th>
                                <th colspan="2">จัดการข้อมูล</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_basic1 = "select * from register where (reg_card = '".$array_login2['reg_card']."' or reg_card = '".$array_login3['mem_card']."') order by reg_id desc";
                            $query_basic1 = mysqli_query($connect, $sql_basic1);
                            while ($array_basic1 = mysqli_fetch_array($query_basic1)) {
                                ?>
                                <tr>
                                    <td><?= $array_basic1['reg_id'] ?></td>
                                    <td><?= changedate($array_basic1['reg_date']) ?></td>
                                    <td><?=$array_basic1['req_title']?><?= $array_basic1['reg_name'] ?> <?= $array_basic1['reg_lastname'] ?></td>
                                    <td><?= $array_basic1['reg_card'] ?></td>
                                    <td><?= changedate($array_basic1['reg_birthday']) ?></td>
                                    <td><?= $array_basic1['reg_age'] ?></td>
                                    <td><?= $array_basic1['reg_work'] ?></td>
                                    <td><?= $array_basic1['req_status'] ?></td>
                                    <td><?= $array_basic1['req_nationality'] ?></td>
                                    <td><?= $array_basic1['req_tel'] ?></td>
                                    <td><?= $array_basic1['req_address'] ?></td>
                                    <td>
                                        <?php if ($array_basic1['req_state'] == 0) { 
                                            echo 'รออนุมัติ';
                                        }else if ($array_basic1['req_state'] == 1) {
                                            echo 'อนุมัติ';
                                        }else if ($array_basic1['req_state'] == 2) {
                                            $i = $array_basic1['req_disapproval'];
                                            echo 'ไม่อนุมัติ เนื่องจาก '; echo $i;
                                        }
?>
                                    </td>
                                    <td>
                                        <a class="btn btn-info mb-control senddatamodal" data-box="#message-box-info" data-url="register_approve_line.php?reg_id=<?=$array_basic1['reg_id']?>&req_state=<?=$array_basic1['req_state']?>">ดูรายละเอียด</a>
                                    </td>
                                    <td class="center" style="text-align: center;"><a class="btn btn-info" href="register_print.php?reg_id=<?= $array_basic1['reg_id'] ?>" target="_blank"><i class="fa fa-file-pdf-o fa-fw" title="พิมพ์"></i>พิมพ์</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->
        </div>
    </div> 
</div>
<script>
    $(".senddatamodal").click(function () {
       $('#message-box-info').addClass('open');
    });
</script>
<!-- info -->
        <div class="message-box animated fadeIn" id="message-box-info">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-info"></span> Information</div>
                    <div class="mb-content">
                        
                    </div>
                    <div class="mb-footer">
                        
                        <a href="index.php">   <button type="button" class="btn btn-default btn-lg mb-control-close">Close</button></a>
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- end info -->
<script >
    $(".senddatamodal").click(function () {
        var url = $(this).attr('data-url');
        $.ajax({
            url: url,
            type: "GET",
            success: function (data) { //Complete
                $(".mb-content").empty();
                $(".mb-content").html(data);
            }
        });
    });
</script>
<?php
include 'footer.php';
?> 