<!DOCTYPE html>
<html lang="en">
    <?php include_once 'PHP/head.php' ?>
    <body>
        <?php include_once "PHP/header.php" ?>
		<?php require_once("db.php");  ?>

		<?php
			if(isset($_SESSION['user_id'])){
			?>
				<h1>Team Schedule</h2>
			<?php
				if(isset($_SESSION['isCoach']) && ($_SESSION['isCoach'] === true)){
				//coach
				?>
					 <p>coach view</p>
				<?php
				}
				else{
				//logged in user/admin
				?>
					 <table>
						<tr>
							<th>Team</th>
							<th>Opponent</th>
							<th>Home</th>
							<th>Date & Time</th>
						</tr>
						<?PHP
							$schedule = get_team_schedule();
							foreach($schedule as $row){
								$team_id = $row['TeamId'];
								$opponent = $row['Opponent'];
								$isHome = $row['IsHomeGame'];
								$gameDate = $row['GameDate'];

								$teamName = get_team_from_teamid($team_id);

								?>
									<tr>
										<td><?php echo $teamName; ?></td>
										<td><?php echo $opponent; ?></td>
										<td><?php 
											if($isHome){
												echo "Yes";
											}
											else{
												echo "No";
											}
										?></td>
										<td><?php echo $gameDate; ?></td>
									</tr>
								<?php
							
							}
						?>
					 </table>
				<?php
				
				}
			}
			else{
				redirect("home.php");
			}
		?>
        
        <?php include_once "PHP/footer.php" ?>
    </body>
</html>