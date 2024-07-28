<?php
class Database {
    private $host = 'localhost';
    private $db = 'boiler-template';
    private $user = 'root';
    private $pass = '';
    private $mysqli;
    private static $instance = null;

    private function __construct() {
        $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->mysqli;
    }
}
?>
