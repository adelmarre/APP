<?php 

$nb = 1;
while ($m = $mouvement -> fetch())
{?> 

	<div class="capteur">
	<h3 class="titre"> Mouvement <?php echo $nb?></h3>
	<img src="<?php echo $m['photo']?>" class="avatar_capteur">
	<?php if ($secondaire==0 || ($secondaire==1 && $usersecondaire['modifiervaleur']==1 )) 
                  {?>
	
	<select name="mouvement[]" single>
	<option  value="<?php echo $m['id_capteur_piece']?>,1,<?php echo $m['id_capteur_catalogue']?>" <?php if ( $m['valeur']==1) {echo 'selected="selected"';}?>  class="switch">On </option>
	<option   value="<?php echo $m['id_capteur_piece']?>,0,<?php echo $m['id_capteur_catalogue']?>" <?php if ( $m['valeur']==0) {echo 'selected="selected"';}?>  class="switch">Off</option>
	</select>
	<?php }
	else {
		if ( $m['valeur']==1) {echo 'ON';}
		else {
			echo 'OFF';
		}
	}

if ($secondaire==0 || ($secondaire==1 && $usersecondaire['supprimercapteur']==1 )) {?>
	</br></br>
	<a class="supprimer" href="maisonsallecapteur.php?id_habitation=<?php echo $h?>&amp;type=<?php echo $m['id_type']?>&amp;supprime=<?php echo $m['id_capteur_piece']?>">Supprimer le capteur</a>
<?php }?>

	</div>
 <?php $nb = $nb + 1; } 
 ?>