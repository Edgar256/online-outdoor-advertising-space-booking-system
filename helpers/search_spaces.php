<?php
// import Config File
require_once('../config/config.php');

// Processing form data when form is submitted                
if (isset($_POST['searchTerm']) || isset($_POST['location_id'])) {

    $searchTerm = $_POST['searchTerm'];
    $location_id = $_POST['location_id'];
    $is_booked = $_POST['is_booked'];

    // return error if both are empty
    if (empty(trim($_POST["searchTerm"])) && empty(trim($_POST["location_id"]))) {
        $search_err = '<div class="alert alert-danger text-center mx-auto">
                            Please enter a property name or location.</div>';
    }

    if (!empty(trim($_POST["searchTerm"])) && empty(trim($_POST["location_id"]))) {
        $searchTerm = trim($_POST["searchTerm"]);
        $searchTerm = mb_strtolower($searchTerm);
        $searchTerm = ucwords($searchTerm);
        $searchTerm = mysqli_real_escape_string($conn, $searchTerm);
        $query = "SELECT spaces.*, locations.id AS location_id, locations.title AS location_title FROM spaces JOIN locations ON spaces.location = locations.id  WHERE UPPER(spaces.title) LIKE UPPER('%$searchTerm%') AND is_booked='$is_booked' ORDER BY reg_date DESC";

        $result = $conn->query($query);
        $spaces_list = $conn->query($query);

        if ($spaces_list->num_rows > 0) {
            while ($row = $spaces_list->fetch_assoc()) {
                $title = mb_convert_case($row["title"], MB_CASE_TITLE, "UTF-8");
                $description = mb_convert_case($row["description"], MB_CASE_TITLE, "UTF-8");
                $price = number_format($row["price"]);
                $imageData = $row['image'];
                $location = $row['location_title'];

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

    if (empty(trim($_POST["searchTerm"])) && !empty(trim($_POST["location_id"]))) {
        $location_id = trim($_POST["location_id"]);
        $query = "SELECT spaces.*, locations.id AS location_id, locations.title AS location FROM spaces JOIN locations ON spaces.location = locations.id  WHERE location='$location_id' AND is_booked='$is_booked' ORDER BY reg_date DESC";
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

    if (!empty(trim($_POST["location_id"])) && !empty(trim($_POST["searchTerm"]))) {
        $searchTerm = trim($_POST["searchTerm"]);
        $location_id = trim($_POST["location_id"]);
        $searchTerm = mb_strtolower($searchTerm);
        $searchTerm = ucwords($searchTerm);
        $searchTerm = mysqli_real_escape_string($conn, $searchTerm);
        $query = "SELECT spaces.*, locations.id AS location_id, locations.title AS location_title FROM spaces JOIN locations ON spaces.location = locations.id  WHERE UPPER(spaces.title) LIKE UPPER('%$searchTerm%') AND location='$location_id' AND is_booked='$is_booked' ORDER BY reg_date DESC";

        $result = $conn->query($query);
        $spaces_list = $conn->query($query);

        if ($spaces_list->num_rows > 0) {
            while ($row = $spaces_list->fetch_assoc()) {
                $title = mb_convert_case($row["title"], MB_CASE_TITLE, "UTF-8");
                $description = mb_convert_case($row["description"], MB_CASE_TITLE, "UTF-8");
                $price = number_format($row["price"]);
                $imageData = $row['image'];
                $location = $row['location_title'];

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

    if (empty(trim($_POST["location_id"])) && empty(trim($_POST["searchTerm"]))) {
        $query = "SELECT spaces.*, locations.id AS location_id, locations.title AS location FROM spaces JOIN locations ON spaces.location = locations.id WHERE is_booked='$is_booked' ORDER BY reg_date DESC";
        $sql = "SELECT spaces.*, locations.title AS location 
                    FROM " . $table . "
                    JOIN locations ON spaces.location = locations.id 
                    WHERE spaces.is_booked = 0 
                    ORDER BY spaces.reg_date ASC";
        $result = $conn->query($sql);
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