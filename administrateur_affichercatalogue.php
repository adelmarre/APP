<?php
include "verifadmin.php";

if(isset($_GET['type']) AND $_GET['type'] == 'capteur') {
 
   if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      $req1 = $bdd->prepare('DELETE FROM catalogue WHERE id_capteur = ?');
      $req1->execute(array($supprime));
   
   }    
}

$catalogue = $bdd -> query('SELECT * FROM catalogue JOIN type_capteur ON catalogue.id_type = type_capteur.id_type_capteur ORDER BY id_capteur');
?>

<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
  <title>Admin - Catalogue</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="administrateur.css" /> 
   
</head>
<div class="snip1231">
 <a  class="current" href="deconnexion.php">Déconnexion</a>

<a class="current" href="administrateur.php">Menu admin</a>    </div>
<body align="center">
  
                                    
<div id="content"> 
<a href="administrateur_ajoutercapteur.php"><button class="snip1351">Ajouter un capteur</button></a></br></br>
  <table border>
    <tr> <th> ID capteur </th> <th> Type de capteur</th><th> Nom</th><th> Référence</th><th> Descprition</th><th>Prix</th><th> Photo</th> </tr>
    <tr>
    <?php

    while($capteur=$catalogue->fetch()) { 
    ?>
      <tr>
          <td><?= $capteur['id_capteur'] ?></td> <td> <?= $capteur['nom_type_capteur'] ?> </td> <td> <?= $capteur['nom'] ?></td><td>  <?= $capteur['reference'] ?></td><td>  <?= $capteur['description'] ?> </td>
           <td><?= $capteur['prix'] ?> </td><td> <img src="<?=$capteur['photo2']?>" id="capteur" width="150em" height="150em"></td>
      </tr>
      
      <td><a href="administrateur_modifiercatalogue.php?id=<?=$capteur['id_capteur']?>">Modifier le capteur</a> 
        <a href="administrateur_affichercatalogue.php?type=capteur&supprime=<?= $capteur['id_capteur'] ?>">Supprimer le capteur</a> </td>
      <?php } ?>
  </table>
</div>
</br>
</body>
