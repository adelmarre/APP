<?php  
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');
if (isset($_POST['test']))
{
	##for ($i=0; $i < 100 ; $i++) 
	{ 
		
	$characts = 'abcdefghijklmnopqrstuvwxyz'; 
	$characts .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';	
	$characts .= '1234567890'; 
	$code_aleatoire = ''; 

	for($i=0;$i < 10;$i++) 
	{ 
	$code_aleatoire .= $characts[ rand() % strlen($characts) ]; 
	} 
	
	$insertmbr = $bdd->prepare("INSERT INTO personne(nom, prenom, mail, mdp, numero, confirmkey) VALUES(?, ?, ?, ?, ?, ?)");
	$insertmbr->execute(array($code_aleatoire, $code_aleatoire, $code_aleatoire, $code_aleatoire, $code_aleatoire, $i));
	}
}
?>

<html>
<head>
	<title>Crash Test</title>
</head>
<body>
</br></br>
<form method="POST" action="">
	<input  type="submit" name="test" value="Tester !">
</form>
	


</body>
</html>