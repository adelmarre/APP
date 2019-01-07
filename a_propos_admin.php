<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');
$requser = $bdd -> prepare('SELECT * FROM A_propos');
$requser ->execute();
$donnees = $requser ->fetch();
    if (isset($_POST['modifier']) AND !empty($_POST['newdescription']) AND $_POST['newdescription']!=$donnees['description']) {
        $newdescription = htmlspecialchars($_POST['newdescription']);
        $insertdescription = $bdd -> prepare("UPDATE A_propos SET description=?");
        $insertdescription ->execute(array($newdescription));
        echo 'modification enregistrée';
    }
       else
    {
    	echo 'aucune modification effectuée';
    }
 
?>

<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
  <title>Admin</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="a_propos_admin.css" /> 
   
</head>
<body>

	<div class="snip1231">
		<a  class="current" href="deconnexion.php">Déconnexion</a>
		</div> 
<div id="content">

  <fieldset id="set">
    <form method="POST" action="">
            <table>
               <tr>
                  <td align="right">
                     <label for="description">Description :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="description" id="description" name="newdescription" value="<?php echo $donnees['description'] ?>" >
                  </td>
                  <input name='modifier'type='submit' value='Modifier'>
</tr>
</table>
</form>
 

 </div>  
    </fieldset>               
</body> 