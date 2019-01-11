<style type="text/css">
 @import url(https://fonts.googleapis.com/css?family=Raleway:400,500);
a.snip0072 {
 border: none;
  background-color: #000000;
  border-radius: 5px;
  color: rgba(255, 255, 255, 0.7);
  cursor: pointer;
  padding: 20px 20px;
  display: inline-block;
  margin: 15px 35px;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-weight: 500;
  font-size: 1em;
  outline: none;
  position: relative;
  overflow: hidden;
  text-decoration: none;
}

a.snip0072:before {
  border-radius: 3px;
  content: '';
  display: block;
  position: absolute;
  left: 10px;
  right: 10px;
  top: 50%;
  bottom: 50%;
  background-color: #ffffff;
  border-top: 2px solid rgba(255, 255, 255, 0.8);
  border-bottom: 2px solid rgba(255, 255, 255, 0.8);
  opacity: 0;
  -webkit-transition: all 0.3s;
  transition: all 0.3s;
  -webkit-transition-delay: 0.3s;
  transition-delay: 0.3s;
}

a.snip0072:hover,
a.snip0072.hover {
  color: #ffffff;
  -webkit-animation: flashText 0.5s;
  animation: flashText 0.5s;
}

a.snip0072:hover:before,a.snip0072.hover:before {
  top: 15%;
  bottom: 15%;
  background-color: rgba(255, 255, 255, 0.1);
  opacity: 0.8;
}

a.snip0072:active:before {
  background-color: rgba(255, 255, 255, 0.3);
  opacity: 1;
  -webkit-transition-delay: 0s;
  transition-delay: 0s;
}
a.snip0072.blue {
  background-color: #1e5d87;
}

a.snip0072.green {
  background-color: #787746
}

a.snip0072.red {
  background-color: #8e2a20;
}
a.snip0072.yellow {
  background-color: #b66015;
}

@-webkit-keyframes flashText {
  0% {
    color: rgba(255, 255, 255, 0.5);
  }
  50% {
    color: transparent;
  }
  100% {
    color: #fff;
  }
}

@keyframes flashText {
  0% {
    color: rgba(255, 255, 255, 0.5);
  }
  50% {
    color: transparent;
  }
  100% {
    color: #fff;
  }
}

#contents {
  margin-top: 20em;
  background-color: rgba(255,255,255,0.2);

}
#contents a {

    left : 5%;

}



</style>
<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','',array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

include "verifadmin.php";
?>


<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
  <title>Admin</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="administrateur.css" /> 
   
</head>
<body >
 <div class="snip1231">
 <a  class="current" href="deconnexion.php">Déconnexion</a>
    </div>


  <div id="contents">

  <a class="snip0072" href="administrateur_afficherclient.php?id_admin=<?= $getidadmin ?>">Afficher les clients </a>
 <a class="snip0072 blue"href="administrateur_nouscontacter.php?id_admin=<?= $getidadmin?>"> Messages reçus</a>
 <a class="snip0072 red"href="administrateur_affichercatalogue.php?id_admin=<?= $getidadmin?>"> Modifier le catalogue</a>
 <a class="snip0072 yellow"href="administrateur_modifierapropos.php?id_admin=<?= $getidadmin?>"> Modifier "à propos"</a>
</div>
</body>


