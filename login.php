<?php
include_once ('inc/db.inc.php');

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

<form action="" method="post">
    <label for="email">Email</label>
    <input type="text" name="password" id="email">

    <label for="password">Password</label>
    <input type="password" name="password" id="password">

    <input type="submit" value="Login">
</form>

<a href="register.php">Create account.</a>

</body>
</html>