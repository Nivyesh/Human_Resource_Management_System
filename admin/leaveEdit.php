<?php
    session_start();
    include 'includes/dbconnection.php';

    if (strlen($_SESSION['aid']) == 0) {
    header('location:logout.php');
    }

    if (isset($_POST['submit'])) {
    $eid       = $_GET['editid'];
    $LeaveType = $_POST['LeaveType'];
    $FromDate  = $_POST['FromDate'];
    $ToDate    = $_POST['ToDate'];
    $Status    = $_POST['Status'];

    $query = mysqli_query($con, "
        UPDATE leave_management SET
        LeaveType='$LeaveType',
        FromDate='$FromDate',
        ToDate='$ToDate',
        Status='$Status'
        WHERE ID='$eid'
    ");

    if ($query) {
        $msg = "Leave Updated Successfully.";
    } else {
        $msg = "Something went wrong.";
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>Edit Leave</title>

<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
<link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
<div id="wrapper">

<?php include_once 'includes/sidebar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">
<div id="content">

<?php include_once 'includes/header.php'; ?>

<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Edit Leave</h1>

<p style="color:green" align="center">
<?php if (isset($msg)) {echo $msg;}?>
</p>

<div class="card shadow mb-4">
<div class="card-body">

<?php
    $eid = $_GET['editid'];
    $ret = mysqli_query($con, "SELECT * FROM leave_management WHERE ID='$eid'");
    $row = mysqli_fetch_assoc($ret);
?>

<form method="post">

<div class="row">
<div class="col-4 mb-3">Leave Type</div>
<div class="col-8 mb-3">
<input type="text" name="LeaveType"
class="form-control form-control-user"
value="<?php echo $row['LeaveType']; ?>">
</div>
</div>

<div class="row">
<div class="col-4 mb-3">From Date</div>
<div class="col-8 mb-3">
<input type="date" name="FromDate"
class="form-control form-control-user"
value="<?php echo $row['FromDate']; ?>">
</div>
</div>

<div class="row">
<div class="col-4 mb-3">To Date</div>
<div class="col-8 mb-3">
<input type="date" name="ToDate"
class="form-control form-control-user"
value="<?php echo $row['ToDate']; ?>">
</div>
</div>

<div class="row">
<div class="col-4 mb-3">Status</div>
<div class="col-8 mb-3">
<select name="Status" class="form-control form-control-user">
<option value="Pending" <?php if ($row['Status'] == "Pending") {
                                echo "selected";
                        }
                        ?>>Pending</option>
<option value="Approved" <?php if ($row['Status'] == "Approved") {
                                 echo "selected";
                         }
                         ?>>Approved</option>
<option value="Rejected" <?php if ($row['Status'] == "Rejected") {
                                 echo "selected";
                         }
                         ?>>Rejected</option>
</select>
</div>
</div>

<div class="row" style="margin-top:4%">
<div class="col-4"></div>
<div class="col-4">
<input type="submit" name="submit" value="Update"
class="btn btn-primary btn-user btn-block">
</div>
</div>

</form>

</div>
</div>

</div>
</div>

<?php include_once 'includes/footer.php'; ?>

</div>
</div>

<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../js/sb-admin-2.min.js"></script>

</body>
</html>