<?php
// import Config File
require('./config/config.php');

if (!isset($_SESSION)) {
    session_start();
}

// Define variables and initialize with empty values
$users = $list = "";
$create_err = "";
$success_msg = "";

$table = "locations";

$sql = "SELECT *  FROM " . $table . " ORDER BY reg_date ASC";
$list = $conn->query($sql);

// require create space file
include('./helpers/create_space.php');

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
    <link rel="stylesheet" href="./assets/css/custom.css">

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
    <!-- End Header -->]
    
    <!-- ======= Sidebar ======= -->
    <!-- import Admin Sidenav -->
    <?php include './components/admin-sidenav.php'; ?>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Spaces</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item">Create A Space</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">

                <div class="col-lg-7">

                    <?php
                    if (!empty($create_err)) {
                        echo '<div class="alert alert-danger" role="alert">' . $create_err . '</div>';
                    }
                    if (!empty($success_msg)) {
                        echo '<div class="alert alert-success" role="alert">' . $success_msg . '</div>';
                    }
                    ?>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create a New Space</h5>

                            <!-- General Form Elements -->
                            <form method="post" id="createSpaceForm" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title" id="title" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="price" class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="price" id="price" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="description" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description" rows="3"
                                            required></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="location" class="col-sm-2 col-form-label">Location</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Location" name="location" id="location"
                                            required>
                                            <option selected>Select Location</option>
                                            <?php
                                            if ($list->num_rows > 0) {
                                                while ($row = $list->fetch_assoc()) {
                                                    $title = mb_convert_case($row["title"], MB_CASE_TITLE, "UTF-8");
                                                    $id = $row["id"];
                                                    echo "<option value=" . $id . ">" . $title . "</option>";
                                                }
                                            } else {
                                                echo "No Locations found";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="image"
                                            accept=" image/gif, image/jpeg,image/jpg, image/png" name="image" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <input type="text" value='<?php echo $_SESSION['id'] ?>' id="creator" name="creator" hidden>
                                </div>

                                <div class="mb-3 d-flex justify-content-center align-items-center">
                                    <div class="">
                                        <input type="submit" name="form_create_space" value="Submit Form"
                                            class="btn btn-primary rounded-pill">
                                    </div>
                                </div>

                            </form><!-- End General Form Elements -->

                        </div>
                    </div>

                </div>

                <div class="col-lg-4">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Space Preview</h5>

                            <div class="col-12 p-2">
                                <div class="card position-relative">
                                    <img id="imagePreview" class="card-img-top" alt="..." />
                                    <div class="position-absolute right-0 p-1">
                                        <span class="badge bg-danger" id="locationText"></span>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title my-1" id="titleText"></h5>
                                        <p class="card-text">Price: $ <span id="priceText"></span> per month</p>
                                        <p class="card-text" id="descriptionText"></p>
                                        <button type="button" class="btn btn-success rounded-pill px-5"
                                            disabled>Book</button>
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
            $("#title").keyup(function (e) {
                var title = $("#title").val();
                $("#titleText").text(title);
            });
            $("#price").keyup(function (e) {
                var price = $("#price").val();
                $("#priceText").text(price);
            });
            $("#description").keyup(function (e) {
                var description = $("#description").val();
                $("#descriptionText").text(description);
            });
            $("#location").change(function (e) {
                var selectedOption = $(this).find("option:selected");
                $("#locationText").text(selectedOption.text());
            });
            $("#image").keyup(function (e) {
                var description = $("#description").val();
                $("#descriptionText").text(description);
            });
            $("#image").change(function () {
                var file = this.files[0];
                var reader = new FileReader();
                reader.onload = function (event) {
                    $("#imagePreview").attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            });

        });
    </script>

</body>

</html>