
<table border>
    <tr> <th> Nom</th><th>Etat </th> <th> date</th><th> heure</th></tr>
    <tr>
    <?php


    while($h=$historique->fetch()) { 
    ?>
    		
      <tr>
          <td><?= $h['id_donnees'] ?></td> 
          <td> <?= $h['valeur'] ?><td>
           <?= $h['ladate'] ?> </td> 
           <td> <?= $h['heure'] ?></td> ?>
           
   </tr>      <?php } ?>
  </table>

 








