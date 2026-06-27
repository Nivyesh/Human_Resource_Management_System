<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';

    if (strlen($_SESSION['uid']) == 0) {
    header('location:logout.php');
    } else {

    $uid = $_SESSION['uid'];
    ?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>My Leave Requests</title>

<!-- CSS -->

<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

<link href="../css/sb-admin-2.min.css" rel="stylesheet">

<link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<link href="../css/sb-admin-2.min.css" rel="stylesheet">
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

<div id="wrapper">

<?php include_once 'includes/sidebar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">

<div id="content">

<?php include_once 'includes/header.php'; ?>

<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">My Leave Requests</h1>

<div class="table-responsive">

<table class="table table-bordered" id="dataTable">

<thead>

<tr>

<th>S no.</th>
<th>EmployeeID</th>
<th>LeaveType</th>
<th>FromDate</th>
<th>ToDate</th>
<th>Status</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php

    $query = mysqli_query($con, "
SELECT * FROM leave_management
WHERE EmployeeID='$uid'
");

    $cnt = 1;

    while ($row = mysqli_fetch_array($query)) {
        ?>

<tr>

<td><?php echo $cnt; ?></td>

<td><?php echo $row['EmployeeID']; ?></td>

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

<?php if ($row['Status'] == "Pending") {?>

<a href="empLeaveEdit.php?editid=<?php echo $row['ID']; ?>"
class="btn btn-primary btn-sm">

Edit

</a>

<?php } else {?>

<span class="text-muted">Locked</span>

<?php }?>

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

<!-- JS -->
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
