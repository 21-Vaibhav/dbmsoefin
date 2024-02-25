<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Student Login</title>
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
        <div class="form-container">
            <!-- Set the action attribute to studentlogin.php -->
            <form action="studentlogin.php" method="POST" onsubmit="return validateForm()">
                <h1>Student Login</h1>
                <br><br>
                <label><span class="subtitle">USN (Length: 10):</span></label><br>
                <input type="text" name="username" id="username" minlength="10" maxlength="10" required><br>
                <label><span class="subtitle">PASSWORD (Length: 7):</span></label><br>
                <input type="password" name="password" id="password" minlength="7" maxlength="7" required><br><br>
                <input type="submit" value="SUBMIT" class="submit-btn">
            </form>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        var usn = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        
        // Check if USN length is 10 and password length is 7
        if (usn.length !== 10) {
            alert("USN must be of length 10.");
            return false;
        }
        if (password.length !== 7) {
            alert("Password must be of length 7.");
            return false;
        }
        return true;
    }
</script>
</body>
</html>
