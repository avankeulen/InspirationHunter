<?php

include_once ('Db.class.php');

class Flag {
    private $post_id;

    public function getPostId()
    {
        return $this->post_id;
    }
    public function setPostId($post_id)
    {
        $this->post_id = $post_id;
    }

    public function flag_post(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("update posts set flag = flag +1 where id = :id");
        $statement->bindValue(":id", $this->getPostId());
        $statement->execute();
    }

}