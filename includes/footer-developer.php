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
<div class="footer">
    <!-- footer-->
    <div class="container">
        <div class="footer-block">
            <!-- footer block -->
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="footer-widget">
                        <h2 class="widget-title">Developer Contact</h2>
                        <ul class="listnone contact">
                            <li><i class="fa fa-map-marker"></i> Bhaktapur, Nepal</li>
                            <li><a href="tel:+9779860577746"><i class="fa fa-phone"></i> +977 9860577746</a></li>
                            <li><a href="mailto:biswasachaju@yahoo.com"><i class="fa fa-envelope-o"></i> biswasachaju@yahoo.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="footer-widget footer-social">
                        <!-- social block -->
                        <h2 class="widget-title">Social Feed</h2>
                        <ul class="listnone">
                            <li><a href="https://www.facebook.com/biswas.achaju.me/"><i class="fa fa-facebook"></i> Facebook</a></li>
                            <li><a href="https://www.instagram.com/biswas.achaju.me/"><i class="fa fa-instagram"></i> Instagram</a></li>
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
                            <p>© Streamlined Unisex Salon | All rights reserved</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.tiny footer block -->
        </div>
        <!-- /.footer block -->
    </div>
</div>
