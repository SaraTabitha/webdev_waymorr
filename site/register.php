<!DOCTYPE html>
<html lang="en">
    <?php include_once 'PHP/head.php' ?>
    <body>
        <?php include_once "PHP/header.php" ?>
		<?php
			include_once("db.php");

			if($_SERVER["REQUEST_METHOD"] == "POST") {
    
			  $email = $_POST["email"];
			  $password = $_POST["password"];
			  $retypePassword = $_POST["retypePassword"];
			  $firstName = $_POST["firstName"];
			  $lastName = $_POST["lastName"];
			  $firstName2 = $_POST["firstName2"];
			  $lastName2 = $_POST["lastName2"];
			  $phone = $_POST["phone"];
			  $phone2 = $_POST["phone2"];
			  $address = $_POST["mailingAddress"];
			  $email2 = $_POST["email2"];

			  //TODO verify required fields

			  //TODO verify email

			  //TODO verify password (matches and fulfills requirements)

			  //TODO verify phone numbers
              
			  register_user($email, $password, $firstName, $lastName, $phone, $address, $firstName2, $lastName2, $phone2, $email2);
			}
		?>
        <h1>Registration</h1>
        <a href="login.php"> Go to Login </a>
        <form method="post" action="register.php">
        <label> E-mail: </label>
        <input type="text" name="email" />
        <br>
        <label>Password:</label>
        <input type="password" name="password" />
        <label>Retype Password:</label>
        <input type="password" name="retypePassword" />
        <br>
		<!-- required -->
            <label>First Name:</label>
            <input type="text" name="firstName" />
            <label>Last Name:</label>
            <input type="text" name="lastName" />
            </br>
            <label>Phone Number:</label>
            <input type="text" name="phone"/>
            </br>
            <label>Mailing Address:</label>
            <input type="text" name="mailingAddress"/>
            </br>
            </br>
            <h3>Parent/Guardian 2</h3>
            <label>First Name:</label>
            <input type="text"/ name="firstName2">
            <label>Last Name:</label>
            <input type="text" name="lastName2"/>
            </br>
            <label>Phone Number:</label>
            <input type="text" name="phone2" />
            </br>
            <label>E-mail:</label>
            <input type="text" name="email2"/>
            </br>
            </br>
        <input type="submit" />
        </form>
        <?php include_once "PHP/footer.php" ?>
    </body>
</html>