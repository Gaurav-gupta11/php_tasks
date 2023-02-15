<!DOCTYPE html>
<html>
  <head>
    <title>Form Example</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="index.js"></script>
  </head>
  <body>
    <form method="post" enctype="multipart/form-data">
      <label for="first-name">First Name:</label>
      <input type="text" id="first-name" name="first-name"  required>
      <br>
      <label for="last-name">Last Name:</label>
      <input type="text" id="last-name" name="last-name" required>
      <br>
      <label for="full-name">Full Name:</label>
      <input type="text" id="full-name" name="full-name" disabled>
      <br>
      <label for="img">Select image:</label>
       <input type="file" id ="img" name="img" accept="image/*">
      <br><br>
      <button type="submit">Submit</button>
    </form>
    <?php include 'logic.php'; ?>
  </body>
</html>