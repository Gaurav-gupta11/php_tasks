<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="pager_style.css">
</head>
<?php include("pager.php");?>
<body>
    <nav>
        <ul>
            <li><a href="pager.php?q=1">Task 1</a></li>
            <li><a href="pager.php?q=2">Task 2</a></li>
            <li><a href="pager.php?q=3">Task 3</a></li>
            <li><a href="pager.php?q=4">Task 4</a></li>
            <li><a href="pager.php?q=5">Task 5</a></li>
            <li><a href="pager.php?q=6">Task 6</a></li>
            <li>
                <form action="index.html" method="post">
                    <input type="submit" name="logout" value="Logout">
                </form>
            </li>
        </ul>
    </nav>
</body>
</html>