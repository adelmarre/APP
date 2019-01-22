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
              
        xmlhttp.open("GET", "getdonnees.php?q=" + str +"&h=" + sth, true);
        xmlhttp.send();
}


</script>



<html>
<head>
  <title>Ma maison - Historique</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="sallestyle.css" /> 

</head>

<body>
<?php include "menu.php" ?>

<div id="colonnegauche">

  

  <div class="Alerte">
    <span class="bouton_fermer" onclick="this.parentElement.style.display='none';">&times;
    </span>
    <strong>Boite d'alerte</strong> </br></br>
    <?php  if (!empty($_GET['id_habitation'])) {
      $anomalie1 = $bdd->prepare("SELECT * from capteurpiece JOIN piece ON capteurpiece.id_piece=piece.id_piece JOIN habitation ON piece.id_habitation=habitation.id_habitation WHERE habitation.id_habitation = ? AND id_type = ? ");

        $anomalie1-> execute(array($_GET['id_habitation'],2));
       
        
        while ($r=$anomalie1->fetch()) {

            if ($r['valeur']>28) {
      
              echo "/!\ Température trop haute dans votre ";
              echo $r['nom'];
               echo "</br>";
             
            }
          
        }
         $anomalie2 = $bdd->prepare("SELECT * from capteurpiece JOIN piece ON capteurpiece.id_piece=piece.id_piece JOIN habitation ON piece.id_habitation=habitation.id_habitation WHERE habitation.id_habitation = ? AND id_type = ? ");

        $anomalie2-> execute(array($_GET['id_habitation'],6));
       
        
        while ($r=$anomalie2->fetch()) {

            if ($r['valeur']>70) {

              echo "/!\ Taux d'humidité trop haut dans votre ";
              echo $r['nom'];
               echo "</br>";
          
            }
          
        }

    }
    ?>
   </br>
  </div>

    
   </br>
 

  <nav>
    <ul class="meta_menu">
      <li class="menu_salles" >
        </br>
        
            <input type="button" value="Salles ↓" class="bouton">
          <ul class="sous_menu_salles">
           </br>
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
                        

                         echo '<li> <input type="radio" name="'.$row['id_habitation'].'" value="'.$row['id_piece'].'" onchange="AfficheCapt(this.value,this.id,this.name)" class="Selec" id="'.$row['nom'].'" > '.$row['nom'].'  </li>' ;
                        
                      

                         }
                       }
                    
                  }
                  

         
              AffichePiece();
              ?>

  </ul>
</form>


 </li>
</nav>

</div>

<div id="Centre">

  <fieldset id="setSalon">
    <legend> <h1 id="titreSet"></h1></legend>
    <div id="contenu">

    Choisissez votre pièce pour afficher l'historique

                           

     
     </div>

                       
                      </fieldset>

 </div>




</body>
 </html>
