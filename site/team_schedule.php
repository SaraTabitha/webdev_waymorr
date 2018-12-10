<!--
	This is the team schedule page
	A User must be logged in to access this page
	If a User has coach permissions, they are able to add and edit games
-->
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
					if(isset($_REQUEST['addGame'])) {
						$team = $_POST["team"];
						$opponent = $_POST["opponent"];
						$isHome = $_POST["isHome"];
						$date = $_POST["date"];
						$time = $_POST["time"];

						add_scheduled_game($team, $opponent, $isHome, $date, $time);
					}
					if(isset($_REQUEST['sendMessage'])) {
						$team = $_POST['messageTeam'];
						$teamId = get_teamid_from_teamName($team);
						$message = $_POST['message'];
						$message = wordwrap($message,70);
						$emails = get_emails_for_team($teamId);
						if($emails) {
							foreach($emails as $email) {
								$email1 = $email['Email'];
								$email2 = $email['Email2'];
								mail($email1, "Message From Way-Morr", $message);
								if($email2 != "") {
									mail($email2, "Message From Way-Morr", $message);
								}
							}
						} else {
							redirect("team_schedule.php");
						}
					}
				}
				
				?>
					<?php 
						function team_dropdown($selected){
							?>
							<select required name="team">
								<?php
									$team_names = get_current_teams(); // only current season team names
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

						function isHome_dropdown($selected){
							$dropdown_name = "isHome";
							?>
							<select required name="<?= $dropdown_name ?>">
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


					?>
					<h2>Edit Schedule</h2>
					<table>
						<tr>
							<th>Team</th>
							<th>Opponent</th>
							<th>Home</th>
							<th>Date</th>
							<th>Time</th>
							<th>Edit</th>
							<th ></th>
						</tr>
						
						<?php
							$schedule = get_current_team_schedule();
							if($schedule != false){
							
							
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
									<form  method="POST" action="changeSchedule.php">
									<input type="hidden" name="id" value="<?= $game_id ?>"/>
									<tr>
										<td>
										<?php 
										//team name dropdown 
										//game_id -> selected form name
										//teamName -> name that becomes the default value of the dropdown for this row

											team_dropdown($teamName);

										
										?>
										</td>


										<td><?php 
											//opponent text field
											?>
											<input required type="text" name ="opponent" value="<?= $opponent?>"/>
										</td>
										<td><?php 
											//yes or no dropdown
											isHome_dropdown($isHome);
										?></td>
										<td><?php
											//date datepicker
											?>
											<input required type="date" name ="date"  value="<?= $gameDate ?>"/>
										</td>
										<td>
											<input required type="time" name ="time"  value="<?= $gameTime ?>"/>
										</td>
										<td>
											<select required name="action">
												<option value="update">Update</option>
												<option value="delete">Delete</option>
											</select>
											
										</td>
										<td>
											<input type="submit"  value="Submit"/>
										</td>
									</tr>
									</form>
									
								<?php
							
								}
								//end of foreach
						?>
						
					 </table>
					 <?php
						 }else{ //if $schedule is never set
								?>
								</table>
								<p>There are currently no scheduled games.</p>
								
								<?php
							}
					 ?>
					 <!--<input type="submit" value="Save Changes"/>-->

					 
					 <h2>Add Game to Schedule</h2>
					 <form method="POST" action="team_schedule.php">
					 <table>
						<tr>
							<th>Team</th>
							<th>Opponent</th>
							<th>Home</th>
							<th>Date</th>
							<th>Time</th>
							<th ></th>
						</tr>
						<tr>
							<td>
								<select required name="team">
								<?php
									$team_names = get_current_teams(); // only current season team names
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
								<input required type="text" name="opponent" value=""/>
							</td>
							<td>
								<select required name="isHome">
									<option value="true">Yes</option>
									<option value="false">No</option>
								</select>
							</td>
							<td>
								<input required type="date" name ="date"  value=""/>
							</td>
							<td>
								<input required type="time" name ="time"  value=""/>
							</td>
							<td>
								<input  required type="submit" value="Add Game" name="addGame"/>
							</td>

						</tr>
					 </table>
					 </form>
					 <h2>Send Message To Team</h2>
					 <form method="post" action="team_schedule.php">
					 <select required name="messageTeam">
						<?php
							$team_names = get_current_teams(); // only current season team names
							foreach($team_names as $row){
								$t_name = $row['Name'];

								?>
								<option value="<?= $t_name ?>" ><?php echo $t_name; ?></option>
								<?php
							}
						?>
					</select>
					<input type="textarea" required name="message" />
					<input type="submit" value="Send Message" name="sendMessage" />
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
							$schedule = get_current_team_schedule(); //should get schedules only from current season 
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