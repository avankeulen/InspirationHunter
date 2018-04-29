<?php
include_once ('Db.class.php');
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

}

?>