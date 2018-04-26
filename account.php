<?php
    include_once ('inc/session_check.inc.php');
    include_once ('classes/Db.class.php');
    include_once ('classes/User.class.php');
    include_once ('classes/Photo.class.php');
    include_once ('classes/Post.class.php');


    $u = new User();
    $userDetails = $u->getUserDetails();

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

<?php
$post = new Post();
$posts = $post->getPosts($user_id);
?>

<section class="content">
    <h1> ACCOUNT </h1>
    <a href="">Edit</a>
    <section class="login-form-wrap2">

        <img class="profilepic" src="img.php" alt="" style="height: 200px;" alt="Profilepic">

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



</body>
</html>