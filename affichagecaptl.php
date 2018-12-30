<?php 
$nb = 1;
while ($l = $luminosite -> fetch())
{?> 

	<div class="capteur">
	<h3 class="titre"> Lumière <?php echo $nb?></h3>
	
	<img src="<?php echo $l['photo']?>" class="avatar_capteur">
	<select name="luminosite[]" single>
	<option  value="<?php echo $l['id_capteur_piece']?>,1" <?php if ( $l['valeur']==1) {echo 'selected="selected"';}?>  class="switch">On </option>
	<option   value="<?php echo $l['id_capteur_piece']?>,0" <?php if ( $l['valeur']==0) {echo 'selected="selected"';}?>  class="switch">Off</option>
	</select>
	</div>
 <?php $nb = $nb + 1; } 
 ?>



