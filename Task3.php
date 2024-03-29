<!DOCTYPE html>
<html>
  <head>
    <title>Form Example</title>
    <!--include style.css for styling-->
    <link rel="stylesheet" href="style.css">
    <!-- include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- include index.js for scripting -->
    <script src="index.js"></script>
  </head>
  <body>
    <!-- create a form with two input fields for first and last name, image,marks and a button to submit the form -->
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
       <input type="file" id ="img" name="img" accept="image/*" required>
      <br><br>
      <label for="marks" id="marks">Marks:</label>
      <textarea name="marks" rows="5" cols="30" required></textarea><br><br>
      <button type="submit">Submit</button>
    </form>
    <!-- create a div to display error messages -->
    <div id="error-message"></div>
    <?php 
      //include logic.php to handle form submission     
      include 'logic3.php'; 
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
    ?>
    <!-- Make a table for submission of value -->
    <table>
      <thead>  
      <tr>
        <th>Subject</th>
        <th>Marks</th>
      </tr>
</thead>
  <?php for ($i=0;$i<$j;$i++) {?>
  <tr>
    <td><?php echo $subject_mark[$i]; ?></td>
    <td><?php echo $subject_mark[$i=$i+1]; ?></td>
  </tr>
<?php }} ?>
</table>
  </body>
</html>