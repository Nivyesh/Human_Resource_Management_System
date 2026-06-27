<?php
    session_start();
    include 'includes/dbconnection.php';
    if (! isset($_SESSION['uid']) || $_SESSION['uid'] == 0) {
    header('location:logout.php');
    } else {

    $empid = $_SESSION['uid'];

    $currentMonth = date('m');
    $currentYear  = date('Y');

    /* ===== PRESENT DAYS ===== */

    $sql = "SELECT COUNT(status) as total_present
FROM attendance
WHERE EmployeeID='$empid'
AND MONTH(AttendanceDate)='$currentMonth'
AND status='Present'";

    $attendanceQuery = mysqli_query($con, $sql);
    $attendanceData  = mysqli_fetch_assoc($attendanceQuery);
    $totalPresent    = (int) $attendanceData['total_present'];

    /* ===== ABSENT DAYS ===== */

    $absentQuery = mysqli_query($con, "SELECT COUNT(status) as total_absent
FROM attendance
WHERE EmployeeID='$empid'
AND MONTH(AttendanceDate)='$currentMonth'
AND status='Absent'");

    $absentData  = mysqli_fetch_assoc($absentQuery);
    $totalAbsent = (int) $absentData['total_absent'];

    /* ===== SALARY ===== */

    $salaryQuery   = mysqli_query($con, "SELECT BasicSalary FROM payroll WHERE EmployeeID='$empid' ORDER BY ID DESC LIMIT 1");
    $salaryData    = mysqli_fetch_assoc($salaryQuery);
    $monthlySalary = $salaryData['BasicSalary'] ?? 0;

    $perDaySalary = ($monthlySalary > 0) ? $monthlySalary / 26 : 0;
    $finalSalary  = $perDaySalary * $totalPresent;

    /* ===== LEAVE BALANCE ===== */

    $totalLeaves = 24;

    $leaveQuery = mysqli_query($con, "SELECT COUNT(ID) as usedLeave
FROM leave_management
WHERE EmployeeID='$empid' AND Status='Approved'");

    $leaveData = mysqli_fetch_assoc($leaveQuery);
    $usedLeave = $leaveData['usedLeave'];

    $remainingLeave = $totalLeaves - $usedLeave;

    ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HRMS Dashboard</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
      .dashboard-card {
        border-radius: 12px;
        transition: 0.3s;
      }

      .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
      }

      .leave-days {
        font-weight: bold;
        color: #4e73df;
        font-size: 18px;
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

            <h1 class="h3 mb-4 text-gray-800">Human Resource Management System</h1>


            <div class="row">

<!-- ===== ROW 1 : WELCOME BOX ===== -->

<div class="col-12 mb-4">

<div class="card dashboard-card border-left-primary shadow py-3">

<div class="card-body">

<?php
    $ret = mysqli_query($con, "SELECT EmpFname,EmpLname FROM employeedetail WHERE ID='$empid'");
    $row = mysqli_fetch_array($ret);
    ?>

<h5>Welcome Back</h5>
<h4><?php echo $row['EmpFname'] . " " . $row['EmpLname']; ?></h4>

</div>

</div>

</div>


<!-- ===== ROW 2 : THREE CARDS ===== -->

<div class="col-xl-4 col-md-6 mb-4">

<div class="card dashboard-card border-left-success shadow h-100 py-2">

<div class="card-body">

<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
Present Days
</div>

<div class="h5 mb-0 font-weight-bold text-gray-800">
<?php echo $totalPresent; ?>
</div>

</div>

</div>

</div>


<div class="col-xl-4 col-md-6 mb-4">

<div class="card dashboard-card border-left-warning shadow h-100 py-2">

<div class="card-body">

<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
Remaining Leave
</div>

<div class="h5 mb-0 font-weight-bold text-gray-800">
<?php echo $remainingLeave; ?>
</div>

</div>

</div>

</div>


<div class="col-xl-4 col-md-6 mb-4">

<div class="card dashboard-card border-left-info shadow h-100 py-2">

<div class="card-body">

<div class="text-xs font-weight-bold text-info text-uppercase mb-1">
Salary Based on Attendance
</div>

<div class="h5 mb-0 font-weight-bold text-gray-800">
₹ <?php echo number_format($finalSalary, 2); ?>
</div>

</div>

</div>

</div>


<!-- ===== ROW 3 : APPLY LEAVE ===== -->

<div class="col-12 mb-4">

<div class="card shadow">

<div class="card-header">
Apply Leave
</div>

<div class="card-body">

<form method="POST">

<div class="row">

<div class="col-md-4">
<input type="date" id="from_date" name="from_date" class="form-control" required>
</div>

<div class="col-md-4">
<input type="date" id="to_date" name="to_date" class="form-control" required>
</div>

<div class="col-md-4">
<input type="text" name="reason" class="form-control" placeholder="Reason" required>
</div>

</div>

<br>

<div class="leave-days">
Total Leave Days : <span id="days">0</span>
</div>

<br>

<button type="submit" class="btn btn-primary">
Submit Leave Request
</button>

</form>

</div>

</div>

</div>

</div>

            <!-- Attendance Chart -->

            <!-- <div class="card shadow mb-4">

<div class="card-header">

Attendance Chart

</div>

<div class="card-body">

<canvas id="attendanceChart"></canvas>

</div>

</div>


</div>

</div>

</div>

</div> -->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
            <script src="js/sb-admin-2.min.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>

              /* Leave Days Calculator */

              document.getElementById("to_date").addEventListener("change", function () {

                let from = new Date(document.getElementById("from_date").value);
                let to = new Date(document.getElementById("to_date").value);

                let diff = (to - from) / (1000 * 60 * 60 * 24) + 1;

                if (diff > 0) {
                  document.getElementById("days").innerHTML = diff;
                }

              });


              /* Attendance Chart */

              // var ctx=document.getElementById('attendanceChart');

              // new Chart(ctx,{

              // type:'doughnut',

              // data:{

              // labels:['Present','Absent'],

              // datasets:[{

              // data:[<?php echo $totalPresent ?>,<?php echo $totalAbsent ?>],

              // backgroundColor:['#1cc88a','#e74a3b']

              // }]

              // },

              // });

            </script>

  </body>

  </html>

<?php }?>