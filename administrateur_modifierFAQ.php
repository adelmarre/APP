
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
  $reqaide = $bdd -> prepare('SELECT * FROM aide WHERE id_question = ?' );
  $reqaide -> execute(array($getid));
  $aide = $reqaide ->fetch();
 } 
      
 
 if (isset($_POST['maj'])) {  
  

        if (isset($_POST['newquestion']) AND !empty($_POST['newquestion']) AND $_POST['newquestion']!=$aide['question']) {
            $newquestion = htmlspecialchars($_POST['newquestion']);
            $reqquestion = $bdd->prepare("SELECT * FROM aide WHERE question = ?");
            $reqquestion->execute(array($newquestion));
            $questionexist = $reqquestion->rowCount();
            if ($questionexist==0) 
              {
              $insertquestion = $bdd -> prepare("UPDATE aide SET question=? WHERE id_question=?");
              $insertquestion ->execute(array($newquestion,$getid));
                  header ("Location: administrateur_afficherFAQ.php");
            }
        else {;
          $msg = "Ce question existe déjà";
        }

       
        }
        if (isset($_POST['newreponse']) AND !empty($_POST['newreponse']) AND $_POST['newrereponse']!=$aide['reponse']) {
          $newreponse = htmlspecialchars($_POST['newreponse']);
          $reqreponse = $bdd->prepare("SELECT * FROM aide WHERE reponse = ?");
            $reqreponse->execute(array($newreponse));
            $reponseexist = $reqreponse->rowCount();
            if ($reponseexist==0) 
              {
                
                $insertreponse = $bdd -> prepare("UPDATE aide SET reponse=? WHERE id_question=?");
                $insertreponse ->execute(array($newreponse,$getid));    
                header ("Location: administrateur_afficherFAQ.php");
            }
        else {
          $msg = "Cette reponse existe déjà";
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
                       <label for="id_question">ID de la question: </label>
                    </td>
                    <td>
                       <?php echo $aide['id_question']?>
                    </td>
                 </tr>
                 <tr>
                    <td align="right">
                       <label for="Question">Question:</label>
                    </td>
                    <td>
                       <textarea cols="69" rows="5" placeholder="question" id="question" name="newquestion" /><?php echo $aide['question'] ?></textarea>
                    </td>
                 </tr>
                 <tr>
                    <td align="right">
                       <label for="Reponse">Réponse :</label>
                    </td>
                    <td>
                       <textarea cols="69" rows="5"  placeholder="Référence" id="reponse" name="newreponse"><?php echo $aide['reponse'] ?> </textarea>
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

  <button type="submit" class="snip0050 yellow" name="maj" value="modifier" ><span>Modifier la description</span><i class="ion-compose"></i></button>

  </form>
</div>
</html>