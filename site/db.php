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


	function is_password_correct($email, $password) {
		global $db;
		$email = $db->quote($email);
		$password = $db->quote($password);
		$rows = $db->query("SELECT PHash FROM User WHERE Email = $email");
		if($rows) {
			foreach($rows as $row) {
				$correct_pwrd = $row["PHash"];
				if(strcmp($correct_pwrd, crypt($password, $email)) == 0) {
					return true;
				} else {
					return false;
				}
			}
		} else {
			return false;
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

	function register_user($email, $pwdHash, $firstName, $lastName, $phone, $address, $firstName2, $lastName2, $phone2, $email2) {
		global $db;
		$email = $db->quote($email);
		$firstName = $db->quote($firstName);
		$lastName = $db->quote($lastName);
		$phone = $db->quote($phone);
		$address = $db->quote($address);
		$pwdHash = $db->quote($pwdHash);
		if($firstName2 != "") {
			$firstName2 = $db->quote($firstName2);
			$lastName2 = $db->quote($lastName2);
			if($phone2 != "") {
				$phone2 = $db->quote($phone2);
			} else {
				$phone2 = NULL;
			} if($email2 != "") {
				$email2 = $db->quote($email2);
			} else {
				$email2 = NULL;
			}
		} else {
			$firstName2 = NULL;
			$lastName2 = NULL;
			$phone2 = NULL;
			$address2 = NULL;
		}
		$result = $db->query("INSERT INTO User (FirstName, LastName, Email, PhoneNumber, PHash, FirstName2, LastName2, Email2, Phone2, IsAdmin, IsCoach) VALUES ($firstName, $lastName, $email, $phone, $pwdHash, $firstName2, $lastName2, $email2, $phone2, FALSE, FALSE)");
		echo "Success";
	}

?>