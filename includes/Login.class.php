<?php

class Login
{
    private $email;
    private $pwd;
    private $name;
    private $query_login = "SELECT id,pass FROM testlogin WHERE email = ?";
    private $query_doesuserexist = "SELECT email FROM testlogin WHERE email = ?";
    private $query_register = "INSERT INTO testlogin (email,pass,name) VALUES (?,?,?)";
    private $conn;

    public function __construct()
    {
        require_once("includes/dbh.inc.php");
        $dbconn = new DBConn();
        $this->conn = $dbconn->getConnection();

    }

    public function filterVars()
    {
        $this->email = strtolower(filter_var($_REQUEST['email'],FILTER_VALIDATE_EMAIL));
        $this->pwd = md5(filter_var($_REQUEST['pwd'],FILTER_SANITIZE_STRING));
        if(isset($_REQUEST['name']))
        {
            $this->name = ucwords(filter_var($_REQUEST['name'],FILTER_SANITIZE_STRING));
        }
    }

    public function doRegister()
    {
        $stmt = $this->conn->prepare($this->query_doesuserexist);
        $stmt->execute(array($this->email));
        if($stmt->rowCount()>0)
        {
            exit();
        }else
        {
            $stmt = $this->conn->prepare($this->query_register);
            $stmt->execute(array($this->email,$this->pwd,$this->name));
        }
    }
    
    public function doLogin()
    {
        $stmt = $this->conn->prepare($query_login);
        $stmt->execute(array($this->email,$this->pwd));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if($data['pass'] == $this->pwd)
        {
            session_start();
            $_SESSION['logged_in'] = true;
            $_SESSION['session_id'] = session_id;
            $_SESSION['userID'] = $data['id'];
        }
    }

    public function doLogout()
    {
        session_destroy();
    }
}