<?php

require_once 'config/Database.php';

class Applications extends Database
{
    // applications Display Query Here
    public function applicationsDisplay()
    {
        $sql = "SELECT * FROM `applications` ORDER BY id DESC";
        // print_r($sql); die();
        $result = $this->connection->query($sql);
        return $result;
    }

    // applications Add Query Here
    public function applicationsAdd($name, $email, $password, $skills, $experience)
    {
        $sql = "INSERT INTO `applications` (name, email, password, skills, experience) VALUES ('$name', '$email', '$password', '$skills', '$experience')";
        // print_r($_POST); die;
        $result = $this->connection->query($sql);
        return $result;
    }

    // applications Edit & Update Query Here
    // applications Show Query Here
    public function applicationsShowById($id)
    {
        $sql = "SELECT * FROM `applications` WHERE id = '$id'";
        $result = $this->connection->query($sql);
        return $result;
    }

    // applications Update Query Here
    public function applicationsUpdate($id, $categorie, $is_active)
    {
        $sql = "UPDATE `applications` set categorie = '$categorie', is_active = '$is_active' WHERE id = '$id'";
        $result = $this->connection->query($sql);
        return $result;
    }


    // applications Delete Query Here
    public function applicationsDelete($id)
    {
        $sql = "DELETE FROM `applications` WHERE id = '$id'";
        $result = $this->connection->query($sql);
        return $result;
    }

    // Total applications
    public function total_applications(){
        $query = "SELECT * FROM `applications`";
        return $query = $this->connection->query($query);
    }
}