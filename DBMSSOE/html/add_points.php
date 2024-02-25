<?php
// Start session management
session_start();

// Include the database connection file
include_once "db_connection.php";

// Check if the user is logged in and is a proctor
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'proctor') {
    // Redirect to the login page if not logged in or not a proctor
    header("Location: proctor_login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the additional points field is set in the POST data
    if (isset($_POST['additional_points'])) {
        // Sanitize the input
        $additional_points = mysqli_real_escape_string($conn, $_POST['additional_points']);
        
        // Retrieve the USN from the form data
        $usn = $_POST['usn'];

        // SQL query to update the points for the student
        $sql = "UPDATE Valid SET points_gained = points_gained + '$additional_points' WHERE usn = '$usn'";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            // Points updated successfully
            header("Location: proctor.php");
            exit();
        } else {
            // Error occurred while updating points
            echo "Error updating points: " . $conn->error;
        }
    } else {
        // If additional_points field is not set in POST data
        echo "Additional points field is not set.";
    }
} else {
    // If form is not submitted via POST method
    echo "Form not submitted.";
}
?>
