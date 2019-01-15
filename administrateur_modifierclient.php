
<style type="text/css">

input {

  border-radius: 4px;
} 
</style>

<?php 
include "verifadmin.php";


if (isset($_GET['id']) AND $_GET['id'] > 0 AND isset($_GET['id_habitation']) AND $_GET['id_habitation'] > 0)
{
    $getid = intval($_GET['id']);
    $getidhabitation = intval($_GET['id_habitation']);
    $requser = $bdd -> prepare('SELECT * FROM habitation JOIN personne ON personne.id = habitation.id_personne WHERE id = ?');
    $requser -> execute(array($getid));
    $user = $requser ->fetch();
  
}
  else {
    $getid = intval($_GET['id']);
    $requser = $bdd -> prepare('SELECT * FROM personne WHERE id = ?');
    $requser -> execute(array($getid));
    $user = $requser ->fetch();
}
 if (isset($_POST['maj'])) {  
        if (isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom']!=$user['nom']) {

          
            $newnom = htmlspecialchars($_POST['newnom']);
            $insertnom = $bdd -> prepare("UPDATE personne SET nom=? WHERE id=?");
            $insertnom ->execute(array($newnom,$getid));
       
        }
        if (isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom']!=$user['nom']) {

          
            $newprenom = htmlspecialchars($_POST['newprenom']);
            $insertprenom = $bdd -> prepare("UPDATE personne SET prenom=? WHERE id=?");
            $insertprenom ->execute(array($newprenom,$getid));    
        
        }
        if (isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']) {
            $newmail = htmlspecialchars($_POST['newmail']);
            $insertmail = $bdd -> prepare("UPDATE personne SET mail=? WHERE id=?");
            $insertmail ->execute(array($newmail,$getid));

        }
        if (isset($_POST['newnumero']) AND !empty($_POST['newnumero']) AND $_POST['newnumero'] != $user['numero']) {
            $newnumero = htmlspecialchars($_POST['newnumero']);
            $insertnumero = $bdd -> prepare("UPDATE personne SET numero=? WHERE id=?");
            $insertnumero ->execute(array($newnumero,$getid));
            
       }
           if (isset($_POST['newadresse']) AND !empty($_POST['newadresse']) AND $_POST['newadresse'] != $user['adresse']) {
            $newadresse = htmlspecialchars($_POST['newadresse']);
            $insertadresse = $bdd -> prepare("UPDATE personne SET adresse=? WHERE id=? AND id_habitation = ?");
            $insertadresse ->execute(array($newadresse,$getid,$getidhabitation));

        }
        if (isset($_POST['newville']) AND !empty($_POST['newville']) AND $_POST['newville'] != $user['ville']) {
        $newville = htmlspecialchars($_POST['newville']);
        $insertville = $bdd -> prepare("UPDATE habitation SET ville=? WHERE id_personne=? AND id_habitation = ? ");
        $insertville ->execute(array($newville,$getid, $getidhabitation));
        
       }
        
        if (isset($_POST['newcp']) AND !empty($_POST['newcp']) AND $_POST['newcp'] != $user['cp']) {
        $newcp = htmlspecialchars($_POST['newcp']);
        $insertville = $bdd -> prepare("UPDATE habitation SET cp=? WHERE id_personne=? AND id_habitation = ? ");
        $insertville ->execute(array($newcp,$getid,$getidhabitation));
      
       }
        if (isset($_POST['pays']) AND !empty($_POST['pays']) AND $_POST['pays'] != $user['pays']) {
        $newpays = htmlspecialchars($_POST['pays']);
        $insertpays = $bdd -> prepare("UPDATE habitation SET pays=? WHERE id_personne=? AND id_habitation = ? ");
        $insertpays ->execute(array($newpays,$getid, $getidhabitation));
        
       }
       if (isset($_POST['typemaison']) AND !empty($_POST['typemaison']) AND $_POST['typemaison'] != $user['typemaison']) {
          $typeh = htmlspecialchars($_POST['typemaison']);
          $newtype = $bdd->prepare("UPDATE habitation SET type = ? WHERE id_habitation = ? AND id_personne " );
          $newtype -> execute(array($typeh,$getidhabitation,$getid));
        }
       header ("Location: administrateur_afficherclient.php");
    }



?>
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
    <form method="post" action="">
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
                     <label for="numero">Numéro de téléphone :</label>
                 </td>
                <td>
                    <input type="tel" id="numero" placeholder="+336xxxxxxxxx" name="newnumero" value="<?php echo $user['numero'] ?>" />
                  </td>
               </tr>
             <?php if (isset($_GET['id_habitation']) AND $_GET['id_habitation'] > 0) {?>
                           
           
                  <tr>
                  <td align="right">
                     <label for="adresse">Adresse :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Adresse" id="adresse" name="newadresse" value="<?php echo $user['adresse'] ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="cp">Code postal:</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Code postal" id="cp" name="newcp" value="<?php echo $user['cp'] ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="ville">Ville :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Ville" id="ville" name="newville" value="<?php echo $user['ville'] ?>" />
                  </td>
               </tr>
               <tr>
                  
                  <td align="right"><label >Pays :</label>  </td>           
                 <td> <?php include "pays.php";?></td>
               </tr>
               <tr>
                <td align="right">
               <label>Type de maison : </label></td>
               <td> <select name="typemaison">
                  <option value="Principale" <?php if($user['type'] == 'Principale') echo "selected"; ?>>Principale</option>
                        <option value="Secondaire"<?php if($user['type'] == 'Secondaire') echo "selected"; ?>>Secondaire</option>   </td>
                      </select>
             <?php }?>
             </tr>
               <tr> 
                  <td></td>
                  <td align="center">
                     <br />
                     <input type="submit" class="boutton "name="maj" value="Mettre à jour le profil!" />
                  </td>
               </tr>
</table>
</div>
</form>