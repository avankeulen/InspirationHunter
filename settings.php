<?php
include_once("classes/Db.class.php");
include_once("classes/User.class.php");
session_start();

if (!isset($_SESSION['username'])) {
    header('location: login.php');
}
if(!empty($_POST)){
    $u = new User();
    // $u->Password= $_POST['oldPassword'];
    $username = $_SESSION['username'];
    $newusername = $_POST['username'];
    $bio = $_POST['bio'];
    $user_img = ""; //$_POST['user_img'];
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
    <title>InspirationHunter Settings</title>
    <link rel="stylesheet" href="css/style.css">
	
</head>

<body>

    <section class="login-form-wrap3">

        <form class="password-form" method="POST" action="">
            <label>username :
                <input class="textbox" type="text" name="username" value=<?php echo $user['username'] ?> >
            </label>
            <label>Bio :
                <input class="textbox" type="text" name="bio" value=<?php echo $user['bio'] ?> >
            </label>

            <label for="profilePicture">Mijn profielfoto</label>
            <input type="file" name="profilePicture" id="profilePicture" accept="image/gif, image/jpeg, image/png, image/jpg">
            <img id="imgPreview" src="<?php echo $user['user_img']; ?>" alt=""/>
            </label>

            <label>
                <input class="textbox" type="password" name="newPassword" placeholder="New Password">
            </label>
            <input class="buttonReset" type="submit" value="Reset">
        </form>
    </section> 


</body>

</html>