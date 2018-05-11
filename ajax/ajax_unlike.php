<?php

include_once ('../classes/Like.class.php');

$l = new Like();

try {

    $l->setPostId($_POST['post_id']);
    $l->setUserId($_POST['user_id']);
    $l->unLikePost();

    $feedback = [
        'status' => 'unliked'
    ];

} catch (Exception $e) {
    die("Something went wrong.");
}


header('Content-Type: application/json');
echo json_encode($feedback);