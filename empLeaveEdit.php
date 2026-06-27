<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';

    if (strlen($_SESSION['uid']) == 0) {
    header('location:logout.php');
    } else {

    $uid = $_SESSION['uid'];
    $eid = $_GET['editid'];

    /* UPDATE LEAVE */

    if (isset($_POST['submit'])) {

        $LeaveType = $_POST['LeaveType'];
        $FromDate  = $_POST['FromDate'];
        $ToDate    = $_POST['ToDate'];

        $query = mysqli_query($con, "UPDATE leave_management
SET LeaveType='$LeaveType',FromDate='$FromDate',ToDate='$ToDate'
WHERE ID='$eid' AND Status='Pending' AND EmployeeID='$uid'");

        echo "<script>alert('Leave Updated Successfully');</script>";
        echo "<script>window.location.href='empLeaves.php'</script>";

    }

    /* DELETE LEAVE */

    if (isset($_POST['delete'])) {

        mysqli_query($con, "DELETE FROM leave_management
WHERE ID='$eid' AND Status='Pending' AND EmployeeID='$uid'");

        echo "<script>alert('Leave Deleted Successfully');</script>";
        echo "<script>window.location.href='myLeaves.php'</script>";

    }
    ?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Edit Leave Request</title>

<!-- CSS FILES -->

<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
<link href="../css/sb-admin-2.min.css" rel="stylesheet">
<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
<link href="../css/sb-admin-2.min.css" rel="stylesheet">
<link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="../css/sb-admin-2.min.css" rel="stylesheet">
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
<link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<div id="wrapper">

<?php include_once 'includes/sidebar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">

<div id="content">

<?php include_once 'includes/header.php'; ?>

<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Edit Leave Request</h1>

<div class="card shadow mb-4">

<div class="card-body">

<?php

    $query = mysqli_query($con, "SELECT * FROM leave_management
WHERE ID='$eid' AND EmployeeID='$uid'");

    $row = mysqli_fetch_array($query);

    ?>

<form method="post">

<div class="form-group">

<label>Leave Type</label>

<input type="text" name="LeaveType" class="form-control"
value="<?php echo $row['LeaveType']; ?>" required>

</div>

<div class="form-group">

<label>From Date</label>

<input type="date" name="FromDate" class="form-control"
value="<?php echo $row['FromDate']; ?>" required>

</div>

<div class="form-group">

<label>To Date</label>

<input type="date" name="ToDate" class="form-control"
value="<?php echo $row['ToDate']; ?>" required>

</div>

<br>

<button type="submit" name="submit" class="btn btn-success">

Update Leave

</button>

<button type="submit" name="delete" class="btn btn-danger"
onclick="return confirm('Are you sure you want to delete this leave?')">

Delete Leave

</button>

<a href="empLeaves.php" class="btn btn-secondary">

Cancel

</a>

</form>

</div>

</div>

</div>

</div>

<?php include_once 'includes/footer.php'; ?>

</div>

</div>

<!-- JS FILES -->

<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../js/sb-admin-2.min.js"></script>

<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../js/sb-admin-2.min.js"></script>

<script src="../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

</body>
</html>

<?php }?>