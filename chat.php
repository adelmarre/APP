<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','',array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
$ide = htmlspecialchars($_GET['ide']);
$idd = htmlspecialchars($_GET['idd']);
$id= htmlspecialchars($_GET['id']);
$chatEnv = $bdd ->query('SELECT * FROM message WHERE (id_expediteur="'.$ide.'" AND id_destinataire="'.$idd.'") OR (id_expediteur="'.$idd.'" AND id_destinataire="'.$ide.'")' );

if (isset($_SESSION['id'])) {
  $getid = intval($_SESSION['id']);
  $reqadmin = $bdd -> prepare('SELECT admin FROM personne WHERE id = ?');
  $reqadmin -> execute(array($getid));
  $user = $reqadmin -> fetch();
  if ($user['admin']!=1) {
    $admin = 0;
  }
  else {
  	$admin = 1 ; 
  }
  
}
else {
	exit();
}


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
	<title>Conversation privée</title>
	  <meta charset="UTF-8">
	   <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="chat.css" /> 
</head>
<body>
	<?php if ($admin==1) { ?>
<div class="snip1231">
 <a  class="current" href="deconnexion.php">Déconnexion</a>

<a class="current" href="administrateur.php">Menu admin</a>    </div>

<?php } 
	else { ?>

		<div class="snip1231">
 	<a  class="current" href="maisonsallecapteur.php">Ma maison</a></div>

<?php	}
	
?>

</br></br></br>
	<div class="chat">
		<?php
		
			$id = htmlspecialchars($_GET['id']);
			$premque = $bdd ->query('SELECT * FROM messageclient WHERE id_destinataire="'.$id.'"');
			$PQ = $premque ->fetch();
			?>
		 
		<p type ="text" name="chat"><?php echo '<font color="gray">'."Client"."</font>"; echo ("   :   "); echo($PQ['message']); echo ("   "); echo '<font color="#5FA2B8">'.$PQ['ladate']."</font>"; echo ("   "); echo '<font color="#5FA2B8">'.$PQ['heure']."</font>";  ?> </br></br><?php while($chatE=$chatEnv->fetch()){   echo '<font color="gray">'.$chatE['nomexpediteur']."</font>"; echo ("   :   "); echo($chatE['message']); echo ("   "); echo '<font color="#5FA2B8">'.$chatE['ladate']."</font>";echo ("      "); echo '<font color="#5FA2B8">'.$chatE['heure']."</font>"; ?></br></p> 
		<?php } ?>
	
	<form method="POST" action="">
		<textarea type="text" name="message" placeholder="Réponse" class ="chat1"></textarea>
	</br> <br/>
<?php 
	if (isset($erreur))
	{
		echo '<font color="red">'.$erreur."</font>";
	}
	?>
	
			
		<input type ="submit" value ="Envoyer" name="envoyer" />



	</form> <br/> <br/>
	</div>
				
					
	

	
</body>
