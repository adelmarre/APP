<?php 

while ($m = $mouvement -> fetch())
{?> 

	 <tr> 
	 <td> Mouvement</td>
	 <td><?php echo $m['numero'] ?></td>

		 	 	<?php 
	 	if ($m['valeur']==1){ 
	 		  echo '<td> Activé </td>';
	 	}
	 	else {
	 		echo ' <td> Désactivé </td>';
	 }
	 ?>

         <td> <?= $m['ladate'] ?> </td> 
           <td> <?= $m['heure'] ?></td> 
	 </tr> 
	
 <?php } 
 ?>

