<?php 
$nb = 1;
while ($v = $volet -> fetch()) {?> 
 
  	<div class="capteur">

            <h3 class="titre"> Volet <?php echo $nb?></h3>
	<img src="<?php echo $v['photo']?>" class="avatar_capteur">
	<?php if ( $v['valeur']==0) {?> 
		<input type="checkbox" name="volet" value="<?php echo $v['id_capteur_piece']?>,1"  class="switch">Descendre </option>
	<?php }
	 else {?> 
		<input type="checkbox"  name="volet" value="<?php echo $v['id_capteur_piece']?>,0"  class="switch">Monter </option>
	<?php }?>

          </div>
<?php $nb = $nb + 1; } ?>

