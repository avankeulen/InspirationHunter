<?php
session_start();

include_once('classes/Upload.class.php');

if (!isset($_SESSION['username'])) {
    header('location: login.php');
}

$post = new Upload();
$posts = $post->getPosts();

?><!doctype html>
<html lang="en">
<head>
    <?php include_once ('inc/head.inc.php'); ?>
    <title>Home - Inspiration Hunter</title>
</head>
<body>



<?php include_once ('inc/nav.inc.php'); ?>



<h1>Welcome <?php echo $_SESSION['username']; ?></h1>

<?php while($row = $posts->fetch()) : ?>
    <div class="post" data-id="<?php echo $row['id']?>">
        <p><?php echo $row['title'] ?></p>
        <p><?php echo $row['description'] ?></p>
        <img src="<?php echo 'images/'.$row['post_img'] ?>" alt="post_img" width="50px" height="auto">
    </div>
<?php endwhile; ?>
<button class="show-posts">Show more</button>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>