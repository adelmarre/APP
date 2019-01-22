<?php
include "verifadmin.php";

if(isset($_GET['type']) AND $_GET['type'] == 'consigne') {

  if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
    $supprime = (int) $_GET['supprime'];
    $req1 = $bdd->prepare('DELETE FROM consignes WHERE id_consignes = ?');
    $req1->execute(array($supprime));
   
  }    
}

$consignes = $bdd -> query('SELECT * FROM consignes ');
?>

<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
  <title>Admin - Afficher la page consignes</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="administrateur.css" /> 
   
</head>
<div class="snip1231">
 <a  class="current" href="deconnexion.php">Déconnexion</a>

<a class="current" href="administrateur.php">Menu admin</a>    </div>
<body>
  <div id="content">
<a href="administrateur_ajouterconsigne.php"><button class="snip1351">Ajouter une consigne</button></a></br></br>
 

  <table border>
    <tr> <th> ID Consignes </th> <th>Consignes</th></tr>
    <tr>
    <?php

    while($cons=$consignes->fetch()) { 
    ?>
      <tr>
          <td><?= $cons['id_consignes'] ?></td> <td> <?= $cons['consigne'] ?> </td> 
      </tr>
      
      <td><a href="administrateur_modifierconsigne.php?id=<?=$cons['id_consignes']?>">Modifier la consigne</a> 
        <hr  color="#D6D6D6" width="95%">
        <a href="administrateur_afficherconsignes.php?type=consigne&supprime=<?=$cons['id_consignes'] ?>">Supprimer la consigne</a> </td>
      <?php } ?>
  </table>
</div>
</br>
</body>
