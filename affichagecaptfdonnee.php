<?php 


while ($f = $fumee -> fetch())
{ ?> 

	<tr>
	 <td> Fumée </td>
	 <td><?php echo $f['numero'] ?></td>
	 	<?php 
	 	if ($f['valeur']==1){ 
	 		  echo '<td> Activé  </td>';
	 	}
	 	else {
	 		echo ' <td> Désactivé  </td>';
	 }
	 ?>

		
           <td><?= $f['ladate'] ?> </td> 
           <td> <?= $f['heure'] ?></td> 
      </td>
	
	
 <?php   } 
 ?>