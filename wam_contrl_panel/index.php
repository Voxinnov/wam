<?php
ob_start();
include("autoload.php");
session_start();
$no_visible_elements=true;
?>

<!DOCTYPE html>


<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <title>Login Page</title>

    <meta name="description" content="login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

    <!--Basic Styles-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link id="bootstrap-rtl-link" href="#" rel="stylesheet" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />

    <!--Fonts-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300" rel="stylesheet" type="text/css">

    <!--Beyond styles-->
    <link id="beyond-link" href="assets/css/beyond.min.css" rel="stylesheet" />
    <link href="assets/css/demo.min.css" rel="stylesheet" />
    <link href="assets/css/animate.min.css" rel="stylesheet" />
    <link id="skin-link" href="#" rel="stylesheet" type="text/css" />

    <!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
    <script src="assets/js/skins.min.js"></script>
</head>
<!--Head Ends-->
<!--Body-->
<body>

   <form action = "login.php" method = "post">
    <div class="login-container animated fadeInDown">
        <div class="loginbox bg-white">
           
           <div align="center"><br><img src="assets/img/favicon.png" style="max-width:70px"></img><br></div>
            <div class="loginbox-textbox">
        <input type="text" class="form-control" placeholder="User Name" name="txtUsername" />
            </div>
            <div class="loginbox-textbox">
    <input type="password" class="form-control" placeholder="Password" name="txtPassword" />
            </div>
            <div class="loginbox-forgot">
               <!-- <a href="#">Forgot Password?</a>-->
            </div>
            <div class="loginbox-submit">
                <!--<input type="button" name="submit" class="btn btn-primary btn-block" value="Login">-->
                 <input type="submit" name="submit" class="btn btn-primary btn-block" value="Submit">
            </div>
            
        </div>
        
    </div>
</form>
    <!--Basic Scripts-->
    <script src="assets/js/jquery-2.0.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/slimscroll/jquery.slimscroll.min.js"></script>

    <!--Beyond Scripts-->
    <script src="assets/js/beyond.js"></script>

    <!--Google Analytics::Demo Only-->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date(); a = s.createElement(o),
            m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '../www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-60412744-1', 'auto');
        ga('send', 'pageview');

    </script>
</body>
</html>
