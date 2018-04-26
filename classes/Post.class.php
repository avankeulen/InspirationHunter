<?php

include_once ('Db.class.php');

class Post {
    private $image;
    private $description;
    private $user_id;
    private $title;
    private $time;

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        // Image crop! werkt nog niet...
        /*$size = 400;
        $image_crop = imagecrop($image, ['x' => 0, 'y' => 0, 'width' => $size, 'height' => $size]);
        $image = $image_crop;*/
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $conn = Db::getInstance();
        $statementUser = $conn->prepare("select id from users where username = :username");
        $statementUser->bindValue(":username", $_SESSION['username']);
        $statementUser->execute();
        $user_id = $statementUser->fetchColumn();
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->title;
    }

    public function SavePost() {
        $conn = Db::getInstance();
        $statement = $conn->prepare("insert into posts (user_id, description, post_img, title, time) VALUES (:id, :d, :p, :t, :ti)");
        $statement->bindValue(":id", $this->getUserId());
        $statement->bindValue(":d", $this->getDescription());
        $statement->bindValue(":p", $this->getImage());
        $statement->bindValue(":t", $this->getTitle());
        $statement->bindValue(":ti", $this->getTime());
        $statement->execute();
        return true;
    }
    
    public function getPosts($user_id){
        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from posts where user_id = '".$user_id."'");
        $statement->execute();
        return $statement;
    }
}