<?php
include "config.php";

if (isset($_POST['submit'])) {
    $product_id = mysqli_real_escape_string($connect, $_POST['product_id']);
    $testing_type = mysqli_real_escape_string($connect, $_POST['testingType']);
    $test_criteria = mysqli_real_escape_string($connect, $_POST['test_criteria']);
    $observed_output = mysqli_real_escape_string($connect, $_POST['observed_output']);
    $test_by = mysqli_real_escape_string($connect, $_POST['test_by']);
    $test_result = mysqli_real_escape_string($connect, $_POST['test_result']);
    $remarks = mysqli_real_escape_string($connect, $_POST['remarks']);

    $sql = "INSERT INTO tests(product_id, test_type, test_criteria, observed_output, tested_by, test_result, remarks) VALUES ('{$product_id}', '{$testing_type}', '{$test_criteria}', '{$observed_output}', '{$test_by}', '{$test_result}', '{$remarks}')";

    if (mysqli_query($connect, $sql)) {
        header("Location:test-record.php");
    } else {
        echo "<p style='color: red; text-align:center;'>Failed to submit test. Error: " . mysqli_error($connect) . "</p>";

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
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Test Product</h3>

                                <?php
                                $prodid = $_GET['prodid'];
                                $sql1 = "SELECT product_id FROM products WHERE id = {$prodid}";
                                $result1 = mysqli_query($connect, $sql1);
                                if ($row1 = mysqli_fetch_assoc($result1)) {

                                    ?>

                                    <form class="user px-1 py-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                        <!-- Product ID -->
                                        <div class="form-group">
                                            <label for="exampleProductid">Product ID</label>
                                            <input type="text" value="<?php echo $row1['product_id']; ?>"
                                                class="form-control" id="exampleProductid" name="product_id"
                                                placeholder="Enter Product ID" required>
                                        </div>

                                        <!-- Test Type -->
                                        <div class="form-group">
                                            <label for="testingType">Testing Type</label>
                                            <select class="form-control" id="testingType" name="testingType" required>
                                                <option disabled selected value="">Select testing type</option>
                                                <option value="Voltage Test">Voltage Test</option>
                                                <option value="Capacity Test">Capacity Test</option>
                                                <option value="Insulation Test">Insulation Test</option>
                                            </select>
                                        </div>

                                        <!-- Test Criteria -->
                                        <div class="form-group">
                                            <label for="exampleTestCriteria">Test Criteria</label>
                                            <textarea class="form-control" id="exampleTestCriteria" name="test_criteria"
                                                rows="2" placeholder="Enter test criteria" required></textarea>
                                        </div>

                                        <!-- Observed Output -->
                                        <div class="form-group">
                                            <label for="exampleObservedOutput">Observed Output</label>
                                            <textarea class="form-control" id="exampleObservedOutput" name="observed_output"
                                                rows="2" placeholder="Enter observed output" required></textarea>
                                        </div>

                                        <!-- Tested By & Test Result (Side by Side) -->
                                        <div class="form-group">
                                            <label for="exampleTestedBy">Tested By</label>
                                            <input type="text" class="form-control" id="exampleTestedBy" name="test_by"
                                                placeholder="Tested by" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="exampleTestResult">Test Result</label>
                                            <select class="form-control" id="exampleTestResult" name="test_result" required>
                                                <option disabled selected value="">Select testing result</option>
                                                <option value="Passed">Passed</option>
                                                <option value="Failed">Failed</option>
                                            </select>
                                        </div>

                                        <!-- Remarks -->
                                        <div class="form-group">
                                            <label for="exampleRemarks">Remarks</label>
                                            <textarea class="form-control" id="exampleRemarks" name="remarks" rows="3"
                                                placeholder="Enter remarks" required></textarea>
                                        </div>

                                        <!-- Submit Button -->
                                        <button type="submit" name="submit" class="btn btn-primary btn-block">Submit
                                            Test</button>

                                    </form>
                                    <?php
                                }
                                ?>



                            </div>
                        </div>
                    </div>
                    <!------------ footer ------------>
                </div>
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