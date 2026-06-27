<?php
    session_start();
    include 'includes/dbconnection.php';
    if (strlen($_SESSION['aid']) == 0) {
    header('location:logout.php');
    } else {

    ?>
    <!DOCTYPE html>
    <html lang='en'>

    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <title>Welcome to Human Resource Management System</title>

        <link href='../vendor/fontawesome-free/css/all.min.css' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900' rel='stylesheet'>
        <link href='../css/sb-admin-2.min.css' rel='stylesheet'>
    </head>

    <body id='page-top'>

        <div id='wrapper'>

            <?php include_once 'includes/sidebar.php';
                ?>

            <div id='content-wrapper' class='d-flex flex-column'>
                <div id='content'>

                    <?php include_once 'includes/header.php';
                        ?>

                    <div class='container-fluid'>

                        <h1 class='h3 mb-4 text-gray-800'>Human Resource Management System</h1>

                        <?php
                            $adminid = $_SESSION['aid'];
                                $ret     = mysqli_query($con, "SELECT AdminName FROM tbladmin WHERE ID='$adminid'");
                                $row     = mysqli_fetch_array($ret);

                                $name = $row['AdminName'];

                                $emp   = mysqli_num_rows(mysqli_query($con, 'SELECT ID FROM employeedetail'));
                                $dept  = mysqli_num_rows(mysqli_query($con, 'SELECT ID FROM departments'));
                                $att   = mysqli_num_rows(mysqli_query($con, 'SELECT ID FROM attendance'));
                                $pay   = mysqli_num_rows(mysqli_query($con, 'SELECT ID FROM payroll'));
                                $leave = mysqli_num_rows(mysqli_query($con, 'SELECT ID FROM leave_management'));
                            ?>

                        <div class='row'>

                            <!-- Welcome -->
                            <div class='col-xl-4 col-md-6 mb-4'>
                                <div class='card border-left-primary shadow h-100 py-2'>
                                    <div class='card-body'>
                                        <div class='text-xs font-weight-bold text-primary text-uppercase mb-1'>Welcome Back
                                        </div>
                                        <div class='h5 font-weight-bold text-gray-800'><?php echo $name;
                                                                                           ?></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Employees -->
                            <div class='col-xl-4 col-md-6 mb-4'>
                                <div class='card border-left-success shadow h-100 py-2'>
                                    <div class='card-body'>
                                        <div class='text-xs font-weight-bold text-success text-uppercase mb-1'>Total
                                            Employees</div>
                                        <div class='h5 font-weight-bold text-gray-800'><?php echo $emp;
                                                                                           ?></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Departments -->
                            <div class='col-xl-4 col-md-6 mb-4'>
                                <div class='card border-left-info shadow h-100 py-2'>
                                    <div class='card-body'>
                                        <div class='text-xs font-weight-bold text-info text-uppercase mb-1'>Total
                                            Departments</div>
                                        <div class='h5 font-weight-bold text-gray-800'><?php echo $dept;
                                                                                           ?></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Attendance -->
                            <div class='col-xl-4 col-md-6 mb-4'>
                                <div class='card border-left-warning shadow h-100 py-2'>
                                    <div class='card-body'>
                                        <div class='text-xs font-weight-bold text-warning text-uppercase mb-1'>Attendance
                                            Records</div>
                                        <div class='h5 font-weight-bold text-gray-800'><?php echo $att;
                                                                                           ?></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payroll -->
                            <div class='col-xl-4 col-md-6 mb-4'>
                                <div class='card border-left-danger shadow h-100 py-2'>
                                    <div class='card-body'>
                                        <div class='text-xs font-weight-bold text-danger text-uppercase mb-1'>Payroll
                                            Records</div>
                                        <div class='h5 font-weight-bold text-gray-800'><?php echo $pay;
                                                                                           ?></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Leave -->
                            <div class='col-xl-4 col-md-6 mb-4'>
                                <div class='card border-left-secondary shadow h-100 py-2'>
                                    <div class='card-body'>
                                        <div class='text-xs font-weight-bold text-secondary text-uppercase mb-1'>Leave
                                            Requests</div>
                                        <div class='h5 font-weight-bold text-gray-800'><?php echo $leave;
                                                                                           ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class='card shadow mb-4'>
                                <div class='card-header py-3'>
                                    <h6 class='m-0 font-weight-bold text-danger'>All Employee Payroll</h6>
                                </div>
                                <div class='card-body'>
                                    <table class='table table-bordered'>
                                        <tr><th>Sr No.</th>
                                            <th>Name</th>
                                            <th>Basic_Salary</th>
                                            <th>Present_days</th>
                                            <th>Calculated_Salary</th>
                                        </tr>
                                        <?php
                                            $sql = "SELECT
    e.ID,
    e.EmpFname,
    e.EmpLname,
    s.BasicSalary,
    COUNT(a.ID) AS present_days,
    (s.BasicSalary / 26) * COUNT(a.ID) AS calculated_salary
FROM employeedetail e

LEFT JOIN attendance a
    ON e.ID = a.EmployeeID
    AND a.Status = 'Present'
    AND DATE_FORMAT(a.AttendanceDate,'%Y-%m') = DATE_FORMAT(CURDATE(),'%Y-%m')

LEFT JOIN payroll s
    ON e.ID = s.EmployeeID

GROUP BY e.ID, e.EmpFname, e.EmpLname, s.BasicSalary";
                                                $result = mysqli_query($con, $sql);
                                                $sr     = 0;
                                                while ($user = mysqli_fetch_assoc($result)) {
                                                ?>
                                            <tr>
                                                <td><?php echo $sr = $sr + 1; ?></td>
                                                <td><?php echo $user['EmpFname'] . ' ' . $user['EmpLname']; ?></td>
                                                <td><?php echo $user['BasicSalary']; ?></td>
                                                <td><?php echo $user['present_days']; ?></td>
                                                <td><?php echo $user['calculated_salary']; ?></td>
                                            </tr>
                                        <?php }
                                            ?>

                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <?php include_once 'includes/footer.php';
                    ?>

            </div>
        </div>

        <a class='scroll-to-top rounded' href='#page-top'>
            <i class='fas fa-angle-up'></i>
        </a>

        <script src='../vendor/jquery/jquery.min.js'></script>
        <script src='../vendor/bootstrap/js/bootstrap.bundle.min.js'></script>
        <script src='../vendor/jquery-easing/jquery.easing.min.js'></script>
        <script src='../js/sb-admin-2.min.js'></script>

    </body>

    </html>
<?php }
?>