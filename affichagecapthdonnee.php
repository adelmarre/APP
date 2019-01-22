<?php 

while ($h = $humidite -> fetch())
{?> 

	 <tr> 
	 <td> Humidité </td>
	 <td><?php echo $h['numero'] ?> </td>
		 <td><?= $h['valeur'] ?> %</td>
           <td><?= $h['ladate'] ?> </td> 
           <td> <?= $h['heure'] ?></td> 
	 </tr> 
	
 <?php  } 
 ?>