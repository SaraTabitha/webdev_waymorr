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

	//Disconnects from the database
	function db_disconnect() {
		global $db;
		if(isset($db)) {
			$db = null;
		}
	}

	$db = $db_connect();

	function is_password_correct($email, $password) {
		global $db;
		$email = $db->quote($email);
		$rows = $db->query("SELECT PHash FROM Users WHERE Email = $email");
		if($rows) {
			foreach($rows as $row) {
				$correct_pwrd = $row["PHash"];
				return strcmp($correct_pwrd, crypt($password, $correct_pwrd));
			}
		} else {
			return FALSE;
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
?>