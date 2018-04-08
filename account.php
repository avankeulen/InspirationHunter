<?php
include_once("classes/Db.class.php");
include_once("classes/User.class.php");

session_start();

if (!isset($_SESSION['username'])) {
    header('location: login.php');
}
$u = new User();
$userDetails = $u->getUserDetails();
    //$u->UserID = $_GET["username"];
   //$userDetails = $u->getUserDetails();
   // $p = new Photo();
   // $p->UserID = $_GET["username"];
    //$profilePhotos = $p->ShowProfilePhotos();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>InspirationHunter Profile Page</title>
    <link rel="stylesheet" href="css/style.css">


</head>
<body>


<section class="login-form-wrap2">

    <img class="profilepic" src="files/profilepics/<?php echo $userDetails['profilpic'] ?>" alt="Profilepic">

    <div class="accountanddiscription">
        <h3 class="accountname"><?php echo $userDetails['username']?></h3>
        <p class="bio">Bio: <?php echo $userDetails['bio'] ?></p>

    </div>
<article class="userPhotos">
    <?php foreach($profilePhotos as $profilePhoto): ?>
       <div>
           <a href="photo.php?postID=<?php echo $profilePhoto['postID']?>"><img src="files/<?php echo $profilePhoto['photo']; ?>" alt=""></a>
           </div>
    <?php endforeach; ?>
</article>
</section>
 

</body>
</html>