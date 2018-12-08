<!DOCTYPE html>
<html lang="en">
    <?php include_once 'PHP/head.php' ?>
    <body>
        <?php include_once "PHP/header.php" ?>
        <?php 
        include_once("db.php");
        if(isset($_SESSION['user_id'])){

            $arr = get_user_info($_SESSION['user_id']);
            $first;
            $last;

            foreach($arr as $row) {
                $first = $row["FirstName"];
                $last = $row["LastName"];
                $email = $row["Email"];
                $phone = $row["PhoneNumber"];


                $first2 = $row["FirstName2"];
                $last2 = $row["LastName2"];
                $email2 = $row["Email2"];
                $phone2 = $row["Phone2"];
				
            }

            if($_SERVER["REQUEST_METHOD"] == "POST"){
                //if contact info is edited
                
                $password = $_POST["pass"];

                if(is_password_correct($email, $password)) {
                    $phone = $_POST["phone"];
                    $email = $_POST["email"];
                    $phone2 = $_POST["phone2"];
                    $email2 = $_POST["email2"];
                    update_contact_info($_SESSION['user_id'], $password, $phone, $email, $phone2, $email2);
                }
                else{
                    ?>
                    <p>Password is incorrect.</p>
                    <?php
                }
            }

            
            
            
            ?>
                <form method="POST" action="my_profile.php">
                    <h1>My Profile</h1>
                    <h2>Parent/Guardian 1</h2>
                    <p><strong>Name: </strong><?php echo $first . " " . $last; ?></p> 
                    <h3>Contact Info</h3>
                    <label for="phone"><strong>Phone: </strong></label><input name="phone" type="text" value="<?php echo $phone; ?>">
                    <label for="email"><strong>Email: </strong></label><input name="email" type="text" value="<?php echo $email; ?>">
                    <br>
                    <h2>Parent/Guardian 2</h2>
                    <p><strong>Name: </strong><?php echo $first2 . " " . $last2; ?></p> 
                    <h3>Contact Info</h3>
                    <label for="phone2"><strong>Phone: </strong></label><input name="phone2" type="text" value="<?php echo $phone2; ?>">
                    <label for="email2"><strong>Email: </strong></label><input name="email2" type="text" value="<?php echo $email2; ?>">
                    <br>
                    <br>
                    <label for="pass"><strong>Password: </strong></label><input name="pass" type="password">
                    <br>
                    <input type="submit" value="Edit Contact Info" />
                </form>
                <h2>Registered Players</h2>
                <p>players...</p>
                <p>Registered for... teams</p>
            <?php
        }
        else{
            redirect("login.php");
        }
        ?>
        
        <?php include_once "PHP/footer.php" ?>
    </body>
</html>