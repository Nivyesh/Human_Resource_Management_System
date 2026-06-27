<?php
    session_start();
    include 'includes/dbconnection.php';

    if (strlen($_SESSION['aid']) == 0) {
    header('location:logout.php');
    }

    if (isset($_POST['submit'])) {
    $eid         = $_GET['editid'];
    $BasicSalary = $_POST['BasicSalary'];
    $Allowance   = $_POST['Allowance'];
    $Deduction   = $_POST['Deduction'];
    $PaymentDate = $_POST['PaymentDate'];

    $NetSalary = $BasicSalary + $Allowance - $Deduction;

    $query = mysqli_query($con, "
        UPDATE payroll SET
        BasicSalary='$BasicSalary',
        Allowance='$Allowance',
        Deduction='$Deduction',
        NetSalary='$NetSalary',
        PaymentDate='$PaymentDate'
        WHERE ID='$eid'
    ");

    if ($query) {
        $msg = "Payroll updated successfully.";
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

<title>Edit Payroll</title>

<!-- Same CSS as Employee Edit -->
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

<h1 class="h3 mb-4 text-gray-800">Edit Payroll</h1>

<p style="font-size:16px; color:green" align="center">
<?php if (isset($msg)) {echo $msg;}?>
</p>

<div class="card shadow mb-4">
<div class="card-body">

<?php
    $eid = $_GET['editid'];
    $ret = mysqli_query($con, "SELECT * FROM payroll WHERE ID='$eid'");
    $row = mysqli_fetch_assoc($ret);
?>

<form method="post">

<div class="row">
<div class="col-4 mb-3">Basic Salary</div>
<div class="col-8 mb-3">
<input type="number" name="BasicSalary" class="form-control form-control-user"
value="<?php echo $row['BasicSalary']; ?>">
</div>
</div>

<div class="row">
<div class="col-4 mb-3">Allowance</div>
<div class="col-8 mb-3">
<input type="number" name="Allowance" class="form-control form-control-user"
value="<?php echo $row['Allowance']; ?>">
</div>
</div>

<div class="row">
<div class="col-4 mb-3">Deduction</div>
<div class="col-8 mb-3">
<input type="number" name="Deduction" class="form-control form-control-user"
value="<?php echo $row['Deduction']; ?>">
</div>
</div>

<div class="row">
<div class="col-4 mb-3">Net Salary</div>
<div class="col-8 mb-3">
<input type="number" class="form-control form-control-user"
value="<?php echo $row['NetSalary']; ?>" readonly>
</div>
</div>

<div class="row">
<div class="col-4 mb-3">Payment Date</div>
<div class="col-8 mb-3">
<input type="date" name="PaymentDate" class="form-control form-control-user"
value="<?php echo $row['PaymentDate']; ?>">
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