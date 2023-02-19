<?php
// import Config File
require('./config/config.php');

if (!isset($_SESSION)) {
    session_start();
}

// Define variables and initialize with empty values
$count_users = $count_admins = $count_spaces = $count_locations  = 0;

$sql = "SELECT COUNT(*) FROM users";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $count_users = $row["COUNT(*)"];
} else {
  $count_users = 0;
}

$sql = "SELECT COUNT(*) FROM admins";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $count_admins = $row["COUNT(*)"];
} else {
  $count_admins = 0;
}

$sql = "SELECT COUNT(*) FROM spaces";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $count_spaces = $row["COUNT(*)"];
} else {
  $count_spaces = 0;
}

$sql = "SELECT COUNT(*) FROM locations";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $count_locations = $row["COUNT(*)"];
} else {
  $count_locations = 0;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - PremierAdvertising Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: PremierAdvertising - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <?php include './components/admin-header.php'; ?>
    <!-- End Header -->
    
  <!-- ======= Sidebar ======= -->
  <!-- import Admin Sidenav -->
  <?php include './components/admin-sidenav.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <div class="col-xxl-3 col-md-6">
              <div class="card info-card sales-card">                

                <div class="card-body">
                  <h5 class="card-title">Users</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $count_users; ?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-3 col-md-6">
              <div class="card info-card sales-card">                

                <div class="card-body">
                  <h5 class="card-title">Admins</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $count_admins; ?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-3 col-md-6">
              <div class="card info-card sales-card">                

                <div class="card-body">
                  <h5 class="card-title">Spaces</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $count_spaces; ?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-3 col-md-6">
              <div class="card info-card sales-card">                

                <div class="card-body">
                  <h5 class="card-title">Locations</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $count_locations; ?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          
          </div>
        </div><!-- End Left side columns -->

      </div>
    </section>

  </main><!-- End #main -->
  

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>