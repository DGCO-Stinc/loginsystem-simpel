<?php
require('header.php');
require('includes/dbh.inc.php');

if(isset($_POST['login-submit']))
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

    global $dbh;
    $query = "SELECT * FROM `login` WHERE email = ? AND pass = ?";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array($email,$pass));

    if($stmt->rowCount() > 0)
    {
        session_start();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['uid'] = $row['id'];
        header('Location: index.php');
    }else{
        echo "couldn't login!";
    }
}else{}

?>

<main>
    <form action="" method="post">
        <input type="text" name="email" placeholder="email"><br>
        <input type="text" name="pwd" placeholder="pwd">
        <input type="submit" name="login-submit" value="login">
    </form>
</main>

<?php
require('footer.php');
?>