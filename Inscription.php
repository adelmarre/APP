<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre','root','');
if (isset($_POST['suivant']))
{
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $mail = ($_POST['mail']);
    $numero = ($_POST['numero']);
    $mdp = sha1($_POST['mdp']);
    $adresse =  htmlspecialchars($_POST['adresse']);
    $cp =  ($_POST['cp']);
    $ville = htmlspecialchars($_POST['ville']);
    $pays = htmlspecialchars($_POST['pays']);


    if (!empty($_POST['nom'])AND !empty($_POST['prenom'])AND!empty($_POST['mail'])AND!empty($_POST['mdp'])AND!empty($_POST['adresse'])AND!empty($_POST['cp'])AND!empty($_POST['ville'])AND!empty($_POST['pays'])) 
    {
        $nomlenght = strlen($nom);
        if ($nomlenght<= 255)
        {
            $prenomlenght = strlen($prenom);
            if ($prenomlenght<= 255)
            {
                $maillenght = strlen($mail);
              if ($maillenght<= 255)
          {
                      if (filter_var($mail,FILTER_VALIDATE_EMAIL)) 
                      {
                          $reqmail = $bdd->prepare("SELECT * FROM membres WHERE mail = ?");
                          $reqmail->execute(array($mail));
                          $mailexist = $reqmail->rowCount();
                          if ($mailexist==0) 
                          {
                            $longueurKey=15;
                            $key="";
                            for ($i=1;$i<$longueurKey;$i++){
                              $key.=mt_rand(0,9);
                            }
                             if (isset($_POST['choix']))
                                {
                             
                                      $insertmbr = $bdd->prepare("INSERT INTO membres(nom, prenom, mail, mdp, numero,confirmkey) VALUES(?, ?, ?, ?, ?, ?)");
                                      $insertmbr->execute(array($nom, $prenom, $mail, $mdp, $numero,$key));
                                      $insertmbr2 =  $bdd->prepare("INSERT INTO habitation(adresse, cp, ville, pays) VALUES(?, ?, ?, ?)");
                                      $insertmbr2->execute(array($adresse, $cp, $ville, $pays));
                                      $header="MIME-Version: 1.0\r\n";
                                      $header.='From:"Hexagon.com"<projet.hexagon@gmail.com>'."\n";
                                      $header.='Content-Type:text/html; charset="utf-8"'."\n";
                                      $header.='Content-Transfer-Encoding: 8bit';

                                      $message='
                                      <html>
                                        <body>
                                          <div align="center">
                                            <a href="http://127.0.0.1/Hexagon/confirmation.php?numero='.urlencode($numero).'&key'.$key.'">Confirmez votre compte !</a>
                                            
                                            
                                          
                                            
                                          </div>
                                        </body>
                                      </html>
                                      ';

                                      mail($mail, "Confirmation de l'inscription", $message, $header);
                                     

                                      $erreur = "Votre compte a bien été créé";

                                  } 
                                  else {
                                    $erreur = "Vous n'avez pas accepter les conditions générales d'utilisation, inscription impossible";
                                  }}
                            else
                            {
                                $erreur = "Votre email est déjà associé à un compte";
                            }
                        }
                        else
                        {
                            $erreur = "Email invalide";
                        }
                    }
                    else
                    {
                        $erreur = "Votre mail ne doit pas dépasser 255 caractères";
                    }          
                        
                }
                else
                {
                    $erreur = "votre prenom ne doit pas dépasser 255 caractères ";
                }
                    

            }
            else
            {
                $erreur = "Votre nom ne doit pas dépasser 255 caractères";
            }

          }
    else   
    {
        $erreur = "Tous les champs doivent être complétés.";
    }
}
 
?>
<html>
<head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="inscription.css" />
        <title>S'inscrire</title>
    </head>
<body><h1>Formulaire d'inscription</h1>
  <form method="post" action="">

     
    
  <div>
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" placeholder="Dupont"autofocus required>
  </div>

  <div>
    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" placeholder="Jean"required>
  </div>

  <div>
    <label for="mail">Courriel :</label>
    <input type="text" id="mail" name="mail" placeholder="hexagon@gmail.com" required>
  </div>
  <div>
    <label for="motdepasse">Définir son mot de passe :</label>
    <input type="password" id="mdp" name="mdp" required>
  </div>
  <div>
    <label for="adresse">Adresse :</label>
    <input type="text" id="adresse" name="adresse" placeholder="12 rue de Vanves"required>
  </div>
   <div>
    <label for="cp">Code Postal :</label>
    <input id="cp" name="cp" placeholder="75006" required>
  </div>
  <div>
    <label for="ville">Ville :</label>
    <input type="text" id="ville" name="ville" placeholder="Paris" name="user_ville"required >
  </div>
   <div>
    <label for="pays">Pays :</label>
    <input type="text" id="pays" name="pays" placeholder="France"required>
  </div>
   <div>
    <label for="numero">Numéro de téléphone :</label>
    <input type="tel" id="numero" placeholder="+336xxxxxxxxx" name="numero" required>
  </div>
 <p><h5><input type="checkbox" name="choix"> J'ai lu et j'accepte les conditions générales d'utilisation <a href="conditions.php" target="_blank"> Conditions d'utilisation </a></h5></p>

  <div class="button">
    <button type="submit" name="suivant" >Je m'inscris</button>
</br>
 <?php
            if (isset($erreur)) 
            { 
                echo '<font color="red">'.$erreur."</font>";
            }
            ?>
  </div>
</form>


</body>
</html>
<!--Confirmation par mail , 9.46 >