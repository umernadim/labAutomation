<?php 

session_start();
if (isset($_SESSION['email'])) {
  header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Lab Automation | Login</title>
  <!-- base:css -->
  <link rel="stylesheet" href="vendors/typicons.font/font/typicons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
 <link rel="shortcut icon" href="logo/favicon.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="logo/apple-touch-icon.png">
  <link rel="icon" type="logo/png" sizes="32x32" href="logo/favicon-32x32.png">
  <link rel="icon" type="logo/png" sizes="16x16" href="logo/favicon-16x16.png">
  <link rel="manifest" href="logo/site.webmanifest"></head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <h2 class="mb-2">Lab Automation</h2>
              <h5 class="font-weight-light">Sign in to continue.</h5>
              <form class="pt-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1"
                    placeholder="Email" required>
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1"
                    placeholder="Password" required>
                </div>
                <div class="mt-3">
                      <input type="submit" value="Sign in" class="btn btn-primary btn-user btn-block" name="login">
                </div>
                <div class="mt-4 text-center">
                  
                  <a href="forgot-password.php" class="auth-link text-black">Forgot password?</a>
                </div>

                <div class="text-center mt-2 font-weight-light">
                  Don't have an account? <a href="register.php" class="text-primary">Create</a>
                </div>
              </form>

              <?php
                          if(isset($_POST['login'])){
                            include "config.php";
                            if(empty($_POST['email']) || empty($_POST['password'])){
                              echo '<div class="alert alert-danger">All Fields must be entered.</div>';
                              die();
                            }else{
                              $email = mysqli_real_escape_string($connect, $_POST['email']);
                              $password = md5($_POST['password']);

                              $sql = "SELECT user_id, first_name, email, role FROM register WHERE email = '{$email}' AND password= '{$password}'";

                              $result = mysqli_query($connect, $sql) or die("Query Failed.");

                              if(mysqli_num_rows($result) > 0){

                                while($row = mysqli_fetch_assoc($result)){
                                  session_start();
                                  $_SESSION["first_name"] = $row['first_name'];
                                  $_SESSION["email"] = $row['email'];
                                  $_SESSION["user_id"] = $row['user_id'];
                                  $_SESSION["role"] = $row['role'];

                                  header("Location:index.php");
                                }

                              }else{
                              echo '<div class="alert alert-danger">Email and Password is not matched.</div>';
                            }
                          }
                          }
                        ?>
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