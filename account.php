<?php
    include_once ('inc/session_check.inc.php');
    include_once ('classes/Db.class.php');
    include_once ('classes/User.class.php');
    include_once ('classes/Photo.class.php');
    include_once ('classes/Post.class.php');


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
$posts = $post->getPosts($g_userID);
?>
    <a href="">Edit</a>
    <?php
    if($g_userID != $user_id){ ?>
        <a id="btnFollow" href="javascript: followUser();"></a><?php
    }
    ?>

    <section class="login-form-wrap2">

        <img class="profilepic" src="img.php?id=<?php echo $g_userID; ?>" alt="" style="height: 200px;" alt="Profilepic">

        <div class="accountanddiscription">
            <h3 class="accountname"><?php echo $userDetails['username']?></h3>
            <p class="bio">Bio: <?php echo $userDetails['bio'] ?></p>

        </div>


<h2> MY POSTS: </h2>
<ul class="list">
        <?php while($row = $posts->fetch()) : ?>
            <li class="post" data-id="<?php echo $row['id']?>">
            <form action="" method="post">
            <img src="<?php echo 'images/'.$row['post_img'] ?>" alt="post_img" width="50px" height="auto">
                <h2><?php echo $row['title'] ?></h2>
                <p><?php echo $row['description'] ?></p>
                <p><?php echo $row['time'] ?></p>
                <input type="hidden" name="id" value="<?php echo $row['id']?>" />
                <input type="submit" name="delete" value="Delete" />
                </form>
            </li>
        <?php endwhile; ?>
    </ul>


    </section>
</section>

<script   src="https://code.jquery.com/jquery-3.3.1.min.js"   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="   crossorigin="anonymous"></script>

<script>
    function getFollowStatus(followUserID) {
        $.ajax({
            type: "POST",
            url: "http://localhost:8888/project/InspirationHunter/ajax/ajax_getFollowStatus.php",
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
            url: "http://localhost:8888/project/InspirationHunter/ajax/ajax_followuser.php",
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
<script src="js/app.js"></script>

</body>
</html>