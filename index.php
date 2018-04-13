<?php
session_start();

include_once('classes/Upload.class.php');

if (!isset($_SESSION['username'])) {
    header('location: login.php');
}

//include_once('Db.class.php');
//include_once('db.inc.php');

$post = new Upload();
$posts = $post->getPosts();
//>>>>>>> refs/remotes/origin/Feature-6-loading-20posts



    if (!empty($_GET)) {
        $conn = Db::getInstance();
        $search = $_GET['search'];

        $stmt = $conn->prepare("SELECT * FROM posts WHERE title LIKE $search");
        $stmt->execute();
        $result = $stmt->fetch();
    }


?><!doctype html>
<html lang="en">
<head>
    <?php include_once ('inc/head.inc.php'); ?>
    <title>Home - Inspiration Hunter</title>
</head>
<body>



<?php include_once ('inc/nav.inc.php'); ?>
<?php //include_once ('search.php'); ?>


<h1>Welcome <?php echo $_SESSION['username']; ?></h1>


<form action="" method="get">
    <input type="text" name="search" placeholder="Search">
</form>



<?php foreach( $result as $result): ?>
    <a href="details.php?watch=<?php echo $result['id']; ?>">
    <?php
        echo $result["title"];
        echo $result["description"];
    ?>
    </a>
<?php endforeach ?>



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