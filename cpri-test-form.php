<?php
include "config.php";

if (isset($_POST['submit'])) {
    $cpri_test_id = mysqli_real_escape_string($connect, $_POST['cpri_test_id']);
    $test_date = mysqli_real_escape_string($connect, $_POST['test_date']);
    $result = mysqli_real_escape_string($connect, $_POST['result']);
    $remarks = mysqli_real_escape_string($connect, $_POST['remarks']);

    $sql = "INSERT INTO cpri_test_results(cpri_test_id, test_date, status, remarks) VALUES ('{$cpri_test_id}', '{$test_date}', '{$result}', '{$remarks}')";

    if (mysqli_query($connect, $sql)) {

        if($result == 'Passed')
        {
            $updateCPRITableQuery = "UPDATE `cpri_tests` SET `approved`='Approved' WHERE `id`= '$cpri_test_id'";

            mysqli_query($connect,$updateCPRITableQuery);
        }


        header("Location:cpri-test-records.php");
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
                                $sql1 = "SELECT id FROM cpri_tests WHERE id = {$prodid}";
                                $result1 = mysqli_query($connect, $sql1);
                                if ($row1 = mysqli_fetch_assoc($result1)) {

                                    ?>

                                    <form class="user px-1 py-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                        <!-- Product ID -->
                                        <div class="form-group">
                                            <label for="exampleProductid">CPRI Test ID</label>
                                            <input type="text" value="<?php echo $row1['id']; ?>"
                                                class="form-control" id="exampleProductid" name="cpri_test_id"
                                                placeholder="Enter Product ID" required>
                                        </div>

                                        <!-- Tested By & Test Result (Side by Side) -->
                                        <div class="form-group">
                                            <label for="exampleTestedBy">Tested Date</label>
                                            <input type="date" class="form-control" id="exampleTestedBy" name="test_date"
                                                placeholder="Tested by" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="exampleTestResult">Test Result</label>
                                            <select class="form-control" id="exampleTestResult" name="result" required>
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