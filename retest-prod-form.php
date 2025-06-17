<?php
include "config.php";

if (isset($_POST['submit'])) {
    $product_id = mysqli_real_escape_string($connect, $_POST['product_id']);
    $test_id = mysqli_real_escape_string($connect, $_POST['test_id']);
    $testing_type = mysqli_real_escape_string($connect, $_POST['testingType']);
    $test_criteria = mysqli_real_escape_string($connect, $_POST['test_criteria']);
    $observed_output = mysqli_real_escape_string($connect, $_POST['observed_output']);
    $test_by = mysqli_real_escape_string($connect, $_POST['test_by']);
    $test_result = mysqli_real_escape_string($connect, $_POST['test_result']);
    $remarks = mysqli_real_escape_string($connect, $_POST['remarks']);

    $sql = "INSERT INTO retested_products(product_id,test_id, test_type, test_criteria, observed_output, tested_by, test_result, remarks) 
            VALUES ('$product_id','$test_id', '$testing_type', '$test_criteria', '$observed_output', '$test_by', '$test_result', '$remarks');";

    $sql .= "INSERT INTO cpri_tests(product_id, test_id) VALUES ('$product_id', '$test_id')";

    if (mysqli_multi_query($connect, $sql)) {
        header("Location: cpri-test-records.php");
        exit;
    } else {
        echo "<p style='color: red; text-align:center;'>Failed to submit test. Error: " . mysqli_error($connect) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lab Automation | Retest-Product</title>
    <link rel="stylesheet" href="vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <link rel="stylesheet" href="css/map/vertical-layout-light/style.css.map">
    <link rel="shortcut icon" href="logo/favicon.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="logo/apple-touch-icon.png">
    <link rel="icon" type="logo/png" sizes="32x32" href="logo/favicon-32x32.png">
    <link rel="icon" type="logo/png" sizes="16x16" href="logo/favicon-16x16.png">
    <link rel="manifest" href="logo/site.webmanifest">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel="stylesheet">
</head>

<body>
<div class="container-scroller">
    <?php include 'components/navBar.php'; ?>

    <div class="container-fluid page-body-wrapper">
        <?php include 'components/sideBar.php'; ?>

        <div class="main-panel">
            <div class="content-wrapper" style="display: flex; justify-content: center;">
                <div class="col-md-6 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Retest Product</h3>

                            <?php
                            $prodid = $_GET['prodid'];
                            $sql1 = "SELECT product_id, test_id, test_type, test_criteria FROM tests WHERE product_id = '$prodid'";
                            $result1 = mysqli_query($connect, $sql1);
                            if ($row1 = mysqli_fetch_assoc($result1)) {
                            ?>

                            <form class="user px-1 py-3" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?prodid=' . $prodid; ?>" method="post">
                                <div class="form-group">
                                    <label for="exampleProductid">Product ID</label>
                                    <input type="text" value="<?php echo $row1['product_id']; ?>" class="form-control" id="exampleProductid" name="product_id" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleTestid">Tested ID</label>
                                    <input type="text" value="<?php echo $row1['test_id']; ?>" class="form-control" id="exampleTestid" name="test_id" required>
                                </div>

                                <div class="form-group">
                                    <label for="testingType">Testing Type</label>
                                    <select class="form-control" id="testingType" name="testingType" required>
                                        <option disabled value="">Select testing type</option>
                                        <option value="Voltage Test" <?php if ($row1['test_type'] == 'Voltage Test') echo 'selected'; ?>>Voltage Test</option>
                                        <option value="Capacity Test" <?php if ($row1['test_type'] == 'Capacity Test') echo 'selected'; ?>>Capacity Test</option>
                                        <option value="Insulation Test" <?php if ($row1['test_type'] == 'Insulation Test') echo 'selected'; ?>>Insulation Test</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleTestCriteria">Test Criteria</label>
                                    <textarea class="form-control" id="exampleTestCriteria" name="test_criteria" rows="2" required><?php echo htmlspecialchars($row1['test_criteria']); ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleObservedOutput">Observed Output</label>
                                    <textarea class="form-control" id="exampleObservedOutput" name="observed_output" rows="2" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleTestedBy">Tested By</label>
                                    <input type="text" class="form-control" id="exampleTestedBy" name="test_by" value="<?= $_SESSION["first_name"] ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleTestResult">Test Result</label>
                                    <select class="form-control" id="exampleTestResult" name="test_result" required>
                                        <option disabled value="Select testing result">Select testing result</option>
                                        <option value="Passed">Passed</option>
                                        <option value="Failed">Failed</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleRemarks">Remarks</label>
                                    <textarea class="form-control" id="exampleRemarks" name="remarks" rows="3" required></textarea>
                                </div>

                                <button type="submit" name="submit" class="btn btn-primary btn-block">Submit Test</button>
                            </form>

                            <?php } else {
                                echo "<p style='color:red;'>Invalid Product ID.</p>";
                            } ?>

                        </div>
                    </div>
                </div>
            </div>
            <?php include 'components/footer.php'; ?>
        </div>
    </div>
</div>

<!-- JS Scripts -->
<script src="js/off-canvas.js"></script>
<script src="js/hoverable-collapse.js"></script>
<script src="js/template.js"></script>
<script src="js/settings.js"></script>
<script src="js/todolist.js"></script>
<script src="vendors/progressbar.js/progressbar.min.js"></script>
<script src="vendors/chart.js/Chart.min.js"></script>
<script src="js/dashboard.js"></script>
</body>
</html>
