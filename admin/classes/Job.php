<?php

require_once 'config/Database.php';

class Job extends Database
{
    // Job categories Display Query Here
    public function jobDisplay()
    {
        $sql = "SELECT * FROM `jobs` ORDER BY id DESC";
        // print_r($sql); die();
        $result = $this->connection->query($sql);
        return $result;
    }

    // Job categories Add Query Here
    public function jobAdd($company_id, $category_id, $title, $description, $location, $salary, $type, $status)
    {
        $sql = "INSERT INTO `jobs` (company_id, category_id, title, description, location, salary, type, status) VALUES ('$company_id', '$category_id', '$title', '$description', '$location', '$salary', '$type', '$status')";
        // print_r($_POST); die;
        $result = $this->connection->query($sql);
        return $result;
    }


    // Job categories Edit & Update Query Here
    // Job categories Show Query Here
    public function jobDisplayShowById($id)
    {
        $sql = "SELECT * FROM `jobs` WHERE id = '$id'";
        $result = $this->connection->query($sql);
        return $result;
    }

    // Job categories Update Query Here
    public function jobUpdate($id, $name)
    {
        $sql = "UPDATE `jobs` set name = '$name' WHERE id = '$id'";
        $result = $this->connection->query($sql);
        return $result;
    }


    // Job categories Delete Query Here
    public function jobDelete($id)
    {
        $sql = "DELETE FROM `jobs` WHERE id = '$id'";
        $result = $this->connection->query($sql);
        return $result;
    }

    // Total Job categories
    public function total_jobDisplay()
    {
        $query = "SELECT * FROM `jobs`";
        return $query = $this->connection->query($query);
    }
}