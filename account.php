<?php
    include_once ('inc/session_check.inc.php');
    include_once ('classes/Db.class.php');
    include_once ('classes/User.class.php');
    include_once ('classes/Photo.class.php');

    $u = new User();
    $userDetails = $u->getUserDetails();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>InspirationHunter Profile Page</title>
    <?php include_once ('inc/head.inc.php'); ?>    


</head>
<body>

<?php include_once ('inc/nav.inc.php'); ?>

<section class="content">
    <h1> ACCOUNT </h1>
    <a href="">Edit</a>
    <section class="login-form-wrap2">

        <img class="profilepic" src="img.php" alt="" style="height: 200px;" alt="Profilepic">

        <div class="accountanddiscription">
            <h3 class="accountname"><?php echo $userDetails['username']?></h3>
            <p class="bio">Bio: <?php echo $userDetails['bio'] ?></p>

        </div>

    </section>
</section>



</body>
</html>