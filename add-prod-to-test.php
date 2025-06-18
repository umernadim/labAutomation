<?php
include 'config.php';

if (isset($_POST['addProduct'])) {
  $prodName = mysqli_real_escape_string($connect, $_POST['prodName']);
  $prodTypeid = mysqli_real_escape_string($connect, $_POST['prodTypeid']);
  $revsionCode = mysqli_real_escape_string($connect, $_POST['revsionCode']);
  $mfgNumber = mysqli_real_escape_string($connect, $_POST['mfgNumber']);
  $mfgDate = mysqli_real_escape_string($connect, $_POST['mfgDate']);
  $uploadedBy = mysqli_real_escape_string($connect, $_POST['uploadedBy']);

  // Check if product already exists
  $sql = "SELECT product_name FROM products WHERE product_name = '{$prodName}'";
  $result = mysqli_query($connect, $sql);

  if (mysqli_num_rows($result) == 0) {
    // Insert new product
    $sql2 = "INSERT INTO products(product_name, product_type_id, revision_code, manufacturing_number, manufactured_date, Uploaded_by) 
             VALUES ('{$prodName}','{$prodTypeid}','{$revsionCode}','{$mfgNumber}','{$mfgDate}','{$uploadedBy}')";

    if (mysqli_query($connect, $sql2)) {
      header("Location: test-products.php");
      exit();
    } else {
      echo "<p style='color:red;text-align:center;margin: 10px 0;'>Can't Insert Product for testing.</p>";
    }
  } else {
    echo "<p style='color:red;text-align:center;margin: 10px 0;'>Product already exists.</p>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Lab Automation | Register</title>
  <link rel="stylesheet" href="vendors/typicons.font/font/typicons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="logo/favicon.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="logo/apple-touch-icon.png">
  <link rel="icon" type="logo/png" sizes="32x32" href="logo/favicon-32x32.png">
  <link rel="icon" type="logo/png" sizes="16x16" href="logo/favicon-16x16.png">
  <link rel="manifest" href="logo/site.webmanifest">
</head>

<body>
  <div class="container-scroller">
    <!-------- navbar ---------->
    <?php
    include 'components/navBar.php';
    ?>
    <div class="container-fluid page-body-wrapper">
      <!---------- sidebar --------->
      <?php
      include 'components/sideBar.php';
      ?>
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-6 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <h1 class="text-center text-primary mb-4">Add Product For Testing</h1>

              <?php
              include 'config.php';

              if (isset($_GET['prodid'])) {
                $id = $_GET['prodid'];

                $sql1 = "SELECT * FROM product_types WHERE id = {$id}";
                $result1 = mysqli_query($connect, $sql1);

                if ($row1 = mysqli_fetch_assoc($result1)) {
                  ?>
              <form class="user" action="<?php echo $_SERVER['PHP_SELF'] . '?prodid=' . $id; ?>" method="post">
                <input type="hidden" name="id" value="<?php echo $row1['id']; ?>">

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" value="<?php echo $row1['type_name']; ?>"
                      name="prodName" placeholder="Product Name" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" value="<?php echo $row1['id']; ?>"
                      name="prodTypeid" placeholder="Product Type ID" required>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="revsionCode"
                      placeholder="Revision Code" maxlength="3" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="mfgNumber" maxlength="4"
                      placeholder="Manufactured Number" required>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="date" class="form-control form-control-user" name="mfgDate"
                      placeholder="Manufactured Date" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="uploadedBy"
                      placeholder="Uploaded By" value="<?= $_SESSION["first_name"] ?>" required>
                  </div>
                </div>

                <input type="submit" value="Add to Test" class="btn btn-primary btn-user btn-block" name="addProduct">
              </form>
              <?php
                } else {
                  echo "<p style='color:red;text-align:center;'>Invalid product type ID.</p>";
                }
              } else {
                echo "<p style='color:red;text-align:center;'>Product ID is missing in the URL.</p>";
              }
              ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
</body>

</html>