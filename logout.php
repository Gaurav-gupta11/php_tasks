<?php

/**
 * If logout button is clicked, destroy session and redirect to index page.
 */
session_start();

session_unset();
session_destroy();
header('Location: index.php');
?>