<?php
 
  	 
if ($_GET['langue']=='fr') {           // si la langue est 'fr' (français) on inclut le fichier fr-lang.php
 	 include('traductions/fr-lang.php');
 	 } 
  	 
else if($_GET['langue']=='en') {      // si la langue est 'en' (anglais) on inclut le fichier en-lang.php
  	 include('traductions/en-lang.php');
  	 }
  	 
else {   $_GET['langue'] = '';                   // si aucune langue n'est déclarée on inclut le fichier fr-lang.php par défaut
  	 include('traductions/fr-lang.php');
  	 }
  	 
 

?>