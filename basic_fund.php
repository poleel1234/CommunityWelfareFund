<?php
session_start();
$pagemain = 'main_basic';
$pagename = 'basic_fund';
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
$sql_basic2 = "select * from fund";
$query_basic2 = mysqli_query($connect, $sql_basic2);
$num2 = mysqli_num_rows($query_basic2);
?>
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="dashboard.php">Home</a></li>                    
    <li><a href="#">ข้อมูลพื้นฐาน</a></li>
    <li class="active">ข้อมูลกองทุน</li>
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
                    <h3 class="panel-title">ข้อมูลกองทุน</h3>
                    <ul class="panel-controls">
                        <?php
                        if ($num2 <= 0) {
                            ?>
                            <li style="margin-right: 50px;"><a href="basic_fund_manage.php"><button type="button" class="btn btn-info">เพิ่มข้อมูล</button></a></li>
                        <?php } ?>
                        <li style="margin-right: 80px;"><a href="#" class="panel-collapse"><button type="button" class="btn btn-warning"><span class="fa fa-angle-down"></span> Hide/Show</button></a></li>
                    </ul>                                
                </div>
                <div class="panel-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>ชื่อองค์กร</th>
                                <th>ที่อยู่</th>
                                <th>โลโก้</th>
                                <th>จัดการข้อมูล</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_basic1 = "select * from fund";
                            $query_basic1 = mysqli_query($connect, $sql_basic1);
                            $num = mysqli_num_rows($query_basic1);
                            if ($num >= 1) {
                                while ($array_basic1 = mysqli_fetch_array($query_basic1)) {
                                    ?>
                                    <tr>
                                        <td><?= $array_basic1['fund_name'] ?></td>
                                        <td><?= $array_basic1['fund_address'] ?></td>
                                        <td class="center" style="text-align: center;"><a href="<?= $array_basic1['fund_logo'] ?>" target="_blank"><i class="fa fa-file-picture-o fa-fw" title="ดูรูปภาพ"></i></a></td>
                                        <td>
                                            <a href="basic_fund_manage.php?mode=edit&fund_id=<?= $array_basic1['fund_id'] ?>"><button type="button" class="btn btn-warning">แก้ไข</button></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="4" style="color: red;"><center><b>ไม่พบข้อมูล</b></center></td>
                            </tr>
                            <?php }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->
        </div>
    </div>    
</div>
<!-- PAGE CONTENT WRAPPER -->                                
</div>    
<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->       
<?php
include 'footer.php';
?>