<?php

// import Config File
require_once('./config/config.php');
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate names
    if (empty(trim($_POST["names"]))) {
        $$creating_acc_err = 'Names is required.
        ';
    } elseif (strlen(trim($_POST["names"])) < 2) {
        $creating_acc_err = 'Names must have atleast 2 characters.';
    } else {
        $names = trim($_POST["names"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = 'Email is required.';
    } else {

        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $creating_acc_err = 'Invalid email format.';
        }

        // verify if email exists
        $emailCheck = $conn->query("SELECT * FROM admins WHERE email = '{$email}' ");
        if ($emailCheck->num_rows > 0) {
            // Email exists
            $creating_acc_err = 'Email already taken.';
        } else {
            // Email does not exist
            $email = trim($_POST["email"]);
        }
    }


    // Validate password
    if (empty(trim($_POST["password"]))) {
        $creating_acc_err = 'Password is required.';
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $creating_acc_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }


    // Check input errors before inserting in database
    if (empty($$creating_acc_err)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare an insert statement
        $sql = "INSERT INTO admins (names, email, password) VALUES ('$names', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {

            $success_msg = 'Your account was successfully created.';

            echo '<script>setTimeout(function(){
                    window.location.href = "admin-login.php";
                }, 2000);</script>';
        } else {
            $saving_user_err = '<div class="alert alert-danger">' . 'Failed to Create Account' . '</div>';
        }
    }


    // Close connection
    // $mysqli->close();
}

?>