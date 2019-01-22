<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=hexagon;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
if ( isset($_POST['fonctionnalite']) && !empty($_POST['fonctinnalite']) ) 
{

	
	

	$req = $bdd->prepare('INSERT INTO capteurs_maison (modele) VALUES (?)');
	$req->execute(array($modele));

	header('Location: capteur.php? ');

}
else{
	echo "Il n'y a rien mon frère";
}
?>