<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');
if (isset($_SESSION['id']))
{
    $requser = $bdd -> prepare('SELECT * FROM personne WHERE id = ?');
    $requser -> execute(array($_SESSION['id']));
    $user = $requser ->fetch();
    if (isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom']!=$user['nom']) {
      
        $newnom = htmlspecialchars($_POST['newnom']);
        $insertnom = $bdd -> prepare("UPDATE personne SET nom=? WHERE id=?");
        $insertnom ->execute(array($newnom,$_SESSION['id']));
              header('Location: gerermamaison.php?id='.$_SESSION['id']);
    }
    if (isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom']!=$user['prenom']) {
      
        $newprenom = htmlspecialchars($_POST['newprenom']);
        $insertnom = $bdd -> prepare("UPDATE personne SET prenom=? WHERE id=?");
        $insertnom ->execute(array($newprenom,$_SESSION['id']));
              header('Location: gerermamaison.php?id='.$_SESSION['id']);
    }
    if (isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail'])
    {
    $newmail = htmlspecialchars($_POST['newmail']);
    $insertmail = $bdd -> prepare("UPDATE personne SET mail=? WHERE id=?");
    $insertmail ->execute(array($newmail,$_SESSION['id']));
    header('Location: gerermamaison.php?id='.$_SESSION['id']);
  }
        if (isset($_POST['newnumero']) AND !empty($_POST['newnumero']) AND $_POST['newnumero'] != $user['newnumero'])
    {
    $newnumero = htmlspecialchars($_POST['newnumero']);
    $insertmail = $bdd -> prepare("UPDATE personne SET numero =? WHERE id=?");
    $insertmail ->execute(array($newnumero,$_SESSION['id']));
    header('Location: gerermamaison.php?id='.$_SESSION['id']);
  }
  if (isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
  {
    $mdp1 = sha1($_POST['newmdp1']);
    $mdp2 = sha1($_POST['newmdp2']);
    if ($mdp1 == $mdp2) 
    {
        $insertmdp = $bdd -> prepare("UPDATE personne SET mdp=? WHERE id=?");
        $insertmdp ->execute(array($mdp1,$_SESSION['id']));
        header('Location: gerermamaison.php?id='.$_SESSION['id']);
    }
    else
    {
        $msg = "Vos deux mots de passe ne correspondent pas";
    }
  }
?>

<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
  <title>Editer mon profil</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="editerprofil.css" /> 
   
</head>
<body>

  <header>
    <img src="logo hexagon final.png" alt="logo Hexagon" id="logo_hexagon">
    <nav class="head">
     <ul>
      <li><a href="#">Ma maison</a></li>
      <li><a href="#">Catalogue</a></li>
      <li><a href="#">A Propos</a></li>
      <li><a href="#">Aide</a></li>
      <li><a href="#">Consignes Globales</a></li>
    </ul>
  </nav>=
</header>


</div>

<div id="colonnedroite">

  <div class="box_profil">

    <img src="profil.jpg" class="photo_profil">
    <br/>
    <div class="affichage_prenom">
      <?php echo $user['prenom'];?></p>
    </div>
    <div class="affichage_nom">
       <?php echo $user['nom'];?></p>
    </div>

  </div>


  <nav>
    <ul class="box_information">

      <li> 
       <p> <a href="Editer Son Profil" class="box">Editer son profil </a>

        <img src="https://image.freepik.com/icones-gratuites/symbole-des-parametres_318-34202.jpg" class="avatar_box">
      </p>
    </li>

    <li>
      <p>
        <a href="Aide" class="box">FAQ </a>

        <img src="https://images.emojiterra.com/twitter/512px/2753.png" class="avatar_box">
      </p>
    </li>
    <li> 
     <p> <a href="A propos" class="box">A propos</a>

      <img src="https://image.freepik.com/icones-gratuites/informations-petite-lettre-symbole-i_318-54670.jpg" class="avatar_box">
    </p>
  </li>
  <li> 
   <p> <a href="Consignes globales" class="box">Consignes globales</a>

    <img src="https://images-na.ssl-images-amazon.com/images/I/61OH1BsW99L._SY355_.jpg" class="avatar_box">
  </p>
</li>
<li> 
 <p> <a href="Catalogue" class="box">Catalogue</a>


  <img src="https://svgsilh.com/svg_v2/160871.svg" class="avatar_box">
</p>



</li>

<li> 

 <p> <a href="gerermamaison" class="box_rouge">Gérer ma maison</a>


 </p>



</li>



<li> 

 <p> <a href="deconnexion.php" class="box_rouge">Déconnexion</a>


 </p>

</li>
</ul>
</nav>





</div>


</div>


<div id="Centre">

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
                  <td></td>
                  <td align="right">
                     <br />
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
