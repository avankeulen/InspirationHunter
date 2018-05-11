<?php
    include_once ('inc/session_check.inc.php');
    include_once ('classes/Db.class.php');
    include_once ('classes/User.class.php');
    include_once ('classes/Photo.class.php');
    include_once ('classes/Post.class.php');
    include_once ('classes/Comment.class.php');



//    $u = new User();
//    $userDetails = $u->getUserDetails();


// ANDER ACCOUNT KRIJGEN http://localhost:8888/project/InspirationHunter/account.php?userID=16

?>
<?php
$u = new User;
$user_id = $u->getUserID();

if(isset($_POST['delete'])){
    $id = $_POST['id'];
    $conn = Db::getInstance();
    $postDelete = $conn->prepare("delete from posts where id = :id and user_id = :user_id");
    $postDelete->bindValue(":id", $id);
    $postDelete->bindValue(":user_id", $user_id);
    $postDelete->execute();
}

$getUsername = new Post();
$username = $getUsername->postUsername();

$comment = new Comment();
$allComments = $comment->GetComments();
rsort($allComments);

if (!empty($_POST['flag'])) {
    $flag = new Post();
    $flag->setPostId($_POST['flag']);
    $flag->flag_post();
}
// Place a comment in PHP
if (!empty($_POST['comment'])){
    $comment = $_POST['comment'];
    $post_id = $_POST['post_id'];

    $c = new Comment();
    $c->setUserId($user_id);
    $c->setPostId($post_id);
    $c->setUsername($_SESSION['username']);
    $c->setComment($comment);
    $c->PlaceComment();
}


?>

<!DOCTYPE html>
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

    <?php

        $g_userID = $user_id;
        if(isset($_GET['userID'])){
            $g_userID = htmlspecialchars($_GET["userID"]);
        }

        $userDetails = $u->getAccountDetails($g_userID);

        $post = new Post();
        $posts = $post->getCustomPosts($g_userID);

    ?>
   
    <?php
    if($g_userID != $user_id){ ?>
        <a id="btnFollow" href="javascript: followUser();"></a>
    <?php } ?>

    <?php
    if($g_userID == $user_id){ ?>
    <a href="settings.php" id="button-regular">Edit</a>
    <?php } ?>

    <section class="login-form-wrap2">

        <img class="profilepic" src="img.php?id=<?php echo $g_userID; ?>" alt="" style="height: 200px;" alt="Profilepic">

        <div class="accountanddiscription">
            <h3 style="color: grey;">profile</h3>
            <h1 style="font-size: 1.8em; color: grey; margin: 20px 0px 0px 0px;" class="accountname"><?php echo $userDetails['username']?></h1>
            <h1 style="font-size: 1.3em; color: grey; margin: 20px 0px 0px 0px; font-weight: 10;"  class="bio">Bio: <?php echo $userDetails['bio'] ?></h1>

        </div>


<h1 style="font-size: 1.5em;"> MY POSTS </h1>


        <?php include_once ('inc/posts.inc.php'); ?>


    </section>
</section>

<script   src="https://code.jquery.com/jquery-3.3.1.min.js"   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="   crossorigin="anonymous"></script>

<script>
    function getFollowStatus(followUserID) {
        $.ajax({
            type: "POST",
            url: "ajax/ajax_getFollowStatus.php",
            data: {"followUserID"  : followUserID},
            success: function(data){
                document.getElementById("btnFollow").innerHTML = data;
            }
        }); 
    }

    function followUser(){
        var followUserID = (<?php echo $g_userID; ?>);

        $.ajax({
            type: "POST",
            url: "ajax/ajax_followuser.php",// "/ajax/ajax_followuser.php"
            data: {"followUserID"  : followUserID},
            success: function(data){
                if(data != "ok"){
                    alert(data);
                }
                getFollowStatus(followUserID);
            }
        }); 

    }
    getFollowStatus(<?php echo $g_userID; ?>);
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>