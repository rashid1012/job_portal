<?php

class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "job_portal_db";

    public $connection;

    public function __construct()
    {
        if (!isset($this->connection)) {
            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

            if (!$this->connection) {
                echo "Cannot connect to database server";
                die;
            }
        }
        return $this->connection;
    }
}
