<?php
session_start();
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $adminid = $_SESSION['bpmsaid'];
        $aname = $_POST['adminname'];
        $mobno = $_POST['contactnumber'];
        $uname = $_POST['username'];
        $email = $_POST['email'];

        // Handle profile picture upload
        if ($_FILES["profilepic"]["name"]) {
            $profilepic = $_FILES["profilepic"]["name"];
            $extension = substr($profilepic, strlen($profilepic) - 4, strlen($profilepic));
            $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");

            if (!in_array($extension, $allowed_extensions)) {
                echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
            } else {
                $profilepic = md5($profilepic) . time() . $extension;
                move_uploaded_file($_FILES["profilepic"]["tmp_name"], "images/" . $profilepic);
                $query = mysqli_query($con, "UPDATE tbladmin SET AdminName='$aname', MobileNumber='$mobno', UserName='$uname', Email='$email', ProfilePic='$profilepic' WHERE ID='$adminid'");
                if ($query) {
                    echo '<script>alert("Admin profile has been updated")</script>';
                } else {
                    echo '<script>alert("Something Went Wrong. Please try again.")</script>';
                }
            }
        } else {
            $query = mysqli_query($con, "UPDATE tbladmin SET AdminName='$aname', MobileNumber='$mobno', UserName='$uname', Email='$email' WHERE ID='$adminid'");
            if ($query) {
                echo '<script>alert("Admin profile has been updated")</script>';
            } else {
                echo '<script>alert("Something Went Wrong. Please try again.")</script>';
            }
        }
    }
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Streamlined Salon Management System | Admin Profile</title>
<!-- CSS and JS files -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
<script>
    new WOW().init();
</script>
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
</head> 
<body class="cbp-spmenu-push">
    <div class="main-content">
        <!--left-fixed -navigation-->
        <?php include_once('includes/sidebar.php');?>
        <!--left-fixed -navigation-->
        <!-- header-starts -->
        <?php include_once('includes/header.php');?>
        <!-- //header-ends -->
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <h3 class="title1">Admin Profile</h3>
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
                        <div class="form-title">
                            <h4>Update Profile :</h4>
                        </div>
                        <div class="form-body">
                            <form method="post" enctype="multipart/form-data">
                                <?php
                                $adminid = $_SESSION['bpmsaid'];
                                $ret = mysqli_query($con, "SELECT * FROM tbladmin WHERE ID='$adminid'");
                                while ($row = mysqli_fetch_array($ret)) {
                                ?>
                                 <div class="form-group"> 
                                    <label for="adminname">Admin Name</label> 
                                    <input type="text" class="form-control" id="adminname" name="adminname" placeholder="Admin Name" value="<?php echo $row['AdminName']; ?>"> 
                                 </div> 
                                 <div class="form-group"> 
                                    <label for="username">User Name</label> 
                                    <input type="text" id="username" name="username" class="form-control" value="<?php echo $row['UserName']; ?>"> 
                                 </div>
                                 <div class="form-group"> 
                                    <label for="contactnumber">Contact Number</label> 
                                    <input type="text" id="contactnumber" name="contactnumber" class="form-control" value="<?php echo $row['MobileNumber']; ?>"> 
                                 </div>
                                 <div class="form-group"> 
                                    <label for="email">Email address</label> 
                                    <input type="email" id="email" name="email" class="form-control" value="<?php echo $row['Email']; ?>"> 
                                 </div>
                                 <div class="form-group">
                                    <label for="profilepic">Upload Profile Picture</label>
                                    <input type="file" name="profilepic" id="profilepic" class="form-control">
                                    <?php if($row['ProfilePic']) { ?>
                                    <img src="images/<?php echo $row['ProfilePic']; ?>" width="100" height="100">
                                    <?php } ?>
                                 </div>
                                 <button type="submit" name="submit" class="btn btn-default">Update</button> 
                                <?php } ?>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('includes/footer.php');?>
    </div>
    <!-- Classie -->
    <script src="js/classie.js"></script>
    <script>
        var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
            showLeftPush = document.getElementById( 'showLeftPush' ),
            body = document.body;
            
        showLeftPush.onclick = function() {
            classie.toggle( this, 'active' );
            classie.toggle( body, 'cbp-spmenu-push-toright' );
            classie.toggle( menuLeft, 'cbp-spmenu-open' );
            disableOther( 'showLeftPush' );
        };
        
        function disableOther( button ) {
            if( button !== 'showLeftPush' ) {
                classie.toggle( showLeftPush, 'disabled' );
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
<?php } ?>
