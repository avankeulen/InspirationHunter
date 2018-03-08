<?php
include_once ('inc/db.inc.php');

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>

<form action="" method="post">
    <label for="email">Email</label>
    <input type="text" name="email" id="email">

    <label for="password">Password</label>
    <input type="password" name="password" id="password">

    <label for="password-confirm">Confirm Password</label>
    <input type="password" name="password-confirm" id="password-confirm">

    <input type="submit">
</form>

<a href="login.php">Already have an account?</a>

</body>
</html>