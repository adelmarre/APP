
<style type="text/css">

input {

  border-radius: 4px;
} 
</style>

<?php 
include "verifadmin.php";

 if (isset($_POST['ajouter'])) {  

      if ((isset($_POST['newnom'])) AND (!empty($_POST['newnom'])) AND (isset($_POST['newreference'])) AND (!empty($_POST['newreference'])) AND (isset($_POST['newreference'])) AND (!empty($_POST['newreference'])) AND (isset($_POST['newdescription'])) AND !empty($_POST['newdescription']) AND (isset($_POST['newprix'])) AND (!empty($_POST['newprix'])) AND (isset($_POST['newphoto'])) AND (!empty($_POST['newphoto'])) AND !empty($_POST['typecapteur']) )
          {
         
            $newnom = htmlspecialchars($_POST['newnom']);
            $reqnom = $bdd->prepare("SELECT * FROM catalogue WHERE nom = ?");
            $reqnom->execute(array($newnom));
            $nomexist = $reqnom->rowCount();

            $newreference = htmlspecialchars($_POST['newreference']);
            $reqreference = $bdd->prepare("SELECT * FROM catalogue WHERE reference = ?");
            $reqreference->execute(array($newreference));
            $referenceexist = $reqreference->rowCount();

            $newdescription = htmlspecialchars($_POST['newdescription']);
            $newprix = intval($_POST['newprix']);
            $newphoto = htmlspecialchars($_POST['newphoto']);
            $typecapteur = htmlspecialchars($_POST['typecapteur']);
            

            if ($nomexist==0) 
     {
               if ($referenceexist==0) 
                    {
                      
                       $insertcapteur =  $bdd->prepare("INSERT INTO catalogue(nom, description, prix, photo2, reference, id_type) VALUES(?, ?, ?, ?, ?, ?)");
                       $insertcapteur->execute(array($newnom,$newdescription,$newprix,$newphoto,$newreference,$typecapteur));
                        header('Location: administrateur_affichercatalogue.php');
                      
                 }
                 else {
                   $msg = "Cette référence existe déjà";
                     
                 }
            }
           else {
          $msg = "Ce nom existe déjà";
        }
      
        
}

}
?>
<head>
  <title>Admin - Catalogue</title>
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
                     <label for="nom">Type de capteur : </label>

                  </td>
                  <td>
                      <select name="typecapteur" value="<?php if(isset($_POST['typecapteur'])) {echo $typecapteur;} ?>" single>
                      <option value="1">Luminosité</option>
                      <option value="4">Fumée</option>
                      <option value="2">Température</option>
                      <option value="5">Volet</option>
                      <option value="3">Mouvement</option>
                    </select>
                     
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="prenom">Nom: </label>
                  </td>
                  <td>
                     <textarea cols="69" rows="5" placeholder="nom" id="nom" name="newnom" required /><?php if(isset($_POST['newnom'])) {echo $_POST['newnom'];} ?></textarea>
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mail">Référence : </label>
                  </td>
                  <td>
                     <textarea cols="69" rows="5" placeholder="Référence"  id="reference" name="newreference"  required /><?php if(isset($_POST['newreference'])) {echo $_POST['newreference'];} ?></textarea>
                  </td>
               </tr>           
               <tr>
                  
                  <td align="right">
                     <label for="numero">Description: </label>
                 </td>
                <td>
                    <textarea cols="69" rows="5" id="description" placeholder="description" name="newdescription" required /><?php if(isset($_POST['newdescription'])) {echo $_POST['newdescription'];} ?></textarea>
                  </td>
               </tr>
                <tr>
                  
                  <td align="right">
                     <label for="numero">Prix en euros: </label>
                 </td>
                <td>
                    <textarea cols="69" rows="5" id="prix" placeholder="prix"  name="newprix" required /><?php if(isset($_POST['newprix'])) {echo $_POST['newprix'];} ?></textarea>
                  </td>
               </tr>
                <tr>
                  
                  <td align="right">
                     <label for="numero">Lien de l'image: </label>
                 </td>
                <td>
                    <textarea cols="69" rows="5" id="photo" placeholder="photo"  name="newphoto" required /><?php if(isset($_POST['newphoto'])) {echo $_POST['newphoto'];} ?></textarea>
                  </td>
               </tr>
               <tr> 
                  <td></td>
                  
               </tr>
               <tr><td></td><td>
               	<?php
         if(isset($msg)) {
            echo '<font color="red">'.$msg."</font>";
         }
         ?></td>
               </tr>
  </table>
  
          <button type="submit" class="snip0050 yellow" name="ajouter" value="ajouter" ><span>Ajouter le capteur</span><i class="ion-compose"></i></button>

  </form>
</div>
