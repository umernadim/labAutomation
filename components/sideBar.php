<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">

      <p class="sidebar-menu-title">Dash menu</p>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php">
        <i class="typcn typcn-device-desktop menu-icon"></i>
        <span class="menu-title">Dashboard </span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="typcn typcn-briefcase menu-icon"></i>
        <span class="menu-title">Internal Testing</span>
        <i class="typcn typcn-chevron-right menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <?php 
          if ($_SESSION["role"] !== "Normal User") {
          ?>
          <li class="nav-item"> <a class="nav-link" href="test-products.php">Test</a></li>
          <?php } ?>
          <li class="nav-item"> <a class="nav-link" href="test-record.php">Records</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
        <i class="typcn typcn-briefcase menu-icon"></i>
        <span class="menu-title">External Testing</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="error">
        <ul class="nav flex-column sub-menu">
           <?php 
          if ($_SESSION["role"] !== "Normal User") {
          ?>
          <li class="nav-item"> <a class="nav-link" href="cpri-test.php">CPRI Testing</a></li>
          <?php } ?>
          <li class="nav-item"> <a class="nav-link" href="remanufacturing-prod.php">Remanufacturing_Prod</a></li>
          <li class="nav-item"> <a class="nav-link" href="retest-prod-records.php">Retested_Prod_Records</a></li>
          <li class="nav-item"> <a class="nav-link" href="cpri-test-records.php">CPRI_Tested_Records</a></li>
        </ul>
      </div>
    </li>

  </ul>

</nav>