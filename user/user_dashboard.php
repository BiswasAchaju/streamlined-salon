<?php
session_start();
include('includes/dbconnection.php');

if (!isset($_SESSION['userid']) || strlen($_SESSION['userid']) == 0) {
    header('location:logout.php');
    exit();
} else {
    $userid = $_SESSION['userid'];
}

function fetchAppointments($con, $userid, $status) {
    $stmt = $con->prepare("SELECT * FROM tblappointment WHERE UserID = ? AND Status = ?");
    $stmt->bind_param("ii", $userid, $status);
    $stmt->execute();
    return $stmt->get_result();
}

function renderAppointmentTable($appointments, $title) {
    $status_labels = ['Pending', 'Confirmed', 'Rejected'];
    echo "<div class='table-responsive bs-example widget-shadow'>
            <h4>{$title}:</h4>
            <table class='table table-bordered'>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Appointment Number</th>
                        <th>Name</th>
                        <th>Mobile Number</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>";
    $cnt = 1;
    while ($row = $appointments->fetch_assoc()) {
        echo "<tr>
                <th scope='row'>{$cnt}</th>
                <td>{$row['AptNumber']}</td>
                <td>{$row['Name']}</td>
                <td>{$row['PhoneNumber']}</td>
                <td>{$row['AptDate']}</td>
                <td>{$row['AptTime']}</td>
                <td>{$status_labels[$row['Status']]}</td>
              </tr>";
        $cnt++;
    }
    echo "      </tbody>
            </table>
          </div>";
}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Streamlined Salon Management System || My Appointments</title>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet">
<!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!-- webfonts -->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!-- animate -->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
<script>
    new WOW().init();
</script>
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!-- //Metis Menu -->
</head>
<body class="cbp-spmenu-push">
    <div class="main-content">
        <!--left-fixed -navigation-->
        <?php include_once('includes/sidebar.php'); ?>
        <!--left-fixed -navigation-->
        <!-- header-starts -->
        <?php include_once('includes/header.php'); ?>
        <!-- //header-ends -->
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                    <h3 class="title1">My Appointments</h3>
                    
                    <?php
                    $pending_appointments = fetchAppointments($con, $userid, 0);
                    renderAppointmentTable($pending_appointments, 'Pending Appointments');

                    $confirmed_appointments = fetchAppointments($con, $userid, 1);
                    renderAppointmentTable($confirmed_appointments, 'Confirmed Appointments');

                    $rejected_appointments = fetchAppointments($con, $userid, 2);
                    renderAppointmentTable($rejected_appointments, 'Rejected Appointments');
                    ?>
                </div>
            </div>
        </div>
        <!--footer-->
        <?php include_once('includes/footer.php'); ?>
        <!--//footer-->
    </div>
    <!-- Classie -->
    <script src="js/classie.js"></script>
    <script>
        var menuLeft = document.getElementById('cbp-spmenu-s1'),
            showLeftPush = document.getElementById('showLeftPush'),
            body = document.body;

        showLeftPush.onclick = function () {
            classie.toggle(this, 'active');
            classie.toggle(body, 'cbp-spmenu-push-toright');
            classie.toggle(menuLeft, 'cbp-spmenu-open');
            disableOther('showLeftPush');
        };

        function disableOther(button) {
            if (button !== 'showLeftPush') {
                classie.toggle(showLeftPush, 'disabled');
            }
        }
    </script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"> </script>
</body>
</html>