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
				$sport = $_POST["sport"];
				$firstName = $_POST["firstName"];
				$lastName = $_POST["lastName"];
				$gender = $_POST["gender"];
				$birthdate = $_POST["birthdate"];
				$age = $_POST["age"];
				$shirtSize = $_POST["shirtSize"];
				if($sport == "" || $firstName == "" || $lastName == "" || $gender == "" || $birthdate == "" || $shirtSize == "") {
					$error = "Please fill in all required fields";
				} else {
					if($age > 18) {
						$error = "Sorry. A player must be 18 years old or younger in order to play on a team";
					} else {
						echo $gender . " ";
						if($gender == "Male") {
							$gender = 1;
						} else {
							$gender = 2;
						} if($sport == "baseball") {
							$sport = 1;
						} else {
							$sport = 2;
						}
						echo $sport . " ";
						$team = assign_team($age, $gender, $sport);
						$team_id = $team['TeamId'];
						$name = $team['Name'];
						$seasonId = $team['SeasonId'];
						echo $team_id . " " . $name . " " . $seasonId . " ";
						register_player($firstName, $lastName, $age, $team_id, $gender, $birthdate, $_SESSION['user_id'], $seasonId, $shirtSize);
					}
				}
				

			}
			
		?>

        <h1>Player Registration</h2>
		<p><?php echo $error; ?> </p>
        <section>
            <form method="post" action="player_registration.php">
            <!-- required -->
            <h3>Player Information</h3>
			<select name="sport">
				<option value="baseball">Baseball</option>
				<option value="football">Football</option>
			</select> <br/>
            <label>First Name:</label>
            <input type="text" name="firstName"/>
            <label>Last Name:</label>
            <input type="text"/ name="lastName">
            </br>
            <label>Gender:</label>
            <select name="gender">
				<option value="Male">Male</option>
				<option value="Female">Female</option>
			</select>
            </br>
            <label>Birthdate:</label>
            <input type="date" name="birthdate"/>
            </br>
			<label>Age As Of 6/1:</label>
			<input type="number" name="age" /> <br/>
            <label>Shirt size:</label>
            <select name="shirtSize">
				<option value="YS">Youth Small</option>
				<option value="YM">Youth Medium</option>
				<option value="YL">Youth Large</option>
				<option value="AS">Adult Small</option>
				<option value="AM">Adult Medium</option>
				<option value="AL">Adult Large</option>
				<option value-"AXL">Adult Extra Large</option>
			</select>

            <!-- TODO: allow user to add players to sign up more than one kid at a time -->
            </br>
            </br>
            <input type="submit">
            </form>
        </section>
        <?php include_once "PHP/footer.php" ?>
    </body>
</html>