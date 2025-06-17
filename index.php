<?php
include './config.php';

// Fetch product/test stats
$total_products = 0;
$test_products = 0;
$passed_products = 0;
$failed_products = 0;

$result1 = mysqli_query($connect, "SELECT COUNT(*) AS total_products FROM products");
if ($row = mysqli_fetch_assoc($result1))
  $total_products = $row['total_products'];

$result2 = mysqli_query($connect, "SELECT COUNT(*) AS test_products FROM tests");
if ($row = mysqli_fetch_assoc($result2))
  $test_products = $row['test_products'];

$result3 = mysqli_query($connect, "SELECT COUNT(*) AS passed_products FROM tests WHERE test_result = 'passed'");
if ($row = mysqli_fetch_assoc($result3))
  $passed_products = $row['passed_products'];

$result4 = mysqli_query($connect, "SELECT COUNT(*) AS failed_products FROM tests WHERE test_result = 'failed'");
if ($row = mysqli_fetch_assoc($result4))
  $failed_products = $row['failed_products'];

// Calculate suggested Y-axis max
$max_value = max($total_products, $test_products, $passed_products, $failed_products);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Lab Automation</title>
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
    :root {
      --color-primary: #000000;
      --color-label: #a7a7a7;
      --color-default: #e2dede;
      --font-family: "Nota Sans";
    }

    .card-container h2,
    .card-container h3 {
      font-weight: 400;
      margin: 0;
    }

    .card-container h2 {
      font-size: 22px;
      margin: 0 0 1px;
    }

    .card-container h3 {
      font-size: 12px;
      color: var(--color-label);
      margin-bottom: 10px;
    }

    .card-container {
      background: #ffffff;
      width: 100%;
      padding: 30px;
      box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
    }

    body .apexcharts-tooltip.apexcharts-theme-light {
      color: var(--color-text);
      background: #ffffff;
      box-shadow: none;
      border: 1px solid #e7e7e7;
      /* border: 0; */
      padding: 8px;
      /* opacity: 1 !important; */
    }

    body .apexcharts-tooltip.apexcharts-theme-light .apexcharts-tooltip-title {
      display: none;
    }

    body .apexcharts-xaxistooltip.apexcharts-xaxistooltip-bottom.apexcharts-theme-light {
      display: none;
    }
  </style>

</head>

<body>
  <div class="container-scroller">
    <?php include 'components/navBar.php'; ?>
    <div class="container-fluid page-body-wrapper">
      <?php include 'components/sideBar.php'; ?>
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row mt-3">

            <!-- Total Products -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Products</div>
                      <div class="h4 mb-0 font-weight-bold text-gray-800"><?= $total_products ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="mdi mdi-briefcase-check mdi-36px" style="color:#ffd67f"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tested Products -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Tested Products</div>
                      <div class="h4 mb-0 font-weight-bold text-gray-800"><?= $test_products ?></div>
                    </div>
                    <div class="col-auto" style="border:2.5px solid rgb(33, 194, 218); border-radius: 50%;">
                      <i class="mdi mdi-test-tube mdi-36px" style="color: rgb(33, 194, 218);"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Passed Products -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pass</div>
                      <div class="h4 mb-0 font-weight-bold text-gray-800"><?= $passed_products ?></div>
                    </div>
                    <div style="background-color: #22c55e; border-radius: 50%;">
                      <i class="mdi mdi-check-circle mdi-36px text-white"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Failed Products -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Fail</div>
                      <div class="h4 mb-0 font-weight-bold text-gray-800"><?= $failed_products ?></div>
                    </div>
                    <div class="col-auto" style="background-color: red; border-radius: 50%;">
                      <i class="mdi mdi-close-circle mdi-36px text-white"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <main class="card-container">
            <h2>Products Details</h2>
            <section id="bar-chart"></section>
          </main>

        </div>
        <?php include 'components/footer.php'; ?>
      </div>
    </div>
  </div>

  <!-- JS Includes -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


  <!-- Chart Script -->

  <script>
    const colorPrimary = getComputedStyle(document.documentElement).getPropertyValue("--color-primary").trim();
    const colorDefault = getComputedStyle(document.documentElement).getPropertyValue("--color-default").trim();
    const colorLabel = getComputedStyle(document.documentElement).getPropertyValue("--color-label").trim();
    const fontFamily = getComputedStyle(document.documentElement).getPropertyValue("--font-family").trim();

    const defaultOptions = {
      chart: {
        toolbar: { show: false },
        selection: { enabled: false },
        zoom: { enabled: false },
        width: "100%",
        height: 250,
        offsetY: 8,
      },
      stroke: { lineCap: "round" },
      dataLabels: { enabled: false },
      legend: { show: false },
      states: {
        hover: { filter: { type: "none" } }
      }
    };

    var barOptions = {
      ...defaultOptions,
      chart: {
        ...defaultOptions.chart,
        type: "bar"
      },
      tooltip: {
        enabled: true,
        fillSeriesColor: false,
        style: { fontFamily: fontFamily },
        y: {
          formatter: (value) => `${value}`
        }
      },
      series: [{
        name: "Products",
        data: [<?= $total_products ?>, <?= $test_products ?>, <?= $passed_products ?>, <?= $failed_products ?>]
      }],
      colors: ["#ffd54f", "#81d4fa", "#a5d6a7", "#ef9a9a"],
      stroke: { show: false },
      grid: {
        borderColor: "rgba(0, 0, 0, 0.05)",
        padding: { left: 0, right: 0, top: -16, bottom: 8 }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: "40%",
          // borderRadius: 0,
          distributed: true
        }
      },
      yaxis: {
        show: true,
        labels: {
          style: { fontFamily: fontFamily, colors: colorLabel }
        }
      },
      xaxis: {
        categories: ["Total", "Tested", "Passed", "Failed"],
        labels: {
          style: { fontFamily: fontFamily, colors: colorLabel }
        },
        axisBorder: { show: false },
        axisTicks: { show: false },
        crosshairs: { show: false }
      }
    };

    var barChart = new ApexCharts(document.querySelector("#bar-chart"), barOptions);
    barChart.render();
  </script>



</body>

</html>