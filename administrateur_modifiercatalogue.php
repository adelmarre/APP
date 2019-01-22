
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
    $reqcapteur = $bdd -> prepare('SELECT * FROM catalogue JOIN type_capteur ON catalogue.id_type = type_capteur.id_type_capteur WHERE id_capteur = ?');
    $reqcapteur -> execute(array($getid));
    $capteur = $reqcapteur ->fetch();
}  
            
 if (isset($_POST['maj'])) {  
        if (isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom']!=$capteur['nom']) {
			      $newnom = htmlspecialchars($_POST['newnom']);
          	$reqnom = $bdd->prepare("SELECT * FROM catalogue WHERE nom = ?");
            $reqnom->execute(array($newnom));
            $nomexist = $reqnom->rowCount();
            if ($nomexist==0) 
            	{
           
	            $insertnom = $bdd -> prepare("UPDATE catalogue SET nom=? WHERE id_capteur=?");
	            $insertnom ->execute(array($newnom,$getid));
	               
		        }
		    else {
		    	$msg = "Ce nom existe déjà";
		    }

       
        }
        if (isset($_POST['newreference']) AND !empty($_POST['newreference']) AND $_POST['newreference']!=$capteur['reference']) {
        	$newreference = htmlspecialchars($_POST['newreference']);
        	$reqreference = $bdd->prepare("SELECT * FROM catalogue WHERE reference = ?");
            $reqreference->execute(array($newreference));
            $referenceexist = $reqreference->rowCount();
            if ($referenceexist==0) 
            	{
		            
		            $insertreference = $bdd -> prepare("UPDATE catalogue SET reference=? WHERE id_capteur=?");
		            $insertreference ->execute(array($newreference,$getid));    
		           
		        }
		    else {
		    	$msg = "Cette référence existe déjà";
		    }
        
        }
        if (isset($_POST['newdescription']) AND !empty($_POST['newdescription']) AND $_POST['newdescription'] != $capteur['description']) {
            $newdescription = htmlspecialchars($_POST['newdescription']);
            $insertdescription = $bdd -> prepare("UPDATE catalogue SET description=? WHERE id_capteur=?");
            $insertdescription ->execute(array($newdescription,$getid));
        

        }
        if (isset($_POST['newprix']) AND !empty($_POST['newprix']) AND $_POST['newprix'] != $capteur['prix']) {
            $newprix = htmlspecialchars($_POST['newprix']);
            $insertprix = $bdd -> prepare("UPDATE catalogue SET prix=? WHERE id_capteur=?");
            $insertprix ->execute(array($newprix,$getid));
           
            
       }
           if (isset($_POST['newphoto']) AND !empty($_POST['newphoto']) AND $_POST['newphoto'] != $capteur['photo']) {
            $newphoto = htmlspecialchars($_POST['newphoto']);
            $insertadresse = $bdd -> prepare("UPDATE catalogue SET photo=? WHERE id_capteur=?");
            $insertadresse ->execute(array($newphoto,$getid));
           

        }
            header ("Location: administrateur_affichercatalogue.php");
        
}

 if (isset($_POST['ajouter'])) {  
      if ((isset($_POST['newnom'])) AND (!empty($_POST['newnom'])) AND (isset($_POST['newreference'])) AND (!empty($_POST['newreference'])) AND (isset($_POST['newreference'])) AND (!empty($_POST['newreference'])) AND (isset($_POST['newdescription'])) AND !empty($_POST['newdescription']) AND (isset($_POST['newprix'])) AND (!empty($_POST['newprix'])) AND (isset($_POST['newphoto'])) AND (!empty($_POST['newphoto'])) )
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
                       $reqidtype =   $bdd->prepare("SELECT id_type_capteur FROM type_capteur WHERE nom_type_capteur = ?");
                       $reqidtype->execute(array($typecapteur));
                       $id_type = $reqidtype -> fetch();
                       $insertcapteur =  $bdd->prepare("INSERT INTO catalogue(nom, description, prix, photo2, reference, id_type) VALUES(?, ?, ?, ?, ?, ?)");
                       $insertcapteur->execute(array($newnom,$newdescription,$newprix,$newphoto,$newreference,$id_type['id_type_capteur']));
                      header("Location: administrateur_affichercatalogue.php");
                      
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
                     <?php if (isset($capteur['nom'])) {echo $capteur['nom_type_capteur'];}
                     else {
                      echo  '<select name="typecapteur" single>
                      <option value="Luminosité">Luminosité</option>
                      <option value="Fumée">Fumée</option>
                      <option value="Température">Température</option>
                      <option value="Volet">Volet</option>
                      <option value="Mouvement">Mouvement</option>
                    </select>';
                     }?>
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="prenom">Nom: </label>
                  </td>
                  <td>
                     <textarea cols="69" rows="5" placeholder="nom" id="nom" name="newnom"  /><?php if (isset($capteur['nom'])) {echo $capteur['nom'];} ?></textarea>
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mail">Référence : </label>
                  </td>
                  <td>
                     <textarea cols="69" rows="5" placeholder="Référence" id="reference" name="newreference"  /><?php if (isset($capteur['reference'])) {echo $capteur['reference'];} ?></textarea>
                  </td>
               </tr>           
               <tr>
                  
                  <td align="right">
                     <label for="numero">Description: </label>
                 </td>
                <td>
                    <textarea cols="69" rows="5" id="description" placeholder="description" name="newdescription"/><?php if (isset($capteur['description'])) {echo $capteur['description'];} ?></textarea>
                  </td>
               </tr>
                <tr>
                  
                  <td align="right">
                     <label for="numero">Prix en euros: </label>
                 </td>
                <td>
                    <textarea cols="69" rows="5" id="prix" placeholder="prix" name="newprix"/><?php if (isset($capteur['prix'])) {echo $capteur['prix'];} ?></textarea>
                  </td>
               </tr>
                <tr>
                  
                  <td align="right">
                     <label for="numero">Lien de l'image: </label>
                 </td>
                <td>
                    <textarea cols="69" rows="5" id="photo" placeholder="photo" name="newphoto"/><?php if (isset($capteur['photo2'])) {echo $capteur['photo2'];} ?></textarea>
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
  <?php if (isset($_GET['id']) AND $_GET['id'] > 0)
        {?>
          <button type="submit" class="snip0050 yellow" name="maj" value="modifier" ><span>Modifier la description</span><i class="ion-compose"></i></button><?php }
          else { ?>
          <button type="submit" class="snip0050 yellow" name="ajouter" value="ajouter" ><span>Ajouter le capteur</span><i class="ion-compose"></i></button>
          
        <?php } ?>
  </form>
</div>
