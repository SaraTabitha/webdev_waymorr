<header>
            <div id="logo">
            <h1 id="way_morr" class="sport_font">WAY-MORR</h1>
            <h2 id="youth_sports" class="sport_font">YOUTH SPORTS</h2>
            <?php
			 
			include_once("db.php");
            if(isset($_SESSION['user_id'])){
                //if user is logged in
                ?>
                <a id="logout" class="sport_font" href="logout.php">Logout</a> 
                <?php
            }
            else{
                ?>
                 <a id="login" class="sport_font" href="login.php">Login</a> 
                <?php
            }
            ?>
            </div>
			<?php

			if(isset($_SESSION['isAdmin']) && ($_SESSION['isAdmin'] === true)){
			//if the user is an admin
			?>
				<nav id="menu">
					<ul >
						<li><a class="sport_font" href="home.php">Home</a></li>
						<li><a class="sport_font" href="about_us.php">About Us</a></li>
						<li><a id="baseball" class="sport_font">Baseball</a>
							<div id="baseball-submenu" class="submenu menu-invisible">
								<a class="sport_font" href="peanuts.php">Peanuts</a>
								<a class="sport_font" href="grade_school_girls_softball.php">Grade School Girls Softball</a>
								<a class="sport_font" href="pee_wees.php">Pee Wees</a>
								<a class="sport_font" href="junior_fastpitch_softball.php">Junior Fastpitch Softball</a>
								<a class="sport_font" href="ponys.php">Ponys</a>
								<a class="sport_font" href="senior_fastpitch.php">Senior Fastpitch</a>
								<a class="sport_font" href="colts.php">Colts</a>
							</div>
						</li>
						<li><a id="flag-football" class="sport_font">Flag Football</a>
							<div id="flag-football-submenu" class="submenu menu-invisible">
								<a class="sport_font" href="junior_division.php">Junior Division</a>
								<a class="sport_font" href="senior_division.php">Senior Division</a>
							</div>
						</li>
						<li><a class="sport_font" href="player_registration.php">Player Registration</a></li>

						<!-- logged in pages -->
						<li><a id="team" class="sport_font">Team</a>
							<div id="team-submenu" class="submenu   menu-invisible">
								<a class="sport_font" href="roster.php">Roster</a>
								<a class="sport_font" href="team_schedule.php">Team Schedule</a>
							</div>
						</li>
						<li><a class="sport_font" href="my_profile.php">My Profile</a></li>
						<li><a id="settings" class="sport_font">Settings</a>
							<div id="settings-submenu" class="submenu   menu-invisible">
								<a class="sport_font" href="edit_home.php">Edit Home</a>
								<a class="sport_font" href="permission_control.php">Permission Control</a>
								<a class="sport_font" href="seasons.php">Seasons</a>
							</div>
						</li>
					</ul>
				</nav>
			<?php
			}
			else if(isset($_SESSION['isCoach']) && ($_SESSION['isCoach'] === true)){
			//if the user is a coach
			?>
				<nav id="menu">
						<ul >
							<li><a class="sport_font" href="home.php">Home</a></li>
							<li><a class="sport_font" href="about_us.php">About Us</a></li>
							<li><a id="baseball" class="sport_font">Baseball</a>
								<div id="baseball-submenu" class="submenu menu-invisible">
									<a class="sport_font" href="peanuts.php">Peanuts</a>
									<a class="sport_font" href="grade_school_girls_softball.php">Grade School Girls Softball</a>
									<a class="sport_font" href="pee_wees.php">Pee Wees</a>
									<a class="sport_font" href="junior_fastpitch_softball.php">Junior Fastpitch Softball</a>
									<a class="sport_font" href="ponys.php">Ponys</a>
									<a class="sport_font" href="senior_fastpitch.php">Senior Fastpitch</a>
									<a class="sport_font" href="colts.php">Colts</a>
								</div>
							</li>
							<li><a id="flag-football" class="sport_font">Flag Football</a>
								<div id="flag-football-submenu" class="submenu menu-invisible">
									<a class="sport_font" href="junior_division.php">Junior Division</a>
									<a class="sport_font" href="senior_division.php">Senior Division</a>
								</div>
							</li>
							<li><a class="sport_font" href="player_registration.php">Player Registration</a></li>

							<!-- logged in pages -->
							<li><a id="team" class="sport_font">Team</a>
								<div id="team-submenu" class="submenu   menu-invisible">
									<a class="sport_font" href="team_schedule.php">Team Schedule</a>
								</div>
							</li>
							<li><a class="sport_font" href="my_profile.php">My Profile</a></li>
						</ul>
					</nav>

			<?php
			}
			else if(isset($_SESSION['user_id'])){
			//user that is logged in (but is not a coach or admin)
			?>
				<nav id="menu">
						<ul >
							<li><a class="sport_font" href="home.php">Home</a></li>
							<li><a class="sport_font" href="about_us.php">About Us</a></li>
							<li><a id="baseball" class="sport_font">Baseball</a>
								<div id="baseball-submenu" class="submenu menu-invisible">
									<a class="sport_font" href="peanuts.php">Peanuts</a>
									<a class="sport_font" href="grade_school_girls_softball.php">Grade School Girls Softball</a>
									<a class="sport_font" href="pee_wees.php">Pee Wees</a>
									<a class="sport_font" href="junior_fastpitch_softball.php">Junior Fastpitch Softball</a>
									<a class="sport_font" href="ponys.php">Ponys</a>
									<a class="sport_font" href="senior_fastpitch.php">Senior Fastpitch</a>
									<a class="sport_font" href="colts.php">Colts</a>
								</div>
							</li>
							<li><a id="flag-football" class="sport_font">Flag Football</a>
								<div id="flag-football-submenu" class="submenu menu-invisible">
									<a class="sport_font" href="junior_division.php">Junior Division</a>
									<a class="sport_font" href="senior_division.php">Senior Division</a>
								</div>
							</li>
							<li><a class="sport_font" href="player_registration.php">Player Registration</a></li>

							<!-- logged in pages -->
							<li><a id="team" class="sport_font">Team</a>
								<div id="team-submenu" class="submenu   menu-invisible">
									<a class="sport_font" href="team_schedule.php">Team Schedule</a>
								</div>
							</li>
							<li><a class="sport_font" href="my_profile.php">My Profile</a></li>
						</ul>
					</nav>

			<?php

			}
			else{
			//site visitor (not logged in)
			
			?>
				<nav id="menu">
					<ul >
						<li><a class="sport_font" href="home.php">Home</a></li>
						<li><a class="sport_font" href="about_us.php">About Us</a></li>
						<li><a id="baseball" class="sport_font">Baseball</a>
							<div id="baseball-submenu" class="submenu menu-invisible">
								<a class="sport_font" href="peanuts.php">Peanuts</a>
								<a class="sport_font" href="grade_school_girls_softball.php">Grade School Girls Softball</a>
								<a class="sport_font" href="pee_wees.php">Pee Wees</a>
								<a class="sport_font" href="junior_fastpitch_softball.php">Junior Fastpitch Softball</a>
								<a class="sport_font" href="ponys.php">Ponys</a>
								<a class="sport_font" href="senior_fastpitch.php">Senior Fastpitch</a>
								<a class="sport_font" href="colts.php">Colts</a>
							</div>
						</li>
						<li><a id="flag-football" class="sport_font">Flag Football</a>
							<div id="flag-football-submenu" class="submenu menu-invisible">
								<a class="sport_font" href="junior_division.php">Junior Division</a>
								<a class="sport_font" href="senior_division.php">Senior Division</a>
							</div>
						</li>
					</ul>
				</nav>
			<?php

			}//end of else
			?>


			
            
</header>
<div id="content">
