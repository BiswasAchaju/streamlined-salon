<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
// Code for deletion
if($_GET['action']=='delete')
{
$id=intval($_GET['id']);
$query=mysqli_query($con,"delete from tblservices where ID='$id'");
    if ($query) {
     echo "<script>alert('Service deleted.');</script>";
     echo "<script>window.location.href='manage-services.php'</script>";
  } else {
    echo "<script>alert('Something Went Wrong. Please try again.');</script>";
    echo "<script>window.location.href='manage-services.php'</script>";
    }
}



  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Streamlined Salon Management System || Manage Services</title>

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
		<!--left-fixed -navigation-->
		 <?php include_once('includes/sidebar.php');?>
		<!--left-fixed -navigation-->
		<!-- header-starts -->
		 <?php include_once('includes/header.php');?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					<h3 class="title1">Manage Services</h3>
					
					
				
					<div class="content">
                        <div class="container">
                            <div class="row">
                                <?php
                                $ret = mysqli_query($con, "SELECT * FROM tblservices");
                                $cnt = 1;
                                while ($row = mysqli_fetch_array($ret)) {
                                    $serviceName = $row['ServiceName'];
                                    $servicePrice = $row['Cost'];
                                    $serviceDescription = $row['Description'];
                                    $serviceImage = $row['Image']; // Assuming you have a column for image in your database
                                ?>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="service-block">
                                        <div class="service-icon mb20">
                                            <img src="images/<?php echo $serviceImage; ?>" width="100%" height="100%" alt="">
                                        </div>
                                        <div class="service-content">
                                            <h2><a href="#" class="title"><?php echo $serviceName; ?></a></h2>
                                            <p><?php echo $serviceDescription; ?></p>
                                            <div class="price">Rs <?php echo $servicePrice; ?></div>
                                            <a href="edit-services.php?editid=<?php echo $row['ID'];?>"><i class="fa fa-edit"></i></a> | 
                                            <a href="manage-services.php?action=delete&&id=<?php echo $row['ID'];?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    $cnt++;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!--footer-->
		 <?php include_once('includes/footer.php');?>
        <!--//footer-->
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
<?php }  ?>