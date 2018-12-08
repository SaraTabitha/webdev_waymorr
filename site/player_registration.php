<!DOCTYPE html>
<html lang="en">
    <?php include_once 'PHP/head.php' ?>
    <body>
        <?php include_once "PHP/header.php" ?>
        <?php
			include_once("db.php");

			if($_SERVER["REQUEST_METHOD"] == "POST") {
				$sport = $_POST["sport"];
				$firstName = $_POST["firstName"];
				$lastName = $_POST["lastName"];
				$gender = $_POST["gender"];
				$birthdate = $_POST["birthdate"];
				$shirtSize = $_POST["shirtSize"];

				//TODO Check all fields filled

			}
		?>

        <h1>Player Registration</h2>
        <section>
            <form>
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