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

$sql = "SELECT spaces.*, locations.title AS location 
    FROM " . $table . "
    JOIN locations ON spaces.location = locations.id 
    WHERE spaces.is_booked = 0 
    ORDER BY spaces.reg_date ASC";

$list = $conn->query($sql);

$table = "locations";

$sql = "SELECT *  FROM " . $table . " ORDER BY reg_date ASC";
$locations = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
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
        <div class="container-fluid py-5 mt-5">
            <div class="container">
                <form action="post" class="d-flex">
                    <div class="col-5 p-1">
                        <input type="text" class="form-control" name="title" id="title">
                    </div>
                    <div class="col-5 p-1">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Select Location</option>
                            <?php
                            if ($locations->num_rows > 0) {
                                while ($row = $locations->fetch_assoc()) {
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
                    <div class="col-2 p-1">
                        <button type="button" class="btn btn-success rounded-pill px-5">Search</button>
                    </div>
                </form>
            </div>
            <div class="container py-2 my-5 d-flex flex-wrap">

                <?php
                if ($list->num_rows > 0) {
                    while ($row = $list->fetch_assoc()) {
                        $title = mb_convert_case($row["title"], MB_CASE_TITLE, "UTF-8");
                        $description = mb_convert_case($row["description"], MB_CASE_TITLE, "UTF-8");
                        $price = number_format($row["price"]);
                        $imageData = $row['image'];
                        $location = $row['location'];

                        echo '<div class="col-4 p-2">
                        <div class="card position-relative">
                            <img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" class="card-img-top" alt="..."/>
                            <div class="position-absolute right-0 p-1">
                                <span class="badge bg-danger">' . $location . '</span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title my-1">' . $title . '</h5>
                                <p class="card-text">Price: $ ' . $price . ' per month</p>
                                <p class="card-text">' . $description . '</p>
                                <button type="button" class="btn btn-success rounded-pill px-5">Book</button>
                            </div>
                        </div>
                    </div>';
                    }
                } else {
                    echo "<div class='alert alert-danger'>No Record Found</div>";
                }
                ?>

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