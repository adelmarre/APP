<?php 
$nb = 1;

while ($l = $luminosite -> fetch())
{?> 

	 <tr> 
	 <td> Lumière <?php echo $nb ?><td>
		 <?= $h['valeur'] ?><td>
           <?= $h['ladate'] ?> </td> 
           <td> <?= $h['heure'] ?></td> ?>
	 </tr> 
	
 <?php $nb = $nb + 1; } 
 ?>



