<?php
// import Config File
require_once('../config/config.php');

// Processing form data when form is submitted                
if (isset($_POST['title']) || isset($_POST['location_id'])) {

    $title = $_POST['title'];
    $location_id = $_POST['location_id'];

    // return error if both are empty
    if (empty(trim($_POST["title"])) && empty(trim($_POST["location_id"]))) {
        $search_err = '<div class="alert alert-danger text-center mx-auto">
                            Please enter a property name or location.</div>';
    }

    if (!empty(trim($_POST["title"])) && empty(trim($_POST["location_id"]))) {
        $title = trim($_POST["title"]);
        $title = mb_strtolower($title);
        $title = ucwords($title);
        $title = mysqli_real_escape_string($conn, $title);
        $query = "SELECT spaces.*, locations.id AS location_id, locations.title AS location FROM spaces JOIN locations ON spaces.location = locations.id  WHERE UPPER(title) LIKE UPPER('%$title%') ORDER BY reg_date DESC";
        $result = $conn->query($query);
        $spaces_list = $conn->query($query);

        if ($spaces_list->num_rows > 0) {
            while ($row = $spaces_list->fetch_assoc()) {
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
            echo "<div class='w-100 text-center py-5 display-1'>No Results found</div>";
        }
    }

    if (empty(trim($_POST["title"])) && !empty(trim($_POST["location_id"]))) {
        $location_id = trim($_POST["location_id"]);
        $query = "SELECT spaces.*, locations.id AS location_id, locations.title AS location FROM spaces JOIN locations ON spaces.location = locations.id  WHERE location='$location_id' ORDER BY reg_date DESC";
        $result = $conn->query($query);
        $spaces_list = $conn->query($query);

        if ($spaces_list->num_rows > 0) {
            while ($row = $spaces_list->fetch_assoc()) {
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
            echo "<div class='w-100 text-center py-5 display-1'>No Results found</div>";
        }
    }

    if (!empty(trim($_POST["location_id"])) && !empty(trim($_POST["title"]))) {
        $title = trim($_POST["title"]);
        $title = mb_strtolower($title);
        $title = ucwords($title);
        $title = mysqli_real_escape_string($conn, $title);
        $query = "SELECT spaces.*, locations.id AS location_id, locations.title AS location FROM spaces JOIN locations ON spaces.location = locations.id  WHERE UPPER(title) LIKE UPPER('%$title%') AND location='$location_id' ORDER BY reg_date DESC";
        $result = $conn->query($query);
        $spaces_list = $conn->query($query);

        if ($spaces_list->num_rows > 0) {
            while ($row = $spaces_list->fetch_assoc()) {
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
            echo "<div class='w-100 text-center py-5 display-1'>No Results found</div>";
        }
    }

    if (empty(trim($_POST["location_id"])) && empty(trim($_POST["title"]))) {
        $title = trim($_POST["title"]);
        $title = mb_strtolower($title);
        $title = ucwords($title);
        $title = mysqli_real_escape_string($conn, $title);
        $query = "SELECT spaces.*, locations.id AS location_id, locations.title AS location FROM spaces JOIN locations ON spaces.location = locations.id ORDER BY reg_date DESC";
        $result = $conn->query($query);
        $spaces_list = $conn->query($query);
        $property_is_taken = $row["is_taken"];

        if ($spaces_list->num_rows > 0) {
            while ($row = $spaces_list->fetch_assoc()) {
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
            echo "<div class='w-100 text-center py-5 display-1'>No Results found</div>";
        }
    }




}
?>