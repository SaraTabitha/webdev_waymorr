<!--
	This page allows an admin to be able to see all users that have an account 
	Admin can also add/remove admin and coaching rights for users
	A user must be logged in and have admin permissions to access this page
-->
<!DOCTYPE html>
<html lang="en">
    <?php include_once 'PHP/head.php' ?>
<body>
    <?php include_once "PHP/header.php" ?>
	<?php 
		include_once "db.php";
		ensure_logged_in();
		if(isset($_SESSION['isAdmin']) == false || $_SESSION['isAdmin'] == false) {
			redirect("home.php", "You do not have permission to view this page");
		}
		$users = get_all_users();
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			if(isset($_REQUEST['makeCoach'])) {
				$userId = $_POST['Id'];
				make_coach($userId);
			} else if(isset($_REQUEST['makeAdmin'])) {
				$userId = $_POST['Id'];
				make_admin($userId);
			} else if(isset($_REQUEST['removeAdmin'])) {
				$userId = $_POST['Id'];
				remove_admin($userId);
			} else if(isset($_REQUEST['removeCoach'])) {
				$userId = $_POST['Id'];
				remove_coach($userId);
			}
			redirect("permission_control.php", "Updated User Successfully");
		}
	?>
    <h1>Permission Control </h1>
	<br />
	<table>
		<thead>
			<tr>
				<th class="hidden">Id</th>
				<th>Last Name</th>
				<th>First Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Parent 2 Last Name</th>
				<th>Parent 2 First Name</th>
				<th>Parent 2 Email</th>
				<th>Parent 2 Phone</th>
				<th>Coach</th>
				<th>Admin</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<?php foreach($users as $user) { ?>
			<tr>
				<form method="post" ACTION="permission_control.php">
				<td class="hidden idColumn"><input name="Id" value=<?php echo $user['Id']; ?> /></th>
				<td><?php echo $user['LastName']; ?></td>
				<td><?php echo $user['FirstName'];?></td>
				<td><?php echo $user['Email'];?></td>
				<td><?php echo $user['PhoneNumber'];?></td>
				<td><?php echo $user['LastName2'];?></td>
				<td><?php echo $user['FirstName2'];?></td>
				<td><?php echo $user['Email2'];?></td>
				<td><?php echo $user['Phone2'];?></td>
				<td><?php 
					if($user['IsCoach']) {
						echo "Yes";
					} else {
						echo "No";
					}
				?></td>
				<td><?php
					if($user['IsAdmin']) {
						echo "Yes";
					} else {
						echo "No";
					}
				?></td>
				<td>
					<?php if($user['IsCoach']) { ?>
					<input type="submit" name="removeCoach" value="Remove Coach"/>
					<?php } else { ?>
					<input type="submit" name="makeCoach" value="Make Coach"/>
					<?php } ?>
				</td>
				<td>
					<?php if($user['IsAdmin']) { ?>
					<input type="submit" name="removeAdmin" value="Remove Admin"/>
					<?php } else { ?>
					<input type="submit" name="makeAdmin" value="Make Admin"/>
					<?php } ?>
				</td>
				</form>
			</tr>
		<?php } ?>
	</table>
    <?php include_once "PHP/footer.php" ?>
</body>
</html>