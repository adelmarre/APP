<style type="text/css">
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 10em; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.maReponse-content {
  background-color: #fefefe;
  margin: auto;
  padding: 1em;
  border: 1px solid #888;
  width: 20%;
}
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;}

}
.Titre{
  text-align: center;
}

</style>

<?php
include "verifadmin.php";

$mail = $bdd -> query('SELECT * FROM mailvisiteur');
$messageclient = $bdd -> query('SELECT * FROM messageclient');
?>        
<?php
   if(isset($_POST['mailform']))
        { if( !empty($_POST['message']) AND !empty($_POST['id_mailvisiteur'])) {
            $id_mailvisiteur = intval($_POST["id_mailvisiteur"]);
            $reqidexist = $bdd -> prepare('SELECT * FROM mailvisiteur WHERE id_mailvisiteur =  ? ');
            $reqidexist -> execute(array($id_mailvisiteur));
            $exist = $reqidexist ->rowCount();
            if ($exist!=0) 
            {
              $id_mailvisiteur = intval($_POST['id_mailvisiteur']);
              $requser = $bdd -> prepare('SELECT * FROM mailvisiteur WHERE id_mailvisiteur = ?');
              $requser -> execute(array($id_mailvisiteur));
              $visiteur = $requser ->fetch();
              $header="MIME-Version: 1.0\r\n";
              $header.='From:"Hexagon.com"<projet@gmail.com>'."\n";
              $header.='Content-Type:text/html; charset="uft-8"'."\n";
              $header.='Content-Transfer-Encoding: 8bit';

              $message='
              <html>
                <body>
                  <div align="center">
                    <br />
                    '.nl2br($_POST['message']).'
                    <br />
                  </div>
                </body>
              </html>
              ';

              mail($visiteur['mail'], "CONTACT - Hexagon.com", $message, $header);
            }
              else {$erreur = "Cet id utilisateur n'existe pas dans notre base de données";} 
          }

  

}   ?>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
  <title>Admin</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="administrateur.css" /> 
   
</head>
<div class="snip1231">
 <a  class="current" href="deconnexion.php">Déconnexion</a>

<a class="current" href="administrateur.php">Menu admin</a>    </div>
<body align="center">
  
<div id="content">
  
<button class="snip0050 yellow" id="monClick"><span>Répondre à un visiteur</span><i class="ion-compose"></i></button>
<?php if (isset($erreur)) {
    echo $erreur;
  }?>
<table border>
    <tr> <th> ID mail visiteur</th><th>Mail </th> <th> Nom</th><th> Prénom</th><th> Contenu</th><th>Date</th><th>Heure</th></tr>
    <tr>
    <?php

    while($m=$mail->fetch()) { 
    ?>
      <tr>
          <td><?= $m['id_mailvisiteur'] ?></td> <td> <?= $m['mail'] ?><td> <?= $m['nom'] ?> </td> <td> <?= $m['prenom'] ?></td><td>  <?= $m['contenu'] ?></td><td>  <?= $m['ladate'] ?> </td><td>  <?= $m['heure'] ?> </td>
   </tr>      <?php } ?>
  </table>
  <br/><br/><br/>
  <p align = "center">Tableau des messages clients</p> </br>
  
<table border>
    <tr> <th> ID client</th><th>Nom</th> <th> Prénom</th><th>Date</th><th>Heure</th><th> Répondre</th><th>Notifications</th></tr>
    <tr>
    <?php

    while($mes=$messageclient->fetch()) { 
      $reqmessage = $bdd -> query('SELECT * FROM message WHERE vu=0 AND id_destinataire="'.$mes['id_destinataire'].'"');
      $pasvuexist = $reqmessage ->rowCount();
      $reqmessage2 = $bdd -> query('SELECT * FROM messageclient WHERE vu=0 AND id_destinataire="'.$mes['id_destinataire'].'"');
      $pasvuexist2 = $reqmessage2 ->rowCount();
      $somme = $pasvuexist + $pasvuexist2;
    ?>
      <tr>
          <td><?= $mes['id_destinataire'] ?></td> <td> <?= $mes['Nom'] ?><td> <?= $mes['Prenom'] ?> </td><td>  <?= $mes['ladate'] ?> </td><td>  <?= $mes['heure'] ?> </td> <td><a href="chat.php?ide=<?= $getidadmin ?>&amp;idd=<?=$mes['id_destinataire']?>&amp;id=<?=$mes['id_destinataire']?>">Répondre à ce client</a> </td><td><?php if ($pasvuexist == 0 and $pasvuexist2==0) {echo"Ce client ne vous a pas envoyé de nouveau message";} else {echo "Vous avez $somme nouveau(x) message(s)";}
           
          ?></td>
   </tr>      <?php } ?>
</table>

</div>
 <div id="maReponse" class="modal">
  <div class="maReponse-content">
    <span class="close">&times;</span>
   <form method="POST">
    <label>ID du visiteur </label></br>
      <input type="text" name="id_mailvisiteur" required>
      
</br>
      <label>Ma réponse : </label></br>
      <textarea name="message" placeholder="message..." required><?php if(isset($_POST['message'])) { echo $_POST['message']; } ?></textarea><br /><br />
      <input type="submit" value="Envoyer !" name="mailform"/>
    </form>  
  </div>
  </div>

<script type="text/javascript">
var reponse = document.getElementById('maReponse');

// Get the button that opens the modal
var click = document.getElementById("monClick");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
click.onclick = function() {
  reponse.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  reponse.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == reponse) {
    reponse.style.display = "none";
  }
}

</script>
</body>
