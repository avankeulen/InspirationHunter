<?php

include_once ('Db.class.php');

class Comment {
    private $user_id;
    private $post_id;
    private $comment;

    private $username;

    public function getUserId()
    {
        return $this->user_id;
    }
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getPostId()
    {
        return $this->post_id;
    }
    public function setPostId($post_id)
    {
        $this->post_id = $post_id;
    }

    public function getComment()
    {
        return $this->comment;
    }
    public function setComment($comment)
    {
        $this->comment = $comment;
    }



    public function PlaceComment() {
        $conn = Db::getInstance();
        $statement = $conn->prepare("insert into comments (user_id, post_id, comment) values (:u, :p,:c );");
        $statement->bindValue(':u', $this->getUserId());
        $statement->bindValue(':p', $this->getPostId());
        $statement->bindValue(':c', $this->getComment());
        $statement->execute();
    }

    /*public function GetComments(){
        $conn = Db::getInstance();
        $statementComment = $conn->prepare("SELECT * FROM users u inner join comments c on u.id = c.user_id;");
        $statementComment->execute();
        $comments = $statementComment->fetch(PDO::FETCH_ASSOC);
        return $comments;
    }*/

    public function GetComments(){
        $conn = Db::getInstance();
        $statementComment = $conn->prepare("SELECT * FROM comments; ");
        $statementComment->execute();
        $comments = $statementComment->fetchAll(PDO::FETCH_ASSOC);
        return $comments;
    }
    
    /*
    public function getUserComment()
    {
        $conn = Db::getInstance();
        $statementUser = $conn->prepare("SELECT * FROM users u inner join comments c on u.id = c.user_id");
        $statementUser->execute();
        $commentUser = $statementUser->fetchColumn();
        return $commentUser;
    }*/




}