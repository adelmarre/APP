<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');
$ide = htmlspecialchars($_GET['ide']);
$idd = htmlspecialchars($_GET['idd']);

$chatEnv = $bdd ->query('SELECT * FROM message WHERE (id_expediteur="'.$ide.'" AND id_destinataire="'.$idd.'") OR (id_expediteur="'.$idd.'" AND id_destinataire="'.$ide.'")' );



if ($_GET['idd']!=1) {
	
	
	$updatevu = $bdd ->query('UPDATE message JOIN personne SET vu = 1 WHERE id_destinataire=id');
	$updatevu2 = $bdd ->query('UPDATE messageclient SET vu = 1 WHERE id_destinataire="'.$id.'"');
	if (isset($_POST['envoyer'])) 
	{
		

		if (!empty($_POST['message']))
		{
			if (isset($_GET['idd'])AND $_GET['idd'] > 0 AND isset($_GET['ide']) AND $_GET['ide'] > 0)
			{
				$getid = intval($_GET['idd']);
				$getidadmin = intval($_GET['ide']);
				$date = date("Y-m-d");
				$heure = date("H:i:s");
				$message = htmlspecialchars($_POST['message']);
				$nom = "admin";
				$insert = $bdd->prepare('INSERT INTO message(id_expediteur,id_destinataire,message,heure,ladate,nomexpediteur) VALUES(?,?,?,?,?,?)');
		    	$insert ->execute(array($getidadmin,$getid,$message,$heure,$date,$nom));
		    	$erreur = "Votre message a bien été envoyé";

			}
		}
		else
		{
			$erreur = "Votre message est vide, veuillez le remplir";
		}
	}
}
else
{
	
	$updatevu = $bdd ->query('UPDATE message SET vu = 1 WHERE nomexpediteur="admin"');
	if (isset($_POST['envoyer'])) 
	{
		

		if (!empty($_POST['message']))
		{
			if (isset($_GET['idd'])AND $_GET['idd'] > 0 AND isset($_GET['ide']) AND $_GET['ide'] > 0)
			{
				$getidadmin = intval($_GET['idd']);
				$getid = intval($_GET['ide']);
				$date = date("Y-m-d");
				$heure = date("H:i:s");
				$message = htmlspecialchars($_POST['message']);
				$nom = "Client";
				$insert = $bdd->prepare('INSERT INTO message(id_expediteur,id_destinataire,message,heure,ladate,nomexpediteur) VALUES(?,?,?,?,?,?)');
		    	$insert ->execute(array($getidadmin,$getid,$message,$heure,$date,$nom));
		    	$erreur = "Votre message a bien été envoyé";
			}
		}
		else
		{
			$erreur = "Votre message est vide, veuillez le remplir";
		}
	}
}
?>
<html>
<head>
	<title>Contact</title>
	<link rel="stylesheet" type="text/css" href="chat.css" /> 
</head>
<body>
	<div class="chat">
		<?php
		
			$id = htmlspecialchars($_GET['id']);
			$premque = $bdd ->query('SELECT * FROM messageclient WHERE id_destinataire="'.$id.'"');
			$PQ = $premque ->fetch();
			?>
		 
		<p type ="text" name="chat"><? echo '<font color="red">'."Client"."</font>"; echo ("   :   "); echo($PQ['message']); echo ("   "); echo '<font color="blue">'.$PQ['ladate']."</font>"; echo ("   "); echo '<font color="blue">'.$PQ['heure']."</font>";  ?> </br></br><?php while($chatE=$chatEnv->fetch()){   echo '<font color="red">'.$chatE['nomexpediteur']."</font>"; echo ("   :   "); echo($chatE['message']); echo ("   "); echo '<font color="blue">'.$chatE['ladate']."</font>";echo ("      "); echo '<font color="blue">'.$chatE['heure']."</font>"; ?></br></p> 
		<?php } ?>
	
	<form method="POST" action="">
		<textarea type="text" name="message" placeholder="Réponse" class ="chat1"></textarea>
	</br> <br/>
		<input type ="submit" value ="Envoyer" name="envoyer" />
	</form> <br/> <br/></div>
	<?php 
	if (isset($erreur))
	{
		echo '<font color="red">'.$erreur."</font>";
	}
	?>
	
						
					
	

	
</body>
</html>