<?php
session_start();

/**
 * If user is not logged in, redirect to login page.
 */
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: index.php');
    exit;
}

/**
 * If task number is set in the URL parameters, redirect to corresponding task page.
 */
if (isset($_GET['q'])) {
    $q = $_GET['q'];
    if ($q >= 1 && $q <= 6) {
        include('Task'.$q.'.php');
    } else {
        echo 'Invalid question number.';
    }
}
?>
