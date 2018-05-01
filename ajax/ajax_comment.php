<?php

include_once ('../classes/Comment.class.php');

$comment = new Comment();

try
{
    $comment->setComment($_POST['comment-text']);
    $comment->setPostId($row['id']);
    $comment->setUserId($_SESSION['user_id']);
    $comment->PlaceComment();

    $feedback = [
        'status'    => 'success',
        'text'      => htmlspecialchars($comment->getComment())
    ];
}
catch(Exception $e)
{

}

header('Content-Type: application/json');
echo json_encode($feedback);

?>