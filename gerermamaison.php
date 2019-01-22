
<script type="text/javascript">
function AfficheTableau(str,habitation){

  if (window.XMLHttpRequest) {
      xmlhttp= new XMLHttpRequest();
                } else {
                    if (window.ActiveXObject)
                        try {
                            xmlhttp= new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            try {
                                xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
                            } catch (e) {
                                return NULL;
                            }
                        }
                }
        xmlhttp.onreadystatechange = function ()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        document.getElementById("contenu").innerHTML = xmlhttp.responseText;
                    }
                }
              
        xmlhttp.open("GET", "getutilisateur.php?q=" + str +"&h=" + habitation , true);
        xmlhttp.send();
}
		function AfficheFormulaire(){
			
			
		
			

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


			
		

			if(UserSecRadio.checked==true) {
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


		function SuprFU(){



			var InfoBox=document.querySelectorAll('.RentrerInfoFU');

			var i=0;

			for (i;i<InfoBox.length;i++){
				InfoBox[i].value="";
			}



		}
		
	</script>

<?php 
session_start();
try {
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','',array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
  if (isset($_SESSION['id']))
  {
    $getid = intval($_SESSION['id']);
    $requser = $bdd -> prepare('SELECT * FROM personne WHERE id = ?');
    $requser -> execute(array($getid));
    $userinfo = $requser ->fetch();

    
  }
  else {
    exit();
  }
}
catch(Exception $e){
  die('Erreur : ' . $e->getMessage());
}

$gethabitation=intval($_GET['id_habitation']);
$requser = $bdd -> prepare('SELECT * FROM habitation JOIN personne ON personne.id = habitation.id_personne WHERE (id = ?) AND (id_habitation = ?)');
$requser -> execute(array($getid,$gethabitation));
$user = $requser ->fetch();
$requser2 = $bdd -> prepare('SELECT * FROM piece WHERE (id_habitation = ?)');
$requser2 -> execute(array($gethabitation));

if (isset($_POST['ajouterUserS'])) {

			if (!empty($_POST['nom'])AND !empty($_POST['prenom'])AND!empty($_POST['mail'])AND!empty($_POST['mdp'])) 
			{
				$nom = htmlspecialchars($_POST['nom']);
			$prenom = htmlspecialchars($_POST['prenom']);
			$mail = htmlspecialchars($_POST['mail']);
			$numero = intval($_POST['numero']);
			$mdp = sha1($_POST['mdp']);
			$mdp2 = sha1($_POST['mdp2']);
		
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

														$insertmbr = $bdd->prepare("INSERT INTO personne(nom, prenom, mail, mdp, numero, confirmkey) VALUES(?, ?, ?, ?, ?, ?)");
														$insertmbr->execute(array($nom, $prenom, $mail, $mdp, $numero, $key));

														$reqsecond = $bdd -> prepare("SELECT * FROM personne WHERE mail = ? ");
								                        $reqsecond -> execute(array($mail));
								                        $usersecondaire = $reqsecond -> fetch();

													
														$insertsecond= $bdd->prepare("INSERT INTO secondairehab(id_principal, id_secondaire, id_habitation) VALUES( ?, ?, ?)");
														$insertsecond->execute(array($getid, $usersecondaire['id'], $gethabitation));
														
														$piece =$bdd->prepare('SELECT id_piece FROM piece  WHERE id_habitation= "'.$gethabitation.'" ');
                     									$piece ->execute();

                     									while ($p = $piece -> fetch()) {
															$insertsecond= $bdd->prepare("INSERT INTO secondaire(id_principal, id_utilisateur_secondaire, id_piece, id_habitation) VALUES( ?, ?,?, ?)");
															$insertsecond->execute(array($getid,$usersecondaire['id'],$p['id_piece'], $gethabitation));
														 
														}

														$usersecond =$bdd->prepare("SELECT * FROM secondairehab JOIN personne ON secondairehab.id_secondaire=personne.id WHERE id_principal=".$getid." AND id_habitation=".$gethabitation." ");
														$usersecond ->execute();

                                        
														$header="MIME-Version: 1.0\r\n";
														$header.='From:"Hexagon.com"<projet@gmail.com>'."\n";
														$header.='Content-Type:text/html; charset="utf-8"'."\n";
														$header.='Content-Transfer-Encoding: 8bit';
														$message='
														<html>
														<body>
														<div align="center">
														Bonjour ,
														par mesure de sécurité vous devez confirmer votre inscription, comme utilisateur secondaire de '.$usersecondaire['prenom'].' '.$usersecondaire['nom'].' ,  en cliquant sur ce lien: 
														<a href="http://127.0.0.1/Hexagon/confirmation.php?mail='.urlencode($mail).'&key='.$key.'">Confirmez votre compte !</a>




														</div>
														</body>
														</html>
														';
														mail($mail, "Confirmation de l'inscription", $message, $header);
														$erreur = "Utilisateur secondaire ajouté!";
														
														
													}  
													else {
														$erreur = "Vous n'avez pas accepter les conditions générales d'utilisation, inscription impossible";
													}}
													else
													{
														$erreur = "L'email inséré est déjà associé à un compte";
													}
												}
												else
												{
													$erreur = "Email invalide";
												}
											}
											else
											{
												$erreur = "Le mot de passe doit au moins contenir une majuscule, une minuscule, un caractère spécial et un chiffre";
											}
										}
										else 
										{
											$erreur = "Le mot de passe doit avoir plus de 10 caractères";
										}
									}
									else 
									{
										$erreur = "Vous n'avez pas saisi les mêmes mot de passe";
									}
								}
								else
								{
									$erreur = "L'email inséré ne doit pas dépasser 255 caractères";
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
if (isset($_POST['ajouter'])) {
					$nom = htmlspecialchars($_POST['nompiece']);
					$superficie = htmlspecialchars($_POST['superficie']);
					$habitation = intval($_GET['id_habitation']);

					$reqpiece = $bdd->prepare("SELECT * FROM piece WHERE id_habitation = ? AND nom= ?");
					$reqpiece->execute(array($habitation,$nom));
					$pieceexist = $reqpiece->rowCount();

					if ($pieceexist==0) {

						$insertpiece = $bdd->prepare("INSERT INTO piece(nom, id_habitation, superficie) VALUES(?, ?, ?)");
						$insertpiece->execute(array($nom, $habitation , $superficie));

							$requser2 = $bdd -> prepare('SELECT * FROM piece WHERE (id_habitation = ?)');
					$requser2 -> execute(array($gethabitation));
						$reqpiece2 = $bdd -> prepare("SELECT id_piece FROM piece WHERE nom = ? ");
                        $reqpiece2 -> execute(array($nom));
                        $pieceinfo = $reqpiece2 -> fetch();
                        $reqsecond = $bdd -> prepare("SELECT * FROM secondairehab WHERE id_principal = ? AND id_habitation = ? ");
						$reqsecond -> execute(array($getid,$gethabitation));
						$erreur = "Pièce ajoutée!";
						while ($u = $reqsecond -> fetch()) {
							$insertsecond= $bdd->prepare("INSERT INTO secondaire(id_principal, id_utilisateur_secondaire, id_piece, id_habitation) VALUES( ?, ?,?, ?)");
							$insertsecond->execute(array($getid, $u['id_secondaire'],$pieceinfo['id_piece'], $habitation));

						}
					}
					else {
						$erreurp= "Ce nom de pièce existe déjà";
					}
}
 if(isset($_GET['utilisateursuppr']) AND !empty($_GET['utilisateursuppr'])) {
				 	  $utilisateursupprime = intval($_GET['utilisateursuppr']);
				      $req1 = $bdd->prepare('DELETE FROM personne WHERE id = ?');
				      $req1->execute(array($utilisateursupprime));
				      $usersecond =$bdd->prepare("SELECT * FROM secondairehab JOIN personne ON secondairehab.id_secondaire=personne.id WHERE id_principal=".$getid." AND id_habitation=".$gethabitation." ");
					  $usersecond ->execute();
}


if (isset($_POST['validation'])) {
	if (!empty($_POST['visualiser'])) {
		foreach ($_POST['visualiser'] as $select)
	     {
	       $value =explode(',',$select);  

	     $insertcondition = $bdd->prepare("UPDATE secondaire SET visualiser=? WHERE id_piece = ? AND id_utilisateur_secondaire = ?");
	        $insertcondition-> execute(array($value[2],$value[0],$value[1]));

	     }
  	}
  	if (!empty($_POST['modifiervaleur'])) {
		foreach ($_POST['modifiervaleur'] as $select)
	     {
	       $value =explode(',',$select);  

	     $insertcondition = $bdd->prepare("UPDATE secondaire SET modifiervaleur=? WHERE id_piece = ? AND id_utilisateur_secondaire = ?");
	        $insertcondition-> execute(array($value[2],$value[0],$value[1]));

	     }
  	}
  	if (!empty($_POST['ajoutercapteur'])) {
		foreach ($_POST['ajoutercapteur'] as $select)
	     {
	       $value =explode(',',$select);  

	     $insertcondition = $bdd->prepare("UPDATE secondaire SET ajoutercapteur=? WHERE id_piece = ? AND id_utilisateur_secondaire = ?");
	        $insertcondition-> execute(array($value[2],$value[0],$value[1]));

	     }
  	}
  	if (!empty($_POST['supprimercapteur'])) {
		foreach ($_POST['supprimercapteur'] as $select)
	     {
	       $value =explode(',',$select);  

	     $insertcondition = $bdd->prepare("UPDATE secondaire SET supprimercapteur=? WHERE id_piece = ? AND id_utilisateur_secondaire = ?");
	        $insertcondition-> execute(array($value[2],$value[0],$value[1]));

	     }
  	}
}
if (isset($_POST['supprimermaison'])) {
	$reqmaison = $bdd->prepare('DELETE FROM habitation WHERE id_habitation = ?');
	$reqmaison->execute(array($gethabitation));
	header("Location: maisonsallecapteur.php");
}

?>


				
<html>
<head>
	<title>Gérer ma Maison</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="gerermamaisonstyle.css">


	

</head>
<body>
	<?php include "header_none.php" ?>
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">

	<div class="colonnedroite">
		<div class="box_profil">
			<img src="image/profil.png" class="photo_profil">
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


          <?php echo '<a id="menu" href="editerprofil.php" class="box">Editer profil</a>'; ?>

          <img src="image/parametre.jpg"
          class="avatar_box">
        </p>
      </li>



      <li>
        <p>
          <?php echo '<a id="menu" href="faq.php" class="box">Aide</a>'; ?>

          <img src="image/question.png" class="avatar_box">
        </p>
      </li>
      <li> 
       <p> <?php echo '<a id="menu" href="apropos.php"  class="box">A propos</a>'; ?>

       <img src="image/information.jpg" class="avatar_box">
     </p>
   </li>
   <li> 
     <p> <?php echo '<a id="menu" href="consignes.php"  class="box">Consignes globales</a>'; ?>

      <img src="image/attention.jpg" class="avatar_box">
    </p>
  </li>
   <li> 
           <p> <?php echo '<a id="menu" href="pagecontact.php?langue=fr"  class="box">Nous contacter</a>'; ?>

            <img src="image/telephone.jpg" class="avatar_box">
          </p>
      </li>
  <li> 
   <p> <?php echo '<a id="menu" href="catalogue.php"  class="box">Catalogue</a>'; ?>


   <img src="image/catalogue.svg" class="avatar_box">
 </p>



		</li>

		<li> 

			<p> <?php echo '<a href="maisonsallecapteur.php" class="box_rouge">Mes maisons</a>'; ?> 



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
					<li><input type="radio" name="Sélection" value="Modifier ma Maison" class="Selec" id="modmais" onchange="AfficheFormulaire()"> Modifier ma maison </li>
					<li><input type="radio" name="Sélection" value="Modifier utilisateur secondaire" class="Selec" id="ajutilsecond" onchange="AfficheFormulaire()"> Ajouter utilisateur secondaire </li>
					<li><input type="radio" name="Sélection" value="Modifier utilisateur secondaire" class="Selec" id="modutilsecond" onchange="AfficheFormulaire()"> Modifier utilisateur secondaire </li>


				</nav>
			</header>

			<?php

				if (isset($erreurp)) 
			      { 
			        echo '<font color="red">'.$erreurp."<br></font> ";
			      }
					 
				?>
			<div id="ajoutersalle">
				

				<fieldset>
					<legend><h2>Ajouter une salle :</h2></legend>
					<FORM method="POST">
						<strong><label>Nom de la maison :</label> </strong>
						<?php echo $user['nomhabitation'];?>
						</br></br>
						<label>Nom de la salle :</label>
						<input type="text" id="nom" name="nompiece"  class="RentrerInfoT"  wrequired>
						</br></br>
						<label>Superficie en m² :</label>
						<input type="number" id="superficie" name="superficie"  class="RentrerInfoT" min="0" value="0" required>
						</br></br>
						<input type="submit" name="ajouter" id="ajouter"  value="Ajouter">
						<input type="button" value="Annuler" class="envoyer" id="suppr" onclick="Supr()">

					</FORM>	
				</fieldset>

			</div>




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

					$paysh = htmlspecialchars($_POST['pays']);
					$newpays = $bdd->prepare("UPDATE habitation SET pays = '$paysh'  WHERE id_habitation = ".$user['id_habitation']." " );
					$newpays -> execute(array($paysh));

					$newpays->closeCursor();

					$cph = htmlspecialchars($_POST['newcp']);
					$newcp = $bdd->prepare("UPDATE habitation SET cp = '$cph'  WHERE id_habitation = ".$user['id_habitation']." " );
					$newcp -> execute(array($cph));

					$newcp->closeCursor();

					$typeh = htmlspecialchars($_POST['typemaison']);
					$newtype = $bdd->prepare("UPDATE habitation SET type = '$typeh'  WHERE id_habitation = ".$user['id_habitation']." " );
					$newtype -> execute(array($typeh));

					$newtype->closeCursor();
					while($p=$requser2->fetch() ) {



						$typeh = htmlspecialchars($_POST[ $p['nom'] ]);
						$newtypeh = $bdd->prepare("UPDATE piece SET nom = '$typeh'  WHERE id_piece = ".$p['id_piece']." " );
						$newtypeh -> execute(array($typeh));

						

					}
					$requser2 = $bdd -> prepare('SELECT * FROM piece WHERE (id_habitation = ?)');
					$requser2 -> execute(array($gethabitation));
					$gethabitation=intval($_GET['id_habitation']);
					$requser = $bdd -> prepare('SELECT * FROM habitation JOIN personne ON personne.id = habitation.id_personne WHERE (id = ?) AND (id_habitation = ?)');
					$requser -> execute(array($getid,$gethabitation));
					$user = $requser ->fetch();
					$erreurm = "Maison modifiée";
					if (isset($erreurm)) {
						echo '<font color="red">'.$erreurm."<br></font> ";
					}


				}

				?>



			<div id="modifiermaison">
				<fieldset>
					<legend><h2>Modifier ma maison :</h2></legend>
					<FORM method="POST" >
							<label> Nom de la  maison : </label>
							<input type="text" id="nomhabi" size="10" name="newnomhabitationm" value="<?php echo $user['nomhabitation']?>"  >
						<br>
						<br>
							<label>Superficie en m² : </label>
							<?php
							$superficietotal =  0 ;
							$superficie = $bdd -> query("SELECT superficie FROM piece WHERE id_habitation = '" . $user['id_habitation'] . "'");
							while ($row = $superficie->fetch()) {
								$superficietotal= $superficietotal + $row["superficie"];
							}
							echo $superficietotal;
							?>
							<br>
							<br>
							<label>Nombre de pièce : </label>
							<?php
							$nbpiece = $bdd -> prepare("SELECT * FROM piece WHERE id_habitation = '" . $user['id_habitation'] . "'");
							$nbpiece ->execute();
							$count= $nbpiece ->rowCount();
							echo $count;?>
							<br>
							<br>
							<label>Les pièces dans la maison :</label>
							<?php 

							while($p=$requser2->fetch() ) 
								{?> 
										<input type="text" id="<?php echo $p['id_piece']?>" name="<?php echo $p['nom'] ?>" value="<?php echo $p['nom']?>"  minlength="2" maxlength="16" size="10">
								<?php }?>
							<br>
							<br>
								<label > Addresse : </label>
								<input type="text" name="newadresse" size="30" value="<?php echo $user['adresse']?>" minlength="2" > 
							<br>
							<br>
								<label > Code postal : </label>
								<input type="text" name="newcp" value="<?php echo $user['cp']?>" minlength="2" size="10">  
							 
							<br>
							<br> 
								<label >Ville : </label>
								<input type="text" name="newville" value="<?php echo $user['ville']?>" minlength="2" size="10">   
							<br>
							<br>
								<label >Pays :</label>				     
									<?php include "pays.php";?>
							<br>
							<br>

								<label>Type de maison : </label>
								<select name="typemaison">
									<option value="Principale" <?php if($user['type'] == 'Principale') echo "selected"; ?>>Principale</option>
          							<option value="Secondaire"<?php if($user['type'] == 'Secondaire') echo "selected"; ?>>Secondaire</option>		
          						</select>
          					<br>
							<br>
								<input type="submit" name="modifMaison" id="modifMaison" value="Modifier">

						</FORM>	

						
				</fieldset>
				</div>



				<?php
				
				
				$usersecond =$bdd->prepare("SELECT * FROM secondairehab JOIN personne ON secondairehab.id_secondaire=personne.id WHERE id_principal=".$getid." AND id_habitation=".$gethabitation." ");
														$usersecond ->execute();

				$tabsecond=$usersecond->fetchAll(PDO::FETCH_ASSOC);?>
				<fieldset id="utilSecond">
					<legend > <ul class="utilisateursecond">
									
						<form method="POST">

							

						<?php 


							foreach ($tabsecond as $row) {

								echo '<li> <input type="radio" name="secondaire" value="'.$row['id_secondaire'].'" id="'.$row['id_habitation'].'" " class="user" onchange="AfficheTableau(this.value,this.id)" > '.$row['mail'].'  </li>' ;?>

								<a href='gerermamaison.php?id_habitation=<?=$gethabitation?>&amp;utilisateursuppr=<?=$row['id_secondaire']?>'>Supprimer l'utilisateur secondaire</a>
								<?php
								


							}


							?>
							
						</form>
						</ul>

					</legend>				   
					<form method="post">
				  	<div id="contenu">
     				</div>
     				</form>

				</fieldset>
				<?php if (isset($erreur)) 
			      { 
			        echo '<font color="red">'.$erreur."<br></font> ";
			      }?>
		
				<div id="ajouterUserS">
				
					<FIELDSET>

						<legend>
					<h2>Formulaire d'inscription utilisateur secondaire </h2></legend>
					<form method="POST" action="">

						</br>
						<div >
							<div>
								<label for="nom">Nom :</label>
								<input type="text" id="noms" name="nom"  class="RentrerInfoFU"   value="<?php if(isset($_POST['nom'])) {echo $nom;} ?>" autofocus required>
							</div>
							<br>

							<div>
								<label for="prenom">Prénom :</label>
								<input type="text" id="prenoms" name="prenom"   class="RentrerInfoFU" value="<?php if(isset($_POST['prenom'])) {echo $prenom;} ?>" required>
							</div>
							<br>

							<div>
								<label for="mail">Courriel :</label>
								<input type="text" id="mails" name="mail"   class="RentrerInfoFU" value="<?php if(isset($_POST['mail'])) {echo $mail;} ?>" required>
							</div>
							<br>
							<div>
								<label for="motdepasse">Définir son mot de passe :</label>
								<input type="password" id="mdps" name="mdp"  class="RentrerInfoFU" required>
							</div>
							<br>
							<div>
								<label for="motdepasse">Confirmer son mot de passe :</label>
								<input type="password" id="mdps2" name="mdp2"  class="RentrerInfoFU"  required>
							</div>
							<br>

							<div>
								<label for="numero de telephone">Numéro de téléphone :</label>
								<input type="tel" id="numero"  name="numero"   class="RentrerInfoFU" value="<?php if(isset($_POST['numero'])) {echo $numero;} ?>" required>
							</div>
							<br>
							<p><input type="checkbox" name="choix"> J'ai lu et j'accepte les conditions générales d'utilisation <a href="conditions.php" onclick="window.open(this.href); return false;" > Conditions d'utilisation </a></p>
							<br>
							<div class="button">
								<button type="submit" name="ajouterUserS" >Inscription</button>
								<input type="button" value="Annuler" class="envoyer" id="supprFU" onclick="SuprFU()">
							</div>

						</div>
							</fieldset>
					</form>

				</div>
			<form method="POST">
			<button name="supprimermaison" type="submit" class="snip1099 yellow"><span>Supprimer ma maison</span><i class="ion-android-arrow-forward"></i></button>
		</form>
			</div>
				<script src="gerermamaison.js"></script> 
		</body>
	