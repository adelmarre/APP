<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');
if (isset($_GET['id']) AND $_GET['id'] > 0)
{
    $getid = intval($_GET['id']);
    $requser = $bdd -> prepare('SELECT * FROM personne WHERE id = ?');
    $requser -> execute(array($getid));
    $userinfo = $requser ->fetch();
  }
?>

<html>
<head>
	<title>Gérer ma Maison</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="gerermamaisonstyle.css">
	<script type="text/javascript">
		function AfficheFormulaireAjMais(){
			
			
			

			var AjHab1=document.getElementById('gHab1');
			var AjHab2=document.getElementById('ajoutHab2');

			if (AjHab1.style.display='none' && AjHab2.style.dispaly){
			AjHab1.style.display='block';
			AjHab2.style.display='block';
		}
			else{
			AjHab1.style.display='none';
			AjHab2.style.display='none';
			}
			
			}
	</script>
</head>
<body>
	<header>
		<img src="logo hexagon.png" alt="logo Hexagon" id="logo_hexagon">
	</header>
</body>
</html>

<div class="colonnedroite">
	<div class="box_profil">
		<img src="profil.jpg" class="photo_profil">
		<br/>
    <div class="affichage_prenom">
      <?php echo $userinfo['prenom'];?></p>
    </div>
    <div class="affichage_nom">
       <?php echo $userinfo['nom'];?></p>
    </div>
</div>

	<nav>
		<ul class="box_information">
			<form  method="post" action="">
			<li>

       			<p> 
       				<a href="editerprofil.php?id=<?php echo $_SESSION['id'];?>" class="box">Editer mon profil</a>

					<img src="https://image.freepik.com/icones-gratuites/symbole-des-parametres_318-34202.jpg"
					class="avatar_box">
				</p>
			</li>
			<li>
				<p>
					<a href="Changer de profil" class="box">Changer de profil </a>

					<img src="https://image.freepik.com/icones-gratuites/changer-d-39-utilisateur_318-1783.jpg"
					class="avatar_box">
				</p>
			</li>
			<li>
				<p>
					<a href="Aide" class="box">Aide </a>
					<img src="https://images.emojiterra.com/twitter/512px/2753.png" class="avatar_box">
				</p>
			</li>
			<li>
				<p> <a href="A propos" class="box">A propos</a>
					<img src="https://image.freepik.com/icones-gratuites/informations-petite-lettre-symbole-i_318-
					54670.jpg" class="avatar_box">
				</p>
			</li>
			<li>
				<p> <a href="Consignes globales" class="box">Consignes globales</a>
					<img src="https://images-na.ssl-images-amazon.com/images/I/61OH1BsW99L._SY355_.jpg"
					class="avatar_box">
				</p>
			</li>
			<li>
				<p> <a href="Catalogue" class="box">Catalogue</a>
					<img src="https://svgsilh.com/svg_v2/160871.svg" class="avatar_box">
				</p>

			</li>
			<li>
				<p> <a href="gerermamaison" class="box_rouge">Gérer ma maison</a>
				</p>

			</li></form>

			<li>
				<p> <a href="deconnexion.php" class="box_rouge">Déconnexion</a>
				</p>

			</li>
		</ul>
	</nav>
</div>

<div class="colonnegauche">
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

	<div id="Centre">
		<fieldset id="set">
			<legend> <h1>Gérer ma maison</h1></legend>

			<header>
				<nav class="head2">
					<ul>
						<li><input type="button" value="Ajouter une salle" class="bouton" onclick="AfficheFormulaire()" id="ajsal"> </li>
						<li><input type="button" value="Modifier ma maison" class="bouton" onclick="AfficheFormulaire()" id="modmais"></li>
						<li><input type="button" value="Ajouter une maison" class="bouton" onclick="AfficheFormulaireAjMais()" id="ajmais"></li>
						<li><input type="button" value="Modifier utilisateurs secondaires" class="bouton" onclick="AfficheFormulaire()" id="modutilsecond"></li>
					</ul>
				</nav>
			</header>

			<form method="post" action="traitement.php"> 

				<div class="colonnegauche">

					<div class="ajoutHab1">

					<label for="nomdelamaison"> Nom de la  Maison: </label>
					<input type="text" class="RentrerInfo" name="nommaison" required minlength="2" maxlength="16" size="16">

					<label for="superficie"> Superficie en m°2: </label>
					<input type="number" class="RentrerInfo" name="superficie" required min="0">

					<label for="nbhab"> Nombre d'habitants: </label>
					<input type="number" class="RentrerInfo" name="nbhab" required min="0">
				</div>

				</div>

				<div class="colonnedroite">

					<div class="ajoutHab2">

					<label for="nbpiece"> Nombre de piéce: </label>
					<input type="number" class="RentrerInfo" name="nbpiece" required min="0" >

					<label for="addresse"> Addresse: </label>
					<input type="text" class="RentrerInfo" name="nommaison" required minlength="2" size="10">

					<input type="submit" value="Valider" class="envoyer">
					<input type="submit" value="Annuler" class="envoyer" is="suppr">
					
					</div>

				</div>

					</form>

				</fieldset>
</div>