

<?php 
session_start();
try {
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');
if (isset($_GET['id']) AND $_GET['id'] > 0)
{
  $getid = intval($_GET['id']);
  $requser = $bdd -> prepare('SELECT * FROM personne WHERE id = ?');
  $requser -> execute(array($getid));
  $userinfo = $requser ->fetch();
}
}
catch(Exception $e){
  die('Erreur : ' . $e->getMessage());
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
			
			
			

			var AjHab1=document.getElementById('ajoutHab1');
			var AjHab2=document.getElementById('ajoutHab2');

			var AjM=document.getElementById('ajmais');
			var UserSec=document.getElementById('modutilsecond');


			AjHab1.style.display='none';
			AjHab2.style.display='none';
			var FieldUser=document.getElementById('utilSecond');


			FieldUser.style.display='none';

			
			if(AjM.checked==true){
				AjHab1.style.display='block';
				AjHab2.style.display='block';
			}

			else if(UserSec.checked==true) {
				FieldUser.style.display='block';

				
			}
		}

		function AfficheMail(){
			var Mail=document.getElementById('mail');

			var US1=document.getElementById('uss1');
			var US2=document.getElementById('uss2');

			Mail.style.display='none';

			if(US1.checked==true  ||  US2.checked==true ){

				Mail.style.display='block';
			}
		}


		function AfficheTableau(){

			var US1=document.getElementById('uss1');
			var US2=document.getElementById('uss2');

			var MP=document.getElementById('MP');
			var SP=document.getElementById('SP');

			var Mail=document.getElementById('mail');

			var TMUS1=document.getElementById('tableauUS1MP');

			
			TMUS1.style.display='none';


			
			if(US1.checked==true  && MP.checked==true ){
				AfficheMail()
				TMUS1.style.display='table';
				
			}


		}



		

		
	</script>

</head>
<body>
	<?php include "header_none.php" ?>
	  <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">

	<div class="colonnedroite">
		<div class="box_profil">
			<img src="profil.jpg" class="photo_profil">
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

   <p> <?php echo '<a href="gerermamaison.php?id='.$_SESSION['id'].'" class="box_rouge">Gérer ma maison</a>'; ?> 
    


   </p>



 </li>


   <li> 

   <p> <?php echo '<a href="MaisonSalleCapteurTempo.php?id='.$_SESSION['id'].'" class="box_rouge">Ma Maison</a>'; ?> 
    


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
			<div id="menu_capteur">
				<ul class="meta_menu">
					<li class="menu_salles">
						<p>

							<input type="button" value="Salles ↓" class="bouton">
						</p>

						<form id="Capt">
							<ul class="sous_menu_salles" >
								<li class="PLI">
									<input type="radio" name="Sélection" value="Chambre 1" class="Selec"> Chambre 1
								</li>
								<li class="PLI">
									<input type="radio" name="Sélection" value="Chambre 2" class="Selec"> Chambre 2
								</li class="PLI">

								<li class="PLI">
									<input type="radio" name="Sélection" value="Cuisine" class="Selec"> Cuisine
								</li>
								<li class="PLI">
									<input type="radio" name="Sélection" value="Salle de bain" class="Selec"> Salle de bain
								</li>
								<li class="PLI">
									<input type="radio" name="Sélection" value="Salon" class="Selec"> Salon
								</li>
								<li class="PLI">

									<input type="radio" name="Sélection" value="Cave" class="Selec"> Cave
								</li>
							</ul>
						</form>
					</ul>
				</div>
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
								<li><input type="radio" name="Sélection" value="Modifier utilisateur secondaire" class="Selec" id="modutilsecond" onchange="AfficheFormulaire()"> Modifier utilisateur secondaire </li>

							</nav>
						</header>

						<form method="post" action="traitement.php"> 

							<div class="colonnegauche">

								<div id="ajoutHab1">

									<label for="nomdelamaison"> Nom de la  Maison: </label>
									<input type="text" class="RentrerInfo" name="nommaison" required minlength="2" maxlength="16" size="16">

									<label for="superficie"> Superficie en m°2: </label>
									<input type="number" class="RentrerInfo" name="superficie" required min="0">

									<label for="nbhab"> Nombre d'habitants: </label>
									<input type="number" class="RentrerInfo" name="nbhab" required min="0">
								</div>

							</div>

							<div class="colonnedroite">

								<div id="ajoutHab2">

									<label for="nbpiece"> Nombre de piéce: </label>
									<input type="number" class="RentrerInfo" name="nbpiece" required min="0" >

									<label for="addresse"> Addresse: </label>
									<input type="text" class="RentrerInfo" name="nommaison" required minlength="2" size="10">

									<input type="submit" value="Valider" class="envoyer">
									<input type="submit" value="Annuler" class="envoyer" id="suppr">

								</div>

							</div>

							<fieldset id="utilSecond">
								<legend > <ul class="utilisateursecond">
									<li><input type="radio" name="u" value="Utilisateur Secondaire 1" class="user" id="uss1" onchange="AfficheMail()" >Utilisateur Secondaire1 </li>
									<li><input type="radio" name="u" value="Utilisateur Secondaire 2" class="user" id="uss2" onchange="AfficheMail()">Utilisateur Secondaire2 </li>
								</ul>
							</legend>

							<ul class ="Maison">
								<li><input type="radio" name="m" value="Maison Principale" class="maison" id="MP" onchange="setTimeout(AfficheTableau,1000)">Maison Principale </li>
								<li><input type="radio" name="m" value="Maison Secondaire " class="maison" id="SP" onchange="setTimeout(AfficheTableau,1000)">Maison Secondaire </li>
							</ul>

							<div id="mail">
								<label for="nbhab"> Adresse Mail </label>
								<input type="text" class="RentrerInfo" name="email" required minlength="2" maxlength="32" size="16">
							</div>

							<div id="tableauUS1MP">
								<table>
									<tr>
										<th><h4>Pièces</h4></th>
										<th><h4>Visualiser les données</h4></th>
										<th><h4>Envoyer des ordres aux actionneurs</h4></th>
										<th><h4>Ajouter des capteurs</h4></th>
										<th><h4>Ajouter des piéces</h4></th>
										
									</tr>

									<tr>
										<th>Salon</th>
										<td><input type="checkbox" name="Sélec" value=""  id="MpDSal"></td>
										<td><input type="Checkbox" name="Sélec" value=""  id="MpOSal"></td>
										<td><input type="Checkbox" name="Sélec" value=""  id="MpAJCSal"></td>
										<td></td>
										

									</tr>

									<tr>
										<th>Chambre 1</th>
										<td><input type="checkbox" name="Sélec" value=""  id="MpDCH1"></td>
										<td><input type="Checkbox" name="Sélec" value=""  id="MpOCH1"></td>
										<td><input type="Checkbox" name="Sélec" value=""  id="MpAJCCH1"></td>
										<td></td>
										

									</tr>

									<tr>
										<th>Chambre 2</th>
										<td><input type="checkbox" name="Sélec" value=""  id="MpDCH2"></td>
										<td><input type="Checkbox" name="Sélec" value=""  id="MpOCH2"></td>
										<td><input type="Checkbox" name="Sélec" value=""  id="MpAJCCH2"></td>
										<td></td>
										
									</tr>


									<tr>
										<th>Cave</th>
										<td><input type="checkbox" name="Sélec" value=""  id="MpDCave"></td>
										<td><input type="Checkbox" name="Sélec" value=""  id="Mpcave"></td>
										<td><input type="Checkbox" name="Sélec" value=""  id="MpAJCCave"></td>
										<td></td>
										
									</tr>


									<tr>
										<th>Cuisine</th>
										<td><input type="checkbox" name="Sélec" value=""  id="MpDCui"></td>
										<td><input type="Checkbox" name="Sélec" value=""  id="MpOCui"></td>
										<td><input type="Checkbox" name="Sélec" value=""  id="MpAJCCui"></td>
										<td></td>
										
										
									</tr>

									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td> <input type="Checkbox" name="Sélec" value=""  id="MpAJP"> </td>


									</table>
									<input type="submit" value="Valider" class="envoyer">
									<input type="submit" value="Annuler" class="envoyer" is="suppr">
								</div>



							</form>

						</fieldset>


					</div>

					

						<?php 

						include "footer.php";

						?>

					</body>
					</html>