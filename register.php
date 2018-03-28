<?php
include_once ('inc/db.inc.php');
include_once ('classes/User.class.php');

if (!empty($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['password-confirm'];

    if (!empty($username) && $password == $passwordConfirm) {
        $user = new User();
        $user->setUsername($username);
        $user->setPassword($password);
        $user->Save();
    }
}

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
    <label for="username">Username</label>
    <input type="text" name="username" id="username">

    <label for="password">Password</label>
    <input type="password" name="password" id="password">

    <label for="password-confirm">Confirm Password</label>
    <input type="password" name="password-confirm" id="password-confirm">

    <input type="submit">
</form>

<a href="login.php">Already have an account?</a>

</body>
</html>