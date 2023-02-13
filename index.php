<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstName = $_POST["firstName"];
  $lastName = $_POST["lastName"];
  $fullName = $firstName . " " . $lastName;
  $file_name= $_FILES['img']['name'];
  $file_tmp = $_FILES['img']['tmp_name'];
  move_uploaded_file($file_tmp,"upload-images/$file_name");
}

?>

<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  First Name: <input type="text" name="firstName" pattern="[a-zA-Z]{1,}" required><br><br>
  Last Name: <input type="text" name="lastName" pattern="[a-zA-Z]{1,}" required><br><br>
  Full name: <input type="text" name="fullName" value="<?php echo $fullName; ?>" disabled><br><br>
  Select image:<input type="file" name="img" accept="image/*"><br><br>
  <input type="submit" value="Submit">
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<p><img src='upload-images/$file_name' alt='img'></p>";
    echo "Hello " . $fullName;
  }
  ?>
</body>
</html>