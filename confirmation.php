<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');
	if(isset($_GET['mail'],$_GET['key'])  AND ! empty($_GET['mail']) AND !empty($_GET['key'])){
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
				echo "Votre inscription a bien été confirmée !";

			}else {
				echo "Votre inscription a déjà été confirmé";
			}

		}else{
			echo "L'utilisateur n'existe pas !";
		}

		}

?>
