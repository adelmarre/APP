
<style type="text/css">

input {

  border-radius: 4px;
} 
</style>

<?php 
include "verifadmin.php";


if (isset($_GET['id']) AND $_GET['id'] > 0)
{
  $getid = intval($_GET['id']);
  $reqconsignes = $bdd -> prepare('SELECT * FROM consignes WHERE id_consignes = ?' );
  $reqconsignes -> execute(array($getid));
  $cons = $reqconsignes ->fetch();
 } 
      
 
 if (isset($_POST['maj'])) {  
  

        if (isset($_POST['newconsigne']) AND !empty($_POST['newconsigne']) AND $_POST['newconsigne']!=$cons['consigne']) {
            $newconsigne = htmlspecialchars($_POST['newconsigne']);
            $reqconsignes = $bdd->prepare("SELECT * FROM consignes WHERE consigne = ?");
            $reqconsignes->execute(array($newquestion));
            $consexist = $reqconsignes->rowCount();
            if ($consexist==0) 
              {
              $insertconsigne = $bdd -> prepare("UPDATE consignes SET consigne=? WHERE id_consignes=?");
              $insertconsigne ->execute(array($newconsigne,$getid));
                  header ("Location: administrateur_afficherconsignes.php");
            }
        else {;
          $msg = "Cette consigne existe déjà";
        }

       
        }
       
        
       
       
        
        
    } 



?>
<html>
<head>
  <meta charset="UTF-8">
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
</head>
  <link rel="stylesheet" type="text/css" href="administrateur.css" /> 

<div class="snip1231">
  <a  class="current" href="deconnexion.php">Déconnexion</a>
  <a class="current" href="administrateur.php">Menu admin</a>   
</div>
</br>

<div id="content">
  <table> 
      <form method="post">
                 <tr>
                    <td align="right">
                       <label for="id_consignes">ID de la consigne: </label>
                    </td>
                    <td>
                       <?php echo $cons['id_consignes']?>
                    </td>
                 </tr>
                 <tr>
                    <td align="right">
                       <label for="Consigne">Consigne:</label>
                    </td>
                    <td>
                       <textarea cols="69" rows="5" placeholder="Consigne" id="consigne" name="newconsigne" /><?php echo $cons['consigne'] ?></textarea>
                    </td>
                 </tr>
                          
                 
                 <tr><td></td><td>
                  <?php
           if(isset($msg)) {
              echo '<font color="red">'.$msg."</font>";
           }
           ?></td>
                 </tr>
  </table>

  <button type="submit" class="snip0050 yellow" name="maj" value="modifier" ><span>Modifier la consigne</span><i class="ion-compose"></i></button>

  </form>
</div>
</html>