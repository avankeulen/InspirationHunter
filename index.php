<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location: login.php');
}

include_once('Db.class.php');
include_once('db.inc.php');


?><!doctype html>
<html lang="en">
<head>
    <?php include_once ('inc/head.inc.php'); ?>
    <title>Home - Inspiration Hunter</title>
</head>
<body>



<?php include_once ('inc/nav.inc.php'); ?>
<?php include_once ('search.php'); ?>


<h1>Welcome <?php echo $_SESSION['username']; ?></h1>

<form action="" method="get">
    <input type="text" name="search">
</form>


<?php foreach( $result as $result ): ?>
    <a href="details.php?watch=<?php echo $result['id']; ?>">
    <?php echo $result["title"];
    echo $result["description"];?>
    </a>
<?php endforeach ?>



</body>
</html>