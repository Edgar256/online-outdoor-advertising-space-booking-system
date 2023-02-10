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

$table = "spaces";

$sql = "SELECT *  FROM " . $table . " ORDER BY reg_date ASC";
$list = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Tables / General - NiceAdmin Bootstrap Template</title>
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
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
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
            <h1>Spaces</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item">Spaces</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Spaces</h5>

                            <!-- Recent Sales -->
                            <div class="col-12">
                                <div class=" overflow-auto">

                                    <div class="card-body">
                                        <table class="table table-borderless datatable table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Image</th>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Date Posted</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                if ($list->num_rows > 0) {
                                                    while ($row = $list->fetch_assoc()) {
                                                        $imageData = $row['image'];

                                                        echo "<tr>";
                                                        echo "<td scope='row'> #" . $row['id'] . "</td>";
                                                        echo '<td><img class="imgTable" src="data:image/jpeg;base64,' . base64_encode($imageData) . '"/></td>';
                                                        echo "<td>" . $row['title'] . "</td>";
                                                        echo "<td>" . $row['description'] . "</td>";
                                                        echo "<td> $ " . $row['price'] . "</td>";
                                                        if ($row['is_booked'] == 1) {
                                                            echo "<td><span class='badge bg-success'>Booked</span></td>";
                                                        } else {
                                                            echo "<td><span class='badge bg-secondary'>Available</span></td>";
                                                        }
                                                        echo "<td>" . $row['reg_date'] . "</td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "<div class='alert alert-danger'>No Record Found</div>";
                                                }
                                                ?>

                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div><!-- End Recent Sales -->
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

</body>

</html>