<?php

$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');

	if(isset($_GET['mail'],$_GET['key'])  AND !empty($_GET['mail']) AND !empty($_GET['key'])){

		$mail= htmlspecialchars(urldecode($_GET['mail']));

		$key = htmlspecialchars($_GET['key']);

		$requser = $bdd -> prepare("SELECT * FROM personne WHERE mail = ? AND confirmkey = ? ");

		$requser -> execute(array($mail,$key));

		$userexist = $requser -> rowCount();



		if ($userexist == 1){

			$user = $requser -> fetch();

			if ($user ['confirme'] == 0 ){

				$updateuser = $bdd -> prepare("UPDATE personne SET confirme = 1 WHERE mail= ? AND confirmkey = ? ");

				$updateuser -> execute(array($mail,$key));


				$erreur= "Votre inscription a bien été confirmée !";



			}else {

				$erreur= "Votre inscription a déjà été confirmé";

			}



		}else{
			

			$erreur =  "L'utilisateur n'existe pas !";

		}



		}



?>

<html>
<head>
        <meta charset="UTF-8" />
          <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
        <link rel="stylesheet" href="inscription.css" />
    
        <title>Confirmation de compte</title>
    </head>

<img src="image/logo hexagon.png" alt="photo de hexagon" id="hexagon">
<body><h1>  <?php
            if (isset($erreur)) 
            { 
                echo $erreur;
            }
?></h1>
<div align="center">
<a href="index.php">Se connecter</a> 
</div>
</body>