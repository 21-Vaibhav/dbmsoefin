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

// Retrieve the logged-in proctor's proctor_id
$proctor_id = $_SESSION['user_id'];

// SQL query to fetch all students under the logged-in proctor along with their points
$sql = "SELECT s.usn, s.firstname, s.lastname, s.sem, s.branch, v.points_gained 
        FROM Student s 
        LEFT JOIN Valid v ON s.usn = v.usn 
        WHERE s.proctor_id = '$proctor_id'";

// Execute the query
$result = $conn->query($sql);

// Create a CSV file content
$csv_content = "USN,First Name,Last Name,Semester,Branch,Points Earned\n";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $csv_content .= "{$row['usn']},{$row['firstname']},{$row['lastname']},{$row['sem']},{$row['branch']},{$row['points_gained']}\n";
    }
}

// Set headers for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="students_data.csv"');

// Output CSV content
echo $csv_content;

// Close database connection
$conn->close();
exit;
?>