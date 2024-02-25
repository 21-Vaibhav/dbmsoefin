<?php
session_start(); // Start session management

// Include the database connection file
include_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve proctor ID and password from the form
    $proctor_id = $_POST["proctor_id"];
    $password = $_POST["password"];

    // SQL query to check if the proctor exists in the database
    $sql = "SELECT * FROM Proctor WHERE proctor_id = '$proctor_id' AND password = '$password'";

    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Proctor exists, set up session
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['proctor_id'];
        $_SESSION['role'] = 'proctor';
        
        // Redirect to proctor.php
        header("Location: proctor.php");
        exit();
    } else {
        // Proctor does not exist or invalid credentials
        echo "Invalid proctor ID or password.";
    }
}
?>