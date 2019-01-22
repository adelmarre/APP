<?php

session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','',array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

if (isset($_GET['q']))   {
$utilisateur = $_GET["q"];
$habitation = $_GET["h"];
}

$piece =$bdd->prepare('SELECT nom, id_piece FROM piece  WHERE id_habitation= "'.$habitation.'" ');
$piece ->execute();
$tabpiece=$piece->fetchAll(PDO::FETCH_ASSOC);

	

echo '<table>
<tr>
<th><h4>Pièces</h4></th>
<th><h4>Visualiser les données</h4></th>
<th><h4>Envoyer des ordres aux actionneurs</h4></th>
<th><h4>Ajouter des capteurs</h4></th>
<th><h4>Supprimer les capteurs</h4></th>

</tr>';?>
<?php
	foreach($tabpiece as $row){
	$requtilisateurinfo = $bdd -> prepare('SELECT * FROM secondaire WHERE id_utilisateur_secondaire= ? AND id_piece = ? AND id_habitation = ? ');
	$requtilisateurinfo ->execute(array($utilisateur,$row['id_piece'],$habitation));
	$utilisateurinfo =$requtilisateurinfo -> fetch(); ?>
	<tr>
		
		<td> <?= $row['nom'] ?></td>
		<td>
			<select name="visualiser[]" single>
			<option value="<?=$row['id_piece']?>,<?=$utilisateur?>,1" <?php if ($utilisateurinfo['visualiser']==1) {echo 'selected="selected"';}?> >Oui </option>
			<option value="<?=$row['id_piece']?>,<?=$utilisateur?>,0" <?php if ($utilisateurinfo['visualiser']==0) {echo 'selected="selected"';}?>> Non </option>
		</td>
		<td>
			<select name="modifiervaleur[]" single>
			<option value="<?=$row['id_piece']?>,<?=$utilisateur?>,1" <?php if ($utilisateurinfo['modifiervaleur']==1) {echo 'selected="selected"';}?> >Oui</option> 
			<option value="<?=$row['id_piece']?>,<?=$utilisateur?>,0" <?php if ($utilisateurinfo['modifiervaleur']==0) {echo 'selected="selected"';}?>> Non </option>
		</td>
		<td>
			<select name="ajoutercapteur[]" single>
			<option value="<?=$row['id_piece']?>,<?=$utilisateur?>,1" <?php if ($utilisateurinfo['ajoutercapteur']==1) {echo 'selected="selected"';}?> >Oui </option>
			<option value="<?=$row['id_piece']?>,<?=$utilisateur?>,0" <?php if ($utilisateurinfo['ajoutercapteur']==0) {echo 'selected="selected"';}?>> Non </option>
		</td>
		<td>
			<select name="supprimercapteur[]" single>
			<option value="<?=$row['id_piece']?>,<?=$utilisateur?>,1" <?php if ($utilisateurinfo['supprimercapteur']==1) {echo 'selected="selected"';}?> >Oui </option>
			<option value="<?=$row['id_piece']?>,<?=$utilisateur?>,0" <?php if ($utilisateurinfo['supprimercapteur']==0) {echo 'selected="selected"';}?>> Non </option>
		</td>

	</tr>
		

	<?php }?>		
	</table>
	<input type="submit" value="Valider" name="validation" class="envoyer">

	




