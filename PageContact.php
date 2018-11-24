<?php
if(isset($_POST['mailform']))
{
	if(!empty($_POST['Nom']) AND !empty($_POST['Prenom']) AND !empty($_POST['Telephone']) AND !empty($_POST['Email']) AND !empty($_POST['Ville']) AND !empty($_POST['Codepostal']) AND !empty($_POST['Votre_demande']))
	{

		$header="MIME-Version: 1.0\r\n";
		$header.='From:"Hexagon.com"<projet.hexagon@gmail.com>'."\n";
		$header.='Content-Type:text/html; charset="utf-8"'."\n";
		$header.='Content-Transfer-Encoding: 8bit';
		$message='
		<html>
			<body>
				<div align="center">
					
					<br />
					<u> Nom de l\'expéditeur :</u>'.$_POST['Nom'].' <br />
					<u> Prenom de l\'expéditeur :</u>'.$_POST['Prenom'].' <br />
					<u> Telephone de l\'expéditeur :</u>'.$_POST['Telephone'].' <br />
					<u> Email de l\'expéditeur :</u>'.$_POST['Email'].' <br />
					<u> Codepostal de l\'expéditeur :</u>'.$_POST['Codepostal'].' <br />

					'.$_POST['Votre_demande'].'
					<br />
				
					
				</div>
			</body>
		</html>
		';
		mail("projet.hexagon@gmail.com", "CONTACT - Hexagon", $message, $header);

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
						<div class="mail">projet.hexagon@gmail.com</div>
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
							<li><input type="text" name="Nom" placeholder="Nom" value="<?php if(isset($_POST['Nom'])) { echo $_POST['Nom']; } ?>" /></li>
							<li><input type="text" name="Prenom" placeholder="Prénom" value="<?php if(isset($_POST['Prenom'])) { echo $_POST['Prenom']; } ?>"/></li>
							<li><input type="text" name="Telephone" placeholder="Téléphone" value="<?php if(isset($_POST['Telephone'])) { echo $_POST['Telephone']; } ?>"></li>
							<li><input type="mail" name="Email" placeholder="Email" value="<?php if(isset($_POST['Email'])) { echo $_POST['Email']; } ?>"></li>
							<li><input type="text" name="Ville" placeholder="Ville" value="<?php if(isset($_POST['Ville'])) { echo $_POST['Ville']; } ?>"></li>
							<li><input type="text" name="Codepostal" placeholder="Code postal" value="<?php if(isset($_POST['Codepostal'])) { echo $_POST['Codepostal']; } ?>"></li>
							</ul>	
							<div>
					
							<textarea name="Votre_demande" placeholder="Votre message"><?php if(isset($_POST['Votre_demande'])) { echo $_POST['Votre_demande']; } ?></textarea>
							<br /> <br />
							<input type="submit" value="Envoyer" name="mailform">					
					
						
							</div>
						</form>
						
						

					

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
