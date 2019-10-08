<!DOCTYPE html>
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title>ระบบกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->                                    
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">

            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="dashboard.php"><?= $array_login['aut_position'] ?><?= $array_login2['reg_name'] ?> <?= $array_login2['reg_lastname'] ?><?= $array_login3['mem_name'] ?> <?= $array_login3['mem_lastname'] ?></a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <?php
                            if ($array_login['aut_img'] != null) {
                                ?>
                                <img src="<?= $array_login['aut_img'] ?>"/>
                                <?php
                            } else {
                                ?>
                                <img src="../CommunityWelfareFund/img/user.png"/>
                            <?php } ?>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <?php
                                if ($array_login['aut_img'] != null) {
                                    ?>
                                    <img src="<?= $array_login['aut_img'] ?>"/> 
                                    <?php
                                } else if ($array_login3['mem_img'] != null) {
                                    ?>
                                    <img src="<?= $array_login3['mem_img'] ?>"/>
                                  <?php  
                                } else {
                                ?>
                                <img src="../CommunityWelfareFund/img/user.png"/>
                            <?php } ?>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name"><?= $array_login['aut_name'] ?>  <?= $array_login['aut_lastname'] ?><?= $array_login2['reg_name'] ?> <?= $array_login2['reg_lastname'] ?><?= $array_login3['mem_name'] ?> <?= $array_login3['mem_lastname'] ?></div>
                                <div class="profile-data-title">
                                    <?= $array_login['aut_position'] ?>
                                    <?php
                                    if ($array_login2['req_state'] == '0') {
                                        echo '<h3 style=background-color:#FF4500;color:#000000;padding:3px;>รออนุมัติ</h3>';
                                    }
                                    if ($array_login2['req_state'] == '1' || $array_login3['reg_id'] != '') {
                                        echo '<h3 style=background-color:#00FF00;color:#000000;padding:3px;>อนุมัติ</h3>';
                                    }
                                    if ($array_login2['req_state'] == '2') {
                                        echo '<h3 style=background-color:#FF0000;color:#000000;padding:3px;>ไม่อนุมัติ</h3>';
                                    }
                                    if ($array_login3['reg_id'] == null && $array_login2['req_state'] == null && $_SESSION['login_aut_id'] == null) {
                                        echo '<h3 style=background-color:#99FFFF;color:#000000;padding:3px;>ไม่ผ่านการสมัครสมาชิก</h3>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>                                                                        
                    </li>
                    <?php
                    if ($_SESSION['login_reg_id'] == null && $_SESSION['login_aut_position'] != 'ผู้บริหาร') {
                        ?>
                        <li class="xn-title">BACK END</li>
                        <li class="<?php
                        if ($pagemain == 'dashboard') {
                            echo 'active';
                        }
                        ?>">
                            <a href="dashboard.php"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>                        
                        </li>                    
                        <li class="xn-openable <?php
                        if ($pagemain == 'main_basic') {
                            echo 'active';
                        }
                        ?>">
                            <a href="#"><span class="fa fa-files-o"></span> <span class="xn-text">จัดการข้อมูลพื้นฐาน</span></a>
                            <ul>
                                <li class="<?php
                                if ($pagename == 'basic_user') {
                                    echo 'active';
                                }
                                ?>"><a href="basic_user.php"><span class="fa fa-image"></span> ข้อมูลผู้ใช้งาน</a></li>
                                <li class="<?php
                                if ($pagename == 'basic_member') {
                                    echo 'active';
                                }
                                ?>"><a href="basic_member.php"><span class="fa fa-user"></span> ข้อมูลสมาชิก</a></li>
                                <li class="<?php
                                if ($pagename == 'basic_benefits') {
                                    echo 'active';
                                }
                                ?>"><a href="basic_benefits.php"><span class="fa fa-users"></span> ข้อมูลสวัสดิการ</a></li>
                                <li class="<?php
                                if ($pagename == 'basic_fund') {
                                    echo 'active';
                                }
                                ?>"><a href="basic_fund.php"><span class="fa fa-users"></span> ข้อมูลกองทุน</a></li>
                            </ul>
                        </li>
                        <li class="<?php
                        if ($pagename == 'register_approve') {
                            echo 'active';
                        }
                        ?>">
                            <a href="register_approve.php"><span class="fa fa-check-square-o"></span> <span class="xn-text">อนุมัติการสมัครสมาชิก</span></a>
                        </li> 
                        <li class="<?php
                        if ($pagename == 'approve_get_benefits') {
                            echo 'active';
                        }
                        ?>">
                            <a href="approve_get_benefits_show.php"><span class="fa fa-check-square-o"></span> <span class="xn-text">อนุมัติการขอรับสวัสดิการ</span></a>
                        </li> 
                        <li class="<?php
                        if ($pagename == 'deposit') {
                            echo 'active';
                        }
                        ?>">
                            <a href="dep_show.php"><span class="fa fa-money"></span> <span class="xn-text">ฝากเงินกองทุน</span></a>
                        </li> 
                        <li class="<?php
                        if ($pagename == 'give_money') {
                            echo 'active';
                        }
                        ?>">
                            <a href="give_money_show.php"><span class="fa fa-money"></span> <span class="xn-text">บันทึกการมอบเงิน</span></a>
                        </li> 
                        <li class="<?php
                        if ($pagename == 'approve_petition') {
                            echo 'active';
                        }
                        ?>">
                            <a href="approve_petition_show.php"><span class="fa fa-check-square-o"></span> <span class="xn-text">อนุมัติการกู้ยืม</span></a>
                        </li> 
                 
                        <li class="<?php
                        if ($pagename == 'deposit_money2') {
                            echo 'active';
                        }
                        ?>">
                            <a href="deposit_money.php"><span class="fa fa-check-square-o"></span> <span class="xn-text">คำนวณเงินนำส่ง</span></a>
                        </li>
                       
           
                    <?php } ?>
                        <li class="xn-title">FRONT END</li>
                    <?php
                    $sql_index = "select * from register where reg_card='" . $array_login2['reg_card'] . "' order by reg_id desc limit 1";
                    $query_index = mysqli_query($connect, $sql_index);
                    $array_index = mysqli_fetch_array($query_index);
                    if ($_SESSION['login_reg_id'] == null && $_SESSION['login_aut_id'] == null) {
                        ?>
                        <li>
                            <a href="register.php"><span class="fa fa-user"></span> <span class="xn-text">สมัครสมาชิก</span></a>
                        </li>  
                    <?php } else if ($array_index['req_state'] == 2) { ?>
                        <li class="xn-title">FRONT END</li>
                        <li>
                            <a href="register.php?reg_id=<?= $array_index['reg_id'] ?>"><span class="fa fa-user"></span> <span class="xn-text">สมัครสมาชิกใหม่</span></a>
                        </li>  
                    <?php } ?>

                    <?php if ($array_index['req_state'] == 1 || $array_login3['mem_id'] != '') { 
                        if($array_login4['c'] <= 0){
                        ?>
                        <li>
                            <a href="get_benefits_show.php"><span class="fa fa-heart-o"></span> <span class="xn-text">ขอรับสวัสดิการ</span></a>
                        </li> 
                            <li>
                            <a href="basic_set_manage.php"><span class="fa fa-heart-o"></span> <span class="xn-text">แก้ไขข้อมูลโปรไฟล์</span></a>
                        </li> 
                           <li class="<?php
                        if ($pagename == 'get_dowload') {
                            echo 'active';
                        }
                        ?>">
                            <a href="get_dowload_show.php"><span class="fa fa-check-square-o"></span> <span class="xn-text">ดาวน์โหลดเอกสาร</span></a>
                        </li> 
                        <li class="<?php
                        if ($pagename == 'petition') {
                            echo 'active';
                        }
                        ?>">
                            <a href="petition_show.php"><span class="fa fa-check-square-o"></span> <span class="xn-text">ขอเอกสารการกู้ยืม</span></a>
                        </li> 
                        <?php if ($_SESSION['login_reg_id'] != null) { ?>
                            <li>
                                <a href="deposit_history.php"><span class="fa fa-heart-o"></span> <span class="xn-text">ประวัติการฝากเงิน</span></a>
                            </li> 
                            
                        <?php
                        }
                        }
                    }
                    ?> 
                            <?php if ($_SESSION['login_aut_position']=='ผู้บริหาร'){
                                
                             ?>
<!--                             <li class="xn-openable <?php
                        if ($pagemain == 'main_report') {
                            echo 'active';
                        }
                        ?>">
                            <a href="#"><span class="fa fa-files-o"></span> <span class="xn-text">รายงาน</span></a>
                            <ul>
                                <li class="<?php
                                if ($pagename == 'report') {
                                    echo 'active';
                                }
                                ?>"><a href="test.php"><span class="fa fa-image"></span> รายงาน1</a></li>
                                <li class="<?php
                                if ($pagename == 'report') {
                                    echo 'active';
                                }
                                ?>"><a href="#"><span class="fa fa-image"></span> รายงาน2</a></li>
                                <li class="<?php
                                if ($pagename == 'report') {
                                    echo 'active';
                                }
                                ?>"><a href="#"><span class="fa fa-image"></span> รายงาน3</a></li>
                                <li class="<?php
                                if ($pagename == 'report') {
                                    echo 'active';
                                }
                                ?>"><a href="#"><span class="fa fa-image"></span> รายงาน4</a></li>
                            </ul>
                        </li> -->
                                 <li class="xn-openable <?php
                        if ($pagemain == 'main_report') {
                            echo 'active';
                        }
                        ?>">
                            <a href="#"><span class="fa fa-files-o"></span> <span class="xn-text">รายงาน</span></a>
                            <ul>
                                <li class="<?php
                                if ($pagename == 'report1') {
                                    echo 'active';
                                }
                                ?>"><a href="test.php"><span class="fa fa-image"></span> รายงานข้อมูลการฝากเงินสมาชิก</a></li>
                                <li class="<?php
                                if ($pagename == 'report2') {
                                    echo 'active';
                                }
                                ?>"><a href="test1.php"><span class="fa fa-user"></span>รายงานข้อมูลจำนวนสมาชิก</a></li>
                                <li class="<?php
                                if ($pagename == 'report6') {
                                    echo 'active';
                                }
                                ?>"><a href="test5.php"><span class="fa fa-users"></span> รายงานข้อมูลยอดนำส่งของผู้สูงอายุ รายเดือน</a></li>
                                <li class="<?php
                                if ($pagename == 'report3') {
                                    echo 'active';
                                }
                                ?>"><a href="test2.php"><span class="fa fa-users"></span> รายงานข้อมูลยอดนำส่งของผู้พิการ รายเดือน</a></li>
                                <li class="<?php
                                if ($pagename == 'report5') {
                                    echo 'active';
                                }
                                ?>"><a href="test4.php"><span class="fa fa-files-o"></span> รายงานยอดเงินกราฟวงกลม</a></li>
                                <li class="<?php
                                if ($pagename == 'report7') {
                                    echo 'active';
                                }
                                ?>"> <a href="test6.php"><span class="fa fa-files-o"></span> รายงานตารางกองทุน</a></li>
                               
                                
                            </ul>
                        </li>
                            <?php } ?>        
                </ul>
                
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->
            <!-- PAGE CONTENT -->
            <div class="page-content">

                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SEARCH -->
                    <li class="xn-search">
                        <form role="form">
                            <input type="text" name="search" placeholder="Search..."/>
                        </form>
                    </li>   
                    <!-- END SEARCH -->
                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right">
                        <a href="#" class="mb-control" data-box="#mb-signout" id="data-logout"><span class="fa fa-sign-out"></span></a>                        
                    </li> 
                    <!-- END SIGN OUT -->


                </ul>
                <!-- END X-NAVIGATION VERTICAL -->                   
                <style>
                    .form-control[disabled], .form-control[readonly] {
                        color: black;
                    }
                </style>                                