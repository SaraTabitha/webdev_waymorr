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

				/*
				* Handle Add Team Form Submission
				*/
				if($_SERVER["REQUEST_METHOD"] == "POST"){
					$team = $_POST["team"];
					$opponent = $_POST["opponent"];
					$isHome = $_POST["isHome"];
					$date = $_POST["date"];
					$time = $_POST["time"];

					?>
					<p><?= $team ?></p>
					<p><?= $opponent ?></p>
					<p><?= $isHome ?></p>
					<p><?= $date ?></p>
					<p><?= $time ?></p>
					
					<?php
					add_scheduled_game($team, $opponent, $isHome, $date, $time);
				}
				
				?>
					<?php 
						function team_dropdown($dropdown_name, $selected){
							?>
							<select name="<?= $dropdown_name ?>">
								<?php
									$team_names = get_all_team_names();
									foreach($team_names as $row){
										$t_name = $row['Name'];

										?>
										<option value="<?= $t_name ?>" <?php
										if($t_name === $selected){
										echo "selected";
										}
										?>><?php echo $t_name; ?></option>
										<?php
									}
								?>
							</select>
							<?php
						}
						$dropdown_name = "test1";
						$selected = "2019 Junior Fastpitch";
						team_dropdown($dropdown_name, $selected);

						function isHome_dropdown($game_id, $selected){
							$dropdown_name = "isHome".$game_id;
							?>
							<select name="<?= $dropdown_name ?>">
								<option value="true" 
								<?php
								if($selected){
								 echo "selected";
								}
								?>
								>Yes</option>
								<option value="false"
								<?php
								if(!$selected){
									echo "selected";
								}
								?>
								>No</option>
								
							</select>
							<?php
						}
						$game_id = "test1";
						$selected = false;
						isHome_dropdown($game_id, $selected);

					?>
					<table>
						<tr>
							<th>Team</th>
							<th>Opponent</th>
							<th>Home</th>
							<th>Date</th>
							<th>Time</th>
							<th>Delete</th>
						</tr>
						<?PHP
							$schedule = get_team_schedule();
							foreach($schedule as $row){
								$game_id = $row['Id']; //id of the scheduled game
								$team_id = $row['TeamId']; //id# of the team 
								$opponent = $row['Opponent'];
								$isHome = $row['IsHomeGame']; 
								$gameDate = $row['Date'];
								$gameTime = $row['Time'];

								$teamName = get_team_from_teamid($team_id); //string team name

								//form names:
								//team : 'Id'col from the db
								//opponent : 'opponent' . Id
								//isHome: 'isHome' . Id
								//date: 'date' . Id 
								//time: 'time' . Id

								?>
									<tr>
										<td>
										<?php 
										//team name dropdown 
										//game_id -> selected form name
										//teamName -> name that becomes the default value of the dropdown for this row

										team_dropdown($game_id, $teamName);

										
										?>
										</td>


										<td><?php 
											//opponent text field
											?>
											<input type="text" name ="<?php echo "opponent" . $game_id; ?>" value="<?= $opponent?>"/>
										</td>
										<td><?php 
											//yes or no dropdown
											isHome_dropdown($game_id, $isHome);
										?></td>
										<td><?php
											//date datepicker
											?>
											<input type="date" name ="<?php echo "date" . $game_id; ?>"  value="<?= $gameDate ?>"/>
										</td>
										<td>
										<input type="time" name ="<?php echo "time" . $game_id; ?>"  value="<?= $gameTime ?>"/>
										</td>
									</tr>
								<?php
							
							}
						?>
					 </table>
					 <input type="submit" value="Save Changes"/>

					 
					 <h2>Add</h2>
					 <form method="POST" action="team_schedule.php">
					 <table>
						<tr>
							<th>Team</th>
							<th>Opponent</th>
							<th>Home</th>
							<th>Date</th>
							<th>Time</th>
							<th>Delete</th>
						</tr>
						<tr>
							<td>
								<select name="team">
								<?php
									$team_names = get_all_team_names();
									foreach($team_names as $row){
										$t_name = $row['Name'];

										?>
										<option value="<?= $t_name ?>"><?php echo $t_name; ?></option>
										<?php
									}
								?>
							</select>
							</td>
							<td>
								<input type="text" name="opponent" value=""/>
							</td>
							<td>
								<select name="isHome">
									<option value="true">Yes</option>
									<option value="false">No</option>
								</select>
							</td>
							<td>
								<input type="date" name ="date"  value=""/>
							</td>
							<td>
								<input type="time" name ="time"  value=""/>
							</td>
							<td>
								<input type="submit" value="Add Game"/>
							</td>

						</tr>
					 </table>
					 </form>
					 
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
							<th>Date</th>
							<th>Time</th>
							
						</tr>
						<?PHP
							$schedule = get_team_schedule();
							foreach($schedule as $row){
								$game_id = $row['Id'];
								$team_id = $row['TeamId'];
								$opponent = $row['Opponent'];
								$isHome = $row['IsHomeGame'];
								$gameDate = $row['Date'];
								$gameTime = $row['Time'];

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
										<td><?php echo $gameTime; ?></td>
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