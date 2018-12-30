<?php 
$nb = 1;
while ($f = $fumee -> fetch())
{?> 

	<div class="capteur">
	<h3 class="titre"> Fumée <?php echo $nb?></h3>
	
	<img src="<?php echo $f['photo']?>" class="avatar_capteur">
	<select name="fumee[]" single>
	<option  value="<?php echo $f['id_capteur_piece']?>,1" <?php if ( $f['valeur']==1) {echo 'selected="selected"';}?>  class="switch">On </option>
	<option   value="<?php echo $f['id_capteur_piece']?>,0" <?php if ( $f['valeur']==0) {echo 'selected="selected"';}?>  class="switch">Off</option>
	</select>
	</div>
 <?php $nb = $nb + 1; } 
 ?>
