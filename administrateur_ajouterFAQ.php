<style type="text/css">
.formajfaq {
  border: none;
  border-radius: 1em;
  color: #ffffff;
  cursor: pointer;
  
  text-align: center;
  display: inline-block;
  
  position: relative;
  font-size: 16px;
 
  
  box-shadow: 1px 1px 2px -2px rgba(255, 255, 255, 0.8) inset, -1px -1px 2px -2px rgba(255, 255, 255, 0.3) inset, 1px 1px 4px rgba(0, 0, 0, 0.3);
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
}
.formajfaq button[type="submit"] {
  font-size: 1em;
  text-align: center;
  width: 10em;
  height: 3em;
  position: absolute;
  bottom: 2em;
  left: 0;
  margin-left: 5em;
  border-radius: 0.35em;
  

}
.formajfaq textarea {
  font-size: 1em;
  text-align: center;
  width: 14em;
  height: 3em;
  
  
  margin-left: 1em;
  border-radius: 0.35em;

}



.formajfaq{
    width: 20em;
    height: 25em;
    background: rgba(0,0,0,0.5);
    color: #fff;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    box-sizing: border-box;
    padding: 70px 30px;
    padding-top: 0.5em;
    padding-left: 1.25em;
}
</style>

<?php 
include "verifadmin.php";
if (isset($_POST['ajout'])) {

  if(!empty($_POST['question']) AND !empty($_POST['réponse']))  {
    $question = htmlspecialchars($_POST['question']);
    $reponse = htmlspecialchars($_POST['réponse']);
    $insertaide = $bdd->prepare("INSERT INTO aide(question, reponse) VALUES(?, ?)");
    $successInsertaide = $insertaide->execute(array($question, $reponse));
    header("Location: administrateur_afficherFAQ.php");
 
  }
  else
  {
    $erreur = "Veuillez remplir tous les champs";
  }
}
  
?>



<html>
<head>
	 <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
  <title>Admin - Ajouter une question/réponse</title>
   <link rel="stylesheet" type="text/css" href="administrateur.css" /> 
     <meta charset="UTF-8">
</head>
<body>
	<div class="snip1231">
 <a  class="current" href="deconnexion.php">Déconnexion</a>

<a class="current" href="administrateur.php?id_admin=<?= $getidadmin ?>">Menu admin</a>    </div>

</br></br>

<div class="formajfaq">
  <h4 align="center">   Ajouter une Question/Réponse</h4>
<form method="POST" action="">

  <label for="question">Question à ajouter :</label>
</br></br>
  <textarea type = "text" name="question" placeholder="Votre question..."></textarea>
</br></br>
  <label for="réponse">Réponse à ajouter :</label>
</br></br>
  <textarea type = "text" name="réponse" placeholder="Votre réponse..."></textarea>
  </br></br><?php
      if (isset($erreur)) 
      { 
        echo '<font color="white">'.$erreur." ";
      }
      ?> 
  <button type="submit" class="snip0050 yellow" name="ajout" ><span>Ajouter</span><i class="ion-compose"></i></button>
</div>

</form>

  


</body>
</html>
