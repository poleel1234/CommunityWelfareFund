<?php
session_start();
$pagemain = 'main_basic';
$pagename = 'basic_member';
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
    .message-box .mb-container {
    /* position: absolute; */
    left: 0px;
    top: 5%;
    background: rgba(0, 0, 0, 0.9);
    padding: 20px;
    width: 100%;
    height: 90%;
}
</style>
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="dashboard.php">Home</a></li>                    
    <li><a href="#">ข้อมูลพื้นฐาน</a></li>
    <li class="active">ข้อมูลสมาชิก</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">                    
    <h2><i class="fa fa-info-circle"></i> ข้อมูลพื้นฐาน</h2>
</div>
<!-- END PAGE TITLE -->                

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">                

    <div class="row">
        <div class="col-md-12">
            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">                   
                    <h3 class="panel-title">ข้อมูลสมาชิก</h3>
                    <ul class="panel-controls">
                        <li style="margin-right: 50px;"><a href="basic_member_manage.php"><button type="button" class="btn btn-info">เพิ่มข้อมูล</button></a></li>
                        <li style="margin-right: 80px;"><a href="#" class="panel-collapse"><button type="button" class="btn btn-warning"><span class="fa fa-angle-down"></span> Hide/Show</button></a></li>
                    </ul>                                
                </div>
                <div class="panel-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>รหัสสมาชิก</th>
                                <th>ชื่อ-สกุล</th>
                                <th>ที่อยู่</th>
                                <th>เลขบัตรประจำตัวประชาชน</th>
                                <th>วันเดือนปีเกิด</th>
                                <th>อาชีพ</th>
                                <th>สถานภาพ</th>
                                <th>สัญชาติ</th>
                                <th>เบอร์โทรศัพท์</th>
                                <th>วันที่สมัครสมาชิก</th>
                                <th>รูป</th>
                                <th>ยอดเงินฝาก</th>
                                <th>จัดการข้อมูล</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_basic1 = "SELECT * FROM member m LEFT JOIN register r ON r.reg_id = m.reg_id";
                            $query_basic1 = mysqli_query($connect, $sql_basic1);
                            while ($array_basic1 = mysqli_fetch_array($query_basic1)) {
                                ?>
                                <tr>
                                    <td><?= $array_basic1['mem_id'] ?></td>
                                    <td><?= $array_basic1['mem_name'] ?> <?= $array_basic1['mem_lastname'] ?></td>
                                    <td><?= $array_basic1['mem_address'] ?></td>
                                    <td><?= $array_basic1['mem_card'] ?></td>
                                    <td><?= $array_basic1['mem_birthday'] ?></td>
                                    <td><?= $array_basic1['mem_work'] ?></td>
                                    <td><?= $array_basic1['mem_status'] ?></td>
                                    <td><?= $array_basic1['mem_nationality'] ?></td>
                                    <td><?= $array_basic1['mem_tel'] ?></td>
                                    <td><?= $array_basic1['reg_date'] ?></td>
                                     <td>
                                        <?php if ($array_basic1['mem_img'] != '') { ?>
                                            <a href="<?= $array_basic1['mem_img'] ?>" target="_blank"><i class="fa fa-file-image-o" aria-hidden="true"></i></a>
                                        <?php } ?>
                                    </td>
                                    <td><?= number_format($array_basic1['mem_deposit'],2) ?></td>
                                    <td>
                                        <a href="basic_member_manage.php?mode=edit&mem_id=<?=$array_basic1['mem_id']?>"><button type="button" class="btn btn-warning">แก้ไข</button></a></li>
                                        <?php if ($array_basic1['mem_id'] != $_SESSION['login_aut_id']) { ?>
                                            <a href="basic_member_save.php?mode=del&mem_id=<?=$array_basic1['mem_id']?>"><button type="button" class="btn btn-danger">ลบ</button></a></li>
                                        <?php } ?>
                                            <?php if ($array_basic1['reg_id'] != '') { ?>
                                              <!-- <td class="center" style="text-align: center;"><a class="btn btn-info" href="register_print.php?reg_id=<?= $array_basic1['reg_id'] ?>" target="_blank"><i class="fa fa-file-pdf-o fa-fw" title="พิมพ์"></i>พิมพ์</a></td> -->
                                        <a class="btn btn-info" href="register_print.php?reg_id=<?= $array_basic1['reg_id'] ?>" target="_blank">ใบสมัคร</a>
                                    <?php } ?>
                                    </td>
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
<!-- info -->
        <div class="message-box message-box-info animated fadeIn" id="message-box-info">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-info"></span> Information</div>
                    <div class="mb-content">
                        
                    </div>
                    <div class="mb-footer">
                        <button type="button" class="btn btn-default btn-lg mb-control-close">Close</button>
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
<?php
include 'footer.php';
?>
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