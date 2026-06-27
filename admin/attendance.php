<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';

    if (strlen($_SESSION['aid']) == 0) {
    header('location:logout.php');
    } else {
    ?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<title>Employees Attendance</title>

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

<h1 class="h3 mb-4 text-gray-800">Employees Attendance</h1>

<!-- 🔍 SEARCH -->
<form method="GET">
<div class="row mb-3">

<div class="col-md-3">
<input type="text" name="empid" class="form-control" placeholder="Search Employee ID">
</div>

<div class="col-md-3">
<input type="date" name="adate" class="form-control">
</div>

<div class="col-md-2">
<button type="submit" class="btn btn-primary">Search</button>
</div>

</div>
</form>

<div class="table-responsive">

<table class="table table-bordered" id="dataTable">

<thead>
<tr>
<th>S no.</th>
<th>Employee</th>
<th>Date</th>
<th>Status</th>
<th>Check In</th>
<th>Check Out</th>
<th>Work Hours</th>
<th>Overtime</th>
</tr>
</thead>

<tbody>

<?php

    $where = "";

    if (! empty($_GET['empid'])) {
        $empid  = $_GET['empid'];
        $where .= " AND attendance.EmployeeID LIKE '%$empid%'";
    }

    if (! empty($_GET['adate'])) {
        $date   = $_GET['adate'];
        $where .= " AND attendance.AttendanceDate='$date'";
    }

    /* ✅ JOIN QUERY WITH FULL NAME */
    $query = mysqli_query($con, "
SELECT attendance.*, employeedetail.EmpFname, employeedetail.EmpLname
FROM attendance
JOIN employeedetail
ON employeedetail.ID = attendance.EmployeeID
WHERE 1 $where
ORDER BY attendance.AttendanceDate DESC
");

    $cnt = 1;

    while ($row = mysqli_fetch_array($query)) {

        ?>

<tr>

<td><?php echo $cnt; ?></td>

<!-- ✅ NAME + ID -->
<td>
<strong><?php echo $row['EmpFname'] . " " . $row['EmpLname']; ?></strong><br>
<small>ID: <?php echo $row['EmployeeID']; ?></small>
</td>

<td><?php echo $row['AttendanceDate']; ?></td>

<td>
<?php
    if ($row['Status'] == "Present") {
            echo "<span class='badge badge-success'>Present</span>";
        } elseif ($row['Status'] == "Absent") {
            echo "<span class='badge badge-danger'>Absent</span>";
        } else {
            echo "<span class='badge badge-warning'>Leave</span>";
        }
        ?>
</td>

<!-- CHECK IN -->
<td>
<?php echo $row['check_in'] ? date("h:i A", strtotime($row['check_in'])) : "-"; ?>
</td>

<!-- CHECK OUT -->
<td>
<?php echo $row['check_out'] ? date("h:i A", strtotime($row['check_out'])) : "-"; ?>
</td>

<!-- WORK HOURS -->
<td>
<?php
    if ($row['check_in'] && $row['check_out']) {
            $start = strtotime($row['check_in']);
            $end   = strtotime($row['check_out']);
            $diff  = $end - $start;
            echo gmdate("H:i", $diff);
        } else {
            echo "-";
        }
        ?>
</td>

<!-- OVERTIME -->
<td>
<?php
    if ($row['check_in'] && $row['check_out']) {
            $start = strtotime($row['check_in']);
            $end   = strtotime($row['check_out']);
            $diff  = $end - $start;

            $hours = $diff / 3600;

            if ($hours > 8) {
                $overtime = $diff - (8 * 3600);
                echo "<span class='text-success font-weight-bold'>" . gmdate("H:i", $overtime) . "</span>";
            } else {
                echo "00:00";
            }
        } else {
            echo "-";
        }
        ?>
</td>

</tr>

<?php
    $cnt++;
    }
    ?>

</tbody>

</table>

</div>

</div>

</div>

<?php include_once 'includes/footer.php'; ?>

</div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

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