<?php
session_start();

/**
 * If user is not logged in, redirect to login page.
 */
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: login.php');
    exit;
}

?>
<ul>
    <li><a href="pager.php?q=1">Task 1</a></li>
    <li><a href="pager.php?q=2">Task 2</a></li>
    <li><a href="pager.php?q=3">Task 3</a></li>
    <li><a href="pager.php?q=4">Task 4</a></li>
    <li><a href="pager.php?q=5">Task 5</a></li>
    <li><a href="pager.php?q=6">Task 6</a></li>
</ul>
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
