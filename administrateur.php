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
      if(isset($_GET['modifier']) AND !empty($_GET['modifier'])) {
     
   }
}

$habitation = $bdd -> query('SELECT * FROM habitation JOIN personne ON personne.id = habitation.id_personne');

?>

<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
  <title>Admin</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href=".css" /> 
   
</head>

<body align="center">
	
                                    
	                                  
	<table border>
		<tr> <th> ID</th> <th> Nom</th><th> Prénom</th><th> Mail</th><th> Numéro</th><th> Adresse</th> <th>Code postal</th><th>Ville</th><th>Type d'habitation</th><th>Pays</th><th>Compte Admin</th></tr>
		<tr>
		<?php

		while($h=$habitation->fetch()) { 
		?>
      <tr>
          <td><?= $h['id'] ?> 
          <?php if($h['confirme'] == 0) 
          { ?>  <a href="administrateur.php?type=personne&confirme=<?= $h['id_personne'] ?>">Confirmer</a>
          <?php } ?> <a href="administrateur.php?type=personne&modifier=<?= $h['id_personne'] ?>">Modifier le client</a>  
          <a href="administrateur.php?type=personne&supprime=<?= $h['id'] ?>">Supprimer le client</a>
           </td> <td> <?= $h['nom'] ?> </td> <td> <?= $h['prenom'] ?></td><td>  <?= $h['mail'] ?></td><td>  <?= $h['numero'] ?> </td>
           <td> <?= $h['adresse']?> </td><td> <?= $h['cp']?></td><td>  <?= $h['ville']?></td> <td><?= $h['type']?>  </td><td> <?= $h['pays']?></td><td><?= $h['admin']?></td>
         
	 </tr>
      
      <td><a href="#">Modifier l'habitation du client</a> </br><a href="administrateur.php?type=personne&supprimehabitation=<?= $h['id_habitation'] ?>">Supprimer l'habitation du client</a> </td>
      <?php } ?>
  </table>


<!--
<?php $req=$bdd ->query('SELECT * FROM personne');
$personnes = $req ->fetchall() ;
foreach ($personnes as $personne): ?>
	<?= $personne['id'] ?>
	<?= $personne['prenom'] ?> 
	<?= $personne['mail'] ?>
	<?= $personne['numero'] ?> 
<?php  endforeach ?>
-->
</body>
