<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="pager_style.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="pager_index.php?q=1">Task 1</a></li>
            <li><a href="pager_index.php?q=2">Task 2</a></li>
            <li><a href="pager_index.php?q=3">Task 3</a></li>
            <li><a href="pager_index.php?q=4">Task 4</a></li>
            <li><a href="pager_index.php?q=5">Task 5</a></li>
            <li><a href="pager_index.php?q=6">Task 6</a></li>
            <li><a href="logout.php"><input type="submit" name="logout" value="Logout"></a>
            </li>
        </ul>
    </nav>
    <?php include("pager.php");?>
</body>
</html>