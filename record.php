<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lab Automation | Records</title>

    <!-- base:css -->
    <link rel="stylesheet" href="vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="logo/favicon.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="logo/apple-touch-icon.png">
    <link rel="icon" type="logo/png" sizes="32x32" href="logo/favicon-32x32.png">
    <link rel="icon" type="logo/png" sizes="16x16" href="logo/favicon-16x16.png">
    <link rel="manifest" href="logo/site.webmanifest">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>

</head>

<body>
    <div class="container-scroller">

        <!-- navbar -->
        <?php include 'components/navBar.php'; ?>

        <div class="container-fluid page-body-wrapper">

            <!-- sidebar -->
            <?php include 'components/sideBar.php'; ?>

            <div class="main-panel">
                <div class="content-wrapper" style="display: flex; justify-content: center;">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card" id="htmlContent">
                                <div class="card-header bg-info text-white">
                                    <h3 class="text-center mb-0 font-weight-bold">Product Report</h3>
                                </div>

                                <?php
                                include "config.php";
                                $id = $_GET['prodid'];
                                $sql = "SELECT 
                                            p.product_name, 
                                            p.product_id, 
                                            p.manufactured_date, 
                                            t.test_id, 
                                            t.test_type, 
                                            t.test_criteria, 
                                            t.observed_output, 
                                            t.test_result, 
                                            t.remarks, 
                                            t.tested_by, 
                                            t.tested_at, 
                                            p.Uploaded_by 
                                        FROM products p 
                                        INNER JOIN tests t ON p.product_id = t.product_id 
                                        WHERE t.id = {$id}";

                                $result = mysqli_query($connect, $sql);

                                if ($row = mysqli_fetch_assoc($result)) {
                                    ?>

                                    <div class="card-body">
                                        <div class="row">
                                            
                                            <div class="col-md-6">
                                                <h5 class="font-weight-bold">Product ID:</h5>
                                                <p><?= $row['product_id'] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="font-weight-bold">Product Testing ID:</h5>
                                                <p><?= $row['test_id'] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="font-weight-bold">Product Name:</h5>
                                                <p><?= $row['product_name'] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="font-weight-bold">Mfg At:</h5>
                                                <p><?= $row['manufactured_date'] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="font-weight-bold">Uploaded By:</h5>
                                                <p><?= $row['Uploaded_by'] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="font-weight-bold">Tested By:</h5>
                                                <p><?= $row['tested_by'] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="font-weight-bold">Testing Type:</h5>
                                                <p><?= $row['test_type'] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="font-weight-bold">Tested At:</h5>
                                                <p><?= $row['tested_at'] ?></p>
                                            </div>

                                            <div class="col-md-6">
                                                <h5 class="font-weight-bold">Test Criteria:</h5>
                                                <p><?= $row['test_criteria'] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="font-weight-bold">Observed Putput:</h5>
                                                <p><?= $row['observed_output'] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="font-weight-bold">Remarks:</h5>
                                                <p><?= $row['remarks'] ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="font-weight-bold">Test Result:</h5>
                                                <p><?= $row['test_result'] ?></p>
                                            </div>
                                            <div class="col-md-12 mt-4">
                                                <button class="btn btn-info no-print" id="generatePDF">
                                                    <i class="mdi mdi-download"></i> Download Report
                                                </button>

                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer -->
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

    <!-- plugins -->
    <script src="vendors/progressbar.js/progressbar.min.js"></script>
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="js/dashboard.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const button = document.getElementById('generatePDF');
            const element = document.getElementById('htmlContent');

            button.addEventListener('click', function () {
                // Temporarily hide the button
                button.style.display = 'none';

                const opt = {
                    margin: 0.5,
                    filename: 'record.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
                };

                html2pdf().set(opt).from(element).save().then(() => {
                    // Show the button back after download
                    button.style.display = 'inline-block';
                });
            });
        });
    </script>




</body>

</html>