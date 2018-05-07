<?php
include_once("classes/Db.class.php");
include_once("classes/User.class.php");
session_start();

// NOG TIMESTAMP TOEVOEGEN!!

if (!isset($_SESSION['username'])) {
    header('location: login.php');
}
if(!empty($_POST)){
    $fotonaam = $_FILES['profilePicture']['tmp_name'];
    $foto = file_get_contents($fotonaam);
    
    $u = new User();
    // $u->Password= $_POST['oldPassword'];
    $username = $_SESSION['username'];
    $newusername = $_POST['username'];
    $bio = $_POST['bio'];
    $user_img = $foto;
    $newpassword = "";
    if(!empty($_POST['newPassword'])) {
        $newpassword = $_POST['newPassword'];
    }

    $result = $u->changeSettings($username, $newusername, $bio, $user_img, $newpassword);
    if($result === true){
        //echo "De gegevens zijn succesvol aangepast, gelieve terug in te loggen met de nieuwe gegevens";
        session_destroy();
        header('location: login.php');
    }else{
        echo $result;
    }
}
$conn =  Db::getInstance();
$statement = $conn->prepare("SELECT * FROM users WHERE username = '" .$_SESSION['username']."'");
//$statement->bindValue(":username",$this->username);
$statement->execute();
if( $statement->rowCount() > 0){
	$user = $statement->fetch(); // array van resultaten opvragen
}


?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include_once ('inc/head.inc.php'); ?>
    <title>InspirationHunter Settings</title>
    <link rel="stylesheet" href="css/style.css">
	
</head>

<body>
<?php include_once ('inc/nav.inc.php'); ?>

<h1> Pas account aan:  </h1>

<div style="margin:20px 10px 10px 10px; padding:25px;border-radius:7px;background-color:rgba(93,180,205,0.25);box-shadow: 0 2px 3px rgba(0,0,0,.16);color:#0781ad;border:solid 1px #0781ad;opacity:0.66;">
    Warning: Editing your account will require us to automatically log you in again! 
</div>

    <section class="login-form-wrap3" class="content" >

        <form class="password-form" method="POST" action="" enctype="multipart/form-data" id="upload-form">
            <label>username :
                <input class="textbox" type="text" name="username" value=<?php echo $user['username'] ?> >
            </label><br />
            <label>Bio :
                <input class="textbox" type="text" name="bio" value=<?php echo $user['bio'] ?> >
            </label><br />

            <label for="profilePicture">Mijn profielfoto</label>
            <input type="file" name="profilePicture" id="profilePicture" accept="image/gif, image/jpeg, image/png, image/jpg"><br />
            <img id="imgPreview" src="img.php" alt="" style="height: 200px;" />
            </label><br />

            <label>New password: 
                <input class="textbox" type="password" name="newPassword" placeholder="New Password">
            </label><br /><br />
            <input class="buttonReset" type="submit" value="Pas gegevens aan">
        </form>
    </section> 


</body>

</html>