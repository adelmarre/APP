
<table id="donnee" border>
    <tr> <th> Nom</th> <th>Référence</th><th>Etat </th><th>Date</th><th>Heure</th></tr>
    
    <?php


    while($h=$historique->fetch()) { 
  
    		
     
          include "affichagecaptldonnee.php";  
           include "affichagecaptmdonnee.php";
            include "affichagecaptfdonnee.php";
            include "affichagecaptvdonnee.php";
          include "affichagecapthdonnee.php";
          include "affichagecapttdonnee.php"; 
           									}	
          ?>
    
    
  </table>

 








