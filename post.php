<?php
	session_start();
	require './config/database.php';
	require './config/connexiondb.php';
	// S'il n'y a pas de session alors on ne va pas sur cette page
	$profil_image = $db->query('SELECT User.id, User.login,
									Image.id as id_image, Image.`user_id`,
									Image.image_path, Image.image_name, Image.like,
									Image.creation_date FROM `User`
									INNER JOIN `Image` ON User.id = Image.`user_id`
									WHERE Image.id = "'.$donnees['id_image'].'"');
	$profil_image = $profil_image->fetch();
	if(!isset($profil_image['id_image'])){
		exit;
	}
	if (isset($_SESSION['logged_on']) && isset($_SESSION['id']) && isset($_POST)) {
		extract($_POST);
		$id = $_SESSION['id'];
		$req = $db->prepare('INSERT INTO `Comment` (`user_id`, `id_image`,`description`) VALUES (?, ?, ?)');
		$req->execute(array($id, $image, $com));
		unset($_POST);
	}
?>

<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Mon profil</title>
		<link rel="stylesheet" type="text/css" href="./css/galerie.css">
	<head>
	<body>
		<?php
			$reponse = $db->query('SELECT `Comment`.`id`, `Comment`.`user_id`, Comment.`id_image`,
			`Comment`.`description`, `Comment`.`creation_date`,
			`Image`.`id` as img_id, `Image`.`like`, 
			`Image`.`user_id` as `id_user_img` FROM `Comment`
			INNER JOIN `Image` ON Comment.id_image = `Image`.`id`
			WHERE `Image`.`id`= "'.$profil_image['id_image'].'"');
			$reponse = $reponse->fetchAll();
			$like = $db->query('SELECT img_id, liker_id FROM `like` WHERE img_id = "'.$profil_image['id_image'].'"
								AND liker_id = "'.$_SESSION['id'].'"');
		?>
		<div class="parent_div_container_2">
			<?php echo '<a id="close-img" onclick="hide_modal('.$count.')">&#10006</a>'?>
			<div class="child-post-1">
				<img id="img-post-1" src="<?=$profil_image['image_path']?>">
				<div class="overlay">
					<div class="text-post"><img id="jaime" src="./ressources/img/jaime.png"><?= number_format_short($donnees['like']) ?>
					</div>
				</div>
			</div>
			<div class="child-post-2">
				<center>
					<p width="100%"><?php echo "Posted By: " . $profil_image['login']?></p>
				</center>
				<div id="mega_box">
					<?php
					if (isset($reponse['0']))
					{
						foreach ($reponse as $donnees) {
						?>
						<div id="box"><p style="margin-left: 5px;"><?php echo $donnees['description']?></p>
							<small style="margin-left: 10px;">By: <?=$donnees['user_id']?> at: <?=$donnees['creation_date']?></small>
						</div>
						<br>
					<?php }
					}
					?>
				</div>
				<!---after megabox--->
				<div class="like-comment">
					<?php
						if (isset($_SESSION['logged_on']) && isset($_SESSION['id'])) {
							echo '<form method="post">';
							echo ' <input type="hidden" name="image" value="' . $profil_image["id_image"] . '">';
							echo ' <input type="hidden" name="image" value="' . $count . '">';
							echo ' <textarea cols="4" maxlength="250" name="com" required></textarea>';
							echo ' <input type="submit">';
							echo ' </form>';
						}
						else
							echo '<p>Veuillez vous connecter pour poster un commentaire';
					?>
				</div>
			</div>
		</div>
	</body>
</html>