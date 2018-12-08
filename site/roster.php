<!DOCTYPE html>
<html lang="en">
    <?php include_once 'PHP/head.php' ?>
    <body>
        <?php include_once "PHP/header.php"; ?>
		<?php
			include_once 'db.php';
			$currentPlayers = get_current_players();
		?>
		<table>
			<thead>
				<tr>
					<th class="hidden">Id</th>
					<th>Last Name</th>
					<th>First Name</th>
					<th>Age</th>
					<th>Gender</th>
					<th>Shirt Size</th>
					<th>Team Name</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<?php foreach($currentPlayers as $player) { ?>
				<tr>
					<td class="hidden idColumn"><?php echo $player['Id']; ?></th>
					<td><?php echo $player['LastName']; ?></td>
					<td><?php echo $player['FirstName']; ?></td>
					<td><?php echo $player['Age']; ?></td>
					<td><?php $gender = $player['Gender'];
							  if($gender == 1) {
								echo "Male";
							  } else {
								echo "Female";
							  } ?> </td>
					<td><?php echo $player['ShirtSize']; ?></td>
					<td><?php echo $player['Name']; ?></td>
					<td>
						<button>Edit Team</button>
					</td>
					<td>
						<button>Delete Player</button>
					</td>
				</tr>
			<?php } ?>
		</table>
        <?php include_once "PHP/footer.php" ?>
    </body>
</html>