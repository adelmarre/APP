<style type="text/css">
  .laClasse {
    width: 5rem:
}
.laClasse:focus {
    width: 10rem;
}
</style>

<?php 
include "verifadmin.php";
$requser = $bdd -> prepare('SELECT * FROM A_propos');
$requser ->execute();
$donnees = $requser ->fetch();
    if (isset($_POST['modifier']) AND !empty($_POST['newdescription']) AND $_POST['newdescription']!=$donnees['description']) {
        $newdescription = htmlspecialchars($_POST['newdescription']);
        $insertdescription = $bdd -> prepare("UPDATE a_propos SET description=?");
        $insertdescription ->execute(array($newdescription));
        header ("Location: administrateur.php");
    }
    
?>

<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
  <title>Admin - Aide </title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="administrateur.css" /> 
   
</head>
<body>

<div class="snip1231">
 <a  class="current" href="deconnexion.php">Déconnexion</a>

<a class="current" href="administrateur.php">Menu admin</a>    </div>
		</div> 
<div id="content">

  <fieldset id="set">
    <form method="POST" action="">
            <table>
               <tr>
                  <td align="right">
                     <label for="description">Description :</label>
                  </td>
                  <td>
                      <textarea cols="75" rows="8" id="description" placeholder="description" name="newdescription"/><?php echo $donnees['description'] ?></textarea>
                     
                  </td>
                  
                  
</tr>
</table>
<button type="submit" class="snip0050 yellow" name="modifier" value="modifier" ><span>Modifier la description</span><i class="ion-compose"></i></button>
</form>
 

 </div>  
    </fieldset>               
</body> 