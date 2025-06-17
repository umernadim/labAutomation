<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lab Automation | CPRI Products</title>
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
        <?php include 'components/navBar.php'; ?>

        <div class="container-fluid page-body-wrapper">
            <?php include 'components/sideBar.php'; ?>

            <div class="main-panel">
                <div class="content-wrapper" style="display: flex; justify-content: center;">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <h3 class="text-center mb-0 font-weight-bold">CPRI Test</h3>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
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

                                <div class="table-responsive">
                                    <?php
                                    include 'config.php';
                                    $search = isset($_GET['search']) ? mysqli_real_escape_string($connect, $_GET['search']) : '';
                                    if (!empty($search)) {
                                        $sql = "SELECT * FROM cpri_tests WHERE product_id LIKE '%$search%' OR test_id LIKE '%$search%' ORDER BY id DESC";
                                    } else {
                                        $sql = "SELECT * FROM cpri_tests ORDER BY id DESC";
                                    }


                                    $result = mysqli_query($connect, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        ?>

                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Product_ID</th>
                                                    <th>Test_ID</th>
                                                    <th>Sent_at</th>
                                                    <th>Result</th>
                                                    <th>Test</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                        <td><?php echo $row['id']; ?></td>
                                                        <td><?php echo $row['product_id']; ?></td>
                                                        <td><?php echo $row['test_id']; ?></td>
                                                        <td><?php echo $row['sent_at']; ?></td>
                                                        <td><?php echo $row['approved']; ?></td>
                                                       
                                                         <td>
                                                            <a href="cpri-test-form.php?prodid=<?php echo $row['id']; ?>"
                                                                style="cursor: pointer; color: #000;">
                                                                <i class="mdi mdi-test-tube mdi-20px" style="color: #F2125E;"></i>
                                                                Test
                                                            </a>
                                                        </td>


                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                    <?php } else {
                                        echo "<h3>No Results Found.</h3>";
                                    } ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <?php include 'components/footer.php'; ?>
            </div>
        </div>
    </div>

    <!-- base:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <script src="vendors/progressbar.js/progressbar.min.js"></script>
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="js/dashboard.js"></script>
    <script>
        function handleDelete(productCount) {
            if (productCount > 0) {
                alert("⚠️ This product type is in use with the Products table. Please delete related products first.");
                return false;
            }
            return confirm("Are you sure you want to delete this product type?");
        }
    </script>

</body>

</html>