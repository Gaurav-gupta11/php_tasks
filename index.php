<?php
session_start();
$error = $_GET['error'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index page</title>
    <link rel="stylesheet" href="index_style.css">
</head>
<body>
    
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <input type="submit" value="Login">
        <?php if ($error === 'invalid_id_password'): ?>
        <p class="error-message">Invalid username or password</p>
        <?php endif; ?>
    </form>
      
</body>
</html>
