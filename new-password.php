<?php
include 'config.php';

session_start();
if (isset($_SESSION['email'])) {
    header("Location: index.php");
}

$forgotPasswordEmail = $_SESSION['forgotPasswordEmail'];

if (!isset($_SESSION['forgotPasswordEmail'])) {
    header('location:forgot-password.php');
}


if (isset($_POST['updatePasswordBtn'])) {

    $password = $_POST['password'];



    $hash_password = md5($_POST['password']);


    $insert = "UPDATE `register` SET `password`='$hash_password' WHERE `email`='$forgotPasswordEmail'";



    if (mysqli_query($connect, $insert)) {
        // echo "<div class='alert alert-danger text-center'>Password Updated Successfully. $password</div>";
        header('location:login.php');


    } else {
        echo "<div class='alert alert-danger text-center'>Password Updation failed.</div>";
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lab Automation | New Password</title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <h1 class="text-center text-primary mb-4">New Password!</h1>

                            <form class="pt-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">


                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg"
                                        id="exampleInputPassword" placeholder="Enter new password" required>
                                </div>

                                <div class="mt-3">
                                    <input type="submit" value="Reset Password"
                                        class="btn btn-primary btn-user btn-block" name="updatePasswordBtn">
                                </div>
                                <div class="mt-4 text-center font-weight-light">
                                    Already Have an account?
                                    <a href="login.php" class="auth-link text-primary">login!</a>
                                </div>

                                <div class="text-center mt-2 font-weight-light">
                                    Don't have an account? <a href="register.php" class="text-primary">Create</a>
                                </div>
                            </form>




                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
</body>

</html>