<?php
	session_start();
	require_once('db_credentials.php');

	//Connects to the database
	function db_connect() {
		try {
			$dbh = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_SERVER, DB_USER, DB_PWD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		} catch(PDOException $e) {
			echo "Encountered an error when trying to connect to the db";
			exit();
		}
		return $dbh;
	}

	$db = db_connect();

	//Disconnects from the database
	function db_disconnect() {
		global $db;
		if(isset($db)) {
			$db = null;
		}
	}

	function has_user($email) {
		global $db;
		$pdo = $db;
		$sql = "SELECT Email FROM User WHERE Email LIKE :email";
		$statement = $pdo->prepare($sql);
		$statement->bindParam("email", $email);
		$statement->execute();
		$rows = $statement->fetchAll();;
		if($rows) {
			return true;
		}
		return false;
	}


	function is_password_correct($email, $password) {
		global $db;
		$pdo= $db;
		$sql = "SELECT Id,PHash FROM User WHERE Email LIKE :email";
		$statement = $pdo->prepare($sql);
		$statement->bindParam("email", $email);
		$statement->execute();
		$rows = $statement->fetchAll();
		
		if($rows) {
			foreach($rows as $row) {
				$correct_pwrd = $row["PHash"];
				
				if(strcmp($correct_pwrd, crypt($password, $email)) == 0) {
					return $row["Id"]; //user_id session variable
				} else {
					return false;
				}
			}
		} else {
			return false;
		}

		
	}

	function isCoach($user_id){
		global $db;

		try{
			$pdo = $db;
			$sql = "SELECT `IsCoach` FROM `User` WHERE `Id` LIKE :userid";
			$statement = $pdo->prepare($sql);
			$statement->bindParam("userid", $user_id);
			$statement->execute();
			$result = $statement->fetchAll();

			if($result){
				foreach($result as $row){
					$isCoach = $row['IsCoach'];
					
					if($isCoach === '1'){
						return true;
					}
					else {
						return false;
					}
				}
			
			}
			else{
				return false;
			}
		}
		catch(PDOException $e){
			echo "Failed: " . $e->getMessage(); 
		}
	}

	function isAdmin($user_id){
		global $db;

		try{
			$pdo = $db;
			$sql = "SELECT `IsAdmin` FROM `User` WHERE `Id` LIKE :userid";
			$statement = $pdo->prepare($sql);
			$statement->bindParam("userid", $user_id);
			$statement->execute();
			$result = $statement->fetchAll();

			if($result){
				foreach($result as $row){
					$isAdmin = $row['IsAdmin'];
					
					if($isAdmin === '1'){
						return true;
					}
					else {
						return false;
					}
				}
			
			}
			else{
				return false;
			}
		}
		catch(PDOException $e){
			echo "Failed: " . $e->getMessage(); 
		}
	}

	function ensure_logged_in() {
		if(!isset($_SESSION["name"])) {
			redirect("login.php", "You must log in before you can view that page.");
		}
	}

	function redirect($url, $flash_message = NULL) {
		if($flash_message) {
			$_SESSION["flash"] = $flash_message; 
		}
		header("Location: $url");
		die;
	}

	function register_user($email, $password, $firstName, $lastName, $phone, $address, $firstName2, $lastName2, $phone2, $email2) {
		global $db;
		$pwdHash = crypt($password, $email);

		if($firstName2 != "") {
			//$firstName2 = $db->quote($firstName2); //->quote adds quotes around the input in the db
			//$lastName2 = $db->quote($lastName2);
			if($phone2 != "") {
				//$phone2 = $db->quote($phone2);
			} else {
				//$phone2 = NULL;
			} if($email2 != "") {
				//$email2 = $db->quote($email2);
			} else {
				$email2 = NULL;
			}
		} else {
			$firstName2 = NULL;
			$lastName2 = NULL;
			$phone2 = NULL;
			$address2 = NULL;
		}

		$pdo = $db;
		$sql = "INSERT INTO User (FirstName, LastName, Email, PhoneNumber, PHash, FirstName2, LastName2, Email2, Phone2, IsAdmin, IsCoach) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$statement = $pdo->prepare($sql);
		$params  = [$firstName, $lastName, $email, $phone, $pwdHash, $firstName2, $lastName2, $email2, $phone2, FALSE, FALSE];
		$statement->execute($params);
		
		echo "Success";
	}

	function get_user_info($user_id){
		global $db;

		try{
			$pdo = $db;
			$sql = "SELECT * FROM `User` WHERE `Id` LIKE :userid";
			$statement = $pdo->prepare($sql);
			$statement->bindParam("userid", $user_id);
			$statement->execute();
			$result = $statement->fetchAll();

			return $result;
		}
		catch(PDOException $e){
			echo "Failed: " . $e->getMessage(); 
		}
	}

	function update_contact_info($user_id, $password, $phone, $email, $phone2, $email2){
		global $db;
		$phash = crypt($password, $email); //if email changes then the hash wont be correct when they login again so hash/password has to change along with the email
		try{
			$pdo = $db;
			$sql = "UPDATE `User` SET `PHash`= :phash,`Email`= :email,`PhoneNumber`= :phone,`Email2`= :email2,`Phone2`= :phone2 WHERE `Id` LIKE :userid";
			$statement = $pdo->prepare($sql);
			$statement->bindParam("phash", $phash);
			$statement->bindParam("email", $email);
			$statement->bindParam("phone", $phone);
			$statement->bindParam("email2", $email2);
			$statement->bindParam("phone2", $phone2);
			$statement->bindParam("userid", $user_id);
			$statement->execute();
		}
		catch(PDOException $e){
			echo "Failed: " . $e->getMessage(); 
		}
	}

	function get_team_schedule(){
		global $db;

		try{
			$pdo = $db;
			$sql = "SELECT * FROM `ScheduledGame`";
			$statement = $pdo->prepare($sql);
			$statement->execute();
			$result = $statement->fetchAll();

			if($result){
				return $result;
			}
			else{
				return false;
			}
		}
		catch(PDOException $e){
			echo "Failed: " . $e->getMessage(); 
		}
	}
	function get_team_from_teamid($team_id){
		global $db;

		try{
			$pdo = $db;
			$sql = "SELECT `Name` FROM `Team` WHERE `Id` LIKE :teamid";
			$statement = $pdo->prepare($sql);
			$statement->bindParam("teamid", $team_id);
			$statement->execute();
			$result = $statement->fetchAll();

			if($result){
				foreach($result as $row){
					return $row['Name'];
				}
			}
			else{
				return false;
			}
			
		}
		catch(PDOException $e){
			echo "Failed: " . $e->getMessage(); 
		}
	}
	function get_teamid_from_teamName($team_name){
	 
		global $db;

		try{
			$pdo = $db;
			$sql = "SELECT `Id` FROM `Team` WHERE `Name` LIKE :teamname";
			$statement = $pdo->prepare($sql);
			$statement->bindParam("teamname", $team_name);
			$statement->execute();
			$result = $statement->fetchAll();

			if($result){
				foreach($result as $row){
					return $row['Id'];
				}
			}
			else{
				return false;
			}
			
		}
		catch(PDOException $e){
			echo "Failed: " . $e->getMessage(); 
		}
	}
	function get_all_team_names(){
		global $db;

		try{
			$pdo = $db;
			$sql = "SELECT `Name` FROM `Team`";
			$statement = $pdo->prepare($sql);
			$statement->execute();
			$result = $statement->fetchAll();

			if($result){
				return $result;
			}
			else{
				return false;
			}
			
		}
		catch(PDOException $e){
			echo "Failed: " . $e->getMessage(); 
		}
	}

	function assign_team($age, $gender, $sport) {
		global $db;
		try{
			$pdo = $db;
			$sql = "SELECT Team.Id AS TeamId, TeamType.Name, Season.Id AS SeasonId FROM `Team` INNER JOIN Season ON Season.Id = Team.SeasonId INNER JOIN TeamType ON TeamType.Id = Team.TeamType WHERE (TeamType.Gender = :gender OR TeamType.Gender = 3) AND :age BETWEEN TeamType.LowerAge AND TeamType.UpperAge AND Season.IsCurrent = 1 AND TeamType.Sport = :sport";
			$statement = $pdo->prepare($sql);
			$statement->bindParam("age", $age);
			$statement->bindParam("gender", $gender);
			$statement->bindParam("sport", $sport);
			$statement->execute();
			$result = $statement->fetchAll();

			if($result) {
				foreach($result as $row) {
					return $row;
				}
			} else{
				return false;
			}
		}
		catch(PDOException $e){
			echo "Failed: " . $e->getMessage(); 
		}
	}

	function register_player($firstName, $lastName, $age, $teamId, $gender, $birthdate, $userId, $seasonId, $shirtSize) {
		global $db;
		try{
			$pdo = $db;
			$sql = "INSERT INTO Player (FirstName, LastName, Age, TeamId, Gender, BirthDate, UserId, SeasonId, ShirtSize) VALUES (:firstName, :lastName, :age, :teamId, :gender, :birthdate, :userId, :seasonId, :shirtSize)";
			$statement = $pdo->prepare($sql);
			$statement->bindParam("firstName", $firstName);
			$statement->bindParam("lastName", $lastName);
			$statement->bindParam("age", $age);
			$statement->bindParam("teamId", $teamId);
			$statement->bindParam("gender", $gender);
			$statement->bindParam("birthdate", $birthdate);
			$statement->bindParam("userId", $userId);
			$statement->bindParam("seasonId", $seasonId);
			$statement->bindParam("shirtSize", $shirtSize);
			$statement->execute();
		}
		catch(PDOException $e){
			echo "Failed: " . $e->getMessage(); 
		}
	}

	function get_all_users() {
		global $db;
		try{
			$pdo = $db;
			$sql = "SELECT Id, FirstName, LastName, Email, PhoneNumber, FirstName2, LastName2, Email2, Phone2, IsAdmin, IsCoach FROM User";
			$statement = $pdo->prepare($sql);
			$statement->execute();
			$result = $statement->fetchAll();
			return $result;
		} catch(PDOException $e) {
			echo "Failed to get users: " . $e->getMessage();
		}
	}

	function get_current_players() {
		global $db;
		try{
			$pdo = $db;
			$sql = "SELECT Player.Id, FirstName, LastName, Age, Gender, ShirtSize, Team.Name FROM Player INNER JOIN Team ON Team.Id = Player.TeamId INNER JOIN Season ON Player.SeasonId = Season.Id WHERE Season.IsCurrent = 1 ORDER BY Player.Age ASC";
			$statement = $pdo->prepare($sql);
			$statement->execute();
			$result = $statement->fetchAll();
			return $result;
		} catch(PDOException $e) {
			echo "Failed to get players: " . $e->getMessage();
		}
	}

	function get_current_teams() {
		global $db;
		try{
			$pdo = $db;
			$sql = "SELECT Name, User.FirstName, User.LastName FROM Team INNER JOIN Season ON Season.Id = Team.SeasonId";
			$statement = $pdo->prepare($sql);
			$statement->execute();
			$result = $statement->fetchAll();
			return $result;
		} catch(PDOException $e) {
			echo "Failed to get teams: " . $e->getMessage();
		}
	}

	function add_scheduled_game($team_name, $opponent, $isHome, $date, $time){
		global $db;
		$team_id = get_teamid_from_teamName($team_name); //grabs id # 
		try{
			$pdo = $db;
			$sql = "INSERT INTO ScheduledGame (TeamId, Opponent, IsHomeGame, Date, Time) VALUES (:team_id, :opponent, :isHome, :date, :time)";
			$statement = $pdo->prepare($sql);
			$statement->bindParam("team_id", $team_id);
			$statement->bindParam("opponent", $opponent);
			$statement->bindParam("isHome", $isHome);
			$statement->bindParam("date", $date);
			$statement->bindParam("time", $time);
			$statement->execute();

		}
		catch(PDOException $e){
			echo "Failed: " . $e->getMessage(); 
		}
	
	}
	function update_scheduled_game($id, $team_name, $opponent, $isHome, $date, $time){
		global $db;
		$team_id = get_teamid_from_teamName($team_name); //grabs id # 
	
		try{
			$pdo = $db;
			
			$sql = "UPDATE `ScheduledGame` SET `TeamId`= :team_id,`Opponent`= :opponent,`IsHomeGame`= :isHome,`Date`= :date,`Time`= :time WHERE `Id` LIKE :id";
			$statement = $pdo->prepare($sql);
			$statement->bindParam("id", $id);
			$statement->bindParam("team_id", $team_id);
			$statement->bindParam("opponent", $opponent);
			$statement->bindParam("isHome", $isHome);
			$statement->bindParam("date", $date);
			$statement->bindParam("time", $time);
			$statement->execute();

		}
		catch(PDOException $e){
			echo "Failed: " . $e->getMessage(); 
		}
	}

	function delete_scheduled_game($id){
		global $db;
		try{
			$pdo = $db;
			
			$sql = "DELETE FROM `ScheduledGame` WHERE `Id` LIKE :id";
			$statement = $pdo->prepare($sql);
			$statement->bindParam("id", $id);
			$statement->execute();

		}
		catch(PDOException $e){
			echo "Failed: " . $e->getMessage(); 
		}
	}

	function get_all_players_for_user($userId) {
		global $db;
		try{
			$pdo = $db;
			$sql = "SELECT FirstName, LastName, Team.Name FROM Player INNER JOIN Team ON Team.Id = Player.TeamId INNER JOIN Season ON Player.SeasonId = Season.Id WHERE Season.IsCurrent = 1 AND Player.UserId = :userId";
			$statement = $pdo->prepare($sql);
			$statement->bindParam("userId", $userId);
			$statement->execute();
			$result = $statement->fetchAll();
			return $result;
		} catch(PDOException $e) {
			echo "Failed to get players: " . $e->getMessage();
		}
	}
	function get_all_news(){
		global $db;
		try{
			$pdo = $db;
			$sql = "SELECT * FROM `News` ORDER BY `Date` DESC"; //news will appear from most recent date to least recent
			$statement = $pdo->prepare($sql);
			$statement->execute();
			$result = $statement->fetchAll();
			return $result;

		} catch(PDOException $e) {
			echo "Failed to get players: " . $e->getMessage();
		}
	}

	function delete_player($playerId) {
		global $db;
		try {
			$pdo = $db;
			$sql = "DELETE FROM Player WHERE Id = :playerId";
			$statement = $pdo->prepare($sql);
			$statement->bindParam("playerId", $playerId);
			$statement->execute();
		} catch(PDOException $e) {
			echo "Failed to delete player: " . $e->getMessage();
		}
	}

	function update_players_team($playerId, $newTeamId) {
		global $db;
		try {
			$pdo = $db;
			$sql = "UPDATE Player SET (TeamId = :newTeamId) WHERE Id = :playerId";
			$statement = $pdo->prepare($sql);
			$statement->bindParam("playerId", $playerId);
			$statement->bindParam("newTeamId", $newTeamId);
			$statement->execute();
		} catch(PDOException $e) {
			echo "Failed to update player: " . $e->getMessage();
		}
	}
	function get_urgent(){
	global $db;
		try{
			$pdo = $db;
			$sql = "SELECT * FROM `Urgent`";
			$statement = $pdo->prepare($sql);
			$statement->execute();
			$result = $statement->fetchAll();
			return $result;

		} catch(PDOException $e) {
			echo "Failed to get players: " . $e->getMessage();
		}
	}
	function update_urgent_message($id, $message, $active){
		global $db;
		try {
			$pdo = $db;
			$sql = "UPDATE `Urgent` SET `Message`= :message,`Active`= :active WHERE `id` LIKE :id";
			$statement = $pdo->prepare($sql);
			$statement->bindParam("message", $message);
			$statement->bindParam("active", $active);
			$statement->bindParam("id", $id);
			$statement->execute();
		} catch(PDOException $e) {
			echo "Failed to update player: " . $e->getMessage();
		}
	}

	function get_current_season() {
		global $db;
		try {
			$pdo = $db;
			$sql = "SELECT Year FROM Season WHERE Season.IsCurrent = 1";
			$statement = $pdo->prepare($sql);
			$statement->execute();
			$rows = $statement->fetchAll();
			if($rows) {
				foreach($rows as $row) {
					return $row['Year'];
				}
			} else {
				return false;
			}
		} catch(PDOException $e) {
			echo "Failed to get current season: " . $e->getMessage();
		}
	}

	function create_new_season($year) {
		end_current_season();
		global $db;
		try {
			$pdo = $db;
			$sql = "INSERT INTO Season (Year, IsCurrent) VALUES (:year, 1)";
			$statement = $pdo->prepare($sql);
			$statement->bindParam("year", $year);
			$statement->execute();
		} catch (PDOException $e) {
			echo "Failed to insert new season" . $e->getMessage();
		}
		$team_types = get_all_team_types();
		if($team_types != false) {
			create_teams($team_types, $year);
		}
	}

	function create_teams($teamTypes, $year) {
		global $db;
		foreach($teamTypes as $teamType) {
			try {
				$name = $year . " " . $teamType['Name'];
				$pdo = $db;
				$sql = "INSERT INTO Team (Name, SeasonId, TeamType) VALUES (:name, (SELECT Id FROM Season WHERE IsCurrent = 1), :teamType)";
				$statement = $pdo->prepare($sql);
				$statement->bindParam("name", $name);
				$statement->bindParam(":teamType", $teamType['Id']);
				$statement->execute();
			} catch(PDOException $e) {
				echo "Failed to create new teams" . $e->getMessage();
			}
		}
	}

	function get_all_team_types() {
		global $db;
		try {
			$pdo = $db;
			$sql = "SELECT Id, Name FROM TeamType";
			$statement = $pdo->prepare($sql);
			$statement->execute();
			$rows = $statement->fetchAll();
			if($rows) {
				return $rows;
			} else {
				return false;
			}
		} catch(PDOException $e) {
			echo "Failed to end the current season: " . $e_>getMessage();
		}
	}

	function end_current_season() {
		global $db;
		try {
			$pdo = $db;
			$sql = "UPDATE Season Set IsCurrent = 0 WHERE IsCurrent = 1";
			$statement = $pdo->prepare($sql);
			$statement->execute();
		} catch(PDOException $e) {
			echo "Failed to end the current season: " . $e->getMessage();
		}
	}

	function delete_news($id){
		
		global $db;
		try {
			$pdo = $db;
			$sql = "DELETE FROM `News` WHERE `Id` = :id";
			$statement = $pdo->prepare($sql);
			$statement->bindParam("id", $id);
			$statement->execute();
		} catch(PDOException $e) {
			echo "Failed to update player: " . $e->getMessage();
		}
	}
?>