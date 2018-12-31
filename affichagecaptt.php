<?php 
$nb = 1;
while ($t = $temperature -> fetch()) {?> 
           
            <div class="capteur">
              

              <h3 class="titre" > Température <?php echo $nb?></h3>

              <img src="<?php echo $t['photo']?>" class="avatar_capteur"  >

              <input type="hidden" name="numcapteur" value="<?php echo $t['id_capteur_piece']?>">	
              <input type="number" name="temperature" step="1" min="0" max="30" value="<?php if ( $t['valeur']!=0) {echo $t['valeur'];}?>">	
            
            </div>
<?php $nb = $nb + 1; } ?>

