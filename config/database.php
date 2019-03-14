<?php

class Database
{
    private $dbUser = 'root';
    private $dbPass = '';
    private $dsn = 'mysql:host=localhost;dbname=qarson_db;charset=utf8';

    public function __construct()
    {
        try {
            $conn = new PDO($this->dsn, $this->dbUser, $this->dbPass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            return $conn;
        } catch (PDOException $e) {
            echo "Połączenie nie udane: " . $e->getMessage();
        }
        


    }
}
