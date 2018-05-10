<?php

include_once ('classes/Like.class.php');
include_once ('classes/Comment.class.php');

$l = new Like();
$likes = $l->getLikes();

if (!empty($_GET['like'])) {
    $l = new Like();
    $l->setPostId($_GET['like']);
    $l->setUserId($_SESSION['user_id']);
    $l->likePost();
} else if (!empty($_GET['unlike'])) {
    $l = new Like();
    $l->setPostId($_GET['unlike']);
    $l->setUserId($_SESSION['user_id']);
    $l->unLikePost();
}

$filter = "";

// Loop comments in PHP
$comment = new Comment();
$allComments = $comment->GetComments();
rsort($allComments);

if (!empty($_POST['flag'])) {
    $flag = new Post();
    $flag->setPostId($_POST['flag']);
    $flag->flag_post();
}

?>

<ul class="list">
    <?php while($row = $posts->fetch()) : ?>
        <?php if ($row['flag'] < 3): ?>

            <li class="post" data-id="<?php echo $row['id'];?>" value="<?php echo $row['id'];?>">

                <a href="account.php?userID=<?php echo $row['user_id']; ?>" id="user-link">
                    <?php foreach ($username as $u): ?>
                        <?php if ($row['user_id'] == $u['id']):?>
                            <div id="user-img-div"><img src="images/uploads/avatar/<?php echo $u['user_img']; ?>" alt=""></div>
                            <h3><?php echo $u['username']; ?></h3>
                            <br><p id="time-set"><?php echo $row['time_set']; ?></p>
                   
                              <p class="locationName"><?php 
                               // $adress = $functie("lng", "lat");
                               // echo $adress['city'];
                            
                            ?></p>
                     

                        <?php endif; ?>
                    <?php endforeach; ?>

                </a>

                <form action="" method="post" id="flag">
                    <a href="#">
                        <input type="hidden" value="<?php echo $row['id'];?>" name="flag">
                        <input type="submit" value="Flag" class="flag-btn" data-id="<?php echo $row['id'];?>">
                    </a>
                </form>

                <p class="flag-p">This post has been flagged: <strong class="flag-count"><?php echo $row['flag']; ?></strong> time<?php if ($row['flag'] != 1): ?><span class="s">s</span><?php endif; ?></p>


                <div id="img-div">
                    
                    <!--<a alt="post_img" href="detail.php?watch=" style="background-image: <?php //echo 'images/uploads/'. $row['post-img']; ?> ")></a>-->
                    <figure class="<?php echo $row['filter'] ?>">
                    <img src="<?php echo 'images/uploads/'.$row['post_img']; ?>" alt="post_img" width="50px" height="auto">
                    </figure>
                </div>
                <h2><?php echo $row['title']; ?></h2>
                <p><?php echo $row['description']; ?></p>

                <?php if (isset($likes)):?>
                    <a href="?like=<?php echo $row['id'];?>" class="like-post like">Like</a>
                <?php endif; ?>
                <?php foreach ($likes as $like): ?>
                    <?php if ($like['post_id'] != $row['id']): ?>
                        <a href="?like=<?php echo $row['id'];?>" class="like-post like">Like</a>
                    <?php else: ?>
                        <a href="?unlike=<?php echo $row['id'];?>" class="like-post unlike">Unlike</a>
                    <?php endif; ?>
                <?php endforeach; ?>


                <form action="" method="post" class="comment-form">
                    <label for="comment<?php echo $row['id'];?>"></label>
                    <input type="text" name="comment" id="comment<?php echo $row['id'];?>" class="comment-text" placeholder="Leave a comment...">
                    <input type="hidden" name="post_id" value="<?php echo $row['id']; ?>" class="id_post">
                    <input type="submit" value="COMMENT" class="btn-comment" data-id="<?php echo $row['id'];?>">
                </form>

                <ul class="comment-ul" data-id="<?php echo $row['id']; ?>">
                    <?php foreach ($allComments as $c): ?>
                        <?php if ($c['post_id'] == $row['id']): ?>
                            <li class="comment-li" >
                                <strong><?php echo $c['username']; ?> </strong>
                                <p><?php echo $c['comment']; ?></p>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>

            </li>

        <?php endif; ?>
    <?php endwhile; ?>
</ul>

<button class="show-posts">Show more</button>