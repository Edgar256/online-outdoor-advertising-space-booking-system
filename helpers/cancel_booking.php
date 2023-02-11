<?php

// import Config File
require_once('../config/config.php');

if (!isset($_SESSION)) {
    session_start();
}

// Define variables and initialize with empty values
$space_id = $_POST['id'];
$booker = NULL;

if ($space_id) {

    $space_id = mysqli_real_escape_string($conn, $space_id);
    $sql = "UPDATE spaces SET is_booked = 0, `user` = NULL WHERE id='$space_id'";

    $spaces_list = $conn->query($sql);

    if ($spaces_list) {
        echo '<script>setTimeout(function(){
            window.location.href = "spaces-listing.php";
        }, 2500);</script>';
    } else {
        echo "error: " . $conn->error;
    }

} else {
    echo "error: " . $conn->error;
}

?>