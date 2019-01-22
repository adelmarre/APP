<?php session_start();?>
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


		<link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
		<div class="blocpage">
		<img src="image/logo dominium.png" alt="Photo de dominium" id="dominium" class="logo_dominium">
		<?php
	
		$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','',array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
		$sql = "SELECT * FROM  'a_propos' ";
		$reponse = $bdd->query('SELECT * FROM a_propos');
		while ($donnees = $reponse->fetch())
		{
			?>
			<div class="contenu">
			
			<div class="texte">
			<p > <?php echo $donnees['description'] ; 
				?>
			</p>

<?php
}
		?>
			</div>

			
			</div>
					
		
		</div>
			<?php require "footer.php"; ?>
		
	
	</body>
	
</html>