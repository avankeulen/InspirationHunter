<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location: login.php');
}

?><!doctype html>
<html lang="en">
<head>
    <?php include_once ('inc/head.inc.php'); ?>
    <title>Home - Inspiration Hunter</title>
</head>
<body>

<<<<<<< HEAD

<?php // include_once ('inc/nav.inc.php'); ?>

=======
<form action="">

    <input type="text">

</form>

<a href="logout.php">Log out.</a>
>>>>>>> origin/master

<h1>Welcome <?php echo $_SESSION['username']; ?></h1>



</body>
</html>