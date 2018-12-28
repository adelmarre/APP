<?php 
$v = $volet ->fetch();
for ($i=0 ; $i<$captvexist ; $i++)
{
 ?>
  	<div class="capteur">

            <h3 class="titre"> Volet </h3>

            <img src="<?php echo $v['photo']?>" class="avatar_capteur">

            <input type="button" value="↑" name="haut" class="variable" id="monter" onclick="Hautbas()" >

            <input type="button" value="↓" name="bas" class="variable" id="baisser" onclick="Hautbas()">

          </div>
<?php } ?>

