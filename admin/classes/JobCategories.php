<?php

require_once 'config/Database.php';

class JobCategories extends Database
{
    // Job categories Display Query Here
    public function jobCategoriesDisplay()
    {
        $sql = "SELECT * FROM `job_categories` ORDER BY id DESC";
        // print_r($sql); die();
        $result = $this->connection->query($sql);
        return $result;
    }

    // Job categories Add Query Here
    public function jobCategoriesDisplayAdd($name)
    {
        $sql = "INSERT INTO `job_categories` (name) VALUES ('$name')";
        // print_r($_POST); die;
        $result = $this->connection->query($sql);
        return $result;
    }


    // Job categories Edit & Update Query Here
    // Job categories Show Query Here
    public function jobCategoriesDisplayShowById($id)
    {
        $sql = "SELECT * FROM `job_categories` WHERE id = '$id'";
        $result = $this->connection->query($sql);
        return $result;
    }

    // Job categories Update Query Here
    public function jobCategoriesDisplayUpdate($id, $name)
    {
        $sql = "UPDATE `job_categories` set name = '$name' WHERE id = '$id'";
        $result = $this->connection->query($sql);
        return $result;
    }


    // Job categories Delete Query Here
    public function jobCategoriesDisplayDelete($id)
    {
        $sql = "DELETE FROM `job_categories` WHERE id = '$id'";
        $result = $this->connection->query($sql);
        return $result;
    }

    // Total Job categories
    public function total_jobCategoriesDisplay()
    {
        $query = "SELECT * FROM `job_categories`";
        return $query = $this->connection->query($query);
    }
}