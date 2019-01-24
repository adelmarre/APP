	<?php session_start(); include "menu.php"; 	


if (isset($_POST['ajouter'])) {
	$adresse =  htmlspecialchars($_POST['adresse']);
	  $cp =  ($_POST['cp']);
	  $ville = htmlspecialchars($_POST['ville']);
	  $pays = htmlspecialchars($_POST['pays']);
	  $type=htmlspecialchars($_POST['type_habitation']);
	  $nomhabitation=htmlspecialchars($_POST['nomhabitation']);
	  if (!empty($_POST['adresse'])AND!empty($_POST['cp'])AND !empty($_POST['ville'])AND!empty($_POST['pays'])AND !empty($_POST['type_habitation'])AND!empty($_POST['nomhabitation'])) {

       
        $insertmbr2 =  $bdd->prepare("INSERT INTO habitation(adresse, cp, ville, pays, type, id_personne, nomhabitation) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $insertmbr2->execute(array($adresse, $cp, $ville, $pays, $type, $_SESSION['id'],$nomhabitation));
        header("Location: maisonsallecapteur.php");
        
    }
	  else {
	  	$erreur = "Tous les champs doivent être complétés";
	  }
}
?>
<head>
	  <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
	<meta charset="UTF-8" />
	<title>Ajouter une maison</title>
	<link rel="stylesheet" type="text/css" href="sallestyle.css" /> 
	
</head>
<div id="EditerProfil">
	<fieldset><legend><h1>Ajouter une maison</h1></legend>
<form method="POST">
       <table >
       	<tr>
       <td>
      <label for="adresse">Adresse :</td>
		<td>
        <input type="text" id="adresse" name="adresse" placeholder="Ex: 6 rue notre dame des champs"  value="<?php if(isset($_POST['adresse'])) {echo $adresse;} ?>"required>
		</td>
      </label>
  		</tr>

		<tr>
		<td>
      <label for="cp">Code Postal :</td>
      	<td>
        <input type="text" id="cp" name="cp" placeholder="Ex: 75006"  value="<?php if(isset($_POST['cp'])) {echo $cp;} ?>" required>
    	</td>
      </label>
		</tr>

      <tr><td>
      <label for="ville">Ville :</td>
      <td>  <input type="text" id="ville" name="ville" placeholder="Ex: Paris" name="user_ville"  value="<?php if(isset($_POST['ville'])) {echo $ville;} ?>" required >
		</td>
      </label>

      <tr><td>
      <label for="pays">Pays :</td>
        <td><select value="<?php if(isset($_POST['pays'])) {echo $pays;} ?>" name='pays' required>

          <option value="Albanie">Albanie </option>
          <option value="Algerie">Algerie </option>
          <option value="Allemagne">Allemagne </option>
          <option value="Belgique">Belgique </option>
          <option value="Canada">Canada </option>
          <option value="Croatie">Croatie </option>
          <option value="Espagne">Espagne </option>
          <option value="France">France </option>
          <option value="Italie">Italie </option>
          <option value="Luxembourg">Luxembourg </option>
          <option value="Royaume_Uni">Royaume Uni </option>
          <option value="Suisse">Suisse </option>
</select>

      </label></td></tr>
      <tr><td>
      <label for="type_habitation">Type d'habitation :</td>
      	<td>
        <select value="<?php if(isset($_POST['type_habitation'])) {echo $type;} ?>" name="type_habitation" required>type_habitation
       
          <option value="Principale">Principale</option>
          <option value="Secondaire">Secondaire</option>
        </select>

      </label></td></tr>

      <tr><td>
      <label for="nomhabitation">Nom de l'habitation:</td>
      <td><input type="text" id="nomhabitation" name="nomhabitation"  value="<?php if(isset($_POST['nomhabitation'])) {echo $nomhabitation;} ?>" required>
    </label></td>

<tr>
	    	<td></td>
    
     <td>
         </br>
        <button type="submit" class="snip0040" name="ajouter" ><span>Ajouter</span><i class="ion-android-done"></i></button><td></tr>
    </table>
    </form>
</fieldset>
