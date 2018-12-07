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
				<img src="capteurluminosite1.jpg" id="capteur" width="60%">	
			</div>
	 		<div class="column">
    			<h2>Capteur de luminosité S+S Regeltechnik</h2>
			    <p>Mesure l'intensité lumineuse. Permet la commande à distance de lampes, d'installations d'éclairage, de volets roulants et stores extérieurs.</br>Référence : CL001</br>
			    </p><p align="right"> <a href="#">> Détails</a></p> <h2>85 €</h2>
			</div>
 			<div class="column">
  				<img src="capteurluminosite2.jpg" id="capteur" width="75%">	
 			</div>
  			<div class="column">
			    <h2>Détecteur d'obscurité connecté DIO </h2>
			    <p>Allume automatiquement vos lampes ou baisse les volets de la maison en fonction du niveau d’obscurité que vous avez défini.</br>Référence : CL002</br>
			    </p><p align="right"> <a href="#">> Détails</a></p> <h2>29.90 €</h2>
  			</div>
		</div>


		<div class="row">
			
		<div class="column">
			<img src="luminosite3.jpg" id="capteur" width="90%">	
			</div>
	 		<div class="column">
    			<h2>Récepteur et interrupteur connectés pour éclairage DIO </h2>
			    <p>Vous permet d'allumer ou d'éteindre vos éclairages à distance.</br>Référence : CL003</br>
			     </p><p align="right"> <a href="#">> Détails</a></p> <h2>27.99 €</h2>
			</div>
		</div>


		<div class="row">

		<div class="column">
  				<img src="capteurtemphum1.jpg"  id="capteur" width="80%">	
 			</div>
  			<div class="column">
			    <h2>Capteur de température et d'humidité ThermoPro TP50</h2>
			    <p>Affiche l'humidité et la température simultanément et enregistre les valeurs minimales et maximales. </br> Possède différents modes d'affichage. Référence : CTH001 </br>
			    </p><p align="right"> <a href="#">> Détails</a></p> <h2>14.99 €</h2>
  			</div>
  		<div class="column">
  				<img src="capteurtemp2.jpg"  id="capteur" width="60%">	
 			</div>
  			<div class="column">
			    <h2>Thermomètre Bluetooth Oregon Scientific EMR 211</h2>
			    <p>Mesure, affiche et enregistre les températures intérieures ou extérieures.</br>Possibilité d'ajouter une sonde d'humidité. Possède un historique sur 7 jours. Référence : CTH002</br>
			    </p><p align="right"> <a href="#">> Détails</a></p> <h2>34.90 €</h2>
  			</div>
		</div>

		<div class="row">

		<div class="column">
  				<img src="capteurtemphum3.jpg"  id="capteur" width="80%">	
 			</div>
  			<div class="column">
			    <h2> Capteur de température et d'humidité Inkbird IBS-TH1</h2>
			    <p>Mesure le taux d'humidité et la température.</br> Haute précision. Référence : CTH003</br>
			    </p><p align="right"> <a href="#">> Détails</a></p> <h2>29.99 €</h2>
  			</div>
  		</div>

		<div class="row">
			
  			<div class="column">
				<img src="detecteurmvt1.png" id="capteur" width="80%">	
			</div>
	 		<div class="column">
    			<h2>Capteur de mouvement EVE</h2>
			    <p>Allume la lumière ou d’autres objets connectés lorsque vous entrez dans la pièce. A l'intérieur comme à l'extérieur, à placer où vous voulez, sur un meuble ou fixé au mur. </br> Angle de vue : 120°. Référence : CM001 </br>
			    </p><p align="right"> <a href="#">> Détails</a></p> <h2>50.07 €</h2>
			</div>
 			<div class="column">
  				<img src="detecteurmvt3.jpg" alt="capteur 2" id="capteur" width="65%">	
 			</div>
  			<div class="column">
			    <h2>Détecteur de mouvement Fibaro</h2>
			    <p>Détecte les mouvement dans votre habitation. </br>Portée: 30 m. Référence : CM002</br>
			    </p><p align="right"> <a href="#">> Détails</a></p> <h2>74.36 €</h2>
  			</div>
		</div>
		<div class="row">
			
		<div class="column">
			<img src="detecteurmvt2.jpg" alt="capteur 2" id="capteur" width="60%">	
			</div>
	 		<div class="column">
    			<h2>Détecteur de mouvement Beewi</h2>
			    <p>Détecte les mouvements dans votre habitation par infrarouge. Fonctionne avec piles.</br>Référence : CM003</br>
			     </p><p align="right"> <a href="#">> Détails</a></p> <h2>19.90 €</h2>
			</div>
		</div>


		<div class="row">
			
  			<div class="column">
				<img src="detecteurfumee2.png" alt="capteur 1" id="capteur" width="70%">	
			</div>
	 		<div class="column">
    			<h2>Détecteur de fumée Netatmo</h2>
			    <p>Détecteur de fumée connecté. Fonctionne sur batterie. </br>Référence : CF001</br>
			    </p><p align="right"> <a href="#">> Détails</a></p> <h2>99.99 €</h2>
			</div>
 			<div class="column">
  				<img src="detecteurfumee.jpg" alt="capteur 2" id="capteur" width="90%">	
 			</div>
  			<div class="column">
			    <h2>Détecteur de fumée Nest Protect</h2>
			    <p>Détecte les températures élevées et le taux d'humidité afin de vous avertir uniquement en cas de danger.</br> Capable de reconnaître un véritable incendie. Référence : CF002</br>
			    </p><p align="right"> <a href="#">> Détails</a></p> <h2>129 €</h2>
  			</div>
		</div>

		<div class="row">
			
  			<div class="column">
				<img src="detecteurfumee3.png" alt="capteur 1" id="capteur" width="80%">	
			</div>
	 		<div class="column">
    			<h2>Détecteur de fumée Eve</h2>
			    <p>Détecteur de fumée et de chaleur connecté. </br>Référence : CF003</br>
			    </p><p align="right"> <a href="#">> Détails</a></p> <h2>119.95 €</h2>
			</div>
		</div>


		<div class="row">
			
  			<div class="column">
				<img src="recepteurvolet.jpg" alt="capteur 1" id="capteur" width="80%">	
			</div>
	 		<div class="column">
    			<h2>3 récepteurs pour volets roulants Dio</h2>
			    <p>Récepteurs pour volet roulant reliés à des interrupteurs actionnables à distance.</br>Référence : CV001</br>
			    </p><p align="right"> <a href="#">> Détails</a></p> <h2>69.99 €</h2>
			</div>
 			<div class="column">
  				<img src="volet2.jpg" alt="capteur 2" id="capteur" width="85%">	
 			</div>
  			<div class="column">
			    <h2>Boitier micro-module Somfy</h2>
			    <p>Permet de commander l'ouverture et la fermeture des volets à distance. S'installe derrière votre interrupteur.</br>Référence : CV002</br>
			    </p><p align="right"> <a href="#">> Détails</a></p> <h2>52.90 €</h2>
  			</div>
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