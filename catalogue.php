<!DOCTYPE html>
<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','', array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

?>
<html>
<link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
		<link rel="stylesheet" href="catalogue.css" />
		<link rel="stylesheet" type="text/css" href="general.css">
		<title>Catalogue</title>
	</head>
	<body>
		<div id="bloc_page">
		<!-- bloc1-->
				<?php if (isset($_SESSION['id'])) {
	include "header_deco.php"; }
	else {
		include "header_connexion.php";
	}

$luminosite = $bdd -> query('SELECT * FROM catalogue WHERE id_type="1"');
$temperature = $bdd -> query('SELECT * FROM catalogue WHERE id_type="2"');
$mouvement = $bdd -> query('SELECT * FROM catalogue WHERE id_type="3"');
$fumee = $bdd -> query('SELECT * FROM catalogue WHERE id_type="4"');
$volet = $bdd -> query('SELECT * FROM catalogue WHERE id_type="5"');
?>  
		<h1>Catalogue</h1>
			<meta charset="UTF-8" />
		<section>
			<div class="sidenav">
			<p>Capteurs</p>
		  	<a href="#capteur_luminosite">Luminosité</a>
		  	<a href="#capteur_temphumi">Humidité</a>
		  	<a href="#capteur_mouvement">Mouvements</a>
		  	<a href="#capteur_fumee">Fumée</a>
		  	<a href="#capteur_volet">Volets</a>
		  	<a href="#capteur_temphumi">Température</a>
			</div>
		<article>
		
		<div class="recherche_p">
			
			<form id="searchthis" method="get">
				<input id="search" name="q" type="text" placeholder="Rechercher (ex: nom,type,...)" />

				<input id="search-btn" type="submit" value="Rechercher" />
			</form>
			<?php

			$articles = $bdd->query('SELECT * FROM catalogue  JOIN type_capteur ON catalogue.id_type=type_capteur.id_type_capteur  ORDER BY id_capteur');
			if (empty($_GET['q'])) {
				//rien ne se passe
			}
			else if(isset($_GET['q']) AND !empty($_GET['q'])) {
			   $q = htmlspecialchars($_GET['q']);
			   $articles = $bdd->query('SELECT * FROM catalogue JOIN type_capteur ON catalogue.id_type=type_capteur.id_type_capteur WHERE nom_type_capteur LIKE "%'.$q.'%" ');
			   if($articles->rowCount() == 0) {
			      $articles = $bdd->query('SELECT * FROM catalogue JOIN type_capteur ON catalogue.id_type=type_capteur.id_type_capteur WHERE CONCAT(nom_type_capteur, description, nom) LIKE "%'.$q.'%" ');
			   }
			   if($articles->rowCount() > 0) { ?>
			   <h2>Résultat pour " <?= $q ?> " :</h2>
			   <?php while($a = $articles->fetch()) { ?>
				    <h3><?= $a['nom'] ?></h3>
					<img src="<?=$a['photo2']?>" id="capteur" width="150em" height="150em"><br>
					<h3><?= $a['prix']?>€</h3><br><br>
			   <?php } ?>
			   
			<?php } else { ?>
			<h2> Aucun résultat pour:" <?= $q ?> "...</h2>
			<?php }} ?>
			
			
			
			
			
		</div>

		</br>
		
		<!--<img src="capteur.png" alt="logo Hexagon" id="capteur">-->
		<div id="capteur_luminosite">
		</br></br>
		<p align="center"><b><FONT size ="5">Les capteurs de luminosité</FONT></b></p></br></br>
		
			<div class="row">
				<hr  color="#D6D6D6" width="95%">
				 <?php while($c=$luminosite->fetch()) { ?>
	  			<div class="column">

					<img src="<?=$c['photo2']?>" id="capteur" width="150em" height="150em">

					<div class="informations">	
						<h2><?= $c['nom']?></h2>
					    <p><?= $c['description']?> <br> Référence : <?=$c['reference']?></p>
					  	<h2><?= $c['prix']?>€</h2>
					</div>

				</div>
				
				<?php }?>
				<hr  color="#D6D6D6" width="95%">
			</div>
		</div>
		<div id="capteur_temphumi">
	</br><br/></br></br></br>

		<p align="center"><b><FONT size ="5">Les capteurs de température et d'humidité</FONT></b></p></br></br>
				
			<div class="row">
				<hr  color="#D6D6D6" width="95%">
				<?php while($c=$temperature->fetch()) { ?>
	  			<div class="column">
					<img src="<?=$c['photo2']?>" id="capteur" width="150em" height="150em">
					<div class="informations">
		    			<h2><?= $c['nom']?></h2>
					    <p><?= $c['description']?> <br>Référence : <?=$c['reference']?></p>
					  	<h2><?= $c['prix']?>€</h2>
					</div>	
				</div>
						 		
				<?php }?>
				<hr  color="#D6D6D6" width="95%">

			</div>
		</div>

	  	<div id="capteur_mouvement">
	</br></br></br></br></br>
		<p align="center"><b><FONT size ="5">Les détecteurs de mouvements</FONT></b></p></br></br></br></br>
	  			<div class="row">
	  			<hr  color="#D6D6D6" width="95%">
				<?php while($c=$mouvement->fetch()) { ?>
		  			<div class="column">
						<img src="<?=$c['photo2']?>" id="capteur" width="150em" height="150em">	
						<div class="informations">
			    			<h2><?= $c['nom']?></h2>
						    <p><?= $c['description']?> <br>Référence : <?=$c['reference']?></p>
						  	<h2><?= $c['prix']?>€</h2>
						</div>
					</div>

		 	
				<?php }?>
				<hr  color="#D6D6D6" width="95%">
				</div>
		</div>

		<div id="capteur_fumee">
		</br></br></br></br></br>
		<p align="center"><b><FONT size ="5">Les détecteurs de fumée</FONT></b></p></br></br></br></br>
		

			<div class="row">
				<hr  color="#D6D6D6" width="95%">
				 <?php while($c=$fumee->fetch()) { ?>
	  			<div class="column">

					<img src="<?=$c['photo2']?>" id="capteur" width="150em" height="150em">

					<div class="informations">	
						<h2><?= $c['nom']?></h2>
					    <p><?= $c['description']?> <br> Référence : <?=$c['reference']?></p>
					  	<h2><?= $c['prix']?>€</h2>
					</div>

				</div>
				
				<?php }?>
				<hr  color="#D6D6D6" width="95%">
			</div>
		</div>


		<div id="capteur_volet">
		</br></br></br></br></br>

		<p align="center"><b><FONT size ="5">Les récepteurs de volets roulants</FONT>

		</b></p></br></br></br></br>
		
			<div class="row">
				<hr  color="#D6D6D6" width="95%">
				 <?php while($c=$volet->fetch()) { ?>
	  			<div class="column">

					<img src="<?=$c['photo2']?>" id="capteur" width="150em" height="150em">

					<div class="informations">	
						<h2><?= $c['nom']?></h2>
					    <p><?= $c['description']?> <br> Référence : <?=$c['reference']?></p>
					  	<h2><?= $c['prix']?>€</h2>
					</div>

				</div>
				<?php }?>
				<hr  color="#D6D6D6" width="95%">
			</div>
	  	</div>


		
		</article>
	</section>

	</body>
			<?php 
	
		include "footer.php";
	
?>
</html>