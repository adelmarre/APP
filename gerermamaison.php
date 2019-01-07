
<?php 
session_start();
try {
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');
	if (isset($_SESSION['id'])) 
	{
		$getid = intval($_SESSION['id']);
		$requser = $bdd -> prepare('SELECT * FROM personne WHERE id = ?');
		$requser -> execute(array($getid));
		$userinfo = $requser ->fetch();
		if (isset($_GET['id_habitation'])) {
			$gethabitation = intval($_GET['id_habitation']);
		}
	}
	else {
		exit();
	}
}
catch(Exception $e){
	die('Erreur : ' . $e->getMessage());
}

$requser = $bdd -> prepare('SELECT * FROM habitation JOIN personne ON personne.id = habitation.id_personne WHERE (id = ?) AND (id_habitation = ?)');
$requser -> execute(array($getid,$gethabitation));
$user = $requser ->fetch();
$requser2 = $bdd -> prepare('SELECT * FROM piece WHERE (id_habitation = ?)');
$requser2 -> execute(array($gethabitation));


if (isset($_POST['valide1']))
{
	$nommaison = htmlspecialchars($_POST['nommaison']);

	
	$adresse = htmlspecialchars($_POST['adresse']);
	$ville = htmlspecialchars($_POST['ville']);
	$cp = htmlspecialchars($_POST['cp']);
	$pays = htmlspecialchars($_POST['pays']);
	{	
		try{
			$insertmais = $bdd->prepare("INSERT INTO habitation(nomhabitation, adresse,id_personne,ville,pays,cp) VALUES(?, ?,?,?,?,?)");
			$insertmais->execute(array($nommaison, $adresse,$userinfo['id'],$ville,$pays,$cp));
		}
		catch(Exception $e){
			die("erreur bdd");
		}

	}
	
	

}
?>


<html>
<head>
	<title>Gérer ma Maison</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="gerermamaisonstyle.css">
	<link rel="stylesheet" type="text/css" href="general.css">

	<script type="text/javascript">

		function AfficheFormulaire(){
			
			
			

			var AjHab=document.getElementById('ajouthab');
			var AjMRadio=document.getElementById('ajmais');
			AjHab.style.display='none';


			

			var FieldUser=document.getElementById('utilSecond');
			var UserSecRadio=document.getElementById('modutilsecond');
			FieldUser.style.display='none';

			var Ajsal=document.getElementById('ajoutersalle');
			var Radioajsal =document.getElementById('ajsal');
			Ajsal.style.display='none';

			var Modmais=document.getElementById('modifiermaison');
			var Radiomodmais=document.getElementById('modmais');
			Modmais.style.display='none';

			var AjU= document.getElementById('ajouterUserS');
			var AjURadio= document.getElementById('ajutilsecond');
			AjU.style.display='none';


			
			if(AjMRadio.checked==true){
				AjHab.style.display='block';

			}

			else if(UserSecRadio.checked==true) {
				FieldUser.style.display='block';

				
			}

			else if (Radioajsal.checked==true) {
				Ajsal.style.display='block';
			}


			else if (Radiomodmais.checked==true) {
				Modmais.style.display='block';
			}

			else if(AjURadio.checked==true){
				AjU.style.display='block';
			}


		}


		function Supr(){



			var InfoBox=document.querySelectorAll('.RentrerInfoT');

			var i=0;

			for (i;i<InfoBox.length;i++){
				InfoBox[i].value=" ";
			}



		}
		
	</script>

</head>
<body>
	<?php include "header_none.php" ?>
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">

	<div class="colonnedroite">
		<div class="box_profil">
			<img src="image/profil.jpg" class="photo_profil">
			<br/>
			<div class="affichage_prenom">
				<?php echo $userinfo['prenom'];?>
			</div>
			<div class="affichage_nom">
				<?php echo $userinfo['nom'];?>
			</div>
		</div>

		<nav>
			<ul class="box_information">


				<li>
					<p>

						<?php echo '<a href="editerprofil.php?id='.$_SESSION['id'].'" class="box">Editer profil</a>'; ?>

						<img src="https://image.freepik.com/icones-gratuites/symbole-des-parametres_318-34202.jpg"
						class="avatar_box">
					</p>
				</li>
				<li>
					<p>
						<?php echo '<a href="faqversionfinale.php?id='.$_SESSION['id'].'" class="box">Aide</a>'; ?>

						<img src="https://images.emojiterra.com/twitter/512px/2753.png" class="avatar_box">
					</p>
				</li>
				<li> 
					<p> <?php echo '<a href="apropos.php?id='.$_SESSION['id'].'" class="box">A propos</a>'; ?>

					<img src="https://image.freepik.com/icones-gratuites/informations-petite-lettre-symbole-i_318-54670.jpg" class="avatar_box">
				</p>
			</li>
			<li> 
				<p> <a href="Consignes globales" class="box">Consignes globales</a>

					<img src="https://images-na.ssl-images-amazon.com/images/I/61OH1BsW99L._SY355_.jpg" class="avatar_box">
				</p>
			</li>
			<li> 
				<p> <?php echo '<a href="catalogue.php?id='.$_SESSION['id'].'" class="box">Catalogue</a>'; ?>


				<img src="https://svgsilh.com/svg_v2/160871.svg" class="avatar_box">
			</p>



		</li>

		<li> 

			<p> <?php echo '<a href="mamaison.php?id='.$_SESSION['id'].'" class="box_rouge">Mes maisons</a>'; ?> 



		</p>



	</li>


	<li> 

		<p> <?php echo '<a href="MaisonSalleCapteurTempo.php?id='.$_SESSION['id'].'&id_habitation='.$_GET['id_habitation'].'" class="box_rouge">Ma Maison</a>'; ?> 



	</p>



</li>



<li> 

	<p> <a href="deconnexion.php" class="deconnexion" class="box_rouge">Déconnexion</a>


	</p>

</li>
</ul>
</nav>
</div>

<div class="colonnegauche">

</div>

<div id="Centre">
	<fieldset id="set">
		<legend> <h1>Gérer ma maison</h1></legend>

		<header>
			<nav class="head2">
				<ul>
					<li> <input type="radio" name="Sélection" value="Ajouter une salle" class="Selec" id="ajsal" onchange="AfficheFormulaire()"> Ajouter une salle </li>
					<li><input type="radio" name="Sélection" value="Modifier ma Maison" class="Selec" id="modmais" onchange="AfficheFormulaire()"> Modifier ma Maison </li>
					<li> <input type="radio" name="Sélection" value="Ajouter ma Maison" class="Selec" id="ajmais" onchange="AfficheFormulaire()"> Ajouter ma Maison  </li>
					<li><input type="radio" name="Sélection" value="Modifier utilisateur secondaire" class="Selec" id="ajutilsecond" onchange="AfficheFormulaire()"> Ajouter utilisateur secondaire </li>
					<li><input type="radio" name="Sélection" value="Modifier utilisateur secondaire" class="Selec" id="modutilsecond" onchange="AfficheFormulaire()"> Modifier utilisateur secondaire </li>


				</nav>
			</header>

			<div id="ajoutersalle">
				<?php

				if (isset($_POST['ajouter'])) {
					$nom = htmlspecialchars($_POST['nom']);
					$superficie = htmlspecialchars($_POST['superficie']);
					$habitation = $_GET['id_habitation'];
					$insertpiece = $bdd->prepare("INSERT INTO piece(nom, id_habitation, superficie) VALUES(?, ?, ?)");
					$insertpiece->execute(array($nom, $habitation , $superficie));
				}?>

				<fieldset>
					<legend><h2>Ajouter une salle :</h2></legend>
					<FORM method="POST">
						<h3>Nom de la maison</h3>
						<?php echo $user['nomhabitation'];?>
						<h3><label>Nom de la salle :</label></h3>
						<input type="text" id="nom" name="nom" required>

						<h3><label>Superficie en m^2 :</label></h3>
						<input type="number" id="superficie" name="superficie" min="0" value="0" required>

						<input type="submit" name="ajouter" id="ajouter" value="Ajouter">

					</FORM>	
				</fieldset>

			</div>




			<div id="modifiermaison">



				<?php
				if (isset($_POST['modifMaison'])) {






					$nomh = htmlspecialchars($_POST['newnomhabitationm']);
					$newnom = $bdd->prepare("UPDATE habitation SET nomhabitation = '$nomh'  WHERE id_habitation = ".$user['id_habitation']." " );
					$newnom -> execute(array($nomh));


					$newnom->closeCursor();

					$adresseh = htmlspecialchars($_POST['newadresse']);
					$newadresse = $bdd->prepare("UPDATE habitation SET adresse = '$adresseh'  WHERE id_habitation = ".$user['id_habitation']." " );
					$newadresse -> execute(array($adresseh));

					$newadresse->closeCursor();

					$villeh = htmlspecialchars($_POST['newville']);
					$newvilleh = $bdd->prepare("UPDATE habitation SET ville = '$villeh'  WHERE id_habitation = ".$user['id_habitation']." " );
					$newvilleh -> execute(array($villeh));

					$newvilleh->closeCursor();



					while($p=$requser2->fetch() ) {



						$typeh = htmlspecialchars($_POST[ $p['nom'] ]);
						$newtypeh = $bdd->prepare("UPDATE piece SET nom = '$typeh'  WHERE id_piece = ".$p['id_piece']." " );
						$newtypeh -> execute(array($typeh));

						$newtypeh->closeCursor();

					}
				}

				?>

				<fieldset>
					<legend><h2>Modifier ma maison :</h2></legend>
					<FORM method="POST">

						<div class="colonnegauche">
							<label> Nom de la  Maison: </label>
							<input type="text" class="RentrerInfo" id="nomhabi" name="newnomhabitationm" value="<?php echo $user['nomhabitation']?>"  minlength="2" maxlength="16" size="16">
							<label> Superficie en m^2 : </label>
							<?php
							$superficietotal =  0 ;
							$superficie = $bdd -> query("SELECT superficie FROM piece WHERE id_habitation = '" . $user['id_habitation'] . "'");
							while ($row = $superficie->fetch()) {
								$superficietotal= $superficietotal + $row["superficie"];
							}
							echo $superficietotal;
							?>
							<label> Nombre de pièce : </label>
							<?php
							$nbpiece = $bdd -> prepare("SELECT * FROM piece WHERE id_habitation = '" . $user['id_habitation'] . "'");
							$nbpiece ->execute();
							$count= $nbpiece ->rowCount();
							echo $count;

							?>
						</div>

						<div class="colonnedroite">

							<label> Type de pièce :  </label>
							<?php 

							while($p=$requser2->fetch() ) 
								{?> 
									<li>	<input type="text" class="RentrerInfo" id="<?php echo $p['id']?>" name="<?php echo $p['nom'] ?>" value="<?php echo $p['nom']?>"  minlength="2" maxlength="16" size="16">
									</li>

								<?php }?>
								<label > Addresse : </label>
								<input type="text" class="RentrerInfo" name="newadresse" value="<?php echo $user['adresse']?>" minlength="2" size="10">   
								<label > Ville : </label>
								<input type="text" class="RentrerInfo" name="newville" value="<?php echo $user['ville']?>" minlength="2" size="10">   

								<input type="submit" name="modifMaison" id="modifMaison" value="Modifier">

							</div>

						</FORM>	

						
					</fieldset>
				</div>



				<?php
				if (isset($_POST['valid1'])) {

					$nomM = htmlspecialchars($_POST['nommaison']);
					$paysM =htmlspecialchars($_POST['pays']);
					$villeM =htmlspecialchars($_POST['ville']);
					$cpM =htmlspecialchars($_POST['cp']);
					$adresseM =htmlspecialchars($_POST['adresse']);



					$habitation = $_GET['habitation'];

					$inserthabitation = $bdd->prepare("INSERT INTO habitation(nomhabitation, pays, ville, cp, adresse, id_personne) VALUES(?, ?, ?,?, ?,?)");
					$inserthabitation->execute(array($nomM, $paysM , $villeM, $cpM, $adresseM));

				}

				?>

				<form method="POST" > 

					<div id="ajouthab">

						<div class="colonnegauche">

							<div id="ajoutHab1">

								<label for="nomdelamaison"> Nom de la  Maison: </label>
								<input type="text" class="RentrerInfoT" name="nommaison" required minlength="2" maxlength="16" size="16" id="m">

								<label for="pays"> Pays : </label>
								<input type="text" class="RentrerInfoT" name="pays" required min="0" id="p">

								<label for="ville"> Ville :</label>
								<input type="text" class="RentrerInfoT" name="ville" required min="0" id="v">




							</div>

						</div>

						<div class="colonnedroite">

							<div id="ajoutHab2">

								<label for="cp"> Code Postal : </label>
								<input type="text" class="RentrerInfoT" name="cp" required min="0" id="c">

								<label for="adresse"> Adresse: </label>
								<input type="text" class="RentrerInfoT" name="adresse" required minlength="2" size="10" id="a">

								<input type="submit" value="Valider" class="envoyer" name="valide1">
								<input type="button" value="Annuler" class="envoyer" id="suppr" onclick="Supr()">


							</div>

						</div>

					</div>
				</form>

				<fieldset id="utilSecond">
					<legend > <ul class="utilisateursecond">

						<form method="POST">

							<?php

							$usersecond =$bdd->prepare("SELECT * FROM secondaire  WHERE id_principal=".$_SESSION['id']."   ");

							$usersecond ->execute();

							$tabsecond=$usersecond->fetchAll(PDO::FETCH_ASSOC);




							foreach ($tabsecond as $row) {

								echo '<li> <input type="radio" name="secondaire" value="'.$row['id_second'].' " class="user" id="'.$row['id_second' ].'"  onchange="AfficheMail()" > '.$row['nom'].' '.$row['prenom'].'   </li>' ;


								$usersecond->closeCursor();


							}


							?>
							<input type="submit" value="Choix utilisateurs secondaires" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="Secondaires">
						</form>


					</ul>
				</legend>

				<ul class ="Maison">
					<?php 

					$habitation =$bdd->prepare('SELECT nomhabitation  FROM habitation  WHERE id_habitation= "'.$user['id_habitation'].'" ');

					$habitation ->execute();

					$tabhab=$habitation->fetchAll(PDO::FETCH_ASSOC);


					foreach ($tabhab as $row) {

						echo '<li> '.$row['nomhabitation'].'  </li>' ;

					}

					?>

				</ul>

				<?php


				if (isset($_POST['Secondaires'])) {

					$email =$bdd->prepare('SELECT mail  FROM secondaire  WHERE id_second= "'.$_POST['secondaire'].'" ');
					$email->execute();
					$tabmail=$email->fetchAll(PDO::FETCH_ASSOC);

					foreach ($tabmail as $row) {

						echo ' <br> '.$row['mail'].' <br>  ' ;

					}



					$piece =$bdd->prepare('SELECT nom, id_piece FROM piece  WHERE id_habitation= "'.$user['id_habitation'].'" ');
					$piece ->execute();
					$tabpiece=$piece->fetchAll(PDO::FETCH_ASSOC);

					echo '<table>
					<tr>
					<th><h4>Pièces</h4></th>
					<th><h4>Visualiser les données</h4></th>
					<th><h4>Envoyer des ordres aux actionneurs</h4></th>
					<th><h4>Ajouter des capteurs</h4></th>
					<th><h4>Ajouter des piéces</h4></th>

					</tr>';

					foreach($tabpiece as $row){
						echo ' <tr>
						<th> '.$row['nom'].' </th> 
						<td><input type="checkbox" name="Sélec" value=""  id="MpD'.$row['id_piece'].'"></td>
						<td><input type="Checkbox" name="Sélec" value=""  id="MpO'.$row['id_piece'].'"></td>
						<td><input type="Checkbox" name="Sélec" value=""  id="MpAJC'.$row['id_piece'].'"></td>
						<td></td>


						</tr>' ;



					}

					echo '<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td> <input type="Checkbox" name="Sélec" value=""  <?php  id="MpAJP'.$user['id_habitation'].'"  > </td>
					</table>
					<input type="submit" value="Valider" class="envoyer">
					<input type="submit" value="Annuler" class="envoyer" id="suppr">';

				}




				?>



			</fieldset>





		</fieldset>

		<?php


		if (isset($_POST['ajouterUserS'])) {

			$id = $_GET['id'];
			$habitation=$_GET['id_habitation'];
			$nom = htmlspecialchars($_POST['nom']);
			$prenom = htmlspecialchars($_POST['prenom']);
			$mail = ($_POST['mail']);
			$numero = ($_POST['numero']);
			$mdp = sha1($_POST['mdp']);
			$mdp2 = sha1($_POST['mdp2']);
			$second= 1; 

			if (!empty($_POST['nom'])AND !empty($_POST['prenom'])AND!empty($_POST['mail'])AND!empty($_POST['mdp'])) 
			{
				$nomlenght = strlen($nom);
				if ($nomlenght<= 255)
				{
					$prenomlenght = strlen($prenom);
					if ($prenomlenght<= 255)
					{
						$maillenght = strlen($mail);
						if ($maillenght<= 255)
						{
							if ($mdp==$mdp2)
							{ 
								if (strlen($_POST['mdp']) >=10)
								{
									if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $_POST['mdp'])) 
									{
										if (filter_var($mail,FILTER_VALIDATE_EMAIL)) 
										{
											$reqmail = $bdd->prepare("SELECT * FROM personne WHERE mail = ?");
											$reqmail->execute(array($mail));
											$mailexist = $reqmail->rowCount();
											if ($mailexist==0) 
											{
												$longueurKey=15;
												$key="";
												for ($i=1;$i<$longueurKey;$i++){
													$key.=mt_rand(0,9); }
													if (isset($_POST['choix']))
													{

														$insertmbr = $bdd->prepare("INSERT INTO personne(nom, prenom, mail, mdp, numero, confirmkey, Secondaire) VALUES(?, ?, ?, ?, ?, ?, ? )");

														$insertmbr->execute(array($nom, $prenom, $mail, $mdp, $numero, $key, $second));


														$insertsecond= $bdd->prepare("INSERT INTO secondaire(id_principal, id_habitationS, nom, prenom, mail) VALUES( ?, ?, ?, ?, ? )");
														$insertsecond->execute(array($id, $habitation,$nom, $prenom, $mail ));



                                        //header("Location: salon.php?id=".$_SESSION['id']);
														$header="MIME-Version: 1.0\r\n";
														$header.='From:"Hexagon.com"<projet@gmail.com>'."\n";
														$header.='Content-Type:text/html; charset="utf-8"'."\n";
														$header.='Content-Transfer-Encoding: 8bit';
														$message='
														<html>
														<body>
														<div align="center">
														Bonjour ,
														par mesure de sécurité vous devez confirmer votre inscription, comme utilisateur secondaire de '.$_SESSION['prenom'].' '.$_SESSION['nom'].' ,  en cliquant sur ce lien: 
														<a href="http://127.0.0.1/Hexagon/confirmation.php?mail='.urlencode($mail).'&key='.$key.'">Confirmez votre compte !</a>




														</div>
														</body>
														</html>
														';
														mail($mail, "Confirmation de l'inscription", $message, $header);
														header("Location: index.php");
													}  
													else {
														$erreur = "Vous n'avez pas accepter les conditions générales d'utilisation, inscription impossible";
													}}
													else
													{
														$erreur = "Votre email est déjà associé à un compte";
													}
												}
												else
												{
													$erreur = "Email invalide";
												}
											}
											else
											{
												$erreur = "Votre mot de passe doit au moins contenir une majuscule, une minuscule, un caractère spécial et un chiffre";
											}
										}
										else 
										{
											$erreur = "Votre mot de passe doit avoir plus de 10 caractères";
										}
									}
									else 
									{
										$erreur = "Vous n'avez pas saisi les mêmes mot de passe";
									}
								}
								else
								{
									$erreur = "Votre mail ne doit pas dépasser 255 caractères";
								}          

							}
							else
							{
								$erreur = "votre prenom ne doit pas dépasser 255 caractères ";
							}

						}
						else
						{
							$erreur = "Votre nom ne doit pas dépasser 255 caractères";
						}
					}
					else   
					{
						$erreur = "Tous les champs doivent être complétés.";
					}

				}
				?>

				<div id="ajouterUserS">
					<h1>Formulaire d'inscription utilisateur secondaire</h1>
					<form method="POST" action="" ">


						<div >
							<div>
								<label for="nom">Nom :</label>
								<input type="text" id="noms" name="nom"   value="<?php if(isset($_POST['nom'])) {echo $nom;} ?>" autofocus required>
							</div>

							<div>
								<label for="prenom">Prénom :</label>
								<input type="text" id="prenoms" name="prenom"  value="<?php if(isset($_POST['prenom'])) {echo $prenom;} ?>" required>
							</div>

							<div>
								<label for="mail">Courriel :</label>
								<input type="text" id="mails" name="mail" placeholder="hexagon@gmail.com"   value="<?php if(isset($_POST['mail'])) {echo $mail;} ?>" required>
							</div>

							<div>
								<label for="motdepasse">Définir son mot de passe :</label>
								<input type="password" id="mdps" name="mdp" required>
							</div>

							<div>
								<label for="motdepasse">Confirmer son mot de passe :</label>
								<input type="password" id="mdps2" name="mdp2" required>
							</div>


							<div>
								<label for="numero de telephone">Numéro de téléphone :</label>
								<input type="tel" id="numero" placeholder="+336xxxxxxxxx" name="numero"  value="<?php if(isset($_POST['numero'])) {echo $numero;} ?>" required>
							</div>

							<p><input type="checkbox" name="choix"> J'ai lu et j'accepte les conditions générales d'utilisation <a href="conditions.php" onclick="window.open(this.href); return false;" > Conditions d'utilisation </a></p>

							<div class="button">
								<button type="submit" name="ajouterUserS" >Inscription</button>
							</div>

						</div>

					</form>

				</div>

			</div> 










			<?php 

			include "footer.php";

			?>



		</body>
		</html>
