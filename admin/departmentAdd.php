<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';

    if (strlen($_SESSION['aid']) == 0) {
    header('location:logout.php');
    } else {

    if (isset($_POST['submit'])) {
        $dept  = $_POST['Department'];
        $cdate = date('Y-m-d');

        $query = mysqli_query($con, "INSERT INTO departments (Department, CreatedDate)
        VALUES ('$dept', '$cdate')");

        if ($query) {
            $msg = "Department has been added successfully.";
        } else {
            $msg = "Something Went Wrong. Please try again.";
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>Add Department</title>

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

<h1 class="h3 mb-4 text-gray-800">Add Department</h1>

<p style="font-size:16px; color:green" align="center">
<?php if ($msg) {echo $msg;}?>
</p>

<form class="user" method="post">

<!-- Department Name -->
<div class="row">
<div class="col-4 mb-3">Department Name</div>
<div class="col-8 mb-3">
<input type="text"
class="form-control form-control-user"
name="Department"
placeholder="Enter Department Name"
required>
</div>
</div>

<!-- Submit Button -->
<div class="row" style="margin-top:4%">
<div class="col-4"></div>
<div class="col-4">
<input type="submit"
name="submit"
value="Add"
class="btn btn-primary btn-user btn-block">
</div>
</div>

</form>

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

</body>
</html>

<?php }?>