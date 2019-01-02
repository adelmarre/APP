
<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');

if (isset($_POST['formconnexion']))
{
	$mailconnect = htmlspecialchars(($_POST['mailconnect']));
	$mdpconnect = sha1($_POST['mdpconnect']);
	if (!empty($mailconnect) AND !empty($mdpconnect)) {
		$requser = $bdd -> prepare("SELECT * FROM personne WHERE mail = ? AND mdp = ?");
        $requser -> execute(array($mailconnect, $mdpconnect));
        $userexist = $requser -> rowCount();
        if ($userexist == 1) {
        	$userinfo = $requser -> fetch();
        	if ($userinfo['confirme']==1 && $userinfo['admin']==0)
        	{
        	
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['nom'] = $userinfo['nom'];
            $_SESSION['prenom'] = $userinfo ['prenom'];
            $_SESSION['mail'] = $userinfo ['mail'];

            $requser = $bdd -> prepare('SELECT * FROM habitation JOIN personne ON personne.id = habitation.id_personne WHERE id = ?');
		    $requser -> execute(array($userinfo['id']));
		    $user = $requser ->fetch();

            header("Location: maisonsallecapteurtempo.php?id=".$_SESSION['id']);
            }
            else { $erreur= "Veuillez confirmer votre compte";}
            if ($userinfo['admin']==1 && $userinfo['confirme']==1)
            {
            	header("Location: administrateur.php?id_admin=".$userinfo['id']);
            }
        }
        else { $erreur = "Mauvaise combinaison email/mot de passe";}
	}
	

}


	?>


<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="accueil.css">
		<link rel="stylesheet" type="text/css" href="general.css">
		<meta charset="utf-8">
		<title>Accueil</title>
	</head>


	<body>

	

			<img src="image/logo hexagon.png" alt="photo de hexagon" id="hexagon">
					
	
		<div id="identification">

			<div id="menucote">

				<ul>
			  <li><a href="inscription.php">S'inscrire</a></li>
			  <li><a href="catalogue.php">Catalogue</a></li>
			  <li><a href="faqversionfinale.php">Aide</a></li>
			  <li><a href="pagecontact.php">Contact</a></li>
			  <li><a href="apropos.php">A propos</a></li>
			  
				</ul>
			
			</div>



			<div id="titre">
				Connexion
			</div>
			
			<form method="POST" action="">
			<div id="utilisateur">
				
				<input type="email" name="mailconnect" placeholder="email" required>
			</div>

		<div id="souvenir">

				
        		<?php
	            if (isset($erreur)) 
	            { 
	                echo '<font color="red">'.$erreur."</font>";
	            }
				?>
				
			</div>

			<div id="motdepasse">
				
				<input type="password" name="mdpconnect" placeholder="mot de passe" required>


			</div>

			<div id="oublie">
				
				<a href="mdpoublie.php">Mot de passe oublié</a>
			</div>

			<div id="connexion">
				
				<button type="submit" class="boutton" name="formconnexion">Accéder à ma maison</button>

			</div></form>


			 

</div>

	
	
		<div id="text">
			
			<center>	<img class="fond" src="image/fond_accueil2.jpg" height="100%" width="100%" height="auto"></center></div>


			</div>
	</body>


</html>
