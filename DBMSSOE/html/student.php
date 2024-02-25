<?php
// Start session management
session_start();

// Include the database connection file
include_once "db_connection.php";

// Check if the user is logged in
if (!isset($_SESSION['usn'])) {
    // Redirect to the login page if not logged in
    header("Location: student_login.php");
    exit();
}

// Retrieve the logged-in student's USN
$usn = $_SESSION['usn'];

// SQL query to fetch student details
$sql = "SELECT s.usn, s.firstname, s.lastname, v.points_gained 
        FROM Student s 
        INNER JOIN Valid v ON s.usn = v.usn 
        WHERE s.usn = '$usn'";

// Execute the query
$result = $conn->query($sql);

// Check if a record is found
if ($result->num_rows > 0) {
    // Fetch the data from the result set
    $row = $result->fetch_assoc();
    $usn = $row['usn'];
    $name = $row['firstname'] . ' ' . $row['lastname'];
    $pointsEarned = $row['points_gained'];
    $totalPoints = 100; // Assuming total points to be earned is 100

    // Display the fetched data on the webpage
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Details</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <script src='jspdf.umd.min.js'></script>
</head>

<body>
    <header class="main-header">
        <div class="logo-container">
            <a href="../html/home.html" class="logo-container">
                <img src="../assets/sit logo.png" alt="Logo" />
            </a>
        </div>
        <h1 class="college-name">Siddaganga Institute of Technology</h1>
    </header>
    <section>
        <div class="student-card">
            <div class="student-card-container">
                <h3>Student details</h3>
                <ul>
                    <li>USN: <?php echo $usn; ?></li>
                </ul>
                <br />
                <ul>
                    <li>NAME: <?php echo $name; ?></li>
                </ul>
                <br />
                <ul>
                    <li>ACTIVITY POINTS EARNED: <?php echo $pointsEarned; ?></li>
                </ul>
                <br />
                <ul>
                    <li>TOTAL POINTS TO BE EARNED: <?php echo $totalPoints; ?></li>
                </ul>
                <br />
                <div class="give-certificates">
                    <p>SUBMIT A CERTIFICATE:</p>
                    <br />
                    <a href="../html/upload_certificate.php"><button class="primary">Submit a certificate</button></a>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
<?php
} else {
    // If no record found, display an error message
    echo "No student data found.";
}
?>