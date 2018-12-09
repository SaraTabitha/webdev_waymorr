<!DOCTYPE html>
<html lang="en">
    <?php include_once 'PHP/head.php' ?>
    <body>
        <?php include_once "PHP/header.php" ?>
		<h1>Welcome</h1>
		<span id="urgentMessage"></span>
		<?php 
			require_once("db.php");
			$news = get_all_news();
			foreach($news as $row){
				$title = $row['Title'];
				$date = $row['Date'];
				$content = $row['Content'];
				$img_url = $row['Url'];

				?>
				<div>
				<h2><?= $title ?></h2>
				<p><em><?= $date ?></em></p>
				<?php
				if($img_url != null){
					?>
					<img src="<?= $img_url ?>"/>
					<?php
				}
				?>
				<p><?= $content ?></p>
				</div>
				<?php
			
			}
		?>
        <!--<p>*updateable by admin</p>
        <p>*images that will be uploaded by admin</p>-->
        <?php include_once "PHP/footer.php" ?>
    </body>
</html>