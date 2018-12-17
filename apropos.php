<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="apropos.css">
		<link rel="stylesheet" type="text/css" href="general.css">
		<meta charset="utf-8">
		<title>A propos</title>
	</head>
		<?php if (isset($_SESSION['id'])) {
	include "header_deco.php"; }
	else {
		include "header_connexion.php";
	}
?>
	<body>

		</div

		<link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
		<div class="blocpage">
		<h1>A propos</h1>

		<?php
		session_start();
		$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');
		$sql = "SELECT * FROM  'A_propos' ";
		$reponse = $bdd->query('SELECT * FROM A_propos');
		while ($donnees = $reponse->fetch())
		{
			?>
			<div class="contenu">
			<img src="image/logo dominium.jpg" alt="Photo de dominium" id="dominium" class="logo_dominium">
			<div class="texte">
			<p > <?php echo $donnees['description'] ; 
				?>
			</p>

<?php
}
		?>
		</div

			
						</div>
					
			
			</div>
			<?php require "footer.php"; ?>
		</div>
	
	</body>
	
</html>