<?php
    session_start();
    error_reporting(0);
    include 'includes/dbconnection.php';

    $msg = "";

    if (isset($_POST['login'])) {

    $Email    = mysqli_real_escape_string($con, $_POST['Email']);
    $Password = mysqli_real_escape_string($con, $_POST['Password']);

    $query = mysqli_query($con, "SELECT ID, EmpFname, EmpLname
                                 FROM employeedetail
                                 WHERE EmpEmail='$Email'
                                 AND EmpPassword='$Password'");

    $ret = mysqli_fetch_array($query);

    if ($ret) {

        $_SESSION['uid']      = $ret['ID'];
        $_SESSION['EmpFname'] = $ret['EmpFname'];
        $_SESSION['EmpLname'] = $ret['EmpLname'];

        header('location:welcome.php');
        exit();

    } else {
        $msg = "Invalid Email or Password!";
    }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HRMS Employee Login</title>

    <!-- Bootstrap -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>

        body{
            background: linear-gradient(135deg, #2952cc, #5c7cfa);
            min-height: 100vh;
        }

        .login-card{
            border-radius: 15px;
            overflow: hidden;
        }

        .login-image img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .login-form{
            padding: 50px;
        }

        .form-control-user{
            height: 50px;
            border-radius: 30px;
        }

        .btn-user{
            border-radius: 30px;
            padding: 12px;
            font-size: 16px;
        }

        @media(max-width: 768px){

            .login-form{
                padding: 30px;
            }

        }

    </style>

</head>

<body>

<?php include 'navbar.php'; ?>

<div class="container">

    <h2 class="text-center text-white pt-4 font-weight-bold">
        Human Resource Management System
    </h2>

    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-10">

            <div class="card login-card shadow-lg border-0 my-5">

                <div class="row no-gutters">

                    <!-- Left Image -->
                    <div class="col-lg-6 d-none d-lg-block login-image">
                        <img src="img/login_reg_admin.jpg" alt="Login Image">
                    </div>

                    <!-- Right Form -->
                    <div class="col-lg-6 bg-white">

                        <div class="login-form">

                            <div class="text-center mb-4">
                                <h1 class="h3 text-gray-900">
                                    Welcome Back!
                                </h1>
                            </div>

                            <!-- Error Message -->
                            <?php if ($msg) {?>

                                <div class="alert alert-danger text-center">
                                    <?php echo $msg; ?>
                                </div>

                            <?php }?>

                            <form method="post">

                                <div class="form-group">
                                    <input type="email"
                                           class="form-control form-control-user"
                                           name="Email"
                                           placeholder="Enter Email Address..."
                                           required>
                                </div>

                                <div class="form-group">
                                    <input type="password"
                                           class="form-control form-control-user"
                                           name="Password"
                                           placeholder="Password"
                                           required>
                                </div>

                                <button type="submit"
                                        name="login"
                                        class="btn btn-primary btn-user btn-block">

                                    Login

                                </button>

                            </form>

                            <hr>

                            <div class="text-center">
                                <a class="small" href="forgetpassword.php">
                                    Forgot Password?
                                </a>
                            </div>

                            <div class="text-center">
                                <a class="small" href="registererms.php">
                                    Create an Account!
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