<?php
include_once ('inc/session_check.inc.php');
include_once ('classes/Post.class.php');
include_once ('classes/User.class.php');
include_once ('classes/Follow.class.php');
include_once ('classes/Comment.class.php');

$u = new User();
$user_id = $u->getUserID();
$_SESSION['user_id'] = $user_id;

$a = new User();
$allUsers = $a->getAllUsers();

$f = new Follow();
$followUserID = $f->getfollowUserID($user_id);

$post = new Post();
$posts = $post->getAllPosts($followUserID);

$getUsername = new Post();
$username = $getUsername->postUsername();


// SEARCH
if (!empty($_GET['search'])) {
    include_once ('classes/Search.class.php');
    $search_term = $_GET['search'];
    $test = new Search();
    $test->setSearchTerm($search_term);
    $result = $test->_Search();
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



?><!doctype html>
<html lang="en">
<head>
    <?php include_once ('inc/head.inc.php'); ?>
    <title>Home - Inspiration Hunter</title>
</head>
<body>

<?php include_once ('inc/nav.inc.php'); ?>


<section class="content">
    <h1 id="welcome">Welcome, <strong class="username"><?php echo $_SESSION['username']; ?></strong></h1>

    <div>
        <h3 style="font-weight:700; font-size:1.3em;">People to follow</h3>
        <ul id="all-users-list">
            <?php foreach ($allUsers as $a): ?>
            <li id="user-list-item">
                <a href="account.php?userID=<?php echo $a['id']; ?>">
                    <div id="user-img-div">
                        <img src="images/uploads/avatar/<?php echo $a['user_img']; ?>" alt="">
                    </div>
                    <h3><?php echo $a['username']; ?></h3>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <?php if (isset($result)): ?>
        <?php include_once ('inc/search.inc.php'); ?>
    <?php endif; ?>

    <?php if (!isset($result)): ?>
        <h3 style="font-weight:700; font-size:1.3em;">Your feed</h3>
        <?php include_once ('inc/posts.inc.php');?>
    <?php endif; ?>
    
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>