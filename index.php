<?php
include_once ('inc/session_check.inc.php');
include_once ('classes/Post.class.php');
include_once ('classes/User.class.php');
include_once ('classes/Follow.class.php');
include_once ('classes/Comment.class.php');
include_once ('classes/Flag.class.php');

$u = new User;
$user_id = $u->getUserID();

$f = new Follow();
$followUserID = $f->getfollowUserID($user_id);

$post = new Post();
$posts = $post->getPosts($followUserID);


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
    $c->setComment($comment);
    $c->PlaceComment();
}
// Loop comments in PHP
$comment = new Comment();
$allComments = $comment->GetComments();

if (!empty($_POST['flag'])) {
    $flag = new Flag();
    $flag->setPostId($_POST['flag']);
    $flag->flag_post();
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

    <?php if (!isset($result)): ?>
    <ul class="list">
        <?php while($row = $posts->fetch()) : ?>
            <?php if ($row['flag'] < 3): ?>

            <li class="post" data-id="<?php echo $row['id'];?>" value="<?php echo $row['id'];?>">

                <form action="" method="post" id="flag">
                    <a href="#">
                        <input type="hidden" value="<?php echo $row['id'];?>" name="flag">
                        <input type="submit" value="Flag">
                    </a>
                </form>
                <p>This post has been flagged: <?php echo $row['flag']; ?> time<?php if ($row['flag'] != 1): ?>s<?php endif; ?></p>

                <img src="<?php echo 'images/uploads/'.$row['post_img']; ?>" alt="post_img" width="50px" height="auto">
                <h2><?php echo $row['title']; ?></h2>
                <p><?php echo $row['description']; ?></p>
                <p><?php echo $row['time_set']; ?></p>

                <form action="" method="post">
                    <label for="comment<?php echo $row['id'];?>">Comment:</label>
                    <input type="text" name="comment" id="comment<?php echo $row['id'];?>">
                    <input type="hidden" name="post_id" value="<?= $row['id']; ?>">
                    <input type="submit" value="Send">
                </form>

                <ul>

                    <?php foreach ($allComments as $c): ?>
                    <?php if ($c['post_id'] == $row['id']): ?>
                        <li>
                            <strong><?php echo $c['username']; ?> </strong>
                            <?php echo $c['comment']; ?>
                        </li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </ul>

            </li>

            <?php endif; ?>
        <?php endwhile; ?>
    </ul>
    
    <button class="show-posts">Show more</button>
    <?php endif; ?>
    
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>