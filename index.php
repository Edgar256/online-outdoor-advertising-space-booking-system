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
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

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
  <link href="assets/css/custom.css" rel="stylesheet">

</head>

<body>

  <!-- include header -->
  <?php include 'components/header.php'; ?>

  <!-- ======= Main Content ======= -->
  <main>
    <div class="container-fluid landing-area py-5">
      <div class="container py-5 my-5">
        <div class="col-8 text-white display-2 pt-5">
          Your One Stop Online Booking Advertising Platform
        </div>
        <?php
        if ((!isset($_SESSION['role']) == 'USER')) {
          echo '<div class="py-3">
          <a href="user-login.php" class="btn btn-primary rounded-pill">Login</a>
          <a href="user-register.php" class="btn btn-outline-light rounded-pill mx-5">Create Account</a>
        </div>';
        }
        ?>
      </div>
    </div>
    <div class="container d-flex p-5">
      <div class="col-8 mx-auto">
        <h3 class="text-center">
          Are you tired of juggling multiple platforms and websites to promote your business? Look no further! Our One
          Stop Online Booking Advertising Platform is here to simplify your life. With our platform, you can:
        </h3>
        <ol>
          <li>Easily create a professional website and mobile-optimized landing pages to showcase your business. </li>
          <li>Manage your bookings, availability, and pricing all in one place.</li>
          <li> Reach potential customers with targeted advertising through our platform and Google.</li>
          <li>Gain insights into your business performance with detailed analytics and reporting.</li>
          <li> Connect with your customers through built-in email marketing tools and personalized communication.</li>
        </ol>



        No matter what type of business you have, our platform has got you covered. From hotels and tours to spas and
        salons, our platform is designed to help you grow your business and reach more customers.

        Say goodbye to the hassle of multiple platforms and hello to streamlined success with Our One Stop Online
        Booking Advertising Platform. Get started today!
      </div>
    </div>
  </main><!-- End #main -->

  <!-- Include Footer -->
  <?php include 'components/footer.php'; ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

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