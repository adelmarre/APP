<style>

.flip-container {
	perspective: 1000px;
	margin-right: auto;
	margin-left: auto;

}
	/* flip the pane when hovered */
	.flip-container:hover .flipper, .flip-container.hover .flipper {
		transform: rotateY(180deg);
	}

.flip-container, .front, .back {
	width: 300px;
	height: 150px;
}

/* flip speed goes here */
.flipper {
	transition: 0.6s;
	transform-style: preserve-3d;

	position: relative;
}

/* hide back of pane during swap */
.front, .back {
	backface-visibility: hidden;

	position: absolute;
	top: 0;
	left: 0;
}

/* front pane, placed above back */
.front {
	z-index: 2;
	/* for firefox 31 */
	transform: rotateY(0deg);
}

/* back, initially hidden pane */
.back {
	transform: rotateY(180deg);
}

</style>

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
	}

}
catch(Exception $e){
	die('Erreur : ' . $e->getMessage());
}

$type = $bdd -> prepare('SELECT * FROM habitation JOIN personne ON personne.id = habitation.id_personne WHERE id = ?');
$type-> execute(array($getid));
?>
<head>
	<title>Ma maison</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="mamaison.css">
	<link rel="stylesheet" type="text/css" href="general.css">

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
				<legend> <h1>Ma maison</h1></legend>
				<?php while($maison=$type->fetch()) { ?>
				<div class="flip-container" ontouchstart="this.classList.toggle('hover');">
					<div class="flipper">
						<div class="front">
							<img src="image/home.png" width="60%">
						</div>
						<div class="back">
							<?php echo '<a href="gerermamaison.php?id='.$_SESSION['id'].'&id_habitation='.$maison['id_habitation'].'"> '.$maison['nomhabitation']; ?></a> 
						</div>
					</div>
				</div>
				<?php }?>	
			</fieldset>


		</div>



	<?php 
	include "footer.php";?>
</body>
