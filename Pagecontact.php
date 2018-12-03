<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet"  href="Pagecontact.css">
		<link rel="stylesheet" type="text/css" href="general.css">
		<title>Contact</title>
	</head>

	<?php require "header.html"; ?>
	<body>
		<div id="bloc_page">
			<div id="conteneur">
				<div id="section1">
						<h1>Nos Coordonées:</h1>
					<div class="coordonnées">
						<img src="icone_mail.png" alt="icone_mail" id="icone_mail">
						<div class="mail">mail@hexagon.fr </div>
						<img src="icone_telephone.png" alt="icone_telephone" id="icone_telephone">
						<div class="telephone">0122334455 </div>
					</div>
				</div>
			</div>
				<div id="section2">
					<div id="aside21">
					<p>Pour nous contacter, merci de bien vouloir remplir le formulaire suivant. Notre équipe s'engage à vous répondre dans les plus brefs délais</p>
					</div>
				
				<div id="aside22">
				
					<div><h2>Votre demande</h2></div>
					
					<div class="demande">
					<ul>
						<li><input style="co" type="text" name="Nom" placeholder="Nom"></li>
						<li><input type="text" name="Prénom" placeholder="Prénom"></li>
						<li><input type="text" name="Téléphone" placeholder="Téléphone"></li>
						<li><input type="text" name="Email" placeholder="Email"></li>
						<li><input type="text" name="Ville" placeholder="Ville"></li>
						<li><input type="text" name="Code postal" placeholder="Code postal"></li>

					</ul>	
					<div>
					<input class=Votre_demande type="text" name="Votre_demande">
					</div>
					</div>
				</div>
				</div>
				<div id="section3">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5438.660570749984!2d2.2743411022013524!3d48.82578830679031!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6707980bd3947%3A0xd54fb6c5e1933333!2s10+Rue+de+Vanves%2C+92170+Issy-les-Moulineaux!5e0!3m2!1sfr!2sfr!4v1542127553454" width="480" height="360" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
			</div>
			<?php require "footer.html"; ?>
		</div>
	</body>

</html>
