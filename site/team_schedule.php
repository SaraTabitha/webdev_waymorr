<!DOCTYPE html>
<html lang="en">
    <?php include_once 'PHP/head.php' ?>
    <body>
        <?php include_once "PHP/header.php" ?>

		<?php
			if(isset($_SESSION['user_id'])){
			?>
				<h1>Team Schedule</h2>
			<?php
				if(isset($_SESSION['isCoach']) && ($_SESSION['isCoach'] === true)){
				//coach
				?>
					 <p>coach view</p>
				<?php
				}
				else{
				//logged in user/admin
				?>
					 <p>user/admin view</p>
				<?php
				
				}
			}
			else{
				redirect("home.php");
			}
		?>
        
        <?php include_once "PHP/footer.php" ?>
    </body>
</html>