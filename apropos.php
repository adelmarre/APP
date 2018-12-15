
	<head>
		<link rel="stylesheet" type="text/css" href="apropos.css">
		<link rel="stylesheet" type="text/css" href="general.css">
		<meta charset="utf-8">
		<title>A propos</title>
	</head>
<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root',''); 
if (isset($_SESSION['id'])) {
  include "header_deco.php"; }
  else {
    include "header_connexion.php";
  }
?>
	<body>
		<link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
		<div class="blocpage">
		<h1>A propos</h1>


			<div class="contenu">
					
						<img src="image/logo dominium.png" alt="Photo de dominium" id="dominium" class="logo_dominium">

						<div class="texte">
							<p>Hexagon est un projet répondant à la demande de Domisep faite à la start-up Dominium (spécialisée en informatique, télécommunications, électronique et traitement du signal) de créer une plate-forme web afin de pouvoir gérer des habitations connectées de particuliers à distance. </br></br>

							Grâce à cette plateforme il vous est possible de gérer les équipements domotiques (radiateurs, climatiseurs, volets roulants, alarmes…) de votre résidence principale (et de vos habitations secondaires) en un clic sans déplacement ! Que ce soit pour régler le chauffage, éteindre une lumière oubliée ou sécuriser votre maison … toutes ces actions vous sont rendues possibles et faciles via votre compte. Il vous est même possible de permettre l’accès à votre espace "Ma maison" avec des fonctionnalités spécifiques à d’autres personnes (membres de votre famille…) en toute simplicité. De plus, notre entreprise vous propose un large choix d'équipement afin de répondre au mieux à votre demande.</br></br>

							Vous êtes intéressé par notre installation? Vous avez des questions ? N’hésitez pas à nous contacter. 
							</p>
						</div>
					
			
			</div>
			<?php require "footer.php"; ?>
		</div>
	
	</body>
	
</html>
