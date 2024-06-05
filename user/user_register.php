<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $query = mysqli_query($con, "INSERT INTO tblusers (UserName, Email, Password) VALUES ('$username', '$email', '$password')");
    if ($query) {
        $query = mysqli_query($con, "SELECT ID FROM tblusers WHERE UserName='$username' AND Password='$password'");
        $ret = mysqli_fetch_array($query);
        if ($ret > 0) {
            $_SESSION['userid'] = $ret['ID'];
            echo "<script type='text/javascript'> document.location ='user_dashboard.php'; </script>";
        }
    } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Streamlined Salon Management | User Registration</title>

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<link href="css/font-awesome.css" rel="stylesheet">
<!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
    <script>
         new WOW().init();
    </script>
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->
</head>
<body class="">
    <div class="main-content">
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page login-page ">
                <h3 class="title1">User Registration</h3>
                <div class="widget-shadow">
                    <div class="login-top">
                        <h4>Join Streamlined Salon Management!</h4>
                    </div>
                    <div class="login-body">
                        <form role="form" method="post" action="">
                            <input type="text" class="user" name="username" placeholder="Username" required="true">
                            <input type="email" name="email" class="lock" placeholder="Email" required="true">
                            <input type="password" name="password" class="lock" placeholder="Password" required="true">
                            <input type="submit" name="register" value="Sign Up">
                            <div class="forgot-grid">
                                <div class="forgot">
                                    <a href="user_login.php">Already have an account? Sign In</a>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="forgot-grid">
                                <div class="forgot">
                                    <a href="../index.php">Back to Home</a>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Classie -->
    <script src="js/classie.js"></script>
    <!--scrolling js-->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!--//scrolling js-->
    <!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.js"> </script>
</body>
</html>
