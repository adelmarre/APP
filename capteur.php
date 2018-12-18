
<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=hexagon','root','');
if (isset($_POST['reference'])) {
	$reference=$_POST['reference'];
	$resultat1 = $bdd -> prepare('SELECT * FROM catalogue WHERE reference = ?');
	$resultat1 -> execute(array($reference));
	$capteur = $resultat1 -> fetch(); 
	$id = $capteur['id_capteur'];
	$insertcapteur = $bdd->prepare("INSERT INTO capteurpiece(id_capteur_catalogue,id_piece) VALUES(?,?)");
	$insertcapteur-> execute(array($id,12));
	header('Location : index.php');
}
?>
<head>
	  <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
	<meta charset="UTF-8" />
	<title>Ajouter un capteur</title>
	<link rel="stylesheet" type="text/css" href="capteur.css" /> 
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

$req1= $bdd-> prepare('SELECT * FROM piece WHERE id_habitation = ?');

?>

<body>
		
			<fieldset>
				
			<legend><h2>Ajouter un capteur:</h2></legend>

	
					<h3>Maison:</h3>
						<p>Nom de la maison </p>

					<h3>Pièce :</h3>
						<p>nom de la pièce</p>

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



</body>
