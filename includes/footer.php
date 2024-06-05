<?php
include('includes/dbconnection.php');
session_start();
error_reporting(0);

if (isset($_POST['sub'])) {
    $email = $_POST['email'];
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $query = mysqli_query($con, "INSERT INTO tblsubscriber (Email) VALUES ('$email')");
        if ($query) {
            echo "<script>alert('You have subscribed successfully!');</script>";
            echo "<script>window.location.href ='index.php'</script>";
        } else {
            echo '<script>alert("Something went wrong. Please try again.");</script>';
        }
    } else {
        echo '<script>alert("Please provide a valid email address.");</script>';
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Streamlined Salon Management System</title>

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
        <!-- footer-->
        <div class="container">
            <div class="footer-block">
                <!-- footer block -->
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="footer-widget">
                            <h2 class="widget-title">Salon Address</h2>
                            <ul class="listnone contact">
                                <?php
                                $ret = mysqli_query($con, "SELECT * FROM tblpage WHERE PageType='contactus'");
                                while ($row = mysqli_fetch_array($ret)) {
                                ?>
                                <li><i class="fa fa-map-marker"></i> <?php echo $row['PageDescription']; ?> </li>
                                <li><i class="fa fa-phone"></i> +<?php echo $row['MobileNumber']; ?></li>
                                <li><i class="fa fa-envelope-o"></i> <?php echo $row['Email']; ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="footer-widget footer-social">
                            <!-- social block -->
                            <h2 class="widget-title">Social Feed</h2>
                            <ul class="listnone">
                                <li><a href="#"><i class="fa fa-facebook"></i> Facebook</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> Gmail</a></li>
                            </ul>
                        </div>
                        <!-- /.social block -->
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                        <div class="footer-widget widget-newsletter">
                            <!-- newsletter block -->
                            <h2 class="widget-title">Newsletters</h2>
                            <p>Enter your email address to receive new patient information and other useful information right to your inbox.</p>
                            <form method="post">
                                <div class="input-group">
                                    <input type="email" class="form-control" placeholder="Enter your email address" name="email" required>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit" value="submit" name="sub">Subscribe</button>
                                    </span>
                                </div>
                            </form>
                            <!-- /input-group -->
                        </div>
                        <!-- newsletter block -->
                    </div>
                </div>
                <div class="tiny-footer">
                    <!-- tiny footer block -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="copyright-content">
                                <p> © Streamlined Unisex Salon | All rights reserved</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.tiny footer block -->
            </div>
            <!-- /.footer block -->
        </div>
    </div>

    <!-- Classie -->
    <script src="js/classie.js"></script>
    <!--scrolling js-->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!--//scrolling js-->
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>
</body>
</html>
