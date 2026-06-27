<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';

    if (strlen($_SESSION['aid']) == 0) {
    header('location:logout.php');
    } else {

    if (isset($_POST['submit'])) {

        $eid    = $_GET['editid'];
        $empid  = $_POST['EmployeeID'];
        $adate  = $_POST['AttendanceDate'];
        $status = $_POST['Status'];

        $query = mysqli_query($con, "UPDATE attendance SET
        EmployeeID='$empid',
        AttendanceDate='$adate',
        Status='$status'
        WHERE ID='$eid'");

        if ($query) {
            $msg = "Attendance record has been updated.";
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

<title>Edit Attendance</title>

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

<h1 class="h3 mb-4 text-gray-800">Edit Attendance Record</h1>

<p style="font-size:16px; color:red" align="center">
<?php if ($msg) {echo $msg;}?>
</p>

<form class="user" method="post">

<?php
    $aid = $_GET['editid'];

    $ret = mysqli_query($con, "SELECT * FROM attendance WHERE ID='$aid'");
    $row = mysqli_fetch_assoc($ret);

    $status = trim($row['Status']);
    ?>

<!-- Employee ID -->
<div class="row">
<div class="col-4 mb-3">Employee ID</div>
<div class="col-8 mb-3">
<input type="text" class="form-control form-control-user"
name="EmployeeID"
value="<?php echo $row['EmployeeID']; ?>">
</div>
</div>

<!-- Attendance Date -->
<div class="row">
<div class="col-4 mb-3">Attendance Date</div>
<div class="col-8 mb-3">
<input type="date"
class="form-control form-control-user"
name="AttendanceDate"
value="<?php echo $row['AttendanceDate']; ?>">
</div>
</div>

<!-- Status -->
<div class="row">
<div class="col-4 mb-3">Status</div>
<div class="col-8 mb-3">

<select name="Status" class="form-control form-control-user">

<option value="Present" <?php if ($status == 'Present') {
                                    echo "selected";
                            }
                            ?>>
Present
</option>

<option value="Absent" <?php if ($status == 'Absent') {
                                   echo "selected";
                           }
                           ?>>
Absent
</option>

<option value="Leave" <?php if ($status == 'Leave') {
                                  echo "selected";
                          }
                          ?>>
Leave
</option>

</select>

</div>
</div>

<!-- Submit Button -->
<div class="row" style="margin-top:4%">
<div class="col-4"></div>
<div class="col-4">
<input type="submit" name="submit"
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