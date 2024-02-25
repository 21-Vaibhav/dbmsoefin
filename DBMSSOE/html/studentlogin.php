<?php
// Start session management
session_start();

// Include the database connection file
include_once "db_connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve student's username (USN) and password from the form
    $usn = $_POST["username"];
    $password = $_POST["password"];

    // SQL query to check if the student exists in the database
    $sql = "SELECT * FROM Student WHERE usn = '$usn' AND password = '$password'";

    // Execute the query
    $result = $conn->query($sql);

    // Check if a record is found
    if ($result->num_rows == 1) {
        // Student exists, set up session
        $row = $result->fetch_assoc();
        $_SESSION['usn'] = $row['usn'];
        
        // Redirect to student.php
        header("Location: student.php");
        exit();
    } else {
        // Student does not exist or invalid credentials
        echo "Invalid USN or password.";
    }
}
?>
