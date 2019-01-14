<?php 
$nb = 1;
while ($l = $fumee -> fetch())
{?> 

	
	 <td> fumée <?php echo $nb ?><td>
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
	
	
 <?php $nb = $nb + 1; } 
 ?>