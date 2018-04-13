<?php

include_once ('Db.class.php');

class Upload {
    private $image;
    private $description;
    private $user_id;
    private $title;

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

    public function SavePost() {
        $conn = Db::getInstance();
        $statement = $conn->prepare("insert into posts (user_id, description, post_img, title) VALUES (:id, :d, :p, :t)");
        $statement->bindValue(":id", $this->getUserId());
        $statement->bindValue(":d", $this->getDescription());
        $statement->bindValue(":p", $this->getImage());
        $statement->bindValue(":t", $this->getTitle());
        $statement->execute();
        return true;
    }
<<<<<<< HEAD

=======
    
    public function getPosts(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from posts");
        $statement->execute();
        return $statement;
    }
>>>>>>> refs/remotes/origin/Feature-6-loading-20posts
}