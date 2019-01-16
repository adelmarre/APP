<?php
session_start();
$bdd = new PDO('mysql:localhost;dbname=hexagon','root','');
if($_GET['langue']=='fr') {     
  	 echo '<a href="pagecontact.php?langue=en" >Change language</a>'; 
  	 }

if($_GET['langue']=='en') {    
  	 echo '<a href="pagecontact.php?langue=fr" >Changer de langue</a>'; 
  	 }
				

			
			
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
			$insert = $bdd->prepare('INSERT INTO mailvisiteur(contenu, ladate, heure, mail, nom, prenom) VALUES(?, ?, ?, ?,? , ?)');
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
<?php if (isset($_SESSION['id'])) {
	include "header_deco.php"; }
	else {
		include "header_connexion.php";
	}
?>

<?php
	require 'choix_langue.php';
?>
<html>
<link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet"  href="pagecontact.css">
		<link rel="stylesheet"  href="general.css">
		<title><?php echo $contact;?></title>
	</head>
	<body>


		<div class="bloc_page">
			<div class="conteneur">
				<div class="section1">
						<fieldset>
						<legend><h1><?php echo $coordonnees;?></h1></legend>
					<div class="coordonnees">
						<img src="image/icone_mail.png" alt="icone_mail" id="icone_mail">
						<div class="mail">projet.hexagon@gmail.com</div>
						<img src="image/icone_telephone.png" alt="icone_telephone" id="icone_telephone">
						<div class="telephone">0122334455 </div>
					</div>
					</fieldset>
				</div>
			</div>
				<div class="section2">
					<fieldset>
						<legend><h1><?php echo $ask;?></h1></legend>

					<div class="" ="aside21">
					<p><?php echo $side_text;?></p>
					</div>
				
				<div class ="aside22">
				
					
					
					<div class="demande">
					<ul>
						<form method="POST" action="">
							<?php echo $name;?>
							<li><input type="text" name="Nom" placeholder="<?php echo $name ;?>" autocomplete="off" required></li>
							<?php echo $surname;?>
							<li><input type="text" name="Prenom" placeholder="<?php echo $surname ;?>" autocomplete="off" required></li>
							<?php echo $mail;?>
							<li><input type="mail" name="Email" placeholder="<?php echo $mail ;?>"  required></li>
							</ul>	
							 <div>
							<textarea type="text" name="Votre_demande" placeholder="Votre message" required > </textarea>
							<br /> <br />
							<input type="submit" value= "<?php echo $button ;?>" name="mailform">					
					
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
				<div class="section3">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5438.660570749984!2d2.2743411022013524!3d48.82578830679031!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6707980bd3947%3A0xd54fb6c5e1933333!2s10+Rue+de+Vanves%2C+92170+Issy-les-Moulineaux!5e0!3m2!1sfr!2sfr!4v1542127553454" width="480" height="360" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>



		


		</div>
			
			<?php
			include "footer.php";
			?>
		
	</body>