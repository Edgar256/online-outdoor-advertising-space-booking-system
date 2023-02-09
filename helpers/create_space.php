<?php

if (isset($_POST['form_create_space'])) {

    // Validate title
    if (empty(trim($_POST["title"]))) {
        $create_err = "Title not found.";
        echo "error: " . $create_err;
    } elseif (strlen(trim($_POST["title"])) < 2) {
        $create_err = "Title must have atleast 2 characters.";
    } else {
        $title = trim($_POST["title"]);
    }

    // Validate price
    if (empty(trim($_POST["price"]))) {
        $create_err = ' Price is required.';
    } else {
        $price = trim($_POST["price"]);
    }

    // Validate description
    if (empty(trim($_POST["description"]))) {
        $create_err = 'Description is required.';
    } else {
        $description = trim($_POST["description"]);
    }

    // Validate location
    if (empty(trim($_POST["location"]))) {
        $create_err = 'Location is required.';
    } else {
        $location = trim($_POST["location"]);
    }

    // Validate creator
    if (empty(trim($_POST["creator"]))) {
        $create_err = 'Creator is required.';
    } else {
        $creator = trim($_POST["creator"]);
    }

    if ((isset($_FILES['image']) && $_FILES['image']['error'] == 0)) {
        $file = $_FILES['image'];
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));
        $allowed = array('jpg', 'jpeg', 'png', 'gif');

        if (!in_array($file_ext, $allowed)) {
            exit(2);
        }

        $data = file_get_contents($file_tmp);

        if (empty($create_err)) {
            //     Prepare an insert statement
            $sql = "INSERT INTO spaces (title, price,creator, description, location, image) VALUES (?, ?, ?, ?, ?, ?)";
            if ($stmt = $conn->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("ssssss", $param_title, $param_price, $creator, $param_description, $param_location, $param_image);

                // Set parameters
                $param_title = $title;
                $param_price = $price;
                $param_creator = $creator;
                $param_description = $description;
                $param_location = $location;
                $param_image = $data;

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Display success message 
                    $success_msg = 'Space entry was successfully created.';
                    echo "<script>setTimeout(\"location.href = 'spaces.php';\",3000);</script>";
                } else {
                    $saving_property_err = $conn->error;
                }
                // Close statement
                $stmt->close();
            }
        }
    }
}
?>