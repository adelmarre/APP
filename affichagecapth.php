  <?php 
$nb = 1;
while ($hum = $humidite -> fetch()) {?> 
           
            <div class="capteur">

            <h3 class="titre"> Humidité <?php echo $nb?></h3>

            <img src="<?php echo $hum['photo']?>" class="avatar_capteur">

            <input type="hidden" name="humcapteur" value="<?php echo $hum['id_capteur_piece']?>"> 
            <label>En pourcentage : </label>
            <input type="number" name="humidite" step="1" min="30" max="100" value="<?php if ( $hum['valeur']!=0) {echo $hum['valeur'];}?>">
            </div>

<?php $nb = $nb + 1; }?>
 


