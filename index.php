<?php
include_once ('inc/session_check.inc.php');
include_once ('classes/Post.class.php');

$post = new Post();
$posts = $post->getPosts();


// SEARCH
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


<section class="content">
    <h1 id="welcome">Welcome <strong><?php echo $_SESSION['username']; ?></strong></h1>

    <?php if (isset($result)): ?>
        <?php foreach($result as $r): ?>
            <a href="details.php?watch=<?php echo $r['title']; ?>"> <?php echo $r["title"]; echo $r['description']; ?> </a>
        <?php endforeach; ?>
    <?php endif; ?>


    <ul class="list">
        <?php while($row = $posts->fetch()) : ?>
            <li class="post" data-id="<?php echo $row['id']?>">
                <img src="<?php echo 'images/'.$row['post_img'] ?>" alt="post_img" width="50px" height="auto">
                <h2><?php echo $row['title'] ?></h2>
                <p><?php echo $row['description'] ?></p>
            </li>
        <?php endwhile; ?>
    </ul>
    
    <button class="show-posts">Show more</button>
    
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>