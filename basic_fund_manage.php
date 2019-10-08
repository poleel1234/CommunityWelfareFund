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
if (isset($_GET['mode']) == "") {
    $mode = 'add';
    $name = 'เพิ่ม';
    $readonly = '';
} elseif (isset($_GET['mode']) == "edit") {
    $mode = "edit";
    $name = 'แก้ไข';
    $readonly = 'readonly';
    $sql_edit = "select * from fund where fund_id='" . $_GET['fund_id'] . "'";
    $query_edit = mysqli_query($connect, $sql_edit);
    $array_edit = mysqli_fetch_array($query_edit);
        $img = "<table width=100% border=0>
                <tr>
                <td align=center><a href='" . $array_edit['fund_logo'] . "' target='_blank'><img src=" . $array_edit['fund_logo'] . " width=40% /></a></td>
                </tr>
            </table>";
}
?>
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="dashboard.php">Home</a></li>
    <li><a href="#">ข้อมูลพื้นฐาน</a></li>
    <li><a href="basic_fund.php">ข้อมูลกองทุน</a></li>
    <li class="active"><?= $name ?>ข้อมูลกองทุน</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="basic_fund_save.php?mode=<?= $mode ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong><?= $name ?></strong> ข้อมูลกองทุน</h3>
                        <ul class="panel-controls">
                            <li style="margin-right: 80px;"><a href="basic_fund.php" ><button type="button" class="btn btn-danger"><span class="fa fa-reply"></span> ย้อนกลับ</button></a></li>
                        </ul>
                    </div>
                    <div class="panel-body">    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="col-md-3 control-label">ชื่อกองทุน</label>
                                <div class="col-md-9">                                            
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="fund_name" class="form-control" required="" value="<?= $array_edit['fund_name'] ?>"/>
                                    </div>                                            
                                </div>
                            </div>
                                <div class="form-group">
                                <label class="col-md-3 control-label">โลโก้</label>
                                <div class="col-md-9">                                            
                                    <div class="input-group">
                                        <input type="file" name="file"/>
                                        <?php if($array_edit['fund_logo'] != ''){ echo $img;} ?>
                                    </div>                                            
                                </div>
                            </div>
                                 <div class="form-group">
                                <div class="col-md-9">                                            
                                    <div class="input-group" >       
                                    </div>                                            
                                </div>
                            </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ที่อยู่</label>
                                    <div class="col-md-9 col-xs-12">                                            
                                        <textarea class="form-control" name="fund_address" rows="5" required=""><?= $array_edit['fund_address'] ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">วัตถุประสงค์สำคัญ</label>
                                    <div class="col-md-9 col-xs-12">                                            
                                        <textarea class="form-control" name="fund_objective" rows="10" required=""><?= $array_edit['fund_objective'] ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">คุณสมบัติของผู้สมัคร</label>
                                    <div class="col-md-9 col-xs-12">                                            
                                        <textarea class="form-control" name="fund_property" rows="10" required=""><?= $array_edit['fund_property'] ?></textarea>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-default" type="reset">Clear Form</button>                                    
                        <button class="btn btn-primary pull-right" type="submit">Submit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>                    

</div>
<!-- END PAGE CONTENT WRAPPER -->                                                
</div>            
<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER --> 
<?php
include 'footer.php';
?>




