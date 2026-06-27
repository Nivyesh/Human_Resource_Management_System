<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';

    if (strlen($_SESSION['aid']) == 0) {
    header('location:logout.php');
    } else {

    /* DELETE PAYROLL */
    if (isset($_GET['delid'])) {
        $eid = $_GET['delid'];
        mysqli_query($con, "DELETE FROM payroll WHERE ID='$eid'");
        echo "<script>alert('Payroll Deleted Successfully');</script>";
        echo "<script>window.location.href='payroll.php'</script>";
    }

    /* ADD NEW PAYROLL */
    if (isset($_POST['addpayroll'])) {

        $empid  = $_POST['empid'];
        $basic  = $_POST['basicsalary'];
        $allow  = $_POST['allowance'];
        $deduct = $_POST['deduction'];
        $date   = $_POST['paymentdate'];

        $netsalary = $basic + $allow - $deduct;

        $query = mysqli_query($con, "INSERT INTO payroll
    (EmployeeID,BasicSalary,Allowance,Deduction,NetSalary,PaymentDate)
    VALUES
    ('$empid','$basic','$allow','$deduct','$netsalary','$date')");

        if ($query) {
            echo "<script>alert('Payroll Added Successfully');</script>";
            echo "<script>window.location.href='payroll.php'</script>";
        } else {
            echo "<script>alert('Something went wrong');</script>";
        }
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Employees Payroll</title>

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

<h1 class="h3 mb-4 text-gray-800">Employees Payroll</h1>

<button class="btn btn-success mb-3" data-toggle="modal" data-target="#addPayroll">
Add New Payroll
</button>

<!-- SEARCH -->
<form method="GET">
<div class="row mb-3">

<div class="col-md-4">
<input type="text" name="empid" class="form-control" placeholder="Search Employee ID">
</div>

<div class="col-md-4">
<input type="date" name="pdate" class="form-control">
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
<th>BasicSalary</th>
<th>Allowance</th>
<th>Deduction</th>
<th>NetSalary</th>
<th>PaymentDate</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php

    $where = "";

    if (! empty($_GET['empid'])) {
        $emp    = $_GET['empid'];
        $where .= " AND payroll.EmployeeID LIKE '%$emp%'";
    }

    if (! empty($_GET['pdate'])) {
        $date   = $_GET['pdate'];
        $where .= " AND payroll.PaymentDate='$date'";
    }

    /* ✅ JOIN QUERY */
    $ret = mysqli_query($con, "
SELECT payroll.*, employeedetail.EmpFname, employeedetail.EmpLname
FROM payroll
JOIN employeedetail
ON employeedetail.ID = payroll.EmployeeID
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

<td><?php echo $row['BasicSalary']; ?></td>
<td><?php echo $row['Allowance']; ?></td>
<td><?php echo $row['Deduction']; ?></td>
<td><?php echo $row['NetSalary']; ?></td>
<td><?php echo $row['PaymentDate']; ?></td>

<td>
<a href="payrollEdit.php?editid=<?php echo $row['ID']; ?>">Edit</a> |
<a href="payroll.php?delid=<?php echo $row['ID']; ?>"
onclick="return confirm('Do you really want to delete?')"
style="color:red">Delete</a>
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

<!-- ADD PAYROLL MODAL -->

<div class="modal fade" id="addPayroll">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Add Employee Payroll</h5>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<form method="POST">

<div class="modal-body">

<div class="form-group">
<label>Employee ID</label>
<input type="text" name="empid" class="form-control" required>
</div>

<div class="form-group">
<label>Basic Salary</label>
<input type="number" name="basicsalary" class="form-control" required>
</div>

<div class="form-group">
<label>Allowance</label>
<input type="number" name="allowance" class="form-control" required>
</div>

<div class="form-group">
<label>Deduction</label>
<input type="number" name="deduction" class="form-control" required>
</div>

<div class="form-group">
<label>Payment Date</label>
<input type="date" name="paymentdate" class="form-control" required>
</div>

</div>

<div class="modal-footer">
<button type="submit" name="addpayroll" class="btn btn-primary">Add Payroll</button>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
</div>

</form>

</div>
</div>
</div>

<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../js/sb-admin-2.min.js"></script>

<script src="../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function(){
    $('#dataTable').DataTable();
});
</script>

</body>
</html>

<?php }?>