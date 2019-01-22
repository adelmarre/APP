<?php 


while ($l = $luminosite -> fetch())
{?> 

	 <tr> 
	 <td> Lumière</td>
	 <td> <?php echo $l['numero']?></td>
		 	<?php 
	 	if ($l['valeur']==1){ 
	 		  echo '<td> Allumé  </td>';
	 	}
	 	else {
	 		echo ' <td> Eteinte </td>';
	 }
	 ?>
          <td><?= $l['ladate'] ?> </td> 
           <td> <?= $l['heure'] ?></td> 
	 </tr> 
	
 <?php  } 
 ?>



