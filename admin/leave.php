<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';

    if (strlen($_SESSION['aid']) == 0) {
    header('location:logout.php');
    } else {

    /* UPDATE STATUS */
    if (isset($_POST['updatestatus'])) {
        $leaveid = $_POST['leaveid'];
        $status  = $_POST['status'];

        mysqli_query($con, "UPDATE leave_management SET Status='$status' WHERE ID='$leaveid'");

        echo "<script>alert('Leave Status Updated');</script>";
        echo "<script>window.location.href='leave.php'</script>";
    }

    /* DELETE LEAVE */
    if (isset($_GET['delid'])) {
        $delid = $_GET['delid'];

        mysqli_query($con, "DELETE FROM leave_management WHERE ID='$delid'");

        echo "<script>alert('Leave Deleted Successfully');</script>";
        echo "<script>window.location.href='leave.php'</script>";
    }
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Employees Leaves</title>

<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
<link href="../css/sb-admin-2.min.css" rel="stylesheet">
<link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

<div id="wrapper">

<?php include_once 'includes/sidebar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">
<div id="content">

<?php include_once 'includes/header.php'; ?>

<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Employees Leaves</h1>

<!-- SEARCH -->
<form method="GET">
<div class="row mb-3">

<div class="col-md-4">
<input type="text" name="empid" class="form-control" placeholder="Search Employee ID">
</div>

<div class="col-md-4">
<input type="date" name="date" class="form-control">
</div>

<div class="col-md-2">
<button class="btn btn-primary">Search</button>
</div>

</div>
</form>

<div class="table-responsive">

<table class="table table-bordered" id="dataTable">

<thead>
<tr>
<th>S no.</th>
<th>Employee</th>
<th>LeaveType</th>
<th>FromDate</th>
<th>ToDate</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php

    $where = "";

    if (! empty($_GET['empid'])) {
        $emp    = $_GET['empid'];
        $where .= " AND leave_management.EmployeeID LIKE '%$emp%'";
    }

    if (! empty($_GET['date'])) {
        $date   = $_GET['date'];
        $where .= " AND leave_management.FromDate='$date'";
    }

    /* ✅ JOIN QUERY */
    $ret = mysqli_query($con, "
SELECT leave_management.*, employeedetail.EmpFname, employeedetail.EmpLname
FROM leave_management
JOIN employeedetail
ON employeedetail.ID = leave_management.EmployeeID
WHERE 1 $where
");

    $cnt = 1;

    while ($row = mysqli_fetch_array($ret)) {
        ?>

<tr>

<td><?php echo $cnt; ?></td>

<!-- ✅ EMPLOYEE NAME + ID -->
<td>
<strong><?php echo $row['EmpFname'] . " " . $row['EmpLname']; ?></strong><br>
<small>ID: <?php echo $row['EmployeeID']; ?></small>
</td>

<td><?php echo $row['LeaveType']; ?></td>
<td><?php echo $row['FromDate']; ?></td>
<td><?php echo $row['ToDate']; ?></td>

<td>
<?php
    if ($row['Status'] == "Approved") {
            echo "<span class='badge badge-success'>Approved</span>";
        } elseif ($row['Status'] == "Rejected") {
            echo "<span class='badge badge-danger'>Rejected</span>";
        } else {
            echo "<span class='badge badge-warning'>Pending</span>";
        }
        ?>
</td>

<td>

<button class="btn btn-info btn-sm"
data-toggle="modal"
data-target="#statusModal<?php echo $row['ID']; ?>">
Change Status
</button>

<a href="leave.php?delid=<?php echo $row['ID']; ?>"
onclick="return confirm('Do you really want to delete this leave?')"
class="btn btn-danger btn-sm">
Delete
</a>

</td>

</tr>

<!-- STATUS MODAL -->

<div class="modal fade" id="statusModal<?php echo $row['ID']; ?>">

<div class="modal-dialog">

<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Update Leave Status</h5>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<form method="post">

<div class="modal-body">

<input type="hidden" name="leaveid" value="<?php echo $row['ID']; ?>">

<label>Status</label>

<select name="status" class="form-control">
<option value="Pending">Pending</option>
<option value="Approved">Approved</option>
<option value="Rejected">Rejected</option>
</select>

</div>

<div class="modal-footer">
<button type="submit" name="updatestatus" class="btn btn-primary">
Update
</button>
</div>

</form>

</div>
</div>
</div>

<?php $cnt++;
    }?>

</tbody>

</table>

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

<script src="../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    $('#dataTable').DataTable();
});
</script>

</body>
</html>

<?php }?>