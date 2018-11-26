<?php 

$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');
if (isset($_POST['suivant']))
{
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $mail = ($_POST['mail']);
    $numero = ($_POST['numero']);
    $mdp = sha1($_POST['mdp']);
     $mdp2 = sha1($_POST['mdp2']);
    $adresse =  htmlspecialchars($_POST['adresse']);
    $cp =  ($_POST['cp']);
    $ville = htmlspecialchars($_POST['ville']);
    $pays = htmlspecialchars($_POST['pays']);
    $type=htmlspecialchars($_POST['type_habitation']);


    if (!empty($_POST['nom'])AND !empty($_POST['prenom'])AND!empty($_POST['mail'])AND!empty($_POST['mdp'])AND!empty($_POST['adresse'])AND!empty($_POST['cp'])AND!empty($_POST['ville'])AND!empty($_POST['pays'])AND!empty($_POST['type_habitation'])) 
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
                    if ($mdp==$mdp2)
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

                                $key.=mt_rand(0,9); }
                             if (isset($_POST['choix']))
                                {
	                           
	                                    $insertmbr = $bdd->prepare("INSERT INTO personne(nom, prenom, mail, mdp, numero, confirmkey) VALUES(?, ?, ?, ?, ?, ?)");
	                                    $insertmbr->execute(array($nom, $prenom, $mail, $mdp, $numero, $key));
                                      
                                                                       
	                               

                                    $requser = $bdd -> prepare("SELECT * FROM personne WHERE mail = ? ");
                                    $requser -> execute(array($mail));
	                                  $userinfo = $requser -> fetch();
                                    $_SESSION['id'] = $userinfo['id'];
                                    $_SESSION['nom'] = $userinfo['nom'];
                                    $_SESSION['prenom'] = $userinfo ['prenom'];
                                    $_SESSION['mail'] = $userinfo ['mail'];
                                            
                                    $insertmbr2 =  $bdd->prepare("INSERT INTO habitation(adresse, cp, ville, pays, type, id_personne) VALUES(?, ?, ?, ?, ?,?)");
                                    $insertmbr2->execute(array($adresse, $cp, $ville, $pays, $type, $userinfo['id']));

                                          
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
                    else {
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
        <link rel="stylesheet" href="inscription.css" />
        <title>Sinscrire</title>
    </head>

<img src="logo hexagon final.png" alt="photo de hexagon" id="hexagon">
<body><h1>Formulaire d'inscription</h1>
    <form method="post" action="">

     
    
  <div>
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" placeholder="Dupont" value="<?php if(isset($nom[''])) {echo $nom;} ?>" autofocus required>
  </div>

  <div>
    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" placeholder="Jean"  value="<?php if(isset($prenom[''])) {echo $prenom;} ?>"required>
  </div>

  <div>
    <label for="mail">Courriel :</label>
    <input type="text" id="mail" name="mail" placeholder="hexagon@gmail.com" value="<?php if(isset($mail[''])) {echo $mail;} ?>" required>
  </div>
  <div>
    <label for="motdepasse">Définir son mot de passe :</label>
    <input type="password" id="mdp" name="mdp" required>
  </div>
  <div>
    <label for="motdepasse">Confirmer son mot de passe :</label>
    <input type="password" id="mdp" name="mdp2" required>
  </div>
  <div>
    <label for="adresse">Adresse :</label>
    <input type="text" id="adresse" name="adresse" placeholder="10 rue de Vanves"  value="<?php if(isset($adresse[''])) {echo $adresse;} ?>"required>
  </div>
   <div>
    <label for="cp">Code Postal :</label>
    <input id="cp" name="cp" placeholder="75006"  value="<?php if(isset($cp[''])) {echo $cp;} ?>" required>
  </div>
  <div>
    <label for="ville">Ville :</label>
    <input type="text" id="ville" name="ville" placeholder="Issy-les-Moulineaux" name="user_ville"  value="<?php if(isset($ville[''])) {echo $ville;} ?>" required >
  </div>
   <div>
    <label for="type_habitation">Type d'habitation :</label>
    <input type="text" id="type_habitation" name="type_habitation" placeholder="Principale"  value="<?php if(isset($type_habitation[''])) {echo $type_habitation;} ?>" required>
  </div>
  <div>
   <div>
    <label for="pays">Pays :</label>
    <input type="text" id="pays" name="pays" placeholder="France"  value="<?php if(isset($pays[''])) {echo $pays;} ?>"required>
  </div>
   <div>
    <label for="numero">Numéro de téléphone :</label>
    <input type="tel" id="numero" placeholder="+336xxxxxxxxx" name="numero"  value="<?php if(isset($numero[''])) {echo $numero;} ?>" required>
  </div>
 <p><input type="checkbox" name="choix"> J'ai lu et j'accepte les conditions générales d'utilisation <a href="conditions.php" onclick="window.open(this.href); return false;" > Conditions d'utilisation </a></p>

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