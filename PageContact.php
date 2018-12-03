<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');
if(isset($_POST['mailform']))

{	



	if( !empty($_POST['Email']) AND !empty($_POST['Prenom']) AND !empty($_POST['Nom']) AND !empty($_POST['Votre_demande']))

	{


    	$mail = ($_POST['Email']);
   		$nom = htmlspecialchars($_POST['Nom']);
   		$prenom = htmlspecialchars($_POST['Prenom']);
    	$demande = ($_POST['Votre_demande']);
		$date = date("Y-m-d");
		$heure = date("H:i:s");
		if (filter_var($mail,FILTER_VALIDATE_EMAIL)) {
			$insert = $bdd->prepare('INSERT INTO mailclients(contenu, ladate, heure, mail, nom, prenom) VALUES(?, ?, ?, ?,? , ?)');
		    $insert ->execute(array($demande, $date, $heure, $mail, $nom, $prenom));
	        $msg = "Demande envoyée! ";               	                            
		}
		else {
			$msg="Mail invalide";
		}
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
		<link rel="stylesheet"  href="pagecontact.css">
		<link rel="stylesheet"  href="general.css">
		<title>Contact</title>
	</head>
	<body>
		<div id="bloc_page">
	<?php include "header.php"
	?>
			<div id="conteneur">
				<div id="section1">
						<h1>Nos Coordonées:</h1>
					<div class="coordonnees">
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
							Nom
							<li><input type="text" name="Nom" placeholder="Nom" autocomplete="off" required></li>
							Prénom
							<li><input type="text" name="Prenom" placeholder="Prénom" autocomplete="off" required></li>
							Email
							<li><input type="mail" name="Email" placeholder="Email"  required></li>
							</ul>	
							 <div>
							<textarea type="text" name="Votre_demande" placeholder="Votre message" required > </textarea>
							<br /> <br />
							<input type="submit" value="Envoyer" name="mailform">					
					
						
							</div>
						</form>
					</div>
					<?php
					if (isset($msg)) 
					{
						echo '<font color="red">'.$msg."</font>";
					}
					?>	
					
					</div>
				</div>
				<div id="section3">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5438.660570749984!2d2.2743411022013524!3d48.82578830679031!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6707980bd3947%3A0xd54fb6c5e1933333!2s10+Rue+de+Vanves%2C+92170+Issy-les-Moulineaux!5e0!3m2!1sfr!2sfr!4v1542127553454" width="480" height="360" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
			
			<?php
			include "footer.php";
			?>
		
	</body>
