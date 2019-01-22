<?php 
$nb = 1;
while ($t = $temperature -> fetch()) {?> 
           
            <div class="capteur">
              

              <h3 class="titre" > Température <?php echo $nb?></h3>

              <img src="<?php echo $t['photo']?>" class="avatar_capteur"  >

              <?php if ($secondaire==0 || ($secondaire==1 && $usersecondaire['modifiervaleur']==1 )) 
                  {?>
              <input type="hidden" name="<?php echo $nb+10 ?>" value="<?php echo $t['id_capteur_piece']?>,<?php echo $t['id_capteur_catalogue']?>"> 
              <input type="number" name="<?php echo $nb ?>" step="1" min="0" max="30" value="<?php if ( $t['valeur']!=0) {echo $t['valeur'];}?>">
              
           <?php }
			else {
				
					echo $t['valeur'];
					echo '°C';
				}
        if ($secondaire==0 || ($secondaire==1 && $usersecondaire['supprimercapteur']==1 )) {?>
          </br></br>
		<a class="supprimer" href="maisonsallecapteur.php?id_habitation=<?php echo $h?>&amp;type=<?php echo $t['id_type']?>&amp;supprime=<?php echo $t['id_capteur_piece']?>">Supprimer le capteur</a>  
  <?php }?>
            </div>
<?php $nb = $nb + 1; }
 ?>
