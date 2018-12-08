<!DOCTYPE html>
<html lang="en">
    <?php include_once 'PHP/head.php' ?>
    <body>
        <?php include_once "PHP/header.php" ?>
        <?php 
        if(isset($_SESSION['user_id'])){
            ?>
                <h1>My Profile</h1>
                <p>Firstname, lastname</p>
                <p>Registered for... teams</p>
                <h2>Contact Info</h2>
                <p>email@email.com</p> <button>edit email</button>
            <?php
        }
        else{
            redirect("login.php");
        }
        ?>
        
        <?php include_once "PHP/footer.php" ?>
    </body>
</html>