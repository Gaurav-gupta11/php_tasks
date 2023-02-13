<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  First Name: <input type="text" name="firstName" pattern="[a-zA-Z]{1,}" required><br><br>
  Last Name: <input type="text" name="lastName" pattern="[a-zA-Z]{1,}" required><br><br>
  Full name: <input type="text" name="fullName" value="<?php echo $fullName; ?>" disabled><br><br>
  Select image:<input type="file" name="img" accept="image/*"><br><br>
  Marks:<br><textarea name="marks" rows="5" cols="30"></textarea><br><br>
  Phone Number: <input type="text" value="+91" name="number"  maxlength="13"><br><br>
  <input type="submit" value="Submit">
    
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstName = $_POST["firstName"];
  $lastName = $_POST["lastName"];
  $fullName = $firstName . " " . $lastName;
  $file_name= $_FILES['img']['name'];
  $file_tmp = $_FILES['img']['tmp_name'];
  $marks = $_POST['marks'];
  $number = $_POST['number'];
  $marks_array = explode("\n", $marks);

  move_uploaded_file($file_tmp,"upload-images".$file_name);
  echo "<p><img src='upload-images$file_name' alt='img'></p>";
  echo "Hello " . $fullName . "<br>";
  if (preg_match("/^\+91[0-9]{10}$/", $number)) {
    echo "Your phone number" . $number . "<br>";
  } else {

    echo "Invalid phone number. Please enter a valid Indian phone number in the format +91xxxxxxxxxx.";
  }

  ?>
  <table border="1">
      <tr>
        <th>Subject</th>
        <th>Marks</th>
      </tr>
  <?php    
  foreach ($marks_array as $mark) {
  $subject_mark = explode("|", $mark);
  ?>
  <tr>
    <td><?php echo $subject_mark[0]; ?></td>
    <td><?php echo $subject_mark[1]; ?></td>
  </tr>
<?php
}
?>
</table>
<?php
}
?>
</body>
</html>