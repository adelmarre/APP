<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hexagon";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (isset($_GET['q']))   {
$q = $_GET["q"];
$sql = "SELECT reference FROM catalogue WHERE id_type = '" . $q . "'";


$result = mysqli_query($conn, $sql);
}
?>
<head>
  <meta charset="UTF-8">
 </head>
						<h3>Référence :</h3>
						<form method="POST" action="">

							<SELECT name="reference" size="1" >
								<OPTION >
								<?php 
							
								while($donnees=mysqli_fetch_assoc($result) ) 
								{
								?>
									<option value ="<?=$donnees['reference']?>"><?=$donnees['reference']?></option>
							    <?php
							    
							        }
							    ?>

							</SELECT> 
			</br></br>
				<input type="submit" name="ajouter" id="ajouter" value="Ajouter le capteur">

				</FORM>	