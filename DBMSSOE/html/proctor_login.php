<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Proctor Login</title>
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
            <!-- Change action attribute to proctorlogin.php -->
            <form action="proctorlogin.php" method="POST" onsubmit="return validateForm()">
                <h1>Proctor Login</h1>
                <br><br>
                <label><span class="subtitle">PROCTOR ID (Length: 5):</span></label><br>
                <input type="text" name="proctor_id" id="proctor_id" minlength="5" maxlength="5" required><br>
                <label><span class="subtitle">PASSWORD (Length: 7):</span></label><br>
                <input type="password" name="password" id="password" minlength="7" maxlength="7" required><br><br>
                <input type="submit" value="SUBMIT" class="submit-btn">
            </form>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        var proctorId = document.getElementById("proctor_id").value;
        var password = document.getElementById("password").value;
        
        // Check if proctor ID length is 5 and password length is 7
        if (proctorId.length !== 5) {
            alert("Proctor ID must be of length 5.");
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
