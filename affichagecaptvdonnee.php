<?php 
$nb = 1;
while ($v = $volet -> fetch())
{?> 

	 <tr> 
	 <td> volet <?php echo $nb ?><td>
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