<?php

include_once ('Db.class.php');

class Login {
    private $username;
    private $password;

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function canLogin() {
        $conn = Db::getInstance();
        $statement = $conn->prepare("select password from users where username = :username");
        $statement->bindValue(":username", $this->username);
        $statement->execute();
        $dbPassword = $statement->fetchColumn();
        if (password_verify($this->password, $dbPassword)) {
            session_start();
            $_SESSION['username'] = $this->username;
            header('location: index.php');
        }
    }
}