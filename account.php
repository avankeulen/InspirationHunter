<?php
include_once("classes/Db.class.php");
include_once("classes/User.class.php");
include_once("classes/Photo.class.php");

session_start();

if (!isset($_SESSION['username'])) {
    header('location: login.php');
}
$u = new User();
$userDetails = $u->getUserDetails();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>InspirationHunter Profile Page</title>
    <link rel="stylesheet" href="css/style.css">


</head>
<body>

<h1> ACCOUNT </h1>
<section class="login-form-wrap2">

    <img class="profilepic" src="img.php" alt="" style="height: 200px;" alt="Profilepic">

    <div class="accountanddiscription">
        <h3 class="accountname"><?php echo $userDetails['username']?></h3>
        <p class="bio">Bio: <?php echo $userDetails['bio'] ?></p>

    </div>


</section>
 

</body>
</html>