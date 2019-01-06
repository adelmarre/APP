<?php 

$nb = 1;
while ($m = $mouvement -> fetch())
{?> 

	<div class="capteur">
	<h3 class="titre"> Mouvement <?php echo $nb?></h3>
	
	<img src="<?php echo $m['photo']?>" class="avatar_capteur">
	<select name="mouvement[]" single>
	<option  value="<?php echo $m['id_capteur_piece']?>,1" <?php if ( $m['valeur']==1) {echo 'selected="selected"';}?>  class="switch">On </option>
	<option   value="<?php echo $m['id_capteur_piece']?>,0" <?php if ( $m['valeur']==0) {echo 'selected="selected"';}?>  class="switch">Off</option>
	</select>
	<a href="maisonsallecapteur.php?id_habitation=<?php echo $h?>&amp;supprime=<?php echo $m['id_capteur_piece']?>">Supprimer le capteur</a>	
	</div>
 <?php $nb = $nb + 1; } 
 ?>
