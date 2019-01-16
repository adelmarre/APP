<?php
session_start();
 
$bdd = new PDO('mysql:host=localhost;dbname=hexagon;charset=utf8', 'root', '',array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

?>

<html>
  	<head>
  		<meta charset="utf-8"/>
  		<title>Aide</title>
  		<link rel="stylesheet" href="faq.css">
   	 	<link rel="stylesheet" type="text/css" href="general.css">
   		 <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
	</head>


<?php if (isset($_SESSION['id'])) {
  include "header_deco.php"; }
  else {
    include "header_connexion.php";
  }
?>

	<body>
		<h1>Questions les plus consultées</h1>
		<div class="banniere">
        <img src="image_faq.jpg" alt="image_faq" id="image_faq" width="auto" height="250">
   		</div>

		<div class="question_reponse">
		<?php
		$sql = "SELECT * FROM  'aide' ";
		$reponse = $bdd->query('SELECT * FROM aide');
		while ($donnees = $reponse->fetch())
		{
			?>
			
			<div class="question">
				<h2><p><?php echo $donnees['question']; ?></p></h2>
			

				<p> <?php echo $donnees['reponse'] ; ?> </p>
			</div>
			
		<?php
		}
		?>
	</div>
	</body>

