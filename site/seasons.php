﻿<!DOCTYPE html>
<html lang="en">
    <?php include_once 'PHP/head.php' ?>
<body>
    <?php include_once "PHP/header.php" ?>
	<?php 
		$error = "";
		include_once "db.php"; 
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			$error = "";
			$year = $_POST['year'];
			if($year != "") {
				create_new_season($year);
			} else {
				$error = "Enter all required fields";
			}
		}
	?>
    <h1>Seasons </h1>
	<h3>
	<?php 
		$cur = get_current_season();
		if($cur != false) {
			echo "Current Season: " . $cur;
		} 
	?> 

	<h2>New Season</h2>
	<p class="error"><?php echo $error; ?></p>
	<form method="post" action="seasons.php">
	<label>Year: </label>
            <input type="number" name="year" />
            </br>
            </br>
        <input type="submit" />
	</form>
    <?php include_once "PHP/footer.php" ?>
</body>
</html>