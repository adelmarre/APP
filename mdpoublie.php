<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');
if(isset($_GET['section'])){
	$section = htmlspecialchars($_GET['section']);
}else{
	$section = "";
}
if (isset($_POST['recup_submit'], $_POST['recup_mail'])) {
	if (!empty($_POST['recup_mail'])) {
		$recup_mail = htmlspecialchars($_POST['recup_mail']);
		if (filter_var($recup_mail,FILTER_VALIDATE_EMAIL)){
			$mailexist = $bdd->prepare('SELECT id,prenom FROM personne WHERE mail = ?');
			$mailexist->execute(array($recup_mail));
			$mailexist_count = $mailexist->rowCount();
			if ($mailexist_count == 1){
				$prenom = $mailexist->fetch();
				$prenom = $prenom['prenom'];
				$_SESSION['recup_mail'] = $recup_mail;
				$recup_code = "";
				for ($i=0; $i < 8 ; $i++) {
					$recup_code .= mt_rand(0,9);
				}
				$_SESSION['recup_code'] = $recup_code;
				$mail_recup_exist = $bdd->prepare('SELECT id FROM recuperation WHERE mail =?');
				$mail_recup_exist->execute(array($recup_mail));
				$mail_recup_exist = $mail_recup_exist->rowCount();
				if ($mail_recup_exist == 1) {
					$recup_insert = $bdd->prepare('UPDATE recuperation SET code = ? WHERE mail = ?');
					$recup_insert->execute(array($recup_code,$recup_mail));
				}else{
					$recup_insert = $bdd->prepare('INSERT INTO recuperation(mail,code) VALUES (?,?)');
					$recup_insert->execute(array($recup_mail,$recup_code));
				}
				$header="MIME-Version: 1.0\r\n";
		        $header.='From:"Hexagon.com"<projet.hexagon@gmail.com>'."\n";
		        $header.='Content-Type:text/html; charset="utf-8"'."\n";
		        $header.='Content-Transfer-Encoding: 8bit';
		        $message = '
		        <html>
		        <head>
		          <title>Récupération de mot de passe - Hexagon.com</title>
		          <meta charset="utf-8" />
		        </head>
		        <body>
		          <font color="#303030";>
		            <div align="center">
		              <table width="600px">
		                <tr>
		                  <td>
		                     
		                    <div align="center">Bonjour <b>'.$prenom.'</b>,</div></br>
		                    Suite à votre demande, voici votre code de récupération: <b>'.$recup_code.'</b>
		                  </td>
		                </tr>
		                <tr>
		                  <td>
		                  <div align="center">
		                  <img src="image/logo hexagon.png">
		                    <font size="2">
		                      Ceci est un email automatique, merci de ne pas y répondre.
		                    </font>
		                  </div>
		                  </td>
		                </tr>
		              </table>
		            </div>
		          </font>
		        </body>
		        </html>
		        ';
		        mail($recup_mail, "Récupération de mot de passe - Hexagon.com", $message, $header);
		        header("Location: mdpoublie.php?section=code");
				
			}else{
				$error = "Cette adresse mail n'est pas enregistrée";
			}
		}else{
			$error = "Adresse mail incorrect";
		}
	}else{
		$error = "Veuillez entrer votre adresse mail";
	}
}
	if (isset($_POST['verif_submit'],$_POST['verif_code'])){
		if(!empty($_POST['verif_code'])){
			$verif_code = htmlspecialchars($_POST['verif_code']);
			$verif_req = $bdd->prepare('SELECT * FROM recuperation WHERE mail = ? AND code = ? ');
			$verif_req->execute(array($_SESSION['recup_mail'],$verif_code));
			$verif_req = $verif_req->rowCount();
			if ($verif_req == 1) {
				$del_req = $bdd->prepare('DELETE FROM recuperation WHERE mail = ?');
				$del_req->execute (array($_SESSION['recup_mail']));
				header("Location: mdpoublie.php?section=changemdp");
			}else{
				$error = "Code invalide";
			}
		}else{
			$error = "Veuillez entrer votre code de vérification";
		}
	}
	if (isset($_POST['change_submit'],$_POST['change_mdp'],$_POST['change_mdpc'])){
		$mdp = htmlspecialchars($_POST['change_mdp']);
		$mdpc = htmlspecialchars($_POST['change_mdpc']);
		if (!empty($mdp) AND !empty($mdpc)){
			if ($mdp == $mdpc) {
				$mdp = sha1($mdp);
				$ins_mdp = $bdd->prepare('UPDATE personne SET mdp = ? WHERE mail = ?');
				$ins_mdp->execute(array($mdp,$_SESSION['recup_mail']));
				header('Location: index.php');
				
			}else{
				$error = "Vos mots de passes ne correspondent pas";
			}
			
		}else{
			$error = "Veuillez remplir tous les champs";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="mdp_oublie.css">
	<link rel="stylesheet" type="text/css" href="general.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
	<title>Mot de passe oublié</title>
</head>
<body>
	<?php
include "header_connexion.php";
?>

	
	
		<section>	
		
		
		<div id= container>
			<div id="filler" class="mdpoublie">
			<?php if ($section == 'code') { ?>
				<h3>Récupération du mot de passe</h3>
				
				<br /><br />
				<form method="POST" class="default-form">
					<input type="text" name="verif_code" placeholder="Code de Vérification"> <br /> <br />
					<input type="submit" name="verif_submit" value="Valider"> 
				</form>
				<br />
			<?php } elseif ($section == 'changemdp') { ?>
				<h3>Modification du mot de passe</h3>
				<br /><br />

				<form method="POST" class="default-form">

					<label for="motdepasse">Définir votre nouveau mot de passe :
						<br>
				        <input type="password" id="motdepasse" name="change_mdp" minlength="10" required>

				        <ul class="requiert">
				          <li>Votre mot de passe doit faire au moins 10 charactères.</li>
				          <li>Votre mot de passe doit contenir au moins un chiffre (0-9).</li>
				          <li>Votre mot de passe doit contenir au moins une minuscule.</li>
				          <li>Votre mot de passe doit contenir au moins une majuscule.</li>
				          <li>Votre mot de passe doit contenir au moins un charactère spécial.</li>
				        </ul>

				     </label> 
				      <label for="motdepasse2">Confirmer votre nouveau mot de passe :
				      	<br>
				        <input type="password" id="motdepasse2" name="change_mdpc" required>

				     </label>
				     <br>
					<input type="submit" name="change_submit" value="Valider"> 
				</form>
				
				<br />

				
			<?php } else { ?>
			<h1>Mot de passe oublié ? </h1>
			<p> Saisissez l'adresse mail liée à votre compte, vous receverez un message de réinitialisation de votre mot de passe dans les plus bref délais!</p>

			
				

				
				<h3>Entrer votre e-mail</h3>
				<form method="POST" class="default-form">
					<input type="email" name="recup_mail" placeholder="exemple@mail.fr"> <br /> 
					<input type="submit" name="recup_submit" value="Envoyer !"> 
				</form> <br />
				<?php } ?>
				<?php if(isset($error)) { echo '<span style="color:red">'.$error.'</span>';} else { echo ""; } ?>
			</div>

		</div>
		
		</section>
	

<script src="mdpoublie.js"></script>
</body>
</html>