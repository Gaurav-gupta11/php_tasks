<?php
session_start();

/**
 * If user is not logged in, redirect to login page.
 */
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: index.html');
    exit;
}

/**
 * If logout button is clicked, destroy session and redirect to index page.
 */
if (isset($_POST['logout'])) {
    session_unset();
    // Destroy the session
    session_destroy();
    
    // Redirect to the index page
    header('Location: index.html');
    exit;
}
?>

<?php
/**
 * If task number is set in the URL parameters, redirect to corresponding task page.
 */
if (isset($_GET['q'])) {
    $q = $_GET['q'];
    if ($q >= 1 && $q <= 6) {
        header('Location: Task'.$q.'.php');
    } else {
        echo 'Invalid question number.';
    }
}
?>
