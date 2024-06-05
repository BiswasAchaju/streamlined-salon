<?php
session_start();
include('includes/dbconnection.php');

// Check if the session is valid
if (!isset($_SESSION['bpmsaid'])) {
    header('location:logout.php');
    exit();
}

$adid = $_SESSION['bpmsaid'];
$ret = mysqli_query($con, "SELECT AdminName, ProfilePic FROM tbladmin WHERE ID='$adid'");

if ($ret) {
    $row = mysqli_fetch_array($ret);
    if ($row) {
        $name = $row['AdminName'];
        $profilepic = $row['ProfilePic'];
    } else {
        $name = "Administrator"; // Fallback if no admin name is found
        $profilepic = "default.png"; // Fallback if no profile picture is found
    }
} else {
    error_log("Query failed: " . mysqli_error($con)); // Log the error
    $name = "Administrator"; // Fallback in case of a query failure
    $profilepic = "default.png"; // Fallback in case of a query failure
}
?>

<div class="sticky-header header-section">
    <div class="header-left">
        <!-- Toggle button start -->
        <button id="showLeftPush"><i class="fa fa-bars"></i></button>
        <!-- Toggle button end -->
        <!-- Logo -->
        <div class="logo">
            <a href="../index.php">
                <h1>Streamlined Salon Appointment</h1>
                <span>AdminPanel</span>
            </a>
        </div>
        <!-- //Logo -->
        <div class="clearfix"></div>
    </div>
    <div class="header-right">
        <div class="profile_details_left">
            <!-- Notifications of menu start -->
            <ul class="nofitications-dropdown">
                <?php
                $ret1 = mysqli_query($con, "SELECT ID, Name FROM tblappointment WHERE Status=''");
                $num = mysqli_num_rows($ret1);
                ?>
                <li class="dropdown head-dpdn">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <span class="badge blue"><?php echo $num; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="notification_header">
                                <h3>You have <?php echo $num; ?> new notification(s)</h3>
                            </div>
                        </li>
                        <li>
                            <div class="notification_desc">
                                <?php
                                if ($num > 0) {
                                    while ($result = mysqli_fetch_array($ret1)) {
                                        ?>
                                        <a class="dropdown-item" href="view-appointment.php?viewid=<?php echo $result['ID']; ?>">
                                            New appointment received from <?php echo $result['Name']; ?>
                                        </a><br />
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <a class="dropdown-item" href="all-appointment.php">No New Appointment Received</a>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <div class="notification_bottom">
                                <a href="new-appointment.php">See all notifications</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Notification menu end -->
        <div class="profile_details">
            <ul>
                <li class="dropdown profile_details_drop">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <div class="profile_img">
                            <span class="prfil-img"><img src="images/<?php echo $profilepic; ?>" alt="Profile Picture" width="50" height="60"> </span>
                            <div class="user-name">
                                <p><?php echo $name; ?></p>
                                <span>Administrator</span>
                            </div>
                            <i class="fa fa-angle-down lnr"></i>
                            <i class="fa fa-angle-up lnr"></i>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                    <ul class="dropdown-menu drp-mnu">
                        <li> <a href="change-password.php"><i class="fa fa-cog"></i> Settings</a> </li>
                        <li> <a href="admin-profile.php"><i class="fa fa-user"></i> Profile</a> </li>
                        <li> <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
</div>
