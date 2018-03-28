<?php
include_once ('inc/db.inc.php');
include_once ('classes/Login.class.php');

if (!empty($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = new Login();
    $login->setUsername($username);
    $login->setPassword($password);
    $login->canLogin();

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

<form action="" method="post">
    <label for="username">Username</label>
    <input type="text" name="username" id="username">

    <label for="password">Password</label>
    <input type="password" name="password" id="password">

    <input type="submit" value="Login">
</form>

<a href="register.php">Create account.</a>

</body>
</html>