<?php

class User {
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
        $settings = [
            "cost" => 12
        ];
        $this->password = password_hash($password, PASSWORD_DEFAULT, $settings);
    }

    public function Save() {
        $conn = new PDO('mysql:host=localhost; dbname=inspiration', 'root', 'root');
        $statement = $conn->prepare("insert into users (username, password) VALUES (:username, :password)");
        $statement->bindValue(":username", $this->username);
        $statement->bindValue(":password", $this->password);
        if($statement->execute()) {
            session_start();
            $_SESSION['username'] = $this->username;
            header('location: index.php');
        } else {
            echo "Something went wrong";
        };
    }

}