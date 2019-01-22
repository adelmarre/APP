<?php 

while ($v = $volet -> fetch())
{?> 

	 <tr> 
	 <td>Volet</td>
	 <td><?php echo $v['numero'] ?></td>
		 	 	<?php 
	 	if ($v['valeur']==1){ 
	 		  echo '<td> Fermé  <td>';
	 	}
	 	else {
	 		echo ' <td> Ouvert  <td>';
	 }
	 ?>

           <?= $v['ladate'] ?> </td> 
           <td> <?= $v['heure'] ?></td> 
	 </tr> 
	
 <?php  } 
 ?>