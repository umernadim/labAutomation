<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lab Automation | Records</title>
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

        <div class="container-fluid page-body-wrapper">

            <!-- partial -->
            <!---------- sidebar --------->
            <?php
            include 'components/sideBar.php';
            ?>
            <!-- partial -->
            <div class="main-panel">

                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                    <h3 class="text-center mb-0 font-weight-bold">Test Records</h3>
                                </div>

                            <!-- Top Bar: Search Bar and Add Product Button -->
                            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                                <!-- Search bar -->
                                <form class="form-inline w-50" method="GET" action="">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control"
                                                placeholder="Search product..." value="<?php if (isset($_GET['search'])) {
                                                    echo htmlspecialchars($_GET['search']);
                                                } ?>">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-info btn-sm" type="submit">
                                                    <i class="mdi mdi-magnify"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Table -->
                            <div class="table-responsive">
                                <?php
                                include 'config.php';
                                $search = isset($_GET['search']) ? mysqli_real_escape_string($connect, $_GET['search']) : '';

                                if (!empty($search)) {

                                    $search = mysqli_real_escape_string($connect, trim($_GET['search']));

                                    $sql = "SELECT t.id, t.test_id, t.product_id, p.product_name, t.test_type, t.tested_by, t.test_result, t.tested_at FROM tests AS t
                                    INNER JOIN products AS p
                                    ON t.product_id = p.product_id
                                    WHERE ( p.product_name LIKE '%$search%' 
                                    OR t.test_id LIKE '%$search%'
                                    OR t.product_id LIKE '%$search%'
                                    OR t.tested_at LIKE '%$search%'
                                    )
                                    ORDER BY id DESC";
                                } else {
                                    $sql = "SELECT t.id, t.test_id, t.product_id, p.product_name, t.test_type, t.tested_by, t.test_result, t.tested_at FROM tests AS t
                                    INNER JOIN products AS p
                                    ON t.product_id = p.product_id
                                    ORDER BY t.id DESC
                                ";
                                }


                                $result = mysqli_query($connect, $sql);
                                if (mysqli_num_rows($result) > 0) {

                                    ?>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Test_id</th>
                                                <th>Product_id</th>
                                                <th>Product_Name</th>
                                                <th>Test_type</th>
                                                <th>Tested_by</th>
                                                <th>Tested_at</th>
                                                <th>Test_result</th>
                                                <th>Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_assoc($result)) {

                                                ?>
                                                <tr>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td><?php echo $row['test_id']; ?></td>
                                                    <td><?php echo $row['product_id']; ?></td>
                                                    <td><?php echo $row['product_name']; ?></td>
                                                    <td><?php echo $row['test_type']; ?></td>
                                                    <td><?php echo $row['tested_by']; ?></td>
                                                    <td><?php echo $row['tested_at']; ?></td>
                                                    <td><?php echo $row['test_result']; ?></td>

                                                    <td>
                                                        <a href="record.php?prodid=<?php echo $row['id'];?> " 
                                                            style="cursor: pointer; color: #000;">
                                                            <i class="mdi mdi-open-in-new" style="color: #F2125E; font-size: 20px;"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php
                                } else {
                                    echo "<h3>No Results Found.</h3>";
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>


                <!------------ footer ------------>
              <?php include 'components/footer.php'; ?>
            </div>
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
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