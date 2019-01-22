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

  if(!empty($_POST['consigne']))  
  {
    $consigne = htmlspecialchars($_POST['consigne']);
    $insertconsigne = $bdd->prepare("INSERT INTO consignes(consigne) VALUES(?)");
    $successInsertconsigne = $insertconsigne->execute(array($consigne));
    $erreur = "Consigne bien ajoutée";
    header ("Location: administrateur_afficherconsignes.php");
  }
  else
  {
    $erreur = "Veuillez remplir  le champ";
  }
}
  
?>



<html>
<head>
	 <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
  <title>Admin - Ajouter une consigne</title>
   <link rel="stylesheet" type="text/css" href="administrateur.css" /> 
     <meta charset="UTF-8">
</head>
<body>
	<div class="snip1231">
 <a  class="current" href="deconnexion.php">Déconnexion</a>

<a class="current" href="administrateur.php">Menu admin</a>    </div>

</br></br>

<div class="formajfaq">
  <h4 align="center">Ajouter une Consigne</h4>
<form method="POST" action="">

  <label for="consigne">Consigne à ajouter</label>
</br></br>
  <textarea type = "text" name="consigne" placeholder="Votre consigne..."></textarea>

  </br></br><?php
      if (isset($erreur)) 
      { 
        echo '<font color="white">'.$erreur." ";
      }
      ?></br>
  
  <button type="submit" class="snip0050 yellow" name="ajout" ><span>Ajouter</span><i class="ion-compose"></i></button>
</div>

</form>

  


</body>
</html>