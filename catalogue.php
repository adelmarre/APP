<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');
?>
<html>
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="catalogue.css" />
		<title>Catalogue</title>
	</head>
	<body>
		<div id="bloc_page">
		<!-- bloc1-->
		<header>
			<img src="hexagon.png" alt="logo Hexagon" id="logo"></p>
		</header>
		<h1>Catalogue</h1>
		<img src="photo baniere.png" alt="logo Hexagon" id="baniere">
		<section>
			<div class="sidenav">
			<p>Capteurs</p>
		  	<a href="#">Luminosité</a>
		  	<a href="#">Humidité</a>
		  	<a href="#">Mouvements</a>
		  	<a href="#">Fumée</a>
		  	<a href="#">Volets</a>
		  	<a href="#">Température</a>
			</div>
		<article>
		
		<div class="recherche_p">
			<form action="/search" id="searchthis" method="get">
			<input id="search" name="q" type="text" placeholder="Rechercher" />
			<input id="search-btn" type="submit" value="Rechercher" />
			</form>
		</div>
		</br>
		
		<!--<img src="capteur.png" alt="logo Hexagon" id="capteur">-->		
		<div class="row">
			
  			<div class="column">
				<img src="captmouv.png" alt="capteur 1" id="capteur" width="80%">	
			</div>
	 		<div class="column">
    			<h2>Capteur de mouvement EVE</h2>
			    <p>Allume la lumière ou d’autres objets connectés lorsque vous entrez dans la pièce. A l'intérieur comme à l'extérieur, à placer où vous voulez, sur un meuble ou fixé au mur. </br> Angle de vue : 120°
</br>
			    </p><p align="right"> <a href="#">> Détails</a></p> <h2>50.07 €</h2>
			</div>
 			<div class="column">
  				<img src="capttemphum.png" alt="capteur 2" id="capteur" width="80%">	
 			</div>
  			<div class="column">
			    <h2>Capteur de température et d'humidité ThermoPro TP50</h2>
			    <p>Affiche l'humidité et la température simultanément et enregistre l'humidité et la température minimum et maximum. </br> Possède différents mode d'affichage </br>
			    </p><p align="right"> <a href="#">> Détails</a></p> <h2>14.99 €</h2>
  			</div>
		</div>
		<div class="row">
			<div class="column">
				<img src="capteur.png" alt="capteur 3" id="capteur">	
			</div>
	 		<div class="column">
    			<h2>Titre du produit</h2>
			    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet pretium urna. Vivamus venenatis velit nec neque ultricies, eget elementum magna tristique. Quisque vehicula, risus eget aliquam placerat, purus leo tincidunt eros, eget luctus quam orci in velit. Praesent scelerisque tortor sed accumsan convallis.</br>
			    </p><p align="right"> <a href="#">> Détails</a></p> <h2>-- $ </h2>
			</div>
			<div class="column">
	  			<img src="map.png" alt="logo Hexagon" id="capteur">	
	   			<p>Retrouvez nous en magasin !</p>
	  		</div>
	  	</div>


		
		</article>
	</section>

	</body>
</html>
