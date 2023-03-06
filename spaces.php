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

$sql = "SELECT spaces.* ,
            COALESCE(users.names, 'N/A') AS user_names,
            COALESCE(users.email, 'N/A') AS user_email 
            FROM " . $table . " 
            LEFT JOIN users ON spaces.user = users.id
            ORDER BY spaces.reg_date ASC";
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
    <link rel="stylesheet" href="assets/css/custom.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                                                    <th scope="col">User_Who_Booked</th>
                                                    <th scope="col">Date Posted</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                if ($list->num_rows > 0) {
                                                    while ($row = $list->fetch_assoc()) {
                                                        $imageData = $row['image'];
                                                        $imgData = base64_encode($row['image']);
                                                        $src = 'data:image/jpeg;base64,' . $imgData;

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
                                                        echo "<td>" . $row['user_names'] . "</td>";
                                                        echo "<td>" . $row['reg_date'] . "</td>";
                                                        echo "<td> <button class='btn btn-primary rounded-pill'  data-bs-toggle='modal' data-bs-target='#editModal" . $row['id'] . "'>EditSpace</button></td>";
                                                        echo "</tr>";

                                                        echo "<div class='modal fade' id='editModal" . $row['id'] . "' tabindex='-1'>
                                                        <div class='modal-dialog modal-dialog-centered'>
                                                          <div class='modal-content'>
                                                            <div class='modal-header'>
                                                              <h5 class='modal-title text-center'>EDIT SPACE MODAL</h5>
                                                              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                            </div>
                                                            <div class='modal-body'>
                                                            <form id='edit-form" . $row['id'] . "' class='d-xl-flex flex-wrap d-md-flex d-sm-block' method='post'>";

                                                        echo "<img src='" . $src . "' alt='Property Image' class='img-fluid mb-3 w-100' />";

                                                        echo "<input type='text' class='form-control' name='id' id='currentSpace" . $row['id'] . "' value='" . $row['id'] . "' hidden />
                                                                                <div class='col-xl-12 col-md-12 col-sm-12 p-3'>
                                                                                    <label for='title' class='form-label'>Space Title <span class='text-danger pl-2'>*</span></label>
                                                                                    <input type='text' class='form-control' value='" . $row['title'] . "' placeholder='" . $row['title'] . "' name='title' id='title" . $row['id'] . "' />
                                                                                </div>
                                                                                <div class='col-xl-12 col-md-12 col-sm-12 p-3'>
                                                                                    <label for='title' class='form-label'>Price <span class='text-danger pl-2'>*</span></label>
                                                                                    <input type='text' class='form-control' value='" . $row['price'] . "' placeholder='" . number_format($row['price']) . "'  name='price' id='price" . $row['id'] . "' />
                                                                                </div>
                                                                                <div class='col-xl-12 col-md-12 col-sm-12 p-3'>
                                                                                    <label for='title' class='form-label'>Description <span class='text-danger pl-2'>*</span></label>
                                                                                    <textarea class='form-control' name='description' value='" . $row['description'] . "' id='description" . $row['id'] . "' rows='5' maxLength='254' id='description" . $row['id'] . "'>" . $row['description'] . "</textarea>
                                                                                </div>
                                                                                <div class='modal-footer d-flex justify-content-between'>
                                                                                    <button type='button' class='btn btn-secondary rounded-pill' data-bs-dismiss='modal'>DISMISS MODAL</button>                                                                                    
                                                                                    <input type='submit' name='delete' value='SAVE EDITS' class='btn btn-primary rounded-pill'/>
                                                                                </div>
                                                                            </form> 
                                                            </div>
                                                            
                                                          </div>
                                                        </div>
                                                      </div>";

                                                        echo '<script> $(document).ready(function () {
                                                        $("#edit-form' . $row['id'] . '").submit(function (e) {
                                                            e.preventDefault();
                                                            var form = $(this);
                                                            var currentSpace = $("#currentSpace' . $row['id'] . '").val();
                                                            var title = $("#title' . $row['id'] . '").val();
                                                            var price = $("#price' . $row['id'] . '").val();
                                                            var description = $("#description' . $row['id'] . '").val();
                    
                                                            if( title=="" || price=="" || description=="" ){
                                                                alert("Please fill all the fields");
                                                                return;
                                                            }
                    
                                                            console.log({currentSpace, title, price, description});
                    
                                                            $.ajax({
                                                                type: "post",
                                                                url: "./helpers/edit_space.php",
                                                                data: { currentSpace, title, price, description},
                                                                success: function (data) {
                                                                    if (data == "success") {
                                                                        alert("Space updated successfully");
                                                                        location.reload();
                                                                    } else {
                                                                        console.log("Space update failed");
                                                                        console.log(data);
                                                                        alert("Space update failed");
                                                                    }
                                                                }
                                                            });
                                                        });
                                                    }); </script>';


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