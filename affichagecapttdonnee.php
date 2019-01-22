<?php 

while ($t = $temperature -> fetch())
{?> 

	 <tr> 
	 <td> Température</td>
	 <td><?php echo $t['numero'] ?></td>
		<td> <?= $t['valeur'] ?> °C</td>
         <td>  <?= $t['ladate'] ?> </td> 
           <td> <?= $t['heure'] ?></td>
	 </tr> 
	
 <?php  } 
 ?>

