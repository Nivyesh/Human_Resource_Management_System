<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';

    if (strlen($_SESSION['aid']) == 0) {
    header('location:logout.php');
    } else {

    if (isset($_POST['submit'])) {
        $eid  = $_GET['editid'];
        $dept = $_POST['DepartmentName'];

        $query = mysqli_query($con, "UPDATE departments SET
        DepartmentName='$dept'
        WHERE ID='$eid'");

        if ($query) {
            $msg = "Department has been updated.";
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

<title>Edit Department</title>

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

<h1 class="h3 mb-4 text-gray-800">Edit Department</h1>

<p style="font-size:16px; color:red" align="center">
<?php if ($msg) {echo $msg;}?>
</p>

<form class="user" method="post">

<?php
    $aid = $_GET['editid'];
    $ret = mysqli_query($con, "SELECT * FROM departments WHERE ID='$aid'");
    while ($row = mysqli_fetch_array($ret)) {
        ?>

<!-- Department Name -->
<div class="row">
<div class="col-4 mb-3">Department</div>
<div class="col-8 mb-3">
<input type="text"
class="form-control form-control-user"
name="Department"
value="<?php echo $row['DepartmentName']; ?>">
</div>
</div>

<!-- Created Date (Readonly) -->
<div class="row">
<div class="col-4 mb-3">Created Date</div>
<div class="col-8 mb-3">
<input type="text"
class="form-control form-control-user"
value="<?php echo $row['CreatedAt']; ?>"
readonly>
</div>
</div>

<?php }?>

<!-- Submit Button -->
<div class="row" style="margin-top:4%">
<div class="col-4"></div>
<div class="col-4">
<input type="submit"
name="submit"
value="Update"
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