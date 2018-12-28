<?php


$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','',array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

if (isset($_GET['q']))   {
$q = $_GET["q"];
$h = $_GET['h'];

}
if (isset($_POST['modifier'])) {
  if (isset($_POST['mouvement'])) {
    $c=$_POST['mouvement'];
    $insertcapteur = $bdd->prepare("UPDATE capteurpiece SET valeur=? WHERE id_capteur_piece= ?");
    $insertcapteur-> execute(array(1,$c));
  }
}

?>
<head>
    <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="sallestyle.css" /> 
  <link rel="stylesheet" type="text/css" href="general.css">
</head>
<?php 
  $luminosite = $bdd -> query('SELECT * FROM type_capteur JOIN capteurpiece ON type_capteur.id_type_capteur=capteurpiece.id_type WHERE id_type_capteur="1"');
  $temperature = $bdd -> query('SELECT * FROM type_capteur JOIN capteurpiece ON type_capteur.id_type_capteur=capteurpiece.id_type WHERE id_type_capteur="2"');
  $mouvement = $bdd -> query('SELECT * FROM type_capteur JOIN capteurpiece ON type_capteur.id_type_capteur=capteurpiece.id_type WHERE id_type_capteur="3"');
  $fumee = $bdd -> query('SELECT * FROM type_capteur JOIN capteurpiece ON type_capteur.id_type_capteur=capteurpiece.id_type WHERE id_type_capteur="4"');
  $volet = $bdd -> query('SELECT * FROM type_capteur JOIN capteurpiece ON type_capteur.id_type_capteur=capteurpiece.id_type WHERE id_type_capteur="5"');
  $humidite = $bdd -> query('SELECT * FROM type_capteur JOIN capteurpiece ON type_capteur.id_type_capteur=capteurpiece.id_type WHERE id_type_capteur="6"');
 ?>
    <div id="titreSet">

      <form method="post" action traitement.php>

        <div class="FDP">
          <?php 
          $captlum = $bdd -> prepare('SELECT * FROM capteurpiece WHERE id_type=? AND id_piece =?'); 
          $captlum -> execute(array(1,$q));
          $capttemp = $bdd -> prepare('SELECT * FROM capteurpiece WHERE id_type=? AND id_piece =?');
          $capttemp ->  execute(array(2,$q));
          $captmouv = $bdd -> prepare('SELECT * FROM capteurpiece WHERE id_type=? AND id_piece =? ');
          $captmouv ->  execute(array(3,$q));
          $captfumee = $bdd -> prepare('SELECT * FROM capteurpiece WHERE id_type=? AND id_piece =?');
          $captfumee -> execute(array(4,$q));
          $captvolet = $bdd -> prepare('SELECT * FROM capteurpiece WHERE id_type=? AND id_piece =?');
          $captvolet -> execute(array(5,$q));
          $capthumidite = $bdd -> prepare('SELECT * FROM capteurpiece WHERE id_type=? AND id_piece =?');
          $capthumidite -> execute(array(6,$q));

          $capthexist = $capthumidite->rowCount();
          $captlexist = $captlum->rowCount();
          $capttexist = $capttemp->rowCount();
          $captmexist = $captmouv->rowCount();
          $captfexist = $captfumee->rowCount();
          $captvexist = $captvolet->rowCount();
       ?><form><?php

          include "affichagecaptl.php";
          include "affichagecaptm.php";
          include "affichagecaptf.php";
          include "affichagecaptv.php";
          include "affichagecapth.php";
          include "affichagecaptt.php"; ?>
          <input type="submit" id="modifier" value="Activer les modifications" >

        </form>
          <div class="ajout">
<?php echo'<a href="capteur.php?id_habitation='.$h.'&id_piece='.$q.'"> Ajouter des capteurs</a>';?> </div>


</div>
