 <?php 

try {
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','',array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
  if (isset($_SESSION['id']))
  {
    $getid = intval($_SESSION['id']);
    $requser = $bdd -> prepare('SELECT * FROM personne WHERE id = ?');
    $requser -> execute(array($getid));
    $userinfo = $requser ->fetch();

    
  }
  else {
    exit();
  }
}
catch(Exception $e){
  die('Erreur : ' . $e->getMessage());
}


?>
  <?php include "header_none.php" ?>
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">

  <div id="colonnedroite">

    <div class="box_profil">

      <img src="image/profil.jpg" class="photo_profil">
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

<p> <?php echo '<a href="maisonsallecapteurtempo.php?id='.$_SESSION['id'].'" class="box_rouge">Mes maisons</a>'; ?> 
    


   </p>



 </li>

 <?php if (isset($_GET['id_habitation'])) {?>
   <li> 

   <p> <?php echo '<a href="gerermamaison.php?id='.$_SESSION['id'].'&id_habitation='.$_GET['id_habitation'].'" class="box_rouge">Gerer ma maison</a>'; ?> 
    


   </p>



 </li>

<?php } ?>

<li> 

 <p> <a href="deconnexion.php" class="deconnexion" class="box_rouge">Déconnexion</a>


 </p>

</li>
</ul>
</nav>





</div>


</div>
