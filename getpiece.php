<?php


$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','',array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

if (isset($_GET['q']))   {
$q = $_GET["q"];
$h = $_GET['h'];

}
if (isset($_POST['modifier'])) {

    $c=$_POST['mouvement'];
    $insertcapteur = $bdd->prepare("UPDATE capteurpiece SET valeur=? ");
    $insertcapteur-> execute(array(2));
  
}

?>
<head>
    <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="sallestyle.css" /> 

</head>
<?php 
  $luminosite = $bdd -> prepare('SELECT * FROM type_capteur JOIN capteurpiece ON type_capteur.id_type_capteur=capteurpiece.id_type WHERE id_type=? AND id_piece=?');
  $luminosite ->  execute(array(1,$q));
  $temperature = $bdd -> prepare('SELECT * FROM type_capteur JOIN capteurpiece ON type_capteur.id_type_capteur=capteurpiece.id_type WHERE id_type=? AND id_piece=?');
  $temperature ->  execute(array(2,$q));
  $mouvement = $bdd -> prepare('SELECT * FROM type_capteur JOIN capteurpiece ON type_capteur.id_type_capteur=capteurpiece.id_type WHERE id_type=? AND id_piece=?');
  $mouvement ->  execute(array(3,$q));
  $fumee = $bdd -> prepare('SELECT * FROM type_capteur JOIN capteurpiece ON type_capteur.id_type_capteur=capteurpiece.id_type WHERE id_type=? AND id_piece=?');
  $fumee ->  execute(array(4,$q));
  $volet = $bdd -> prepare('SELECT * FROM type_capteur JOIN capteurpiece ON type_capteur.id_type_capteur=capteurpiece.id_type WHERE id_type=? AND id_piece=?');
  $volet ->  execute(array(5,$q));
  $humidite = $bdd -> prepare('SELECT * FROM type_capteur JOIN capteurpiece ON type_capteur.id_type_capteur=capteurpiece.id_type WHERE id_type=? AND id_piece=?');
  $humidite ->  execute(array(6,$q));
 ?>
    <div id="titreSet">

      <form method="post">

        <div class="FDP">
          <form><?php
           echo' <div class="cell">';
          include "affichagecaptl.php";
          include "affichagecaptm.php";
          include "affichagecaptf.php";
           echo'</div>';
          echo' <div class="cell">';
         
          include "affichagecaptv.php";
          include "affichagecapth.php";
          include "affichagecaptt.php"; ?>
        </div>
          <input type="submit" id="modifier" name="modifier" value="Activer les modifications" >

        </form>
          <div class="ajout">
<?php echo'<a href="capteur.php?id_habitation='.$h.'&id_piece='.$q.'"> Ajouter des capteurs</a>';?> </div>


</div>
