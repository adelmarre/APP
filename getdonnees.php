<?php


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
  $historique = $bdd -> prepare('SELECT * FROM donnees WHERE  id_piece=?');
  $historique ->  execute(array(1,$q));

 ?>
    <div id="titreSet">



        <div class="FDP">
          <?php
          echo '<div class="capteur">';
            include "affichagedonnee.php";
            echo '</div>';
            ?>

        </div>


