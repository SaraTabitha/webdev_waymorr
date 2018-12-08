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
            ?>
                <h1>My Profile</h1>
                <h2>Parent/Guardian 1</h2>
                <p><strong>Name: </strong><?php echo $first . " " . $last; ?></p> 
                <h3>Contact Info</h3>
                <p><strong>Phone: </strong><?php echo $phone ?></p>
                <p><strong>Email: </strong><?php echo $email ?></p>
                <br>
                <h2>Parent/Guardian 2</h2>
                <p><strong>Name: </strong><?php echo $first2 . " " . $last2; ?></p> 
                <h3>Contact Info</h3>
                <p><strong>Phone: </strong><?php echo $phone2 ?></p>
                <p><strong>Email: </strong><?php echo $email2 ?></p>
                <br>
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