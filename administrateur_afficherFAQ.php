 

<?php



include "verifadmin.php";

if(isset($_GET['type']) AND $_GET['type'] == 'question') {
 
  if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
    $supprime = (int) $_GET['supprime'];
    $req1 = $bdd->prepare('DELETE FROM aide WHERE id_question = ?');
    $req1->execute(array($supprime));
   
  }    
}

$aide = $bdd -> query('SELECT * FROM aide ');
?>

<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
  <title>Admin - Afficher la page Aide</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="administrateur.css" /> 
   
</head>
<div class="snip1231">
 <a  class="current" href="deconnexion.php">Déconnexion</a>

<a class="current" href="administrateur.php?id_admin=<?= $getidadmin ?>">Menu admin</a>    </div>
<body>
  <div id="content">
<a href="administrateur_ajouterFAQ.php"><button class="snip1351">Ajouter une question/réponse</button></a></br></br>
 

  <table border>
    <tr> <th> ID Question </th> <th>Question</th><th>Réponse</th></tr>
    <tr>
    <?php

    while($FAQ=$aide->fetch()) { 
    ?>
      <tr>
          <td><?= $FAQ['id_question'] ?></td> <td> <?= $FAQ['question'] ?> </td> <td> <?= $FAQ['reponse'] ?></td>
      </tr>
      
      <td><a href="administrateur_modifierFAQ.php?id_admin=<?= $getidadmin ?>&amp;id=<?=$FAQ['id_question']?>">Modifier la question</a> 
        <hr  color="#D6D6D6" width="95%">
        <a href="administrateur_afficherFAQ.php?id_admin=<?= $getidadmin?>&amp;type=question&supprime=<?=$FAQ['id_question'] ?>">Supprimer la question</a> </td>
      <?php } ?>
  </table>
</div>
</br>
</body>
