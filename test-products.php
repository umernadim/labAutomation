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
                                <h3 class="text-center mb-0 font-weight-bold">Test Products</h3>
                            </div>

                            <!-- Top Bar: Search Bar -->
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

                                    $sql = "SELECT p.id, p.product_id, p.product_name, pt.code, p.revision_code, p.manufacturing_number, p.manufactured_date, p.Uploaded_by FROM products p INNER JOIN product_types pt ON p.product_type_id = pt.id 
                                        WHERE (p.product_name LIKE '%$search%' 
                                        OR p.product_id LIKE '%$search%' 
                                        OR p.manufactured_date LIKE '%$search%'
                                        )
                                        ORDER BY id DESC";
                                } else {
                                    $sql = "SELECT p.id, p.product_id, p.product_name, pt.code, p.revision_code, p.manufacturing_number, p.manufactured_date, p.Uploaded_by FROM products p INNER JOIN product_types pt ON p.product_type_id = pt.id ORDER BY p.id DESC";
                                }

                                $result = mysqli_query($connect, $sql);
                                if (mysqli_num_rows($result) > 0) {

                                    ?>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Prod_id</th>
                                                <th>Prod_name</th>
                                                <th>Prod_Code</th>
                                                <th>Revg_Code</th>
                                                <th>Mfg_No.</th>
                                                <th>Mfg_Date</th>
                                                <th>Uploaded_By</th>
                                                <th>Test</th>
                                                <th>Delete</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_assoc($result)) {

                                                ?>
                                                <tr>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td><?php echo $row['product_id']; ?></td>
                                                    <td><?php echo $row['product_name']; ?></td>
                                                    <td><?php echo $row['code']; ?></td>
                                                    <td><?php echo $row['revision_code']; ?></td>
                                                    <td><?php echo $row['manufacturing_number']; ?></td>
                                                    <td><?php echo $row['manufactured_date']; ?></td>
                                                    <td><?php echo $row['Uploaded_by']; ?></td>
                                                    <td>
                                                        <a href="test-product-form.php?prodid=<?php echo $row['id']; ?>"
                                                            style="cursor: pointer;color: #000;">
                                                            <i class="mdi mdi-test-tube mdi-20px" style="color: #F2125E;"></i>
                                                            Test
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);"
                                                            onclick="confirmDelete(<?php echo $row['id']; ?>)"
                                                            style="cursor: pointer; color: #000;">
                                                            <i class="mdi mdi-delete mdi-20px" style="color: #F2125E;"></i>
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
                <!-- <?php
                include 'components/footer.php';
                ?> -->
            </div>
        </div>

        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
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
    <script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this product? This will also delete associated test data.")) {
            window.location.href = "delete-product.php?prodid=" + id;
        }
    }
</script>

</body>

</html>