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
$is_booked = 1;

$table = "spaces";

$sql = "SELECT spaces.*, locations.title AS location 
    FROM " . $table . "
    JOIN locations ON spaces.location = locations.id 
    WHERE spaces.is_booked = " . $is_booked . "
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
        <div class="container-fluid py-5 mt-5">
            <div class="container">
                <h1 class="">Booked Spaces </h1>
                <form action="post" class="d-flex" method="post" id="search-form">
                    <div class="col-5 p-1">
                        <input type="text" class="form-control" name="searchTerm" id="searchTerm">
                    </div>
                    <div class="col-5 p-1">
                        <select class="form-select" aria-label="" id="location_id" name="location_id">
                            <option value="" selected>Select Location</option>
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
                        <input type="text" id="isBooked" value="<?php echo $is_booked ?>" hidden>
                    </div>
                    <div class="col-2 p-1">
                        <input type="submit" class="btn btn-success rounded-pill px-5" name="submit" value="Search" />
                    </div>
                </form>
            </div>
            <div class="container py-2 my-5 d-flex flex-wrap" id="results">

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
                                <p class="card-text">' . $description . '</p>';
                        if ($row["is_booked"] == 1) {
                            echo '<button type="button" class="btn btn-danger rounded-pill unBookButton px-5" data-user=' . $_SESSION['id'] . ' data-id=' . $row['id'] . '>Cancel Booking</button>';
                        } else {
                            echo '<button type="button" class="btn btn-success rounded-pill bookButton px-5" data-user=' . $_SESSION['id'] . ' data-id=' . $row['id'] . '>Book</button>';
                        }
                        echo '</div>
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

    <!-- JQUERY LINK -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            // AJAX SEARCH BUTTON
            $("#search-form").submit(function (e) {
                e.preventDefault();
                var searchTerm = $("#searchTerm").val();
                var location_id = $('#location_id').val();
                var is_booked = $('#isBooked').val();
                console.log({ searchTerm, location_id })
                if (!searchTerm && !location_id) {
                    return alert("Please enter one of the fields")
                }
                $.ajax({
                    url: "./helpers/search_spaces.php",
                    type: "post",
                    data: { searchTerm, location_id, is_booked },
                    success: function (response) {
                        $("#results").html(response);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        // handle error
                        console.log({ jqXHR, textStatus, errorThrown });
                    }

                })
            });

            // AJAX CALL FOR BOOK BUTTON
            $(document).on("click", ".bookButton", function () {
                var id = $(this).attr('data-id');
                var user = $(this).attr('data-user');

                console.log({ id, user });

                $.ajax({
                    url: './helpers/book.php',
                    type: 'post',
                    data: { id, user },
                    success: function (response) {
                        $("#results").html(response);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        // handle error
                        console.log({ jqXHR, textStatus, errorThrown });
                    }
                });
            });

            // AJAX CALL FOR UNBOOK BUTTON
            $(document).on("click", ".unBookButton", function () {
                var id = $(this).attr('data-id');
                var user = $(this).attr('data-user');

                console.log({ id, user });

                $.ajax({
                    url: './helpers/cancel_booking.php',
                    type: 'post',
                    data: { id, user },
                    success: function (response) {
                        $("#results").html(response);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        // handle error
                        console.log({ jqXHR, textStatus, errorThrown });
                    }
                });
            });
        });
    </script>


</body>

</html>