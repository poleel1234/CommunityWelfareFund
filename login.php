<?php
session_start();
include "connect_db.php";
?>
<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title>ระบบกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->  
        <link href="https://fonts.googleapis.com/css?family=Chonburi|Niramit" rel="stylesheet">
    </head>
    <style>
        h1 {
            text-align: center;
            text-transform: uppercase;
            color: #FFFFFF;
            font-family: 'Niramit', sans-serif;
        }
        b {
            color: #FFFFFF;
        }
    </style>
    <body>
        <div class="login-container">
            <div class="login-box animated fadeInDown">
                <div><center><img src="img/bmg_logo.png"></center></div>
                <div><h1>ระบบกองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร</h1></div>
                <div class="login-body">
                    <div class="login-title"><strong>Welcome</strong>, Please login</div>
                    <form action="login_chk.php" name="formlogin" id="formlogin" class="form-horizontal" method="post" onsubmit="return chk_form()"> <!-- ส่งค่าไป chk_form  -->
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off" required="" value="<?= $_COOKIE['CK_username'] ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" required="" value="<?= $_COOKIE['CK_password'] ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <input class="icheckbox" type="checkbox" name="keep_login" id="keep_login" value="1" checked <?= (isset($_COOKIE['CK_username']) && $_COOKIE['CK_password']) ?>>
                                <span class="form-check-sign"></span>
                                <b>Remember Me</b>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-info btn-block">Log In</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; 2018 Community Welfare Fund
                    </div>
                    <div class="pull-right">
                        <a href="register.php">สมัครสมาชิก</a> |
                        <a href="#">ขอรับสวัสดิการ</a> |
                        <a href="#">ขอกู้ยืม</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
    function chk_form() {
        var j_keep_login = document.formlogin.keep_login; //ประกาศตัวแปรเก็บค่า
        var i_username = document.formlogin.username.value;
        var i_password = document.formlogin.password.value;
        if (j_keep_login.checked === true) {
            var days = 1; // กำหนดจำนวนวันที่ต้องการให้จำค่า
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));//จะทำงานหลังจากเวลาที่กำหนดเพียง 1 ครั้งเกี่ยวกับวันที่ getTime() ใช้แสดงจำนวนเต็มของเวลา โดยเริ่มนับจากเวลา 00:00 นาฬิกา
            var expires = "; expires=" + date.toGMTString();
            document.cookie = "CK_username=" + i_username + "; expires=" + expires + "; path=/";
            document.cookie = "CK_password=" + i_password + "; expires=" + expires + "; path=/";
        } else {
            var expires = "";
            document.cookie = "CK_username=" + expires + ";-1;path=/";
            document.cookie = "CK_password=" + expires + ";-1;path=/";
        }
    }
</script>