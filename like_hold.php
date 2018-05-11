<?php

session_start();

include_once ('classes/Like.class.php');

$l = new Like();
$l->setUserId($_SESSION['user_id']);
$allLikes = $l->getLikes();

foreach ($allLikes as $like) {
    $status = $like['status'];

    switch ($status) {
        case 1:
            if ($like['post_id'] == 26) {
                echo "liked";
            } else {
                echo "not this post ";
            }
            break;
        default:
            echo "not Liked";
            break;
    }
}


