<?php

require_once 'config/Database.php';

class Candidates extends Database
{
    // candidates Display Query Here
    public function candidatesDisplay()
    {
        $sql = "SELECT * FROM `candidates` ORDER BY id DESC";
        // print_r($sql); die();
        $result = $this->connection->query($sql);
        return $result;
    }

    // candidates Add Query Here
    public function candidatesAdd($name, $email, $password, $skills, $experience)
    {
        $sql = "INSERT INTO `candidates` (name, email, password, skills, experience) VALUES ('$name', '$email', '$password', '$skills', '$experience')";
        // print_r($_POST); die;
        $result = $this->connection->query($sql);
        return $result;
    }

    // companies email is already registered
    public function emailExists($email)
    {
        $query = "SELECT id FROM candidates WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($this->connection, $query);
        return mysqli_num_rows($result) > 0;
    }

    // candidates Edit & Update Query Here
    // candidates Show Query Here
    public function candidatesShowById($id)
    {
        $sql = "SELECT * FROM `candidates` WHERE id = '$id'";
        $result = $this->connection->query($sql);
        return $result;
    }

    // candidates Update Query Here
    public function candidatesUpdate($id, $categorie, $is_active)
    {
        $sql = "UPDATE `candidates` set categorie = '$categorie', is_active = '$is_active' WHERE id = '$id'";
        $result = $this->connection->query($sql);
        return $result;
    }


    // candidates Delete Query Here
    public function candidatesDelete($id)
    {
        $sql = "DELETE FROM `candidates` WHERE id = '$id'";
        $result = $this->connection->query($sql);
        return $result;
    }

    // Total candidates
    public function total_candidates(){
        $query = "SELECT * FROM `candidates`";
        return $query = $this->connection->query($query);
    }
}