	<?php session_start(); include "menu.php" ?>	
<?php

if (isset($_POST['reference'])) {
	$reference=$_POST['reference'];
	$resultat1 = $bdd -> prepare('SELECT * FROM catalogue WHERE reference = ?');
	$resultat1 -> execute(array($reference));
	$capteur = $resultat1 -> fetch(); 
	$id = $capteur['id_capteur'];
	$type=$capteur['id_type'];
	$insertcapteur = $bdd->prepare("INSERT INTO capteurpiece(id_capteur_catalogue,id_piece,id_type) VALUES(?,?,?)");
	$insertcapteur-> execute(array($id,$_GET['id_piece'],$type));
	if ($type==2) {
		$insertcapteur = $bdd->prepare("INSERT INTO capteurpiece(id_capteur_catalogue,id_piece,id_type) VALUES(?,?,?)");
		$insertcapteur-> execute(array($id,$_GET['id_piece'],6));
	}
	header("Location: maisonsallecapteur.php?id=".$_SESSION['id']);
}
?>
<head>
	  <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
	<meta charset="UTF-8" />
	<title>Ajouter un capteur</title>
	<link rel="stylesheet" type="text/css" href="sallestyle.css" /> 
	<link rel="stylesheet" type="text/css" href="general.css" /> 
</head>
        <script>
            function showUser(str)
            {
                if (str == "")
                {
                    document.getElementById("txtHint").innerHTML = "";
                    return;
                }
                if (window.XMLHttpRequest) {
                    xmlhttp= new XMLHttpRequest();
                } else {
                    if (window.ActiveXObject)
                        try {
                            xmlhttp= new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            try {
                                xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
                            } catch (e) {
                                return NULL;
                            }
                        }
                }

                xmlhttp.onreadystatechange = function ()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "getcapteur.php?q=" + str, true);
                xmlhttp.send();
            }
        </script>
<?php $type= $bdd -> query('SELECT DISTINCT nom_type_capteur,id_type_capteur FROM catalogue JOIN type_capteur ON catalogue.id_type=type_capteur.id_type_capteur');
$g = $_GET['id_habitation'];
$gg =$_GET['id_piece'];
$reqhab = $bdd -> prepare('SELECT * FROM piece WHERE (id_habitation=?) AND (id_piece=?)');
$reqhab -> execute(array($g,$gg));
$hab =$reqhab ->fetch();


?>

<body>

<div id="Centre">
			<fieldset>
				
			<legend><h1>Ajouter un capteur</h1></legend>

					<h3>Pièce :</h3>
						<p><?php echo $hab['nom']?></p>

						<h3>Capteur:</h3>

							<FORM>
							<SELECT name="fonctionnalite" size="1" onchange="showUser(this.value)" >
								<option value=""> Choisir :</option>
								<?php 
								while($donnees=$type->fetch()) 
								{
								?>
									<option value ="<?php echo $donnees['id_type_capteur']; ?>"><?php echo $donnees['nom_type_capteur']; ?></option>
							    <?php
							    
							        }
							    ?>

							</SELECT> 	
					
						
					
					</form>
					  <div id="txtHint"><b>Les références des capteurs seront notés ici.</b></div>

</div>
    <?php 

                      include "footer.php";

                      ?>
</body>
