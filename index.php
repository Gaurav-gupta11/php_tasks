<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data" action="" target="_self">
        First Name: <input type="text" name="firstName" pattern="[a-zA-Z]{1,}" required><br><br>
        Last Name: <input type="text" name="lastName" pattern="[a-zA-Z]{1,}" required><br><br>
        Full name: <input type="text" name="fullName" value= "<?php echo $fullName; ?>" disabled><br><br>
        <input type="submit" value="submit"><br><br>
      
      </form>
      <?php include 'logic.php'; ?>
</body>
</html>