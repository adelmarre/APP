<?php 
$nb = 1;
while ($t = $temperature -> fetch())
{?> 

	 <tr> 
	 <td> capteur de température <?php echo $nb ?><td>
		 <?= $h['valeur'] ?><td>
           <?= $h['ladate'] ?> </td> 
           <td> <?= $h['heure'] ?></td> ?>
	 </tr> 
	
 <?php $nb = $nb + 1; } 
 ?>