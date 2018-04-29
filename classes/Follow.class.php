<?php
include_once ('Db.class.php');
include_once ('User.class.php');

class Follow {

    function getfollowUserID($userID){
        $conn = Db::getInstance();
        $followCheck = $conn->prepare("select followUserID from follow where userID = :userID");
        $followCheck->bindValue(":userID", $userID);
        $followCheck->execute();

        $aantal = $followCheck->rowCount();
        if($aantal > 0){
            $result = $followCheck->fetch();
            $result = $result['followUserID'];
        }else{
            $result = '';
        }

        return $result;
    }

    function getFollowStatus($followUserID){
        $u = new User;
        $userID = $u->getUserID();
        
        $conn = Db::getInstance();
        $followCheck = $conn->prepare("select * from follow where followUserID = :followUserID and userID = :userID ");
        $followCheck->bindValue(":userID", $userID);
        $followCheck->bindValue(":followUserID", $followUserID);
        $followCheck->execute();

        $aantal = $followCheck->rowCount();
        if($aantal == 0){
            $result = "follow";
        }else{
            $result = 'unfollow';
        }

        return $result;
    }

    function followUser($followUserID){
        $u = new User;
        $userID = $u->getUserID();

        if($userID == $followUserID){
            return "ERROR";
            die();
        }
        
        $followStatus = $this->getFollowStatus($followUserID);
        if($followStatus == "follow"){
            $conn = Db::getInstance();
            $followCheck = $conn->prepare("insert into follow VALUES( NULL, :userID, :followUserID )");
            $followCheck->bindValue(":userID", $userID);
            $followCheck->bindValue(":followUserID", $followUserID);
            $result = $followCheck->execute();
        }else{
            $conn = Db::getInstance();
            $followCheck = $conn->prepare("delete from follow where followUserID = :followUserID and userID = :userID ");
            $followCheck->bindValue(":userID", $userID);
            $followCheck->bindValue(":followUserID", $followUserID);
            $result = $followCheck->execute();
        }
        

        if(!$result){
            return "Er is een probleem opgetreden";
        }else{
            return "ok";
        }
    }
}






?>