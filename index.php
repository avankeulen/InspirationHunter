<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location: login.php');
}

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form action="">

    <input type="text">

</form>

<a href="logout.php">Log out.</a>

<h1>Welcome <?php echo $_SESSION['username']; ?></h1>

</body>
</html>