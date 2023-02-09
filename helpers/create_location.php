<?php

// import Config File
require_once('../config/config.php');

if (!isset($_SESSION)) {
    session_start();
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Define variables and initialize with empty values
$title = "";
$create_err = "";
$success_msg = "";

// Validate location
if (empty(trim($_POST["title"]))) {
    $create_err = 'Title is required.';
} elseif (strlen(trim($_POST["title"])) < 2) {
    $create_err = "Title must be more than 2 characters.";
} else {
    $title = trim($_POST["title"]);
    $titleCheck = $conn->query("SELECT * FROM locations WHERE  title= '{$title}' ");
    if ($titleCheck->num_rows > 0) {
        // Location exists
        $create_err = "Location already exists";
        echo "error: " . $create_err;
    } else {
        // Save New Location
        // Prepare an insert statement
        $sql = "INSERT INTO locations (title) VALUES ('$title')";

        if ($conn->query($sql) === TRUE) {

            $table = "locations";
            $sql = "SELECT *  FROM " . $table . " ORDER BY reg_date ASC";
            $list = $conn->query($sql);
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

        } else {
            echo "error: Error saving location";
        }
    }

}

?>