<?php
    include 'includes/dbconnection.php';
    error_reporting(0);

    $msg = "";

    if (isset($_POST['submit'])) {

    $FName    = mysqli_real_escape_string($con, $_POST['FirstName']);
    $LName    = mysqli_real_escape_string($con, $_POST['LastName']);
    $empcode  = mysqli_real_escape_string($con, $_POST['empcode']);
    $Email    = mysqli_real_escape_string($con, $_POST['Email']);
    $Password = mysqli_real_escape_string($con, $_POST['Password']);

    // CHECK EMAIL EXISTS

    $ret = mysqli_query($con,
        "SELECT EmpEmail FROM employeedetail
         WHERE EmpEmail='$Email'"
    );

    $count = mysqli_num_rows($ret);

    if ($count > 0) {

        $msg = "This email is already registered.";

    } else {

        $query = mysqli_query($con,
            "INSERT INTO employeedetail
            (EmpFname, EmpLName, EmpCode, EmpEmail, EmpPassword)
            VALUES
            ('$FName','$LName','$empcode','$Email','$Password')"
        );

        if ($query) {

            $msg = "You have successfully registered.";

        } else {

            $msg = "Something went wrong. Please try again.";
        }
    }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HRMS Register</title>

    <!-- Bootstrap -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>

        body{
            background: linear-gradient(135deg, #2952cc, #5c7cfa);
            min-height: 100vh;
        }

        .register-card{
            border-radius: 15px;
            overflow: hidden;
        }

        .register-image img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .register-form{
            padding: 40px;
        }

        .form-control-user{
            height: 50px;
            border-radius: 30px;
            padding-left: 20px;
        }

        .btn-user{
            border-radius: 30px;
            padding: 12px;
            font-size: 16px;
        }

        @media(max-width:768px){

            .register-form{
                padding: 25px;
            }

        }

    </style>

    <script>

        function checkpass() {

            var password = document.getElementById("Password").value;
            var repeatPassword = document.getElementById("RepeatPassword").value;

            if(password != repeatPassword){

                alert("Password and Confirm Password do not match.");
                return false;
            }

            return true;
        }

    </script>

</head>

<body>

<?php include 'navbar.php'; ?>

<div class="container">

    <h2 class="text-center text-white pt-4 font-weight-bold">
        Human Resource Management System
    </h2>

    <div class="row justify-content-center">

        <div class="col-xl-11 col-lg-12 col-md-10">

            <div class="card register-card shadow-lg border-0 my-5">

                <div class="row no-gutters">

                    <!-- Left Image -->
                    <div class="col-lg-5 d-none d-lg-block register-image">

                        <img src="img/login_reg_admin.jpg" alt="Register Image">

                    </div>

                    <!-- Right Form -->
                    <div class="col-lg-7 bg-white">

                        <div class="register-form">

                            <div class="text-center mb-4">

                                <h1 class="h3 text-gray-900">
                                    Create an Account!
                                </h1>

                            </div>

                            <!-- Message -->
                            <?php if ($msg) {?>

                                <div class="alert alert-info text-center">
                                    <?php echo $msg; ?>
                                </div>

                            <?php }?>

                            <form class="user"
                                  name="register"
                                  method="post"
                                  onsubmit="return checkpass();">

                                <!-- Name -->
                                <div class="form-group row">

                                    <div class="col-sm-6 mb-3">

                                        <input type="text"
                                               class="form-control form-control-user"
                                               name="FirstName"
                                               placeholder="First Name"
                                               pattern="[A-Za-z]+"
                                               required>

                                    </div>

                                    <div class="col-sm-6">

                                        <input type="text"
                                               class="form-control form-control-user"
                                               name="LastName"
                                               placeholder="Last Name"
                                               pattern="[A-Za-z]+"
                                               required>

                                    </div>

                                </div>

                                <!-- Employee Code -->
                                <div class="form-group">

                                    <input type="text"
                                           class="form-control form-control-user"
                                           name="empcode"
                                           placeholder="Enter your Employee Code"
                                           pattern="[0-9]+"
                                           required>

                                </div>

                                <!-- Email -->
                                <div class="form-group">

                                    <input type="email"
                                           class="form-control form-control-user"
                                           name="Email"
                                           placeholder="Email Address"
                                           required>

                                </div>

                                <!-- Password -->
                                <div class="form-group row">

                                    <div class="col-sm-6 mb-3">

                                        <input type="password"
                                               class="form-control form-control-user"
                                               id="Password"
                                               name="Password"
                                               placeholder="Password"
                                               required>

                                    </div>

                                    <div class="col-sm-6">

                                        <input type="password"
                                               class="form-control form-control-user"
                                               id="RepeatPassword"
                                               name="RepeatPassword"
                                               placeholder="Repeat Password"
                                               required>

                                    </div>

                                </div>

                                <!-- Button -->
                                <button type="submit"
                                        name="submit"
                                        class="btn btn-primary btn-user btn-block">

                                    Register Account

                                </button>

                            </form>

                            <hr>

                            <div class="text-center">

                                <a class="small" href="loginerms.php">

                                    Already have an account? Login!

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- JS -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>

</body>
</html>