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
                  if ($mailexist