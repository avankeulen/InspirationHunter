<?php
include_once ('classes/Login.class.php');
// test
if (!empty($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = new Login();
    $login->setUsername($username);
    $login->setPassword($password);
    $login->canLogin();
    if (!$login->canLogin()) {
        $error = "";
    }

}

?><!doctype html>
<html lang="en">
<head>
    <title>Login - Inspiration Hunter</title>
    <?php include_once ('inc/head.inc.php'); ?>
    <link rel="stylesheet" href="css/logreg.css">
</head>
<body>


<form action="" method="post" id="logreg_form">
    <img src="images/logotext.svg" alt="">
    <h1>Login</h1>
    <br>
    <?php if (isset($error)): ?>
        <div class="form_error">Username and Password don't match.</div>
    <?php endif; ?>
    <label for="username">Username</label>
    <br>
    <input type="text" name="username" id="username">
    <br>

    <label for="password">Password</label>
    <br>
    <input type="password" name="password" id="password">
    <br>

    <input type="submit" value="Login">
    <br>
    
    <a href="register.php">No account yet? Create account.</a>
</form>



</body>
</html>