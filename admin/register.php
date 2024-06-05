<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['register'])) {
    $adminuser = $_POST['username'];
    $password = md5($_POST['password']);
    $email = $_POST['email'];
    $company_id = $_POST['company_id'];

    // Check if the company ID is valid
    $company_query = mysqli_query($con, "SELECT * FROM tblcompany WHERE CompanyID='$company_id'");
    if(mysqli_num_rows($company_query) == 0) {
        $msg = "Invalid Company ID.";
    } else {
        // Check if username or email already exists
        $check_query = mysqli_query($con, "SELECT * FROM tbladmin WHERE UserName='$adminuser' OR Email='$email'");
        if(mysqli_num_rows($check_query) > 0) {
            $msg = "Username or Email already exists.";
        } else {
            $query = mysqli_query($con, "INSERT INTO tbladmin(UserName, Password, Email, CompanyID) VALUES('$adminuser', '$password', '$email', '$company_id')");
            if($query) {
                $msg = "Registration successful. You can log in now.";
            } else {
                $msg = "Something went wrong. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Streamlined Salon Management System | Register Admin Page</title>
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <!-- font CSS -->
    <!-- font-awesome icons -->
    <link href="css/font-awesome.css" rel="stylesheet"> 
    <!-- //font-awesome icons -->
    <!-- js-->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/modernizr.custom.js"></script>
    <!--webfonts-->
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <!--//webfonts--> 
    <!--animate-->
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <!--//end-animate-->
    <!-- Metis Menu -->
    <script src="js/metisMenu.min.js"></script>
    <script src="js/custom.js"></script>
    <link href="css/custom.css" rel="stylesheet">
    <!--//Metis Menu -->
</head> 
<body class="cbp-spmenu-push">
    <div class="main-content">
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page login-page ">
                <h3 class="title1">Register Admin</h3>
                <div class="widget-shadow">
                    <div class="login-top">
                        <h4>Register a new Admin for BPMS AdminPanel!</h4>
                    </div>
                    <div class="login-body">
                        <form role="form" method="post" action="">
                            <p style="font-size:16px; color:red" align="center"> <?php if($msg){ echo $msg; } ?> </p>
                            <input type="text" class="user" name="username" placeholder="Username" required="true">
                            <input type="password" name="password" class="lock" placeholder="Password" required="true">
                            <input type="email" class="user" name="email" placeholder="Email" required="true">
                            <input type="text" class="user" name="company_id" placeholder="Company ID" required="true">
                            <input type="submit" name="register" value="Register">
                        </form>
                        <div class="forgot-grid">
                            <div class="forgot">
                                <a href="index.php">Back to Login</a>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Classie -->
    <script src="js/classie.js"></script>
    <script>
        var menuLeft = document.getElementById('cbp-spmenu-s1'),
            showLeftPush = document.getElementById('showLeftPush'),
            body = document.body;
                
        showLeftPush.onclick = function() {
            classie.toggle(this, 'active');
            classie.toggle(body, 'cbp-spmenu-push-toright');
            classie.toggle(menuLeft, 'cbp-spmenu-open');
            disableOther('showLeftPush');
        };
            
        function disableOther(button) {
            if(button !== 'showLeftPush') {
                classie.toggle(showLeftPush, 'disabled');
            }
        }
    </script>
    <!--scrolling js-->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!--//scrolling js-->
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"> </script>
</body>
</html>
