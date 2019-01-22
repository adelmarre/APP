<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');
if (isset($_SESSION['id']))
{
    $getid = intval($_SESSION['id']);
    $requser = $bdd -> prepare('SELECT * FROM personne WHERE id = ?');
    $requser -> execute(array($getid));
    $user = $requser ->fetch();
    if (isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom']!=$user['nom']) {
      
        $newnom = htmlspecialchars($_POST['newnom']);
        $insertnom = $bdd -> prepare("UPDATE personne SET nom=? WHERE id=?");
        $insertnom ->execute(array($newnom,$getid));
              
    }
    if (isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom']!=$user['prenom']) {
      
        $newprenom = htmlspecialchars($_POST['newprenom']);
        $insertnom = $bdd -> prepare("UPDATE personne SET prenom=? WHERE id=?");
        $insertnom ->execute(array($newprenom,$getid));
              
    }
    if (isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail'])
    {
    $newmail = htmlspecialchars($_POST['newmail']);
    $insertmail = $bdd -> prepare("UPDATE personne SET mail=? WHERE id=?");
    $insertmail ->execute(array($newmail,$getid));

  }
        if (isset($_POST['newnumero']) AND !empty($_POST['newnumero']) AND $_POST['newnumero'] != $user['newnumero'])
    {
    $newnumero = htmlspecialchars($_POST['newnumero']);
    $insertmail = $bdd -> prepare("UPDATE personne SET numero =? WHERE id=?");
    $insertmail ->execute(array($newnumero,$getid));
 
  }
  if (isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
  {
    $mdp1 = sha1($_POST['newmdp1']);
    $mdp2 = sha1($_POST['newmdp2']);
    if ($mdp1 == $mdp2) 
    {
        $insertmdp = $bdd -> prepare("UPDATE personne SET mdp=? WHERE id=?");
        $insertmdp ->execute(array($mdp1,$getid));
       
    }
    else
    {
        $msg = "Vos deux mots de passe ne correspondent pas";
    }
     header('Location: maisonsallecapteur.php');
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

<?php include "menu.php" ?>


<div id="EditerProfil">

  <fieldset id="set">
    <legend> <h1>Editer son profil</h1></legend>
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
                     <input type="tel" id="numero" placeholder="+336xxxxxxxxx" name="newnumero" value="<?php echo $user['numero'] ?>" />
                  </td>
               </tr>
               <tr>
                  <td></td>
                  <td align="center">
                     <br />
                     <input type="submit" class="boutton "name="maj" value="Mettre à jour mon profil!" />
                  </td>
               </tr>
            </table>
         </form>
         <?php if (isset($msg)) {echo$msg;} ?>

 </div>  </form>
    </fieldset>               
       </body>     
<?php
}
else { header('Location : index.php');}
?>
