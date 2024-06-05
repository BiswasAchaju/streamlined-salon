<?php 
include('includes/dbconnection.php');
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
  {
    $name=$_POST['name'];
    $email=$_POST['email'];
    $services=$_POST['services'];
    $adate=$_POST['adate'];
    $atime=$_POST['atime'];
    $phone=$_POST['phone'];
    $aptnumber = mt_rand(100000000, 999999999);
  
    $query=mysqli_query($con,"insert into tblappointment(AptNumber,Name,Email,PhoneNumber,AptDate,AptTime,Services) value('$aptnumber','$name','$email','$phone','$adate','$atime','$services')");
    if ($query) {
        $ret=mysqli_query($con,"select AptNumber from tblappointment where Email='$email' and  PhoneNumber='$phone'");
        $result=mysqli_fetch_array($ret);
        $_SESSION['aptno']=$result['AptNumber'];
        echo "<script>window.location.href='thank-you.php'</script>";  
    } else {
        echo "<script>alert('Something Went Wrong. Please try again.');</script>"; 
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Streamlined Salon Management System|| Appointments Form</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i%7cMontserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <?php include_once('includes/header.php');?>
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-caption">
                        <h2 class="page-title">Book Appointment</h2>
                        <div class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li class="active">Book Appointment</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h1>Appointment Form</h1>
                            <p> Book your appointment to save salon rush.</p>
                            <form method="post" onsubmit="return validateForm()">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label" for="name">Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" required="true" pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label" for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required="true" maxlength="10" pattern="9[0-9]{9}" title="Phone number must start with 9 and be exactly 10 digits long">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label" for="email">Email</label>
                                        <input type="email" class="form-control" id="appointment_email" placeholder="Email" name="email" required="true" pattern="[a-z]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Email must contain only lowercase letters before @">
                                        <div id="email_error" style="color: red; display: none;">Email must contain only lowercase letters before @</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label" for="services">Services</label>
                                        <select name="services" id="services" required="true" class="form-control">
                                            <option value="">Select Services</option>
                                            <?php 
                                            $query=mysqli_query($con,"select * from tblservices");
                                            while($row=mysqli_fetch_array($query)) {
                                                echo "<option value='" . $row['ServiceName'] . "'>" . $row['ServiceName'] . "</option>";
                                            }
                                            ?> 
                                        </select>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="adate">Appointment Date</label>
                                            <input type="date" class="form-control" name="adate" id="inputdate" required="true">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="atime">Appointment Time</label>
                                            <input type="time" class="form-control" name="atime" id="atime" required="true" min="08:00" max="20:00" title="Appointment time must be between 8 AM and 8 PM">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" id="submit" name="submit" class="btn btn-default">Book</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <script type="text/javascript">
                                function validateForm() {
                                    var email = document.getElementById('appointment_email').value;
                                    var emailPattern = /^[a-z]+@[a-z0-9.-]+\.[a-z]{2,}$/;
                                    var emailError = document.getElementById('email_error');
                                    if (!emailPattern.test(email)) {
                                        emailError.style.display = 'block';
                                        return false;
                                    }
                                    emailError.style.display = 'none';
                                    return true;
                                }

                                $(function(){
                                    var dtToday = new Date();
                                    var month = dtToday.getMonth() + 1;
                                    var day = dtToday.getDate() + 1;
                                    var year = dtToday.getFullYear();
                                    if(month < 10)
                                        month = '0' + month.toString();
                                    if(day < 10)
                                        day = '0' + day.toString();
                                    var maxDate = year + '-' + month + '-' + day;
                                    $('#inputdate').attr('min', maxDate);
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('includes/footer.php');?>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/menumaker.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/sticky-header.js"></script>
</body>
</html>
