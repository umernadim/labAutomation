<?php
include 'config.php';

session_start();
if (isset($_SESSION['email'])) {
  header("Location: index.php");
}

if (isset($_POST['submit'])) {
  $fname = mysqli_real_escape_string($connect, $_POST['first_name']);
  $lname = mysqli_real_escape_string($connect, $_POST['last_name']);
  $email = mysqli_real_escape_string($connect, $_POST['email']);
  $password = mysqli_real_escape_string($connect, md5($_POST['password']));
  $role = mysqli_real_escape_string($connect, $_POST['role']);

  $check = "SELECT email FROM register WHERE email = '{$email}'";
  $res = mysqli_query($connect, $check);

  if (mysqli_num_rows($res) > 0) {
    echo "<div class='alert alert-danger text-center'>Email already exists.</div>";
  } else {
    $insert = "INSERT INTO register (first_name, last_name, email, password, role)
               VALUES ('{$fname}', '{$lname}', '{$email}', '{$password}', '{$role}')";
    if (mysqli_query($connect, $insert)) {
      header("Location: login.php");
      exit;
    } else {
      echo "<div class='alert alert-danger text-center'>Registration failed.</div>";
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Lab Automation | Register</title>
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
          <div class="col-lg-5 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <h1 class="text-center text-primary mb-4">Create an Account!</h1>

              <form class="user" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="exampleFirstName" name="first_name"
                      placeholder="First Name" Required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="exampleLastName" name="last_name"
                      placeholder="Last Name" Required>
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email"
                    placeholder="Email Address" Required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" id="exampleInputPassword"
                    name="password" placeholder="Password" Required>
                </div>

                <div class="form-group">
                  <select class="form-control form-control-lg" name="role" id="exampleFormControlSelect2" Required>
                    <option disabled selected>Select user</option>
                    <option value="Admin">Admin</option>
                    <option value="Tester">Tester</option>
                    <option value="Normal User">Normal User</option>
                  </select>
                </div>

                <input type="submit" value="Register Account" class="btn btn-primary btn-user btn-block" name="submit">
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="login.php" class="text-primary">Login</a>
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