<?php
include_once("Db.class.php");

class Photo
{
public function getPhoto(){

        $conn =  Db::getInstance();

        $statement = $conn->prepare("select * from users where username= :username");
        $statement->bindValue(":username",$_SESSION['username']);
        $statement->execute();
        $result =  $statement->fetch();
        return $result['user_img'];

    }
}
?>