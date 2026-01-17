<?php
class DB
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'dbs12522068';
    private $db;

    public function __construct($host = null, $username = null, $password = null, $database = null)
    {
        if ($host != null) {
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;
        }
        try {
            $this->db = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->database,
                $this->username,
                $this->password,
                array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8",
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
                )
            );
        } catch (PDOException $e) {
            die("IMPOSSIBLE DE SE CONNECTER A LA BASE DE DONNEE");
        }
    }
    public function query($sql, $data = array())
    {
        $req = $this->db->prepare($sql);
        $req->execute($data);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }
}
class DB2
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'dbs12515927';
    private $db;

    public function __construct($host = null, $username = null, $password = null, $database = null)
    {
        if ($host != null) {
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;
        }
        try {
            $this->db = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->database,
                $this->username,
                $this->password,
                array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8",
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
                )
            );
        } catch (PDOException $e) {
            die("IMPOSSIBLE DE SE CONNECTER A LA BASE DE DONNEE");
        }
    }
    public function query($sql, $data = array())
    {
        $req = $this->db->prepare($sql);
        $req->execute($data);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }
}
