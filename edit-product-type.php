<?php

if (isset($_POST['save'])) {
    include 'config.php';
    $id = mysqli_real_escape_string($connect, $_POST['id']);
    $type_name = mysqli_real_escape_string($connect, $_POST['prodName']);
    $code = mysqli_real_escape_string($connect, $_POST['prodCode']);

    $sql = "UPDATE product_types SET type_name='{$type_name}', code='{$code}' WHERE id = {$id}";

    if (mysqli_query($connect, $sql)) {
        header("Location:product-type.php");
        exit();
    } else {
        echo "<p style='color:red;'>Update failed: " . mysqli_error($connect) . "</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lab Automation | Product</title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">

    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <link rel="stylesheet" href="css/map/vertical-layout-light/style.css.map">
    <!-- endinject -->

    <link rel="shortcut icon" href="logo/favicon.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="logo/apple-touch-icon.png">
    <link rel="icon" type="logo/png" sizes="32x32" href="logo/favicon-32x32.png">
    <link rel="icon" type="logo/png" sizes="16x16" href="logo/favicon-16x16.png">
    <link rel="manifest" href="logo/site.webmanifest">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel="stylesheet">

</head>

<body>

    <div class="container-scroller">
        <!-------- navbar ---------->
        <?php

        include 'components/navBar.php';

        ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">

            <!---------- sidebar --------->
            <?php
            include 'components/sideBar.php';
            ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper" style="display: flex; justify-content: center;">
                    <div class="col-md-6 grid-margin ">
                        <div class="card mt-5">
                            <div class="card-body">
                                <h3 class="card-title">Update Product Type</h3>
                                <?php
                                include 'config.php';
                                $id = $_GET['prodid'];
                                $sql1 = "SELECT * FROM product_types WHERE id = {$id}";
                                $result1 = mysqli_query($connect, $sql1);
                                if ($row1 = mysqli_fetch_assoc($result1)) {
                                    ?>

                                    <form class="forms-sample" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="Post">
                                        <div class="form-group">
                                            <input type="hidden" name="id" value="<?php echo $row1['id']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputProdName">Product Name</label>
                                            <input type="text" name="prodName" class="form-control"
                                                id="exampleInputProdName" placeholder="Enter Product name"
                                                value="<?php echo $row1['type_name']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputProdCode">Product Code</label>
                                            <input type="text" name="prodCode" class="form-control"
                                                id="exampleInputProdCode" placeholder="Enter product code"
                                                value="<?php echo $row1['code']; ?>">
                                        </div>

                                        <button type="submit" name="save" class="btn btn-primary mr-2">Submit</button>

                                    </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!------------ footer ------------>
                <?php
                include 'components/footer.php';
                ?>
            </div>
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="vendors/progressbar.js/progressbar.min.js"></script>
    <script src="vendors/chart.js/Chart.min.js"></script>

    <script src="js/dashboard.js"></script>
    <!-- End custom js for this page-->
</body>

</html>