<?php

require_once 'config/Database.php';

class Companies extends Database
{
    // companies Display Query Here
    public function companiesDisplay()
    {
        $sql = "SELECT * FROM `companies` ORDER BY id DESC";
        // print_r($sql); die();
        $result = $this->connection->query($sql);
        return $result;
    }

    // companies Add Query Here
    public function companiesAdd($name, $email, $password, $website, $location, $description)
    {
        $password = sha1($password);
        $sql = "INSERT INTO `companies` (name, email, password, website, location, description) VALUES ('$name', '$email', '$password', '$website', '$location', '$description')";
        // print_r($_POST); die;
        $result = $this->connection->query($sql);
        return $result;
    }

    // companies email is already registered
    public function emailExists($email)
    {
        $query = "SELECT id FROM companies WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($this->connection, $query);
        return mysqli_num_rows($result) > 0;
    }


    // companies Edit & Update Query Here
    // companies Show Query Here
    public function companiesShowById($id)
    {
        $sql = "SELECT * FROM `companies` WHERE id = '$id'";
        $result = $this->connection->query($sql);
        return $result;
    }

    // companies Update Query Here
    public function companiesUpdate($id, $categorie, $is_active)
    {
        $sql = "UPDATE `companies` set categorie = '$categorie', is_active = '$is_active' WHERE id = '$id'";
        $result = $this->connection->query($sql);
        return $result;
    }


    // companies Delete Query Here
    public function companiesDelete($id)
    {
        $sql = "DELETE FROM `companies` WHERE id = '$id'";
        $result = $this->connection->query($sql);
        return $result;
    }

    // Total companies
    public function total_companies()
    {
        $query = "SELECT * FROM `companies`";
        return $query = $this->connection->query($query);
    }
}
