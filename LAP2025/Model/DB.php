<?php

namespace Model;


use PDO;

class DB
{

    private static $host = '127.0.0.1:3310';
    private static $user = 'root';
    private static $pass = '';
    private static $dbName = 'lap2025';
    protected $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbName, self::$user, self::$pass);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
}