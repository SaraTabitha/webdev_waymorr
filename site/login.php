<!DOCTYPE html>
<html lang="en">
    <?php include_once 'PHP/head.php' ?>
	<?php
			include_once("db.php");
			$error= "";
			if($_SERVER["REQUEST_METHOD"] == "POST") {
				$error = "";
				$email = $_POST["email"];
				$pwd = $_POST["password"];
				//echo is_password_correct($email, $pwd);
				if(is_password_correct($email, $pwd)) {
					//TODO Set Session variables
					$_SESSION['user_id'] = is_password_correct($email, $pwd); //sets user_id to the Id in the User table

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
					?>
					<p><?php echo "Successfully logged in!" ?></p>
					<?php
				} else {
					$error = "Email or password is incorrect";
				}
			}
		?>
    <body>
        <?php include_once "PHP/header.php" ?>
        <h1>Login</h1>
		<p class="error"><?php echo $error;?></p>

		<a href="register.php"> Go to Registration </a>
        
        <form method="post" action="login.php">
        <label>E-mail:</label>
        <input type="text" name="email"/>
        <label>Password:</label>
        <input type="password" name="password" />
        <br>
        <input type="submit" />
        </form>

        
        <?php include_once "PHP/footer.php" ?>
    </body>
</html>