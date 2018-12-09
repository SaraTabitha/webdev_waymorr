<!DOCTYPE html>
<html lang="en">
    <?php include_once 'PHP/head.php' ?>
    <body>
        <?php 
			include_once "PHP/header.php";
			if($_SERVER["REQUEST_METHOD"] == "POST") {
				if(isset($_REQUEST['editButton'])) {
					$playerId = $_POST['Id'];
					$newTeamId = $_POST['Team'];
					edit_player_team($playerId, $newTeamId);
				}
				if(isset($_REQUEST['deleteButton'])) {
					$playerId = $_POST['Id'];
					delete_player($playerId);
				}
			}
		?>
		<?php
			include_once 'db.php';
			$currentPlayers = get_current_players();
			$currentTeams = get_current_teams();
		?>
		<table id="playerTable">
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
					<form method = "post" action = "roster.php">
					<td class="hidden idColumn"><input name="Id" value=<?php echo $player['Id']; ?> /></th>
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
					<td>
						<select name="Team">
							<?php foreach($currentTeams as $team) { ?>
							<option value= <?php echo $team['Id'];?>
										<?php if($player['Name'] == $team['Name']) { 
											echo 'selected';
										} ?> 
										> <?php echo $team['Name'];?></option>
							<?php } ?>
						</select>
					</td>
					<td>
						<input type="Submit" name="editButton" value="Edit Team" />
					</td>
					<td>
						<input type="Submit" name="deleteButton" value="Delete Player">
					</td>
					</form>
				</tr>
			<?php } ?>
		</table>
        <?php include_once "PHP/footer.php" ?>
    </body>
</html>