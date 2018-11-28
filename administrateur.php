<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');

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
  <link rel="stylesheet" type="text/css" href=".css" /> 
   
</head>
<a href="deconnexion.php" class="box_rouge">Déconnexion</a>
<body align="center">
	
                                    
	                                  
	<table border>
		<tr> <th> ID personne </th> <th> Nom</th><th> Prénom</th><th> Mail</th><th> Numéro</th><th> Adresse</th> <th>Code postal</th><th>Ville</th><th>Type d'habitation</th><th>Pays</th></tr>
		<tr>
		<?php

		while($h=$habitation->fetch()) { 
		?>
      <tr>
          <td><?= $h['id'] ?> 
          <?php if($h['confirme'] == 0) 
          { ?>  <a href="administrateur.php?type=personne&confirme=<?= $h['id_personne'] ?>">Confirmer</a>
          <?php } ?> <a href="administrateur_modifierclient.php?id=<?=$h['id_personne']?>">Modifier le client</a>  
          <a href="administrateur.php?type=personne&supprime=<?= $h['id'] ?>">Supprimer le client</a>
           </td> <td> <?= $h['nom'] ?> </td> <td> <?= $h['prenom'] ?></td><td>  <?= $h['mail'] ?></td><td>  <?= $h['numero'] ?> </td>
           <td> <?= $h['adresse']?> </td><td> <?= $h['cp']?></td><td>  <?= $h['ville']?></td> <td><?= $h['type']?>  </td><td> <?= $h['pays']?></td>
         
	 </tr>
      
      <td><a href="#">Modifier l'habitation du client</a> </br><a href="administrateur.php?type=personne&supprimehabitation=<?= $h['id_habitation'] ?>">Supprimer l'habitation du client</a> </td>
      <?php } ?>
  </table>



<table border>
    <tr> <th> ID personne</th> <th> Nom</th><th> Prénom</th><th> Mail</th><th>Numero</th><th>Compte Admin</th></tr>
    <tr>
    <?php

    while($p=$personne->fetch()) { 
    ?>
      <tr>
          <td><?= $p['id'] ?> 
          <?php if($p['confirme'] == 0) 
          { ?>  <a href="administrateur.php?type=personne&confirme=<?= $p['id_personne'] ?>">Confirmer</a>
          <?php } ?> <a href="administrateur_modifierclient.php?id=<?=$p['id_personne']?>">Modifier le client</a>  
          <a href="administrateur.php?type=personne&supprime=<?= $p['id'] ?>">Supprimer le client</a>
           </td> <td> <?= $p['nom'] ?> </td> <td> <?= $p['prenom'] ?></td><td>  <?= $p['mail'] ?></td><td>  <?= $p['numero'] ?> </td><td>  <?= $p['admin'] ?> </td>
           
   </tr>
      
      
      <?php } ?>
  </table>


</body>
