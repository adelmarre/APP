<?php session_start(); ?>
<script type="text/javascript">

function AfficheCapt(str,std,sth){

  var Titre=document.getElementById('titreSet');
  Titre.innerHTML=std;//changer le nom de la piece
  if (window.XMLHttpRequest) {
      xmlhttp= new XMLHttpRequest();
                } else {
                    if (window.ActiveXObject)
                        try {
                            xmlhttp= new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            try {
                                xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
                            } catch (e) {
                                return NULL;
                            }
                        }
                }
        xmlhttp.onreadystatechange = function ()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        document.getElementById("contenu").innerHTML = xmlhttp.responseText;
                    }
                }
              
        xmlhttp.open("GET", "getdonnees.php?q=" + str +"&h=" + sth true);
        xmlhttp.send();
}


</script>



<html>
<head>
  <title>Javascript</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="sallestyle.css" /> 

</head>

<body>

  <?php include "menu.php"; ?>



<div id="colonnegauche">


  <nav>
    <ul class="meta_menu">
      <li class="menu_salles" >
        </br>
        
            <input type="button" value="Salles ↓" class="bouton">
          <ul class="sous_menu_salles">
            <form>
                <?php

                function AffichePiece(){
                     $bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');
                    
                    if (isset($_GET["id_habitation"])) {
                     
                      $piece =$bdd->prepare('SELECT nom,id_piece,id_habitation FROM piece  WHERE id_habitation= "'.$_GET["id_habitation"].'" ');

                      $piece ->execute();
                      
                       $tabpiece=$piece->fetchAll(PDO::FETCH_ASSOC);

                       //var_dump($tabpiece);

                      
                      foreach ($tabpiece as $row) {
                        

                         echo '<li> <input type="radio" name="'.$row['id_habitation'].'" value="'.$row['id_piece'].'" onchange="AfficheCapt(this.value,this.id,this.name)" class="Selec" id="'.$row['id_piece'].'" > '.$row['nom'].'  </li>' ;
                        
                      

                         }
                       }
                    
                  }
                  ?>
              <?php
              AffichePiece();
              ?>

  </ul>
</form>


 </li>

 <li class="menu habitation">
  <p> 
   <form method="post" action="traitement.php">
    <input type="button" value="Habitation ↓" class="bouton">
  </form>
</p>

<ul class="sous_menu_habitations">

<?php
  function page_redirect($location)
 {
   echo '<META HTTP-EQUIV="Refresh" >';
   exit; 
 }
?>

<FORM method="GET" action="">

  <?php
  
  function habitation() {

   $bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');



   $habitation =$bdd->prepare('SELECT nomhabitation,id_habitation  FROM habitation  WHERE id_personne= "'.$_SESSION['id'].'" ');

   $habitation ->execute();

    $tabhab=$habitation->fetchAll(PDO::FETCH_ASSOC);


   foreach ($tabhab as $row) {

    echo '<li> <input type="radio" name="id_habitation" value="'.$row['id_habitation'].'" class="SelecHabitation" id="'.$row['id_habitation'].'"  > '.$row['nomhabitation'].'  </li>' ;


    $habitation->closeCursor();

    
  }
  
}
?>

<?php


habitation();

?>

<input type="submit" id="Hab" value="Entrer" >
</FORM>



</ul>
</form>
</nav>

</div>

<div id="Centre">

  <fieldset id="setSalon">
    <legend> <h1 id="titreSet"></h1></legend>
    <div id="contenu">

    Choisissez votre habitation puis votre pièce
    
                           

     
     </div>

                       
                      </fieldset>

 </div>

                      <?php 

                      include "footer.php";

                      ?>



</body>
 </html>