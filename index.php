<?php
require('header.php');
?>

<main>
    <?php
    if(isset($_SESSION['uid'])){

        echo "<p>logged in!</p>";
    }else
        {
            echo "<p>not logged in!</p>";
        }
    ?>
</main>

<?php
require('footer.php');
?>
