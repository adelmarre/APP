  <?php 
$nb = 1;
while ($hum = $humidite -> fetch()) {?> 
           
            <div class="capteur">

            <h3 class="titre"> Humidité <?php echo $nb?></h3>

            <img src="<?php echo $hum['photo']?>" class="avatar_capteur">
            <?php if ($secondaire==0 || ($secondaire==1 && $usersecondaire['modifiervaleur']==1 )) 
                  {?>
            <label> En pourcentage : </label>
            <select class="valeur" name="humidite[]" single>
            <option  value="<?php echo $hum['id_capteur_piece']?>,0,<?php echo $hum['id_capteur_catalogue']?>" <?php if ( $hum['valeur']==0) {echo 'selected="selected"';}?>  class="switch">-- </option>
			<option  value="<?php echo $hum['id_capteur_piece']?>,30,<?php echo $hum['id_capteur_catalogue']?>" <?php if ( $hum['valeur']==30) {echo 'selected="selected"';}?>  class="switch">30 </option>
			<option   value="<?php echo $hum['id_capteur_piece']?>,40,<?php echo $hum['id_capteur_catalogue']?>" <?php if ( $hum['valeur']==40) {echo 'selected="selected"';}?>  class="switch">40</option>
			<option  value="<?php echo $hum['id_capteur_piece']?>,50,<?php echo $hum['id_capteur_catalogue']?>" <?php if ( $hum['valeur']==50) {echo 'selected="selected"';}?>  class="switch">50 </option>
			<option   value="<?php echo $hum['id_capteur_piece']?>,60,<?php echo $hum['id_capteur_catalogue']?>" <?php if ( $hum['valeur']==60) {echo 'selected="selected"';}?>  class="switch">60</option>
			<option  value="<?php echo $hum['id_capteur_piece']?>,70,<?php echo $hum['id_capteur_catalogue']?>" <?php if ( $hum['valeur']==70) {echo 'selected="selected"';}?>  class="switch">70 </option>
			<option   value="<?php echo $hum['id_capteur_piece']?>,80,<?php echo $hum['id_capteur_catalogue']?>" <?php if ( $hum['valeur']==80) {echo 'selected="selected"';}?>  class="switch">80</option>
			<option   value="<?php echo $hum['id_capteur_piece']?>,90,<?php echo $hum['id_capteur_catalogue']?>" <?php if ( $hum['valeur']==90) {echo 'selected="selected"';}?>  class="switch">90</option>
			<option   value="<?php echo $hum['id_capteur_piece']?>,100,<?php echo $hum['id_capteur_catalogue']?>" <?php if ( $hum['valeur']==100) {echo 'selected="selected"';}?>  class="switch">100</option>
			</select> 	
            <?php }
			else {
				
					echo $hum['valeur'];
					echo '%';
				}
				if ($secondaire==0 || ($secondaire==1 && $usersecondaire['supprimercapteur']==1 )) {?>
		</br></br>
		<a class="supprimer" href="maisonsallecapteur.php?id_habitation=<?php echo $h?>&amp;type=<?php echo $hum['id_type']?>&amp;supprime=<?php echo $hum['id_capteur_piece']?>">Supprimer le capteur</a>
<?php }?>
            </div>

<?php $nb = $nb + 1; }?>
 


