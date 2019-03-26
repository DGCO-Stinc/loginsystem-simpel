<?php
require('header.php');
require('includes/dbh.inc.php');
if(isset($_POST['register-submit']))
{
    if(isset($_POST['email']))
    {
        $email = strtolower(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    }
    if(isset($_POST['pwd']))
    {
        $pass = md5(filter_var($_POST['pwd'],FILTER_SANITIZE_STRING));
        echo $pass;
    }
    if(isset($_POST['name']))
    {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    }

    global $dbh;
    $query = "SELECT * FROM login WHERE email = ?";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array($email));

    if($stmt->rowCount() > 0){
        echo "account already exists!";
    }
    else{
        $query = "INSERT INTO login (email,pass,name) VALUES (?,?,?)";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array($email,$pass,$name));
    }
}else
    {
    }
?>

<main>
    <form action="" method="post">
        <input type="text" name="email" placeholder="email"><br>
        <input type="text" name="pwd" placeholder="pwd"><br>
        <input type="text" name="name" placeholder="name">
        <input type="submit" name="register-submit" value="register">
    </form>
</main>

<?php
require('footer.php');
?>
