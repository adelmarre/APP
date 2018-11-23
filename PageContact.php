<?php
if(isset($_POST['mailform']))
{
	if(!empty($_POST['Nom']) AND !empty($_POST['Prenom']) AND !empty($_POST['Telephone']) AND !empty($_POST['Email']) AND !empty($_POST['Ville']) AND !empty($_POST['Codepostal']) AND !empty($_POST['Votre_demande']))
	{

	}
	else
	{
		$msg='Tous les champs doivent être complétés !';
	}

}



?>
<html>
<link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet"  href="Pagecontact.css">
		<title>Contact</title>
	</head>
	<body>
		<div id="bloc_page">
			<header>
				<img src="logo hexagon.png" alt="logo Hexagon" id="logo_hexagon">
				<nav>
					<ul>
						<li><a href="#">Ma maison</a></li>
						<li><a href="catalogue.html">Catalogue</a></li>
						<li><a href="apropos.html">A Propos</a></li>
						<li><a href="aide.html">Aide</a></li>
						<li><a href="">Consignes Globales</a></li>
					</ul>
				</nav>
			</header>
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
						<form method="POST" action="">
							<li><input type="text" name="Nom" placeholder="Nom" value="<?php if(isset($_POST['Nom'])){echo $_POST['Nom'];}?>"></li>
							<li><input type="text" name="Prenom" placeholder="Prénom"></li>
							<li><input type="text" name="Telephone" placeholder="Téléphone"></li>
							<li><input type="mail" name="Email" placeholder="Email"></li>
							<li><input type="text" name="Ville" placeholder="Ville"></li>
							<li><input type="text" name="Codepostal" placeholder="Code postal"></li>
						</form>
						
						

					</ul>	
					<div>
					<form method="POST" action="">
						<textarea name="Votre_demande" placeholder="Votre message"></textarea>
						<br /> <br />
						<input type="submit" value="Envoyer" name="mailform">
					</form>
					
					
						
					</div>

					</div>
					<?php
					if (isset($msg)) 
					{
						echo $msg;
					}

					?>	
					
				</div>
				</div>
				<div id="section3">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5438.660570749984!2d2.2743411022013524!3d48.82578830679031!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6707980bd3947%3A0xd54fb6c5e1933333!2s10+Rue+de+Vanves%2C+92170+Issy-les-Moulineaux!5e0!3m2!1sfr!2sfr!4v1542127553454" width="480" height="360" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
			</div>
			<footer>
				<a href="Pagecontact.html">Nous Contacter</a>
				<p> test</p>
			</footer>
		</div>
	</body>

</html>
