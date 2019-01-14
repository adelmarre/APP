
<table border>
    <tr> <th> Nom</th><th>Etat </th> <th> date</th><th> heure</th></tr>
    
    <?php


    while($h=$historique->fetch()) { 
    ?>
    		
     
          <?php include "affichagecaptldonnee.php";  
           include "affichagecaptmdonnee.php";
            include "affichagecaptfdonnee.php";
            include "affichagecaptvdonnee.php";
          include "affichagecapthdonnee.php";
          include "affichagecapttdonnee.php"; 
           										?>
         <?php } ?>
    
  </table>

 








