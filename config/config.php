<?php

// DATABASE CREDENTIALS
define("DB_HOST", 'localhost'); // DATABASE HOST
define("DB_USER", 'root'); // DATABASE USER
define("DB_PASSWORD", ''); // DATABASE PASSWORD
define("DB_NAME", 'adverts_database'); // DATABASE NAME

// connect to the database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to create users table
$sql_create_database = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;

// connect to database
if ($conn->query($sql_create_database) !== TRUE) {
    // echo "Error creating database: " . $conn->error;
}

// Close connection
$conn->close();

//connect to the created database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// sql to create users table
$sql_create_users_table = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    names VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    role VARCHAR(255) NOT NULL DEFAULT 'USER',
    password VARCHAR(255) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

// create Users table
if ($conn->query($sql_create_users_table) !== TRUE) {
    // echo "Error creating table: " . $conn->error;
}

// sql to create admins table
$sql_create_admins_table = "CREATE TABLE IF NOT EXISTS admins (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    names VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    role VARCHAR(255) NOT NULL DEFAULT 'ADMIN',
    password VARCHAR(255) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

// create Users table
if ($conn->query($sql_create_admins_table) !== TRUE) {
    // echo "Error creating table: " . $conn->error;
}

// sql to create locations table
$sql_create_locations_table = "CREATE TABLE IF NOT EXISTS locations (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

// create Locations table
if ($conn->query($sql_create_locations_table) !== TRUE) {
    // echo "Error creating table: " . $conn->error;
}

// sql to create space table
$sql_create_spaces_table = "CREATE TABLE IF NOT EXISTS spaces (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,    
    description VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image BLOB NOT NULL,  
    is_booked TINYINT(1) NOT NULL DEFAULT 0,

    location INT(6) UNSIGNED,
    FOREIGN KEY (location) REFERENCES locations(id),
    
    creator INT(6) UNSIGNED,
    FOREIGN KEY (creator) REFERENCES admins(id),

    user INT(6) UNSIGNED,
    FOREIGN KEY (user) REFERENCES users(id) ON UPDATE CASCADE ON DELETE SET NULL,
     
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

// create Managers table
if ($conn->multi_query($sql_create_spaces_table) !== TRUE) {
    // DISPLAY ERROR HERE IF DB HAS NOT BEEN CREATED
    // echo "Error creating table: " . $conn->error;
}

// echo 'Connected successfully';
// mysqli_close($conn);

?>