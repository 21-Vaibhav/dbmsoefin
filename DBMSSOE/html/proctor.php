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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proctor Dashboard</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <header class="main-header">
        <div class="logo-container">
            <a href="../html/home.html" class="logo-container">
                <img src="../assets/sit logo.png" alt="Logo">
            </a>
        </div>
        <h1 class="college-name">Siddaganga Institute of Technology</h1>
    </header>
    <div class="flex-container">
        <div class="content-container">
            <h1>Proctor Dashboard</h1>
            <h2>Students under your supervision:</h2>
            <table>
                <thead>
                    <tr>
                        <th>USN</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Semester</th>
                        <th>Branch</th>
                        <th>Points Earned</th>
                        <th>Add Points</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are any students under the proctor
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["usn"] . "</td>";
                            echo "<td>" . $row["firstname"] . "</td>";
                            echo "<td>" . $row["lastname"] . "</td>";
                            echo "<td>" . $row["sem"] . "</td>";
                            echo "<td>" . $row["branch"] . "</td>";
                            echo "<td>" . ($row["points_gained"] ?? 0) . "</td>"; // Display points earned or 0 if null
                            echo "<td>";
                            echo "<form action='add_points.php' method='POST'>";
                            echo "<input type='hidden' name='usn' value='" . $row["usn"] . "'>";
                            echo "<input type='number' name='additional_points' required>";
                            echo "<input type='submit' value='Add Points'>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No students under your supervision.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <div class="view-btn">
                <div class="buttons">
                    <a href="data.php"><button class="primary">View</button></a>
                    <div class="buttons">
                        <br>
                        <br>
                        <a href="generate_pdf.php"><button class="primary">Generate data</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>