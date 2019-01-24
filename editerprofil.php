<?php 
session_start();
include "menu.php";
    $getid = intval($_SESSION['id']);
    $requser = $bdd -> prepare('SELECT * FROM personne WHERE id = ?');
    $requser -> execute(array($getid));
    $user = $requser ->fetch();
if (isset($_POST['maj'])) {
    if (isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom']!=$user['nom']) {
      
        $newnom = htmlspecialchars($_POST['newnom']);
        $insertnom = $bdd -> prepare("UPDATE personne SET nom=? WHERE id=?");
        $insertnom ->execute(array($newnom,$getid));
        $msg ="Mis à jour!";

        $requser = $bdd -> prepare('SELECT * FROM personne WHERE id = ?');
        $requser -> execute(array($getid));
        $userinfo = $requser ->fetch();

              
    }
    if (isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom']!=$user['prenom']) {
      
        $newprenom = htmlspecialchars($_POST['newprenom']);
        $insertnom = $bdd -> prepare("UPDATE personne SET prenom=? WHERE id=?");
        $insertnom ->execute(array($newprenom,$getid));
        $msg = "Mis à jour!";
      
    $requser = $bdd -> prepare('SELECT * FROM personne WHERE id = ?');
    $requser -> execute(array($getid));
    $userinfo = $requser ->fetch();

              
    }
    if (isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail'])
    {
    $newmail = htmlspecialchars($_POST['newmail']);
    $insertmail = $bdd -> prepare("UPDATE personne SET mail=? WHERE id=?");
    $insertmail ->execute(array($newmail,$getid));
     $msg = "Mis à jour!";

  }
        if (isset($_POST['newnumero']) AND !empty($_POST['newnumero']) AND $_POST['newnumero'] != $user['numero'])
    {
    $newnumero = htmlspecialchars($_POST['newnumero']);
    $insertnumero = $bdd -> prepare("UPDATE personne SET numero =? WHERE id=?");
    $insertnumero ->execute(array($newnumero,$getid));
     $msg = "Mis à jour!";
 
  }
  if (isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
  {
    $mdp1 = sha1($_POST['newmdp1']);
    $mdp2 = sha1($_POST['newmdp2']);
    if ($mdp1 == $mdp2) 
    {
        $insertmdp = $bdd -> prepare("UPDATE personne SET mdp=? WHERE id=?");
        $insertmdp ->execute(array($mdp1,$getid));
        $msg = "Mis à jour!";
       
    }
    else
    {
        $msg = "Vos deux mots de passe ne correspondent pas";
    }
    
  }
   $requser = $bdd -> prepare('SELECT * FROM personne WHERE id = ?');
    $requser -> execute(array($getid));
    $user = $requser ->fetch();
}
?>

<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
  <title>Editer mon profil</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="sallestyle.css" /> 
  
</head>
<body>




<div id="EditerProfil">

  <fieldset id="set">
    <legend> <h1>Editer son profil</h1></legend>
    <button class="hand" id="monClick"><i class="ion-android-hand"></i></button>
    <form method="POST" action="">
            <table>
               <tr>
                  <td align="right">
                     <label for="nom">Nom :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Nom" id="nom" name="newnom" value="<?php echo $user['nom'] ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="prenom">Prenom:</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Prénom" id="prenom" name="newprenom" value="<?php echo $user['prenom'] ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mail">Courriel :</label>
                  </td>
                  <td>
                     <input type="email" placeholder="Courriel" id="mail" name="newmail" value="<?php echo $user['mail'] ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="motdepasse">Mot de passe :</label>
                  </td>
                  <td>
                     <input type="password"  id="mdp" name="newmdp1" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="motdepasse">Confirmation du mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" id="mdp" name="newmdp2" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="telephone">Numéro de téléphone : </label>
                  </td>
                  <td>
                     <input type="tel" id="numero" placeholder="0627xxxxxx" name="newnumero" value="<?php echo $user['numero'] ?>" />
                  </td>
               </tr>
               <tr>
                  <td></td>
                  <td >
                  </br>
                  
                     <button type="submit" class="snip0040 "name="maj"><span>Mettre à jour!</span><i class="ion-android-done"></i></button>
                  </td>
               </tr>
            </table>
         </form>
         <?php if (isset($msg)) {echo '<font color="red">'.$msg.'</font>' ;} ?>

 </div>  </form>
    </fieldset>  
 <div id="maReponse" class="modal">
  <div class="maReponse-content">
    <span class="close">&times;</span>
   <ul> Indications pour le mot de passe : </br><br>
    <li>Au moins 10 charactères.</li>
    <li>Au moins un chiffre (0-9).</li>
    <li>Au moins une minuscule.</li>
    <li>Au moins une majuscule.</li>
    <li>Au moins un charactère spécial.</li>
  </ul>
  </div>
  </div>

    <script type="text/javascript">
var reponse = document.getElementById('maReponse');

// Get the button that opens the modal
var click = document.getElementById("monClick");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
click.onclick = function() {
  reponse.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  reponse.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == reponse) {
    reponse.style.display = "none";
  }
}

</script>             
       </body>     
