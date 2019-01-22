<?php 
$nb = 1;
while ($v = $volet -> fetch()) {?> 
 
  	<div class="capteur">

            <h3 class="titre"> Volet <?php echo $nb?></h3>
	<img src="<?php echo $v['photo']?>" class="avatar_capteur">
	<?php if ($secondaire==0 || ($secondaire==1 && $usersecondaire['modifiervaleur']==1 )) 
                  {?>
	<?php if ( $v['valeur']==0) {?> 
		<input type="checkbox" name="volet" value="<?php echo $v['id_capteur_piece']?>,1,<?php echo $v['id_capteur_catalogue']?>"  class="switch">Descendre </option>
	<?php }
	 else {?> 
		<input type="checkbox"  name="volet" value="<?php echo $v['id_capteur_piece']?>,0,<?php echo $v['id_capteur_catalogue']?>"  class="switch">Monter </option>
	<?php }
	
	}
	else {
		if ( $v['valeur']==1) {echo 'Le volet est descendu.';}
		else {echo 'Le volet est monté.';}
	}
	if ($secondaire==0 || ($secondaire==1 && $usersecondaire['supprimercapteur']==1 )) 
                  {?>
                  	</br></br>
	<a class="supprimer" href="maisonsallecapteur.php?id_habitation=<?php echo $h?>&amp;type=<?php echo $v['id_type']?>&amp;supprime=<?php echo $v['id_capteur_piece']?>">Supprimer le capteur</a>
	<?php }
	?>	
          </div>
<?php $nb = $nb + 1; } ?>

