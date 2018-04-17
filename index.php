<?php
include_once ('inc/session_check.inc.php');
include_once('classes/Upload.class.php');


$post = new Upload();
$posts = $post->getPosts();


if (!empty($_GET['search'])) {
    include_once ('classes/Search.class.php');

    $search_term = $_GET['search'];
    $test = new Search();
    $test->setSearchTerm($search_term);
    $result = $test->_Search();
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


<?php if (isset($result)): ?>
    <?php foreach($result as $r): ?>
        <a href="details.php?watch=<?php echo $r['title']; ?>"> <?php echo $r["title"]; echo $r['description']; ?> </a>
    <?php endforeach; ?>
<?php endif; ?>



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