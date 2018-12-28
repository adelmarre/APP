<?php 
$f = $fumee ->fetch();

for ($i=0 ; $i<$captfexist ; $i++)
{?>
		<div class="capteur" >

            <h3 class="titre"> Détecteur de fumées </h3>

            <img src="<?php echo $f['photo']?>" class="avatar_capteur">

            <input type="checkbox" name="detecteur1" class="switch">

            <span class="slider round"> </span>
        </div>


<?php } ?>


