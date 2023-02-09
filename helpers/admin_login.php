<?php

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $creating_acc_err = 'Email is required.';
    } else {

        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $creating_acc_err = "Invalid email format";
        }
        $email = trim($_POST["email"]);

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
    if (empty($creating_acc_err)) {

        // Prepare and execute the query
        $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ?");
        // $stmt->bind_param("s", $email);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $stmt->bind_param("s", $email);
        }
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if the query returned any rows
        if ($result->num_rows > 0) {
            // Fetch the user data
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password'])) {

                $inactive = 3600;

                // start session if session is not started
                if (!isset($_SESSION)) {
                    ini_set('session.gc_maxlifetime', $inactive); // set the session max lifetime to 2 hours
                    session_start();
                }

                // set session variables
                $_SESSION['email'] = $user['email'];
                $_SESSION['names'] = $user['names'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['time'] = time();
                $_SESSION['auth_active'] = TRUE;
                $_SESSION['id'] = $user['id'];

                $success_msg = 'Login was successful.';

                echo '<script>setTimeout(function(){
                    window.location.href = "dashboard.php";
                }, 2500);</script>';

            } else {
                $creating_acc_err = 'Invalid Password.';
            }

        } else {
            // Show an error message if email not found
            $creating_acc_err = 'Email not found.';
        }

    }

    // Close connection
    $conn->close();

}
?>