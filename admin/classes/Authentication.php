<?php
require_once 'config/Database.php';

class Authentication extends Database
{
    // Admin Authentication
    public function adminLoginById($email, $password)
    {
        $password = sha1($password);
        $sql = "SELECT * FROM `admins` WHERE email = '$email' AND password = '$password'";
        $result = $this->connection->query($sql);
        return $result;
    }
}

?>