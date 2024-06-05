<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_GET['deleteid'])) {
        $deleteid = intval($_GET['deleteid']);
        $query = mysqli_query($con, "DELETE FROM tblcustomers WHERE ID='$deleteid'");
        if ($query) {
            echo "<script>alert('Customer deleted successfully.');</script>";
            echo "<script>window.location.href='customer-list.php'</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
        }
    }
}
?>
