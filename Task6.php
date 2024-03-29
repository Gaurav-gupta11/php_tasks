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
    <!-- create a form with two input fields for first and last name, image,marks,phone number,email and a button to submit the form -->
    <form id="my-form" method="post" enctype="multipart/form-data" action="logic6.php" >
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
      <label for="phone">Phone:</label>
      <select id="country-code" name="country-code">
      <option value="+91">+91</option>
      <option value="+81">+81</option>
      </select>
      <input type="text" id="phone" name="phone" pattern="\d{10}" title="Please enter a valid Indian phone number starting with +91 and 10 digits long." required><br><br>
      <label for="email">Email:</label>
      <input type="text" id="email" name="email" required><br>
      <button type="submit" name="submit">Submit</button>
      <button type="submit" name="download" >Download</button>
    </form>
    <!-- create a div to display error messages -->
    <div id="error-message"></div>
  </body>
</html>