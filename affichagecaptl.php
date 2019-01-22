<?php 
$nb = 1;
while ($l = $luminosite -> fetch())
{?> 

	<div class="capteur">
	<h3 class="titre"> Lumière <?php echo $nb?></h3>
	
	<img src="<?php echo $l['photo']?>" class="avatar_capteur">
	 <?php if ($secondaire==0 || ($secondaire==1 && $usersecondaire['modifiervaleur']==1 )) 
                  {?>

	<select name="luminosite[]" single>
	<option  value="<?php echo $l['id_capteur_piece']?>,1,<?php echo $l['id_capteur_catalogue']?>" <?php if ( $l['valeur']==1) {echo 'selected="selected"';}?>  class="switch">On </option>
	<option   value="<?php echo $l['id_capteur_piece']?>,0,<?php echo $l['id_capteur_catalogue']?>" <?php if ( $l['valeur']==0) {echo 'selected="selected"';}?>  class="switch">Off</option>
	</select>

	<?php }
	else {
		if ( $l['valeur']==1) {echo 'ON';}
		else {
			echo 'OFF';
		}
	}
	 if ($secondaire==0 || ($secondaire==1 && $usersecondaire['supprimercapteur']==1 )) {?>
	 </br></br>
		<a class="supprimer" href="maisonsallecapteur.php?id_habitation=<?php echo $h?>&amp;type=<?php echo $l['id_type']?>&amp;supprime=<?php echo $l['id_capteur_piece']?>">Supprimer le capteur</a>	
	<?php }?>
	</div>
 <?php $nb = $nb + 1; } 
 ?>



