<!--
	Logs the user out, ends their session, and sends the user to the home page
-->

<!DOCTYPE html>
<html lang="en">
    <?php include_once 'PHP/head.php' ?>
    <body>
        <?php include_once "PHP/header.php" ?>
        <?php 
        include_once("db.php");

        session_destroy();
        session_regenerate_id(TRUE);
        session_start();
        redirect("home.php");
        ?>
        
        <?php include_once "PHP/footer.php" ?>
    </body>
</html>