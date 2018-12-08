<!DOCTYPE html>
<html lang="en">
    <?php include_once 'PHP/head.php' ?>
<body>
    <?php include_once "PHP/header.php" ?>
    <?php
        require_once("db.php");
        if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true){

            ?>
            <h1>Edit Home </h1>
            <?php
        }
        else{
            redirect("home.php");
        }
    ?>
    
    
    <?php include_once "PHP/footer.php" ?>
</body>
</html>