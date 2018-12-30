<?php 
$nb = 1;
while ($t = $temperature -> fetch()) {?> 
           
            <div class="capteur">
              

              <h3 class="titre" > Température <?php echo $nb?></h3>

              <img src="<?php echo $t['photo']?>" class="avatar_capteur"  >


              <input type="number" name="temperature" step="0.5" min="13" max="30" value="19">
              <span class="slider round"> </span>
            </div>
<?php $nb = $nb + 1; } ?>

