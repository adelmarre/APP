<?php 
$l = $luminosite ->fetch();

for ($i=0 ; $i<$captlexist ; $i++) {?>
 <div class="capteur" id="capteurl1">

            <h3 class="titre"> Lampe </h3>

            <img src="http://data-cache.abuledu.org/1024/ampoule-allumee-5435780b.jpg" class="avatar_capteur_lampe_allume">
            <img src="<?php echo $l['photo']?>" class="avatar_capteur_lampe_éteint">

            <input type="checkbox" name="lampe1" id="switch1" onchange="EteintAllume()">

            <span class="slider round"> </span>

          </div>



 <?php } ?>





