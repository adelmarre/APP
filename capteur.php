
<style>
	

fieldset {
	position: relative;
	margin-left: auto;
	margin-right: auto;
	margin-top: 5%;
	margin-bottom:auto;
	width: 50em;
	border:2px solid black;
	padding: 1%;
}




input[type=number]::-webkit-inner-spin-button,input[type=number]::-webkit-outer-spin-button {
   
   opacity: 1;

}



#capteur1{

	text-align: left;
	display: inline-flex;
	width: 35em;
	position: relative;
	margin-left: 0%;
	margin-top: 5%;
	padding-bottom: 1%;
	float: left;
}



#type{
	width: auto;
	padding-right: 6.5%;
	padding-left: 0.5%;
	
}



#ajouter{
	margin-top: 2%;
	width: 30%;
	height: 2.5em;
	position: relative;
	margin-right: 0%;
	margin-left: 70%;
	transition : all 0.3s;
	font-size: 1.5em;

}

#ajouter:hover{

	background-color: #008CBA; 
    color: white;

}




</style>
<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');
$suivant = 0;
if (isset($_GET['bouton']) AND !empty($_GET['fonctionnalite'])) {
	$fonctionnalite = $_GET['fonctionnalite'];
	$resultat= $bdd -> prepare('SELECT reference FROM catalogue WHERE id_type = ?');
	$resultat -> execute(array($fonctionnalite));
	$suivant = 1;  }

if (isset($_GET['ajouter']) AND !empty($_GET['reference'])) {
	$reference=  $_GET['reference'];
	$nb = $_GET['nombre'];
	$resultat1 = $bdd -> prepare('SELECT * FROM catalogue WHERE reference = ?');
	$resultat1 -> execute(array($reference));
	$capteur = $resultat1 -> fetch(); 
	$id = $capteur['id_capteur_catalogue'];
	$insertcapteur = $bdd->prepare("INSERT INTO capteurpiece(id_capteur_catalogue,nbcapteur) VALUES(?, ?)");
	$insertcapteur-> execute(array($id, $nb));
	$suivant=1;
}?>

<head>

	<meta charset="utf-8">
	<title>Ajouter un capteur</title>
</head>
<?php $type= $bdd -> query('SELECT DISTINCT nom_type_capteur,id_type_capteur FROM catalogue JOIN type_capteur ON catalogue.id_type=type_capteur.id_type_capteur');

$req1= $bdd-> prepare('SELECT * FROM piece WHERE id_habitation = ?');
$req1-> execute(array(1));
$piece = $req1 ->fetch();

?>

<body>
		
			<fieldset>
				
			<legend><h2>Ajouter un capteur:</h2></legend>
			<section>
	
					<h3>Maison:</h3>
						<p>Nom de la maison </p>

					<h3>Pièce :</h3>
						<p><?php echo $piece['nom']?></p>
					<h3> Superficie :</h3>
					<p><?php echo $piece['superficie']?> m^2</p>

				<div id="capteur1">
					<div id="type">
						<h3>Capteur:</h3>

							<FORM action="<?php echo $_SERVER['PHP_SELF']; ?>" >
							<SELECT name="fonctionnalite" size="1" >
								<option>
								<?php 
								while($donnees=$type->fetch()) 
								{
								?>
									<option value ="<?php echo $donnees['id_type_capteur']; ?>"><?php echo $donnees['nom_type_capteur']; ?></option>
							    <?php
							    
							        }
							    ?>

							</SELECT> 	
					
						<input type="submit" name="bouton" value="Envoyer">
					
					</form>
					<?php if ($suivant==1) {?>

					
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
					</div>
					<div id="type">

						<h3>Référence :</h3>
						

							<SELECT name="reference" size="1" >
								<OPTION >
								<?php 
							
								while($donnees=$resultat->fetch() ) 
								{
								?>
									<option value ="<?=$donnees['reference']?>"><?=$donnees['reference']?></option>
							    <?php
							    
							        }
							    ?>

							</SELECT> 
					</div>
					<div id="nb_capteur">
						<h3>Nombre de capteurs : </h3>
						<input type="number" name="nombre" value="0" min="0" max="5" id="nombre">
						<span class="validity"></span>
					</div>
				</div>
				<input type="submit" name="ajouter" id="ajouter" value="Ajouter">

				</FORM>	
				</div><?php }?> </fieldset>
</section>	
</body>
