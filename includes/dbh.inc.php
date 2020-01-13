<?php

class DBConn
{
    private $host = "localhost";
    private $dbname="deb113326_2092822";
    private $uname= "deb113326_2092822";
    private $pwd = "-";
    public $dbconn;

    public function __construct()
    {
        $dbconn = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname,$this->uname,$this->pwd);

    }

    public function getConnection()
    {
        return $dbconn;
    }
}
