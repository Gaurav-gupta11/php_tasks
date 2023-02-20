<?php
session_start();

// Replace these values with your own plain-text password and username
$stored_password = 'gaurav';
$stored_username = 'gaurav';

if ($_POST['username'] == $stored_username && $_POST['password'] == $stored_password) {
  $_SESSION['logged_in'] = true;
  $_SESSION['username'] = $stored_username;
  header('Location: pager.php');
  exit;
} else {
  echo 'Invalid username or password.';
}
?>
