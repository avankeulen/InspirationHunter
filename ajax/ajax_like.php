<?php

include_once ('../classes/Like.class.php');

$l = new Like();
$likes = $l->getLikes();

try {
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
} catch (Exception $e) {

}



header('Content-Type: application/json');
echo json_encode($feedback);