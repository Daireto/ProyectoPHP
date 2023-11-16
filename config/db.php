<?php
class Database
{
    private static $objeto = null;
    private $conn;

    private $host = 'localhost';
    private $usuario = 'root';
    private $passwd = '';
    private $database = 'parking';

    private function __construct()
    {
        $this->conn = new mysqli($this->host, $this->usuario, $this->passwd, $this->database);

        if ($this->conn->connect_error) {
            die('Connection failed: ' . $this->conn->connect_error);
        }
    }

    public static function connect()
    {
        if (self::$objeto === null) {
            self::$objeto = new self();
        }

        return self::$objeto->conn;
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}