<?php

include_once ('Db.class.php');

class Like {
    private $user_id;
    private $post_id;


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

    public function likePost() {
        $conn = Db::getInstance();
        $statement = $conn->prepare('insert into likes (user_id, post_id, status) values (:u, :p, 1)');
        $statement->bindValue(":u", $this->user_id);
        $statement->bindValue(":p", $this->post_id);
        $statement->execute();
    }





}

?>