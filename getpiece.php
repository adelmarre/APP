<?php

session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','',array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

if (isset($_GET['q']))   {
$q = $_GET["q"];
$h = $_GET['h'];

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
          $getid= intval($_SESSION['id']);
          $reqsecondaire = $bdd->prepare("SELECT * FROM secondaire WHERE id_piece = ? AND id_utilisateur_secondaire = ?");
          $reqsecondaire->execute(array($q,$getid));
          $usersecondaire = $reqsecondaire ->fetch();
          $secondaire = $reqsecondaire->rowCount();

          if ($secondaire==0 || ($secondaire==1 && $usersecondaire['visualiser']==1 )) 
                  {
           echo' <div class="cell">';
          include "affichagecaptl.php";
          include "affichagecaptm.php";
          include "affichagecaptf.php";
           echo'</div>';
          echo' <div class="cell">';
         
          include "affichagecaptv.php";
          include "affichagecapth.php";
          include "affichagecaptt.php"; 
          echo'</div>';
        }
         else {
        echo " En tant qu'utilisateur secondaire vous ne pouvez pas visualiser les capteurs de cette pièce";
      }
        if ($secondaire==0 || ($secondaire==1 && $usersecondaire['modifiervaleur']==1 )) 
                  {
          echo "</br>";
          echo "<div class='container'>";

          echo '<button id="button" type="submit" id="modifier" name="modifier">Activer les modifications</button>';
          echo '</div>';
        }
       ?>
        </div>
        

        </form>
          <div class="ajout">
            <?php if ($secondaire==0 || ($secondaire==1 && $usersecondaire['ajoutercapteur']==1 )) 
                  {
            echo'<a class="ajouter" href="capteur.php?id_habitation='.$h.'&id_piece='.$q.'"> Ajouter des capteurs</a>';
}?>

 </div>

         <?php if ($secondaire==0 )
                  {
echo'<a class="supprimer" href="maisonsallecapteur.php?id_habitation='.$h.'&supprimer='.$q.'"> Supprimer la salle</a>';
}?>

</div>

