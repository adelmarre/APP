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
              
        xmlhttp.open("GET", "getpiece.php?q=" + str +"&h=" + sth, true); // fait passer l'id de la pièce plus celui de la maison
        xmlhttp.send();
}


</script>



<html>
<head>
  <title>Ma maison</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="sallestyle.css" /> 

</head>

<body>

  <?php include "menu.php";

if (isset($_POST['modifier'])) {
  if (!empty($_POST['mouvement'])) {
     foreach ($_POST['mouvement'] as $select)
      {
        $o =explode(',',$select);  

        $date = date("Y-m-d");
        $heure = date("H:i:s");

        $insertcapteur = $bdd->prepare("UPDATE capteurpiece SET valeur=? WHERE id_capteur_piece = ? ");
        $insertcapteur-> execute(array($o[1],$o[0]));

         $Recup = $bdd->prepare("SELECT valeur,capteurpiece.id_type,id_capteur_piece,reference,id_piece from capteurpiece JOIN catalogue ON capteurpiece.id_capteur_catalogue=catalogue.id_capteur WHERE id_capteur_piece= ? AND id_capteur_catalogue = ?");
        $Recup-> execute(array($o[0],$o[2]));

        $Rec=$Recup->fetch();
                   

        $inserthistorique = $bdd->prepare("INSERT INTO donnees(valeur, ladate, heure, id_piece, id_type,id_capteur_piece, numero) VALUES( ?, ?,?, ?, ?, ?,?)");
        $inserthistorique-> execute(array($Rec['valeur'],$date ,$heure ,$Rec['id_piece'] ,$Rec['id_type'], $Rec['id_capteur_piece'], $Rec['reference'] ));
  
      }
  }
  if (!empty($_POST['fumee'])) {
     foreach ($_POST['fumee'] as $select)
      {
        $o =explode(',',$select);  
        
        $insertcapteur = $bdd->prepare("UPDATE capteurpiece SET valeur=? WHERE id_capteur_piece = ? ");
        $insertcapteur-> execute(array($o[1],$o[0]));

        $date= date("Y-m-d");
        $heure = date("H:i:s");

       $Recup = $bdd->prepare("SELECT valeur,capteurpiece.id_type,id_capteur_piece,reference,id_piece from capteurpiece JOIN catalogue ON capteurpiece.id_capteur_catalogue=catalogue.id_capteur WHERE id_capteur_piece= ? AND id_capteur_catalogue = ?");
        $Recup-> execute(array($o[0],$o[2]));

        $Rec=$Recup->fetch();
                   

       
        $inserthistorique = $bdd->prepare("INSERT INTO donnees(valeur, ladate, heure, id_piece, id_type,id_capteur_piece, numero) VALUES( ?, ?,?, ?, ?, ?,?)");
        $inserthistorique-> execute(array($Rec['valeur'],$date ,$heure ,$Rec['id_piece'] ,$Rec['id_type'], $Rec['id_capteur_piece'], $Rec['reference'] ));
      
    
  
      }
  }
  if (!empty($_POST['luminosite'])) {
     foreach ($_POST['luminosite'] as $select)
      {
        $o =explode(',',$select);  
        

        $date= date("Y-m-d");
        $heure = date("H:i:s");

        $insertcapteur = $bdd->prepare("UPDATE capteurpiece SET valeur=? WHERE id_capteur_piece = ? ");
        $insertcapteur-> execute(array($o[1],$o[0]));

        $Recup = $bdd->prepare("SELECT valeur,capteurpiece.id_type,id_capteur_piece,reference,id_piece from capteurpiece JOIN catalogue ON capteurpiece.id_capteur_catalogue=catalogue.id_capteur WHERE id_capteur_piece= ? AND id_capteur_catalogue = ?");
        $Recup-> execute(array($o[0],$o[2]));

        $Rec=$Recup->fetch();
                   
        $inserthistorique = $bdd->prepare("INSERT INTO donnees(valeur, ladate, heure, id_piece, id_type,id_capteur_piece, numero) VALUES( ?, ?,?, ?, ?, ?,?)");
        $inserthistorique-> execute(array($Rec['valeur'],$date ,$heure ,$Rec['id_piece'] ,$Rec['id_type'], $Rec['id_capteur_piece'] ,$Rec['reference'] ));
      
  
      }
  }
  if (isset($_POST['volet'])) {
        $select=$_POST['volet'];
        $o =explode(',',$select);  
        
        $insertcapteur = $bdd->prepare("UPDATE capteurpiece SET valeur=? WHERE id_capteur_piece = ? ");
        $insertcapteur-> execute(array($o[1],$o[0]));

       $Recup = $bdd->prepare("SELECT valeur,capteurpiece.id_type,id_capteur_piece,reference,id_piece from capteurpiece JOIN catalogue ON capteurpiece.id_capteur_catalogue=catalogue.id_capteur WHERE id_capteur_piece= ? AND id_capteur_catalogue = ?");
        $Recup-> execute(array($o[0],$o[2]));

        $Rec=$Recup->fetch();
         
       
        $inserthistorique = $bdd->prepare("INSERT INTO donnees(valeur, ladate, heure, id_piece, id_type,id_capteur_piece, numero) VALUES( ?, ?,?, ?, ?, ?,?)");
        $inserthistorique-> execute(array($Rec['valeur'],$date ,$heure ,$Rec['id_piece'] ,$Rec['id_type'], $Rec['id_capteur_piece'], $Rec['reference'] ));
      }
      $i=1;
      $essai = 3;
  while ($i<1000) {
      if (isset($_POST[$i])) {
 
        $select=intval($_POST[$i]);
        $id_capteur=$_POST[$i+10];
        $o =explode(',',$id_capteur); 
        $insertcapteur = $bdd->prepare("UPDATE capteurpiece SET valeur=? WHERE id_capteur_piece = ? ");
        $insertcapteur-> execute(array($select,$o[0]));

        $date= date("Y-m-d");
        $heure = date("H:i:s");

        $Recup = $bdd->prepare("SELECT valeur,capteurpiece.id_type,id_capteur_piece,reference,id_piece from capteurpiece JOIN catalogue ON capteurpiece.id_capteur_catalogue=catalogue.id_capteur WHERE id_capteur_piece= ? AND id_capteur_catalogue = ?");
        $Recup-> execute(array($o[0],$o[1]));

        $Rec=$Recup->fetch();
                   

        $inserthistorique = $bdd->prepare("INSERT INTO donnees(valeur, ladate, heure, id_piece, id_type,id_capteur_piece, numero) VALUES( ?, ?,?, ?, ?, ?,?)");
        $inserthistorique-> execute(array($Rec['valeur'],$date ,$heure ,$Rec['id_piece'] ,$Rec['id_type'], $Rec['id_capteur_piece'], $Rec['reference'] ));
      }
    
      else { break;
      }
        $i=$i+1;
  }

 if (!empty($_POST['humidite'])) {
     foreach ($_POST['humidite'] as $select)
      {
        $o =explode(',',$select);  
        
        $insertcapteur = $bdd->prepare("UPDATE capteurpiece SET valeur=? WHERE id_capteur_piece = ? ");
        $insertcapteur-> execute(array($o[1],$o[0]));


        $date= date("Y-m-d");
        $heure = date("H:i:s");
        $Recup = $bdd->prepare("SELECT valeur,capteurpiece.id_type,id_capteur_piece,reference,id_piece from capteurpiece JOIN catalogue ON capteurpiece.id_capteur_catalogue=catalogue.id_capteur WHERE id_capteur_piece= ? AND id_capteur_catalogue = ?");
        $Recup-> execute(array($o[0],$o[2]));

        $Rec=$Recup->fetch();
                   

        $inserthistorique = $bdd->prepare("INSERT INTO donnees(valeur, ladate, heure, id_piece, id_type,id_capteur_piece, numero) VALUES( ?, ?,?, ?, ?, ?,?)");
        $inserthistorique-> execute(array($Rec['valeur'],$date ,$heure ,$Rec['id_piece'] ,$Rec['id_type'], $Rec['id_capteur_piece'], $Rec['reference'] ));
      
  
      }
  }




}
   if(isset($_GET['supprime']) AND !empty($_GET['supprime']) AND isset($_GET['type']) AND !empty($_GET['type'])  ) {
      $supprime = intval($_GET['supprime']);
      $type = (int) $_GET['type'];
      if ($type==2) {
          $req1 = $bdd->prepare('DELETE FROM capteurpiece WHERE id_capteur_piece = ?');
          $req1->execute(array($supprime));
          $req2 = $bdd->prepare('DELETE FROM capteurpiece WHERE id_capteur_piece = ?');
          $req2->execute(array($supprime+1));
      }
      if ($type==6) {
          $req1 = $bdd->prepare('DELETE FROM capteurpiece WHERE id_capteur_piece = ?');
          $req1->execute(array($supprime));
          $req2 = $bdd->prepare('DELETE FROM capteurpiece WHERE id_capteur_piece = ?');
          $req2->execute(array($supprime-1));
      }
      else {
      $req1 = $bdd->prepare('DELETE FROM capteurpiece WHERE id_capteur_piece = ?');
      $req1->execute(array($supprime));
    }

}

 if(isset($_GET['supprimer']) AND !empty($_GET['supprimer']))  {
  $supprimer = intval( $_GET['supprimer']);
  $habitation = intval($_GET['id_habitation']);
   $reqpiece = $bdd->prepare('DELETE FROM piece WHERE id_piece = ? AND id_habitation= ? ');
   $reqpiece->execute(array($supprimer,$habitation));

 }
?>
<div id="colonnegauche">

  <div class="Alerte">
         <?php 
        $reqmessage = $bdd -> query('SELECT * FROM message WHERE vu=0 AND nomexpediteur="admin"');
        $pasvuexist = $reqmessage ->rowCount();
        $id = intval($_SESSION['id']);
        if ($pasvuexist !=0) { 
          echo '<a id="menu" href="pagecontact.php?langue=fr"><img src="image/logomessage.png" class="avatar_notif"> <h6>Vous avez reçu un/des nouveau(x) message(s)</h6></a>';}
          ?>
         
   
    <strong>Boite d'alerte</strong> <br>
 <span class="bouton_fermer" onclick="this.parentElement.style.display='none';">&times;</span>
    <?php  if (!empty($_GET['id_habitation'])) {
      $anomalie1 = $bdd->prepare("SELECT * from capteurpiece JOIN piece ON capteurpiece.id_piece=piece.id_piece JOIN habitation ON piece.id_habitation=habitation.id_habitation WHERE habitation.id_habitation = ? AND id_type = ? ");

        $anomalie1-> execute(array($_GET['id_habitation'],2));
       
        
        while ($r=$anomalie1->fetch()) {

            if ($r['valeur']>28) {
      
              echo "/!\ Température trop haute dans votre ";
              echo $r['nom'];
               echo "";
             
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


  <nav>
    <ul class="meta_menu">
      <li class="menu_salles" >
        </br>
        
            <input type="button" value="Salles ↓" class="bouton">
          <ul class="sous_menu_salles">
            <form>
                <?php

                function AffichePiece($id){
                     $bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');
                    
                    if (isset($_GET["id_habitation"])) {
                      $id_habitation = intval($_GET['id_habitation']);

                      $reqsecondairehab = $bdd->prepare("SELECT * FROM secondaire WHERE id_utilisateur_secondaire = ? AND id_habitation = ?");// on cherche si l'utilisateur est secondaire pour la maison 
                      $reqsecondairehab->execute(array($id, $id_habitation));
                      $secondairehab = $reqsecondairehab->fetch();
                      $secondaire = $reqsecondairehab->rowcount();
                 
                      if ($secondaire==0) {

                      $piece =$bdd->prepare('SELECT nom,id_piece,id_habitation FROM piece  WHERE id_habitation= "'.$id_habitation.'" ');

                      $piece ->execute();

                      }
                      else {
                          $piece =$bdd->prepare('SELECT * FROM piece JOIN secondaire ON piece.id_piece=secondaire.id_piece WHERE (secondaire.id_habitation= ?) AND (secondaire.id_utilisateur_secondaire= ?)');//si oui on affiche que les pièces où il est utilisateur secondaire grace a la table secondaire

                          $piece ->execute(array($id_habitation, $id));
                          
                      }
                       $tabpiece=$piece->fetchAll(PDO::FETCH_ASSOC);
                  
                       //var_dump($tabpiece);

                      
                      foreach ($tabpiece as $row) {
                        

                         echo '<li> <input type="radio" name="'.$row['id_habitation'].'" value="'.$row['id_piece'].'" onchange="AfficheCapt(this.value,this.id,this.name)" class="Selec" id="'.$row['nom'].'" > '.$row['nom'].'  </li>' ;
                        
                      

                         }
                       }
                    
                  }
                  ?>
              <?php
              AffichePiece($getid);
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
  
  function habitation($id) {

   $bdd = new PDO('mysql:host=localhost;dbname=hexagon','root','');


    $reqsecondairehab = $bdd->prepare("SELECT * FROM secondairehab WHERE id_secondaire = ?");
    $reqsecondairehab->execute(array($id));
    $secondairehab = $reqsecondairehab->fetch();
    $secondaire = $reqsecondairehab->rowcount();
    if ($secondaire==0) {//verification est ce un utilisateur secondaire, ici non


   $habitation =$bdd->prepare('SELECT nomhabitation,id_habitation  FROM habitation  WHERE id_personne= "'.$id.'" ');

   $habitation ->execute();
 }
  else {
   $habitation =$bdd->prepare('SELECT nomhabitation,habitation.id_habitation  FROM secondairehab JOIN habitation ON secondairehab.id_habitation=habitation.id_habitation  WHERE id_secondaire= ? ');//on affiche la maison de lutilisateur principal auquel il est lié

   $habitation ->execute(array($id));
  }

    $tabhab=$habitation->fetchAll(PDO::FETCH_ASSOC);


   foreach ($tabhab as $row) {

    echo '<li> <input type="radio" name="id_habitation" value="'.$row['id_habitation'].'" class="SelecHabitation" id="'.$row['id_habitation'].'"  > '.$row['nomhabitation'].'  </li>' ;


    $habitation->closeCursor();

    
  }

  
}
?>

<?php


habitation($getid);
?>

<button  class="snip1479" type="submit" id="Hab" >Entrer </button>
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

      <?php
            $reqsecondairehab = $bdd->prepare("SELECT * FROM secondairehab WHERE id_secondaire = ?");
            $reqsecondairehab->execute(array($_SESSION['id']));
            $secondairehab = $reqsecondairehab->fetch();
            $secondaire = $reqsecondairehab->rowcount();
            if ($secondaire==0) {//verification est ce un utilisateur secondaire, ici non
      ?>
      ou ajoutez une maison : 
                <br>
                 <a id="ajoutermaison" href="maison.php"> 
                <div class="swiggleBox">
                +1 Maison
                    <svg width="130" height="65" viewBox="0 0 130 65" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.6,0.5c0,5.4,0,61.5,0,61.5s4.5,5.4,9.9,0c5.4-5.4,9.9,0,9.9,0s4.5,5.4,9.9,0c5.4-5.4,9.9,0,9.9,0
                    s4.5,5.4,9.9,0c5.4-5.4,9.9,0,9.9,0s4.5,5.4,9.9,0c5.4-5.4,9.9,0,9.9,0s4.5,5.4,9.9,0c5.4-5.4,9.9,0,9.9,0s4.5,5.4,9.9,0
                    c5.4-5.4,9.9,0,9.9,0s4.5,5.4,9.9,0c0,0,0-56.1,0-61.5H0.6z"/>
                    </svg>
                </div>  
                </a>     
                </label>
         <?php } ?>
     </div>

                       
  </fieldset>

 </div>

</body> 
