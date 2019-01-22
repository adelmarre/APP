<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');
if (isset($_POST['suivant']))
{
  $nom = htmlspecialchars($_POST['nom']);
  $prenom = htmlspecialchars($_POST['prenom']);
  $mail = ($_POST['mail']);
  $numero = ($_POST['numero']);
  $motdepasse = sha1($_POST['motdepasse']);
  $motdepasse2 = sha1($_POST['motdepasse2']);
  $adresse =  htmlspecialchars($_POST['adresse']);
  $cp =  ($_POST['cp']);
  $ville = htmlspecialchars($_POST['ville']);
  $pays = htmlspecialchars($_POST['pays']);
  $type=htmlspecialchars($_POST['type_habitation']);
  $nomhabitation=htmlspecialchars($_POST['nomhabitation']);
  
  if (!empty($_POST['nom'])AND !empty($_POST['prenom'])AND!empty($_POST['mail'])AND!empty($_POST['motdepasse'])AND !empty($_POST['adresse'])AND!empty($_POST['cp'])AND !empty($_POST['ville'])AND!empty($_POST['pays'])AND !empty($_POST['type_habitation'])AND!empty($_POST['nomhabitation']))
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
          if ($motdepasse==$motdepasse2)
          { 
            if (strlen($_POST['motdepasse']) >=10)
            {
              if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $_POST['motdepasse'])) 
              {
                if (filter_var($mail,FILTER_VALIDATE_EMAIL)) 
                {
                  $reqmail = $bdd->prepare("SELECT * FROM personne WHERE mail = ?");
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


                        $insertmbr = $bdd->prepare("INSERT INTO personne(nom, prenom, mail, mdp, numero, confirmkey) VALUES(?, ?, ?, ?, ?, ?)");
                        $successInsertMBR = $insertmbr->execute(array($nom, $prenom, $mail, $motdepasse, $numero, $key));
                        
                        


                        $requser = $bdd -> prepare("SELECT * FROM personne WHERE mail = ? ");
                        $requser -> execute(array($mail));
                        $userinfo = $requser -> fetch();
                        $_SESSION['id'] = $userinfo['id'];
                        $_SESSION['nom'] = $userinfo['nom'];
                        $_SESSION['prenom'] = $userinfo ['prenom'];
                        $_SESSION['mail'] = $userinfo ['mail'];


                        $id_pers = $bdd -> query('SELECT id FROM personne WHERE id_type="1"'); // sert à quoi?
                        $insertmbr2 =  $bdd->prepare("INSERT INTO habitation(adresse, cp, ville, pays, type, id_personne, nomhabitation) VALUES(?, ?, ?, ?, ?, ?, ?)");
                        $insertmbr2->execute(array($adresse, $cp, $ville, $pays, $type, $userinfo['id'],$nomhabitation));



                                        //header("Location: salon.php?id=".$_SESSION['id']);
                        $header="MIME-Version: 1.0\r\n";
                        $header.='From:"Hexagon.com"<projet@gmail.com>'."\n";
                        $header.='Content-Type:text/html; charset="utf-8"'."\n";
                        $header.='Content-Transfer-Encoding: 8bit';
                        $message='
                        <html>
                        <body>
                        <div align="center">
                        Bonjour ,
                        par mesure de sécurité vous devez confirmer votre inscription en cliquant sur ce lien: 
                        <a href="http://127.0.0.1/Hexagon/confirmation.php?mail='.urlencode($mail).'&key='.$key.'">Confirmez votre compte !</a>




                        </div>
                        </body>
                        </html>
                        ';
                        mail($mail, "Confirmation de l'inscription", $message, $header);
                        header("Location: index.php");


                        }  
                        else {
                          $erreur = "Vous n'avez pas accepté les conditions générales d'utilisation, inscription impossible";
                        }
                      }
                      
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
                  $erreur = "Votre mot de passe doit au moins contenir une majuscule, une minuscule, un caractère spécial et un chiffre";
                }
              }
              else 
              {
                $erreur = "Votre mot de passe doit avoir plus de 10 caractères";
              }
            }
            else 
            {
              $erreur = "Vous n'avez pas saisi les mêmes mot de passe";
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
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="inscription.css" />
    <title>S'inscrire</title>
  </head>

  <img src="image/logo hexagon.png" alt="photo de hexagon" id="hexagon">

  <body>

    <h1>Formulaire d'inscription</h1>
    
    <form method="post">

    <div id="erreur">
      <?php
      if (isset($erreur)) 
      { 
        echo '<font color="red">'.$erreur."<br></font> ";
      }
      ?>
    </div>


      <label for="nom">Nom :

        <input type="text" id="nom" name="nom" placeholder="Ex: Dupont" value="<?php if(isset($_POST['nom'])) {echo $nom;} ?>"  minlength="3" maxlenght="255" required>

        <ul class="requiert">
          <li>Votre nom doit faire plus de 3 charactères (et moins de 255).</li>
          <li>Votre nom ne doit pas contenir de charactères spéciaux ( ! , @ , _ )</li>
        </ul>

      </label>


      
      <label for="prenom">Prénom :

        <input type="text" id="prenom" name="prenom" placeholder="Ex: Jean"  value="<?php if(isset($_POST['prenom'])) {echo $prenom;} ?>" minlength="3" maxlenght="255" required>

        <ul class="requiert">
          <li>Votre prénom doit faire plus de 3 charactères (et moins de 255).</li>
          <li>Votre prénom ne doit pas contenir de charactères spéciaux ( ! , @ , _ )</li>
        </ul>

      </label>


      
      <label for="mail">Courriel :

        <input type="text" id="mail" name="mail" placeholder="Ex: hexagon@gmail.com" value="<?php if(isset($_POST['mail'])) {echo $mail;} ?>" required>

        <ul class="requiert">
          <li>Votre mail doit être valide</li>
        </ul>

      </label>


      
      <label for="motdepasse">Définir son mot de passe :

        <input type="password" id="motdepasse" name="motdepasse" minlength="10" required>

        <ul class="requiert">
          <li>Votre mot de passe doit faire au moins 10 charactères.</li>
          <li>Votre mot de passe doit contenir au moins un chiffre (0-9).</li>
          <li>Votre mot de passe doit contenir au moins une minuscule.</li>
          <li>Votre mot de passe doit contenir au moins une majuscule.</li>
          <li>Votre mot de passe doit contenir au moins un charactère spécial.</li>
        </ul>

      </label>


      
      <label for="motdepasse2">Confirmer son mot de passe :

        <input type="password" id="motdepasse2" name="motdepasse2" required>

      </label>


      
      <label for="adresse">Adresse :

        <input type="text" id="adresse" name="adresse" placeholder="Ex: 10 rue de Vanves"  value="<?php if(isset($_POST['adresse'])) {echo $adresse;} ?>"required>

      </label>



      <label for="cp">Code Postal :

        <input type="text" id="cp" name="cp" placeholder="Ex: 75006"  value="<?php if(isset($_POST['cp'])) {echo $cp;} ?>" required>


      </label>


      
      <label for="ville">Ville :
        <input type="text" id="ville" name="ville" placeholder="Ex: Paris" name="user_ville"  value="<?php if(isset($_POST['ville'])) {echo $ville;} ?>" required >

      </label>


      <label for="pays">Pays :
        <select value="<?php if(isset($_POST['pays'])) {echo $pays;} ?>" name='pays' required>

          <option value="Albanie">Albanie </option>
          <option value="Algerie">Algerie </option>
          <option value="Allemagne">Allemagne </option>
          <option value="Belgique">Belgique </option>
          <option value="Canada">Canada </option>
          <option value="Croatie">Croatie </option>
          <option value="Espagne">Espagne </option>
          <option value="France">France </option>
          <option value="Italie">Italie </option>
          <option value="Luxembourg">Luxembourg </option>
          <option value="Royaume_Uni">Royaume Uni </option>
          <option value="Suisse">Suisse </option>
</select>

      </label>

      <label for="type_habitation">Type d'habitation :

        <select value="<?php if(isset($_POST['type_habitation'])) {echo $type;} ?>" name="type_habitation" required>type_habitation
       
          <option value="Principale">Principale</option>
          <option value="Secondaire">Secondaire</option>
        </select>

      </label>

      <label for="nomhabitation">Nom de l'habitation:
      <input type="text" id="nomhabitation" name="nomhabitation"  value="<?php if(isset($_POST['nomhabitation'])) {echo $nomhabitation;} ?>" required>
    </label>



        <label for="numero">Numéro de téléphone :
        <input type="tel" id="numero" placeholder="Ex: 0627xxxxxx" name="numero"  value="<?php if(isset($_POST['numero'])) {echo $numero;} ?>" required>
     
      <ul class="requiert">
          <li>Cette entrée ne peut contenir que des chiffres</li>
        </ul>
      </label>

      <div id="CUG">
        <p><input type="checkbox" name="choix" required="Il faut vérifier cette condition."> J'ai lu et j'accepte les conditions générales d'utilisation <a href="conditions.php" onclick="window.open(this.href);return false;" > Conditions d'utilisation </a></p>
      </div>


      <div class="button">
        <button type="submit" name="suivant" >Je m'inscris</button>
      </br> </br>
      
    </div>
  </form>

<script src="inscription.js"></script>
</body>
</html>