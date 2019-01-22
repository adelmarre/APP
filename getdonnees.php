<?php


$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','',array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

if (isset($_GET['q']))   {
$q = intval($_GET["q"]);
$h = intval($_GET['h']);

}

?>
<head>
    <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="sallestyle.css" /> 

</head>
<?php 
  $historique = $bdd -> prepare('SELECT * FROM donnees WHERE  id_piece= ?');
  $historique ->  execute(array($q));

  $luminosite = $bdd -> prepare('SELECT * FROM donnees WHERE id_type=? AND id_piece=?');
  $luminosite ->  execute(array(1,$q));
  $temperature = $bdd -> prepare('SELECT * FROM donnees WHERE id_type=? AND id_piece=?');
  $temperature ->  execute(array(2,$q));
  $mouvement = $bdd -> prepare('SELECT * FROM donnees WHERE id_type=? AND id_piece=?');
  $mouvement ->  execute(array(3,$q));
  $fumee = $bdd -> prepare('SELECT * FROM donnees WHERE id_type=? AND id_piece=?');
  $fumee ->  execute(array(4,$q));
  $volet = $bdd -> prepare('SELECT * FROM donnees WHERE id_type=? AND id_piece=?');
  $volet ->  execute(array(5,$q));
  $humidite = $bdd -> prepare('SELECT * FROM donnees WHERE id_type=? AND id_piece=?');
  $humidite ->  execute(array(6,$q));



 ?>



       
          <?php
          echo '<div class="capteur">';
            include "affichagedonnee.php";
            echo '</div>';

              $historique->closeCursor();
              $luminosite->closeCursor();
              $temperature->closeCursor();
              $mouvement->closeCursor();
              $fumee->closeCursor();
              $volet->closeCursor();
              $humidite->closeCursor();
            ?>



