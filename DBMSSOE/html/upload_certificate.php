<?php
require 'db_connection.php';
if(isset($_POST["submit"])){
  $name = $_POST["name"];
  if($_FILES["image"]["error"] == 4){
    echo "<script>alert('Image Does Not Exist');</script>";
  }
  else{
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    $validFileExtensions = ['jpg', 'jpeg', 'png', 'pdf']; // Updated to include PDF
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION); // Get file extension
    $fileExtension = strtolower($fileExtension); // Convert to lowercase
    if ( !in_array($fileExtension, $validFileExtensions) ){
      echo "<script>alert('Invalid File Extension');</script>";
    }
    else if($fileSize > 10000000000000){
      echo "<script>alert('File Size Is Too Large');</script>";
    }
    else{
      $newFileName = uniqid() . '.' . $fileExtension; // Generate unique filename
      $uploadDirectory = 'img/';
      move_uploaded_file($tmpName, $uploadDirectory . $newFileName); // Move uploaded file

      $query = "INSERT INTO tb_upload VALUES('', '$name', '$newFileName')";
      mysqli_query($conn, $query); // Insert data into database
      echo "<script>alert('Successfully Added'); document.location.href = 'data.php';</script>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Upload File</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="name">Name : </label>
        <input type="text" name="name" id="name" required value=""> <br>
        <label for="image">File : </label>
        <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png, .pdf" required> <br> <br>
        <button type="submit" name="submit">Submit</button>
    </form>
    <br>

</body>

</html>