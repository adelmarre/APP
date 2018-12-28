<?php 
$t = $temperature ->fetch();
for ($i=0 ; $i<$capttexist ; $i++) {?> 
           
            <div class="capteur">
              

              <h3 class="titre" > Température </h3>

              <img src="<?php echo $t['photo']?>" class="avatar_capteur"  >


              <input type="number" name="temperature" step="0.5" min="13" max="30" value="19">
              <span class="slider round"> </span>
            </div>
          <?php }?>

