<?php

// import Config File
require_once('../config/config.php');

if (!isset($_SESSION)) {
    session_start();
}

// Define variables and initialize with empty values
$space_id = $_POST['id'];
$booker = $_POST['user'];

if ($space_id && $booker) {
    $sql = "UPDATE spaces SET is_booked = 1, user = ? WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ii", $booker, $space_id);
        $stmt->execute();
        $stmt->close();
        // echo "success";
        echo '<script>setTimeout(function(){
            window.location.href = "booked-spaces-listing.php";
        }, 2500);</script>';
    } else {
        echo "error: " . $conn->error;
    }
} else {
    echo "error: " . $conn->error;
}

?>