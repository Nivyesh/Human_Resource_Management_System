<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';

    if (strlen($_SESSION['aid']) == 0) {
    header('location:logout.php');
    } else {

    // ADD DEPARTMENT
    if (isset($_POST['adddept'])) {
        $deptname = $_POST['DepartmentName'];
        $created  = date("Y-m-d");

        mysqli_query($con, "INSERT INTO departments (DepartmentName, CreatedAt)
                        VALUES ('$deptname', '$created')");

        echo "<script>alert('Department Added Successfully');</script>";
        echo "<script>window.location.href='alldepartments.php'</script>";
    }

    // DELETE DEPARTMENT
    if (isset($_GET['delid'])) {
        $eid = $_GET['delid'];

        mysqli_query($con, "DELETE FROM departments WHERE ID='$eid'");

        echo "<script>alert('Department Deleted Successfully');</script>";
        echo "<script>window.location.href='alldepartments.php'</script>";
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>All Departments</title>

<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
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

<h1 class="h3 mb-4 text-gray-800">All Departments</h1>

<!-- ADD BUTTON -->
<button class="btn btn-success mb-3" data-toggle="modal" data-target="#addDeptModal">
<i class="fas fa-plus"></i> Add Department
</button>

<!-- TABLE -->
<div class="card shadow mb-4">
<div class="card-body">
<div class="table-responsive">

<table class="table table-bordered table-striped table-hover" id="dataTable" width="100%">
<thead class="thead-dark">
<tr>
<th>S no.</th>
<th>Department</th>
<th>Created Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>

<?php
    $ret = mysqli_query($con, "SELECT * FROM departments");
    $cnt = 1;
    while ($row = mysqli_fetch_array($ret)) {
        ?>

<tr>
<td><?php echo $cnt; ?></td>
<td><?php echo $row['DepartmentName']; ?></td>
<td><?php echo $row['CreatedAt']; ?></td>

<td>
<a href="departmentEdit.php?editid=<?php echo $row['ID']; ?>"
class="btn btn-primary btn-sm">
<i class="fas fa-edit"></i>
</a>

<a href="alldepartments.php?delid=<?php echo $row['ID']; ?>"
onclick="return confirm('Do you really want to delete?');"
class="btn btn-danger btn-sm">
<i class="fas fa-trash"></i>
</a>
</td>

</tr>

<?php $cnt++;
    }?>

</tbody>
</table>

</div>
</div>
</div>

</div>
</div>

<?php include_once 'includes/footer.php'; ?>

</div>
</div>

<!-- ADD MODAL -->
<div class="modal fade" id="addDeptModal" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Add Department</h5>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<form method="post">
<div class="modal-body">

<div class="form-group">
<label>Department Name</label>
<input type="text" name="DepartmentName"
class="form-control" required>
</div>

</div>

<div class="modal-footer">
<button type="submit" name="adddept" class="btn btn-primary">
Add Department
</button>
<button type="button" class="btn btn-secondary" data-dismiss="modal">
Cancel
</button>
</div>
</form>

</div>
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