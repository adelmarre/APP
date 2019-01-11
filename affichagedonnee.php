<?php 

echo '
	<h3 class="titre"> Historique ></h3>
	
			<table>
					<tr>
					<th><h4>Capteur</h4></th>
					<th><h4>date</h4></th>
					<th><h4>heure</h4></th>
					<th><h4>etat</h4></th>

					

					</tr>';

?>

<?php 
while ($h = $historique -> fetch())
{


		echo ' <tr>
						<th> '.$h['id_donnees'].' </th> 
						<td>'.$h['ladate'].'</td>
						<td>>'.$h['heure'].'</td>' ; ?>

						<td> <?php if ( $h['valeur']==0) {echo 'désactivé';} else{echo'activé';}?> </td>
						
<?php

		echo				'</tr>';


     
	
	
 } 

 echo '</table>' ;
 ?>







					}

