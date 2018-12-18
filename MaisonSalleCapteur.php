



<?php 
session_start();
try {
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');
if (isset($_GET['id']) AND $_GET['id'] > 0)
{
  $getid = intval($_GET['id']);
  $requser = $bdd -> prepare('SELECT * FROM personne WHERE id = ?');
  $requser -> execute(array($getid));
  $userinfo = $requser ->fetch();
}
}
catch(Exception $e){
  die('Erreur : ' . $e->getMessage());
}
?>





<html>
<head>
  <title>MaMaison</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="sallestyle.css" /> 
  <link rel="stylesheet" type="text/css" href="general.css">
  <script type="text/javascript" >
   function AfficheHab(){

    var Titre=document.getElementById('titreSet');

    var Principal=document.getElementById('MenuMaisonPrincipal');
    var Secondaire=document.getElementById('MenuMaisonSecondaire');

    var Pradio=document.getElementById('PrincipalRadio');
    var Sradio=document.getElementById('SecondaireRadio');

    var Capteurd2=document.getElementById('capteurd2');
    var Capteurm=document.getElementById('capteurm');



    

    var NbTotalCapt=document.querySelectorAll('.capteur, .capteurch1, .capteurch2, .capteurcui, .capteursalbain, .capteurcave');
    var NbTotalRadio=document.querySelectorAll('#ch1, #ch2, #cui, #salbain, #salon, #cave');






    var i=0;
    var y=0;

    Capteurd2.style.display='none';
    Capteurm.style.display='none';

    for(i; i< NbTotalRadio.length; i++){
      if(NbTotalRadio[i].checked==true){

       NbTotalRadio[i].checked=false;

       for(y; y< NbTotalRadio.length; y++){
        NbTotalCapt[y].style.display='none';
      }

    }
  }




  if(Pradio.checked==true){
    Titre.innerHTML='Maison Principal';
    Principal.style.display='block';
    Secondaire.style.display='none';





  }
  else{
    Titre.innerHTML='Maison Secondaire';
    Principal.style.display='none';
    Secondaire.style.display='block';



  }
}



function AfficheCapt(){
  var Titre=document.getElementById('titreSet');

  var Capteursalon=document.getElementsByClassName('capteur');
  var Capteurch1=document.getElementsByClassName('capteurch1');
  var Capteurch2=document.getElementsByClassName('capteurch2');
  var Capteurcui=document.getElementsByClassName('capteurcui');
  var Capteursalbain=document.getElementsByClassName('capteursalbain');
  var Capteurcave=document.getElementsByClassName('capteurcave');




  var Ch1radio=document.getElementById('ch1');
  var Ch2radio=document.getElementById('ch2');
  var Cuiradio=document.getElementById('cui');
  var Salbainradio=document.getElementById('salbain');
  var Salonradio=document.getElementById('salon');
  var Caveradio=document.getElementById('cave');

  var i=0;



  if(Ch1radio.checked==true){
    Ch1radio.checked=
    Titre.innerHTML='Chambre 1';
    for (i; i< Capteurch1.length; i++){
      Capteurch1[i].style.display='table-cell';
    }

    for (i; i< Capteurch2.length; i++){
     Capteurch2[i].style.display='none';
   }
   for (i; i< Capteurcui.length; i++){
    Capteurcui[i].style.display='none';
  }

  for (i; i< Capteursalbain.length; i++){
    Capteursalbain[i].style.display='none';
  }

  for (i; i< Capteursalon.length; i++){
    Capteursalon[i].style.display='none';

  }

  for (i; i< Capteurcave.length; i++){
    Capteurcave[i].style.display='none';
  }

}



else if(Ch2radio.checked==true){
  Titre.innerHTML='Chambre 2';

  for (i; i< Capteurch2.length; i++){
    Capteurch1[i].style.display='table-cell';
  }

  for (i; i< Capteurch1.length; i++){
   Capteurch2[i].style.display='none';
 }
 for (i; i< Capteurcui.length; i++){
  Capteurcui[i].style.display='none';
}

for (i; i< Capteursalbain.length; i++){
  Capteursalbain[i].style.display='none';
}

for (i; i< Capteursalon.length; i++){
  Capteursalon[i].style.display='none';

}

for (i; i< Capteurcave.length; i++){
  Capteurcave[i].style.display='none';
}
}




else if(Cuiradio.checked==true){
  Titre.innerHTML='Cuisine';

  for (i; i< Capteurcui.length; i++){
    Capteurcui[i].style.display='table-cell';
  }

  for (i; i< Capteurch2.length; i++){
   Capteurch2[i].style.display='none';
 }
 for (i; i< Capteurcui.length; i++){
  Capteurch1[i].style.display='none';
}

for (i; i< Capteursalbain.length; i++){
  Capteursalbain[i].style.display='none';
}

for (i; i< Capteursalon.length; i++){
  Capteursalon[i].style.display='none';

}

for (i; i< Capteurcave.length; i++){
  Capteurcave[i].style.display='none';
}
}



else if(Salbainradio.checked==true){
  Titre.innerHTML='Salle de bain';

  for (i; i< Capteursalbain.length; i++){
    Capteurch1[i].style.display='table-cell';
  }

  for (i; i< Capteurch2.length; i++){
   Capteurch2[i].style.display='none';
 }
 for (i; i< Capteurcui.length; i++){
  Capteurcui[i].style.display='none';
}

for (i; i< Capteurch1.length; i++){
  Capteurch1[i].style.display='none';
}

for (i; i< Capteursalon.length; i++){
  Capteursalon[i].style.display='none';

}

for (i; i< Capteurcave.length; i++){
  Capteurcave[i].style.display='none';
}
}



else if(Salonradio.checked==true){
  Titre.innerHTML='Salon';

  for (i; i< Capteursalon.length; i++){
    Capteursalon[i].style.display='table-cell';
  }

  for (i; i< Capteurch2.length; i++){
   Capteurch2[i].style.display='none';
 }
 for (i; i< Capteurcui.length; i++){
  Capteurcui[i].style.display='none';
}

for (i; i< Capteursalbain.length; i++){
  Capteursalbain[i].style.display='none';
}

for (i; i< Capteurch1.length; i++){
  Capteursalon[i].style.display='none';

}

for (i; i< Capteurcave.length; i++){
  Capteurcave[i].style.display='none';
}
}



else if(Caveradio.checked==true){
  Titre.innerHTML='Cave';

  for (i; i< Capteurcave.length; i++){
    Capteurcave[i].style.display='table-cell';
  }

  for (i; i< Capteurch2.length; i++){
   Capteurch2[i].style.display='none';
 }
 for (i; i< Capteurcui.length; i++){
  Capteurcui[i].style.display='none';
}

for (i; i< Capteursalbain.length; i++){
  Capteursalbain[i].style.display='none';
}

for (i; i< Capteursalon.length; i++){
  Capteursalon[i].style.display='none';

}

for (i; i< Capteurch1.length; i++){
  Capteurch1[i].style.display='none';
}

}




}







function EteintAllume(){
  var Allume1=document.getElementById('capteurl1').getElementsByClassName('avatar_capteur_lampe_allume');
  var Allume2=document.getElementById('capteurl2').getElementsByClassName('avatar_capteur_lampe_allume');

  var Eteint1=document.getElementById('capteurl1').getElementsByClassName('avatar_capteur_lampe_éteint');
  var Eteint2=document.getElementById('capteurl2').getElementsByClassName('avatar_capteur_lampe_éteint');

  var L1=document.getElementById('switch1');
  var L2=document.getElementById('switch2');

  var i1=0;
  var i2=0;



  if(L1.checked==true){

    for (i1; i1<Allume1.length; i1++){


      Allume1[i1].style.display='block';
      Eteint1[i1].style.display='none';

    }
  }
  else{
    for (i1; i1<Allume1.length; i1++){
      Allume1[i1].style.display='none';
      Eteint1[i1].style.display='block';
    }
  }


  if(L2.checked==true){

    for (i2; i2<Allume2.length; i2++){


      Allume2[i2].style.display='block';
      Eteint2[i2].style.display='none';

    }
  }
  else{
    for (i2; i2<Allume2.length; i2++){
      Allume2[i2].style.display='none';
      Eteint2[i2].style.display='block';
    }
  }

}


/*fonction incomplete/ne marche pas: fait bugger les autres fonctions
function Hautbas(){
  var M=document.getElementById('monter');
  var B=document.getElementById('baisser');
  document.getElementById('monter').addEventListener('click',function()){
    if(B.active==true){

    }
  }
  document.getElementById('baisser').addEventListener('click',function())
} */

</script>




</head>
<body>

  <?php include "header_none.php" ?>
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">

  <div id="colonnedroite">

    <div class="box_profil">

      <img src="profil.jpg" class="photo_profil">
      <br/>
      <div class="affichage_prenom">
       <?php echo $userinfo['prenom'];?>
     </div>
     <div class="affichage_nom">
       <?php echo $userinfo['nom'];?>
     </div>

   </div>


   <nav>
    <ul class="box_information">

        <li>
          <p> 

            
                        <?php echo '<a href="editerprofil.php?id='.$_SESSION['id'].'" class="box">Editer profil</a>'; ?>
            
            <img src="https://image.freepik.com/icones-gratuites/symbole-des-parametres_318-34202.jpg"
            class="avatar_box">
          </p>
        </li>

        

        <li>
          <p>
            <?php echo '<a href="faqversionfinale.php?id='.$_SESSION['id'].'" class="box">Aide</a>'; ?>

            <img src="https://images.emojiterra.com/twitter/512px/2753.png" class="avatar_box">
          </p>
        </li>
        <li> 
         <p> <?php echo '<a href="apropos.php?id='.$_SESSION['id'].'"  class="box">A propos</a>'; ?>

          <img src="https://image.freepik.com/icones-gratuites/informations-petite-lettre-symbole-i_318-54670.jpg" class="avatar_box">
        </p>
      </li>
      <li> 
       <p> <a href="Consignes globales" class="box">Consignes globales</a>

        <img src="https://images-na.ssl-images-amazon.com/images/I/61OH1BsW99L._SY355_.jpg" class="avatar_box">
      </p>
    </li>
    <li> 
     <p> <?php echo '<a href="catalogue.php?id='.$_SESSION['id'].'"  class="box">Catalogue</a>'; ?>


      <img src="https://svgsilh.com/svg_v2/160871.svg" class="avatar_box">
    </p>



  </li>

  <li> 

   <p> <?php echo '<a href="gerermamaison.php?id='.$_SESSION['id'].'" class="box_rouge">Gérer ma maison</a>'; ?> 
    


   </p>



 </li>


   <li> 

   <p> <?php echo '<a href="MaisonSalleCapteur.php?id='.$_SESSION['id'].'" class="box_rouge">Ma Maison</a>'; ?> 
    


   </p>



 </li>



 <li> 

   <p> <a href="deconnexion.php" class="deconnexion" class="box_rouge">Déconnexion</a>


   </p>

 </li>
</ul>
</nav>





</div>


</div>

<div id="colonnegauche">

  <div class="Alerte">
    <span class="bouton_fermer" onclick="this.parentElement.style.display='none';">&times;
    </span>
    Boite d'alerte
  </div>


  <nav>
    <ul class="meta_menu">
      <li class="menu_salles" >
        <p> 
          <form method="post" action="traitement.php">
            <input type="button" value="Salles ↓" class="bouton">

          </p>



          <ul class="sous_menu_salles" id="MenuMaisonPrincipal">
            <li>
              <input type="radio" name="Sélection" value="Chambre 1" class="Selec" id="ch1" onchange="AfficheCapt()"> Chambre 1
            </li>

            <li>
             <input type="radio" name="Sélection" value="Chambre 2" class="Selec" id="ch2"  onchange="AfficheCapt()"> Chambre 2
           </li>


           <li>
            <input type="radio" name="Sélection" value="Cuisine" class="Selec" id="cui"  onchange="AfficheCapt()"> Cuisine
          </li>

          <li>
           <input type="radio" name="Sélection" value="Salle de bain" class="Selec" id="salbain"  onchange="AfficheCapt()">  Salle de bain
         </li>

         <li>
           <input type="radio" name="Sélection" value="Salon" class="Selec" id="salon"  onchange="AfficheCapt()"> Salon 
         </li>

         <li>
          <input type="radio" name="Sélection" value="Cave" class="Selec" id="cave"  onchange="AfficheCapt()"> Cave

        </li>

        <li>
         <p>
           <a href="ajouter une salle" class="ajout"> Ajouter une salle </a>
         </p>
       </li>

     </p>
   </ul>


 </li>

 <li class="menu habitation">
  <p> 
   <form method="post" action="traitement.php">
    <input type="button" value="Habitation ↓" class="bouton">
  </form>
</p>

<ul class="sous_menu_habitations">
  <li>

    <input type="radio" name="SélectionHabitation" value="Maison Principal" class="SelecHabitation" id="PrincipalRadio"   onchange="AfficheHab()" > Maison Principal

  </li>

  <li>
    <input type="radio" name="SélectionHabitation" value="Maison Secondaire" class="SelecHabitation"  id ="SecondaireRadio" onchange="AfficheHab()"> Maison Secondaire 
  </li>

  <li>
   <p>
     <a href="ajouter une habitation" class="ajout"> Ajouter une habitation </a>
   </p>
 </li>

</ul>
</form>
</nav>


<?php
if (isset($_SESSION['id']))
{
  $getid = intval($_SESSION['id']);
  $requser = $bdd -> prepare('SELECT * FROM personne WHERE id = ?');
  $requser -> execute(array($getid));
  $userinfo = $requser ->fetch();
  $valeurtemp = htmlspecialchars($_POST["temperature"]);
  $valeurlampe1 = htmlspecialchars($_POST["lampe1"]);
  $valeurlampe2 = htmlspecialchars($_POST["lampe2"]);
  $valeurvoletplus = htmlspecialchars($_POST["haut"]);
  $valeurvoletmoins = htmlspecialchars($_POST["bas"]);
  $valeurdetecteur2 = htmlspecialchars($_POST["detecteur1"]);
  $valeurhumidite = htmlspecialchars($_POST["eau"]);
  $valeurdetecteur2 = htmlspecialchars($_POST["detecteur2"]);
}
if (isset($_POST['valide'])){
  if (isset($_POST["lampe1"])){

    $insertval = $bdd -> prepare("UPDATE capteurpiece SET valeur=1 WHERE id_type=1");
    $insertval ->execute(array($valeurlampe1,$_SESSION['id']));
  }
  else
  {
    $insertval = $bdd -> prepare("UPDATE capteurpiece SET valeur=0 WHERE id_type=1");
    $insertval ->execute(array($valeurlampe1,$_SESSION['id']));
  }

}

?>

</div>

<div id="Centre">

  <fieldset id="setSalon">
    <legend> <h1 id="titreSet"></h1></legend>
    <div class=Salon>

      <form method="post" action traitement.php>

        <div class="FDP">

          <div class="capteur">

            <h3 class="titre"> Température </h3>

            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQunrWUy0VQcH_Knq_1O1G9aE9lGL_txsN1lfa83tJSn9nu1_BP" class="avatar_capteur">


            <input type="number" name="temperature" step="0.5" min="13" max="30" value="19">
          </div>

          <div class="capteur" id="capteurl1">

            <h3 class="titre"> Lampe 1 </h3>

            <img src="http://data-cache.abuledu.org/1024/ampoule-allumee-5435780b.jpg" class="avatar_capteur_lampe_allume" >
            <img src="https://image.freepik.com/icones-gratuites/symbole-d-39-ampoule-noire_318-60262.jpg" class="avatar_capteur_lampe_éteint">

            <input type="checkbox" name="lampe1" id="switch1" onchange="EteintAllume()">

            <span class="slider round"> </span>

          </div>

          <div class="capteur" id="capteurl2">

            <h3 class="titre"> Lampe 2 </h3>

            <img src="http://data-cache.abuledu.org/1024/ampoule-allumee-5435780b.jpg" class="avatar_capteur_lampe_allume">
            <img src="https://image.freepik.com/icones-gratuites/symbole-d-39-ampoule-noire_318-60262.jpg" class="avatar_capteur_lampe_éteint">

            <input type="checkbox" name="lampe2" id="switch2" onchange="EteintAllume()">

            <span class="slider round"> </span>

          </div>

          <div class="capteur">

            <h3 class="titre"> Volet </h3>

            <img src="https://previews.123rf.com/images/istinatali/istinatali1603/istinatali160300389/59700697-symbole-des-volets-vecteur-fen%C3%AAtre-d-illustration-.jpg" class="avatar_capteur">

            <input type="button" value="↑" name="haut" class="variable" id="monter" onclick="Hautbas()" >

            <input type="button" value="↓" name="bas" class="variable" id="baisser" onclick="Hautbas()">

          </div>

        </div>

        <div class="FDP">


          <div class="capteur">

            <h3 class="titre"> Détecteur 1 </h3>

            <img src="https://cdn3.domomat.com/16028-large_default/detecteur-de-mouvement-luxomat-lc-click-n-200-blanc.jpg" class="avatar_capteur">

            <input type="checkbox" name="detecteur1" class="switch">

            <span class="slider round"> </span>
          </div>

          <div class="capteur">

            <h3 class="titre"> Humidité </h3>

            <img src="https://previews.123rf.com/images/barbaliss/barbaliss1501/barbaliss150100019/35670421-goutte-d-eau-symbole-avec-un-filet-de-d%C3%A9grad%C3%A9-illustration-vectorielle.jpg" class="avatar_capteur">

            <div class="range">
              <input type="range" name="eau" min="0" max="100" step="1" class="curseur" list="tickmarks">
            </div>
            <datalist id="tickmarks">
              <option value="0" label="0%">
                <option value="10">
                  <option value="20">
                    <option value="30">
                      <option value="40">
                        <option value="50" label="50%">
                          <option value="60">
                            <option value="70">
                              <option value="80">
                                <option value="90">
                                  <option value="100" label="100%">
                                  </datalist>

                                </div>


                                <div class="capteur" id="capteurd2">

                                  <h3 class="titre"> Détecteur 2 </h3>

                                  <img src="https://cdn3.domomat.com/16028-large_default/detecteur-de-mouvement-luxomat-lc-click-n-200-blanc.jpg" class="avatar_capteur">

                                  <input type="checkbox" name="detecteur2" class="switch">

                                  <span class="slider round"> </span>
                                </div>


                                <div class="capteur" id="capteurm">

                                  <h3 class="titre"> Mouvement </h3>

                                  <img src="http://www.lucid.fr/files/documents/tech/detection2.jpg" class="avatar_capteur"">

                                  <input type="checkbox" name="mouvement" class="switch">

                                  <span class="slider round"> </span>
                                </div>

                              </div>
                                <input type="submit"  class="boutton "name="valide" value="Valider"  />


                              <a href="ajouter des capteurs" class="ajout"> Ajouter des capteurs </a>

                            </form>
                          </div>

                        </div>

                      </fieldset>


                      <?php 

                      include "footer.php";

                      ?>



                    </body>
                    </html>

