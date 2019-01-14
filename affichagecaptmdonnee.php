<?php 
$nb = 1;
while ($m = $mouvement -> fetch())
{?> 

	 <tr> 
	 <td> Mouvement <?php echo $nb ?><td>

		 	 	<?php 
	 	if ($h['valeur']==1){ 
	 		  echo 'activé  <td>';
	 	}
	 	else {
	 		echo 'désactivé  <td>';
	 }
	 ?>

          <?= $h['ladate'] ?> </td> 
           <td> <?= $h['heure'] ?></td> ?>
	 </tr> 
	
 <?php $nb = $nb + 1; } 
 ?>

