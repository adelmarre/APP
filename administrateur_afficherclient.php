<?php

include "verifadmin.php";

if(isset($_GET['type']) AND $_GET['type'] == 'personne') {
   if(isset($_GET['confirme']) AND !empty($_GET['confirme'])) {
      $confirme = (int) $_GET['confirme'];
      $req = $bdd->prepare('UPDATE personne SET confirme = 1 WHERE id = ?');
      $req->execute(array($confirme));
   }
   if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      $req1 = $bdd->prepare('DELETE FROM personne WHERE id = ?');
      $req1->execute(array($supprime));
      //$req2 = $bdd->prepare('DELETE FROM habitation WHERE id_personne = ?');
      //$req2->execute(array($supprime));
   }
   if(isset($_GET['supprimehabitation']) AND !empty($_GET['supprimehabitation'])) {
      $supprimehabitation = (int) $_GET['supprimehabitation'];
      $req = $bdd->prepare('DELETE FROM habitation WHERE id_habitation = ?');
      $req->execute(array($supprimehabitation));
   }
    
}

$habitation = $bdd -> query('SELECT * FROM habitation JOIN personne ON personne.id = habitation.id_personne');
$personne = $bdd -> query('SELECT * FROM personne');
?>

<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
  <title>Admin</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="administrateur.css" /> 
   
</head>
<div class="snip1231">
 <a  class="current" href="deconnexion.php">Déconnexion</a>

<a class="current" href="administrateur.php">Menu admin</a>    </div>
<body align="center">
  
                                    
<div id="content"> 

  <table border>
    <tr> <th> ID personne </th> <th> Nom</th><th> Prénom</th><th> Mail</th><th> Numéro</th><th>ID habitation</th><th> Adresse</th> <th>Code postal</th><th>Ville</th><th>Type d'habitation</th><th>Pays</th></tr>
    <tr>
    <?php

    while($h=$habitation->fetch()) { 
    ?>
      <tr>
          <td><?= $h['id'] ?></td> <td> <?= $h['nom'] ?> </td> <td> <?= $h['prenom'] ?></td><td>  <?= $h['mail'] ?></td><td>  <?= $h['numero'] ?> </td>
           <td><?= $h['id_habitation'] ?> </td><td> <?= $h['adresse']?> </td><td> <?= $h['cp']?></td><td>  <?= $h['ville']?></td> <td><?= $h['type']?>  </td><td> <?= $h['pays']?></td>
         
   </tr>
      
      <td><a href="administrateur_modifierclient.php?id=<?=$h['id']?>&amp;id_habitation=<?=$h['id_habitation']?>">Modifier l'habitation du client</a> </br><a href="administrateur_afficherclient.php?type=personne&supprimehabitation=<?= $h['id_habitation'] ?>">Supprimer l'habitation du client</a> </td>
      <?php } ?>
  </table>

</br>

<table border>
    <tr> <th> ID personne</th> <th> Nom</th><th> Prénom</th><th> Mail</th><th>Numero</th></tr>
    <tr>
    <?php

    while($p=$personne->fetch()) { 
    ?>
      <tr>
          <td><?= $p['id'] ?> 
          <?php if($p['confirme'] == 0) 
          { ?>  <a href="administrateur_afficherclient.php?type=personne&confirme=<?= $p['id'] ?>">Confirmer</a>
          <?php } ?> <a href="administrateur_modifierclient.php?id=<?=$p['id']?>">Modifier le client</a>  
          <a href="administrateur_afficherclient.php?type=personne&supprime=<?= $p['id'] ?>">Supprimer le client</a>
           </td> <td> <?= $p['nom'] ?> </td> <td> <?= $p['prenom'] ?></td><td>  <?= $p['mail'] ?></td><td>  <?= $p['numero'] ?> </td>
           
   </tr>
      
      
      <?php } ?>
  </table>

</div>
</body>
