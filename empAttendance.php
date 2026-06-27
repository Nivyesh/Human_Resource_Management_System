<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';

    if (strlen($_SESSION['uid']) == 0) {
    header('location:logout.php');
    } else {

    $empid = $_SESSION['uid'];
    ?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>My Attendance</title>

<!-- ✅ FIXED CSS (ONLY REQUIRED FILES) -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

<!-- ✅ CUSTOM CSS -->
<style>
.table td, .table th {
    text-align: center;
    vertical-align: middle;
}

.time-in {
    color: #16a34a;
    font-weight: 600;
}

.time-out {
    color: #dc2626;
    font-weight: 600;
}

.work-hours {
    font-weight: 600;
}

.overtime {
    background: #dcfce7;
    color: #166534;
    padding: 4px 8px;
    border-radius: 6px;
    font-weight: bold;
}

.no-overtime {
    color: #64748b;
}
</style>

</head>

<body id="page-top">

<div id="wrapper">

<?php include_once 'includes/sidebar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">
<div id="content">

<?php include_once 'includes/header.php'; ?>

<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">My Attendance</h1>

<!-- SEARCH -->
<form method="GET">
<div class="row mb-3">
<div class="col-md-4">
<input type="date" name="adate" class="form-control">
</div>
</div>
</form>

<div class="table-responsive">

<table class="table table-bordered" id="dataTable">

<thead>
<tr>
<th>S no.</th>
<th>EmployeeID</th>
<th>Employee Name</th>
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

    if (! empty($_GET['adate'])) {
        $date   = $_GET['adate'];
        $where .= " AND attendance.AttendanceDate='$date'";
    }

    $query = mysqli_query($con, "
SELECT attendance.*, employeedetail.EmpFname
FROM attendance
JOIN employeedetail
ON employeedetail.ID = attendance.EmployeeID
WHERE attendance.EmployeeID='$empid' $where
ORDER BY attendance.AttendanceDate DESC
");

    $cnt = 1;

    while ($row = mysqli_fetch_array($query)) {

        ?>

<tr>

<td><?php echo $cnt; ?></td>
<td><?php echo $row['EmployeeID']; ?></td>
<td><?php echo $row['EmpFname']; ?></td>
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
<td class="time-in">
<?php echo $row['check_in'] ? date("h:i A", strtotime($row['check_in'])) : "-"; ?>
</td>

<!-- CHECK OUT -->
<td class="time-out">
<?php echo $row['check_out'] ? date("h:i A", strtotime($row['check_out'])) : "-"; ?>
</td>

<!-- WORK HOURS -->
<td class="work-hours">
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
                echo "<span class='overtime'>" . gmdate("H:i", $overtime) . "</span>";
            } else {
                echo "<span class='no-overtime'>00:00</span>";
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

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>



  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script type="text/javascript">
    $(".jDate").datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true
}).datepicker("update", "10/10/2016");
  </script>

</body>
</html>

<?php }?>