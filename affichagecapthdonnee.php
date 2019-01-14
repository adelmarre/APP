<?php 
$nb = 1;
while ($h = $humidite -> fetch())
{?> 

	 <tr> 
	 <td> capteur d'humidité <?php echo $nb ?><td>
		 <?= $h['valeur'] ?><td>
           <?= $h['ladate'] ?> </td> 
           <td> <?= $h['heure'] ?></td> ?>
	 </tr> 
	
 <?php $nb = $nb + 1; } 
 ?>