<!--
	This page is for a user to register an account for the web site
	A user can enter their own info and also can add the optional info for a spouse if they want a family account
	A user does not need to be logged in to access this page
-->
<!DOCTYPE html>
<html lang="en">
    <?php include_once 'PHP/head.php' ?>
    <body>
        <?php include_once "PHP/header.php" ?>
		<?php
			include_once("db.php");
			$error = "";

			if($_SERVER["REQUEST_METHOD"] == "POST") {
				$error = "";
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

			  if(has_user($email) == true) {
				$error = "There is already a user with that email.";
			  
			  } else if(verify_phone($phone) == false || ($phone2 != "" && verify_phone($phone2) == false)) {
					$error = "Please enter a valid phone number";
			  } else if($email == "" || $password == "" || $retypePassword == "" || $firstName == "" || $lastName == "" || $phone == "" || $address == "") {
			  	  $error = "Please fill in all required fields";
			  } else if($password != $retypePassword) {
			  	  $error = "Please make sure your password matches when you retype it";
			  } else if(verify_password($password) == false) {
					$error = "Your password must be at least 8 characters long and contain a capital letter, a number, and some other character";
			  } else {
					register_user($email, $password, $firstName, $lastName, $phone, $address, $firstName2, $lastName2, $phone2, $email2);
					$_SESSION['user_id'] = get_user_id($email); //sets user_id to the Id in the User table

					if(isCoach($_SESSION['user_id'])){
						$_SESSION['isCoach'] = true;
						
					}
					else{
						$_SESSION['isCoach'] = false;
						
					}

					if(isAdmin($_SESSION['user_id'])){
						$_SESSION['isAdmin'] = true;
						
					
					}
					else{
						$_SESSION['isAdmin'] = false;
						
					}

					redirect("home.php");
			  }
			}

			function verify_email($email) {
				$at = strpos($email, '@');
				if($at == false) {
					return false;
				} else {
					$dot = strpos($email, '.', $at);
					$length = strlen($email);
				}
				return true;
			}

			function verify_phone($phone) {
				$array = str_split($phone);
				foreach($array as $char) {
					if(is_numeric($char) == false && $char != '(' && $char != ')' && $char != '-') {
						return false;
					}
				}
				return true;
			}

			function verify_password($password) {
				$length = 0;
				$hasCapLetter = false;
				$hasNumber = false;
				$hasNonLetterOrNumber = false;
				$array = str_split($password);
				foreach($array as $char) {
					if($char >= 'A' && $char <= 'Z') {
						$hasCapLetter = true;
					} else if(is_numeric($char)) {
						$hasNumber = true;
					} else if($char >= 'a' && $char <= 'z') {
						$hasLetter = true;
					} else {
						$hasNonLetterOrNumber = true;
					}
					$length = $length + 1;
				}
				if($length >= 8 && $hasCapLetter == true && $hasNumber == true && $hasNonLetterOrNumber == true) {
					return true;
				}
				return false;
			}
		?>
        <h1>Registration</h1>
        <a href="login.php"> Go to Login </a>
		<p class="error"><?php echo $error;?></p>
        <form method="post" action="register.php">
        <label> E-mail: </label>
        <input type="email" name="email" required/>
        <br>
        <label>Password:</label>
        <input type="password" name="password" required/>
        <label>Retype Password:</label>
        <input type="password" name="retypePassword" required/>
        <br>
		<!-- required -->
            <label>First Name:</label>
            <input type="text" name="firstName" required/>
            <label>Last Name:</label>
            <input type="text" name="lastName" required/>
            </br>
            <label>Phone Number:</label>
            <input type="text" name="phone" maxlength="12" required/>
            </br>
            <label>Mailing Address:</label>
            <input type="text" name="mailingAddress" required/>
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