<?php 

$m = $mouvement ->fetch();
for ($i=0 ; $i<$captmexist ; $i++) {?> 

	<div class="capteur">
	<h3 class="titre"> Mouvement </h3>
	
	<img src="<?php echo $m['photo']?>" class="avatar_capteur">
	<input type="checkbox" name="mouvement" value="<?php echo $m['id_capteur_piece']?>" class="switch">
		

	</div>
 <?php } ?>


