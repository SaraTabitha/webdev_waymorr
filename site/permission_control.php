<!DOCTYPE html>
<html lang="en">
    <?php include_once 'PHP/head.php' ?>
<body>
    <?php include_once "PHP/header.php" ?>
	<?php 
		include_once "db.php";
		$users = get_all_users();
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
				<td class="hidden"><?php echo $user['Id'];?></td>
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
					<button class="makeAdmin">Make Admin</button>
				</td>
				<td>
					<button class="makeCoach">Make Coach</button>
				</td>
			</tr>
		<?php } ?>
	</table>
    <?php include_once "PHP/footer.php" ?>
</body>
</html>