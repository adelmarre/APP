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
<head>
  <meta charset="UTF-8">
 </head>
  <?php include "header_none.php" ?>
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">


  <div id="colonnedroite">

    <div class="box_profil">

      <img src="image/profil.png" class="photo_profil">
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


          <?php echo '<a id="menu" href="editerprofil.php" class="box">Editer profil</a>'; ?>

          <img src="image/parametre.jpg"
          class="avatar_box">
        </p>
      </li>



      <li>
        <p>
          <?php echo '<a id="menu" href="faq.php" class="box">Aide</a>'; ?>

          <img src="image/question.png" class="avatar_box">
        </p>
      </li>
      <li> 
       <p> <?php echo '<a id="menu" href="apropos.php"  class="box">A propos</a>'; ?>

       <img src="image/information.jpg" class="avatar_box">
     </p>
   </li>
   <li> 
     <p> <?php echo '<a id="menu" href="consignes.php"  class="box">Consignes globales</a>'; ?>

      <img src="image/attention.jpg" class="avatar_box">
    </p>
  </li>
   <li> 
           <p> <?php echo '<a id="menu" href="pagecontact.php?langue=fr"  class="box">Nous contacter</a>'; ?>

            <img src="image/telephone.jpg" class="avatar_box">
          </p>
      </li>
  <li> 
   <p> <?php echo '<a id="menu" href="catalogue.php"  class="box">Catalogue</a>'; ?>


   <img src="image/catalogue.svg" class="avatar_box">
 </p>



</li>

  <li> 
<?php if (isset($_GET['id_habitation'])) {
  $id_habitation=intval($_GET['id_habitation']);
  echo '<a id="menu" href="maisonsallecapteur.php?id_habitation='.$id_habitation.'" class="box_rouge">Mes maisons</a>';
}
else { ?>
<p> <?php echo '<a id="menu" href="maisonsallecapteur.php" class="box_rouge">Mes maisons</a>'; ?> 
    
<?php } ?>

   </p>



 </li>

 <?php if (isset($_GET['id_habitation'])) {
            $id_habitation=intval($_GET['id_habitation']);
            $reqsecondairehab = $bdd->prepare("SELECT * FROM secondairehab WHERE id_secondaire = ?");
            $reqsecondairehab->execute(array($_SESSION['id']));
            $secondairehab = $reqsecondairehab->fetch();
            $secondaire = $reqsecondairehab->rowcount();
            if ($secondaire==0) {//verification est ce un utilisateur secondaire, ici non
?>
   <li> 

   <p> <?php echo '<a id="menu" href="gerermamaison.php?id_habitation='.$id_habitation.'" class="box_rouge">Gerer ma maison</a>'; ?> 
    


   </p>



 </li>

 <li> 

   <p> <?php echo '<a id="menu" href="Historique.php?id_habitation='.$id_habitation.'" class="box_rouge">Historique</a>'; ?> 
    


   </p>



 </li>

<?php }
} ?>

<li> 

 <p> <a href="deconnexion.php" id="menu" class="deconnexion" class="box_rouge">Déconnexion</a>


 </p>

</li>
</ul>
</nav>





</div>


</div>
