<!DOCTYPE html>
<html lang="en">
    <?php include_once 'PHP/head.php' ?>
	<?php
			include_once("db.php");

			if($_SERVER["REQUEST_METHOD"] == "POST") {
				$email = $_POST["email"];
				$pwd = $_POST["password"];
				//echo is_password_correct($email, $pwd);
				if(is_password_correct($email, $pwd)) {
					//TODO Set Session variables
					$_SESSION['user_id'] = is_password_correct($email, $pwd); //sets user_id to the Id in the User table
					redirect("home.php");
					?>
					<p><?php echo "Successfully logged in!" ?></p>
					<?php
				} else {?>
					<p>Failed</p>
				<?php }
			}
		?>
    <body>
        <?php include_once "PHP/header.php" ?>
        <h1>Login</h1>
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