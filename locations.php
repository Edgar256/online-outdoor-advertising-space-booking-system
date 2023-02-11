<?php
// import Config File
require('./config/config.php');

if (!isset($_SESSION)) {
  session_start();
}

// Define variables and initialize with empty values
$title = $list = "";
$create_err = "";
$success_msg = "";

$table = "locations";

$sql = "SELECT *  FROM " . $table . " ORDER BY reg_date ASC";
$list = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Premier Advertising</title>
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
      <h1>Locations</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
          <li class="breadcrumb-item">Locations</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="">
            <div class="">
              <h5 class="card-title">Locations</h5>

              <div class="section">
                <div class="row">

                  <div class="col-lg-4">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Create a New Location</h5>

                        <div class="error"></div>

                        <!-- General Form Elements -->
                        <form method="post" id="createLocationForm">
                          <div class="row mb-3">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="title" id="title" required>
                            </div>
                          </div>
                          <div class="mb-3 d-flex justify-content-center align-items-center">
                            <div class="">
                              <button type="submit" class="btn btn-primary">Submit
                                Form</button>
                            </div>
                          </div>
                        </form><!-- End General Form Elements -->

                      </div>
                    </div>

                  </div>
                  <div class="col-lg-8">
                    <div class="card">
                      <div class="card-title p-4">Locations</div>
                      <div class="card-body">
                        <!-- Default Table -->
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Title</th>
                              <th scope="col">Date Created</th>
                            </tr>
                          </thead>
                          <tbody id="results">

                            <?php
                            if ($list->num_rows > 0) {
                              while ($row = $list->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td scope='row'> #" . $row['id'] . "</td>";
                                echo "<td>" . $row['title'] . "</td>";
                                echo "<td>" . $row['reg_date'] . "</td>";
                                echo "</tr>";
                              }
                            } else {
                              echo "<div class='alert alert-danger'>No Record Found</div>";
                            }
                            ?>

                          </tbody>
                        </table>
                        <!-- End Default Table Example -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>


            </div>
          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

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

  <!-- JQUERY LINK -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
    $(document).ready(function () {
      $("#createLocationForm").submit(function (e) {
        e.preventDefault();
        var title = $("#title").val();
        $.ajax({
          url: "./helpers/create_location.php",
          type: "post",
          data: { title },
          success: function (response) {
            $("#results").html(response);
          },
          error: function (jqXHR, textStatus, errorThrown) {
            // handle error
            console.log({ jqXHR, textStatus, errorThrown });
          }

        })

      });
    });
  </script>

</body>

</html>