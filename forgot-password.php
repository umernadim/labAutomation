<?php
include 'config.php';

session_start();
if (isset($_SESSION['email'])) {
  header("Location: index.php");
}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = $_POST['email'];

    $pincode = rand(1001,9999);

    $_SESSION['pincode'] = $pincode;
    $_SESSION['forgotPasswordEmail'] = $email;

    // TODO: Validate that this email exists in your DB before proceeding

    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';            // Set the SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'itsumernadeem@gmail.com';      // Your Gmail address
        $mail->Password   = 'tbtw qkoe infs ksjh';       // App password or Gmail password (use app password if 2FA is on)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('itsumernadeem@gmail.com', 'Lab Automation');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Request';
        $mail->Body    = "Hi,<br><br> Your verification code is $pincode " . $email . "' </a><br><br>Kindly, ignore this email,If you didn't request.";

        $mail->send();
        echo "<script>alert('Reset password link has been sent to your email');</script>";
        echo "<script>window.location.href = 'verify-code.php';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lab Automation | Forgot Password</title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->
     <link rel="shortcut icon" href="logo/favicon.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="logo/apple-touch-icon.png">
  <link rel="icon" type="logo/png" sizes="32x32" href="logo/favicon-32x32.png">
  <link rel="icon" type="logo/png" sizes="16x16" href="logo/favicon-16x16.png">
  <link rel="manifest" href="logo/site.webmanifest">
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <h1 class="text-center text-primary mb-4">Forgot Password!</h1>

                            <form class="pt-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-lg"
                                        id="exampleInputEmail1" placeholder="Enter your email" required>
                                </div>
                               
                                <div class="mt-3">
                                    <input type="submit" value="Reset Password" class="btn btn-primary btn-user btn-block"
                                        name="login">
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