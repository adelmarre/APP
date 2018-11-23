<?php
if(isset($_POST['mailform']))

$header="MIME-Version: 1.0\r\n";
$header.='From:"Hexagon.com"<projet.hexagon@gmail.com>'."\n";
$header.='Content-Type:text/html; charset="utf-8"'."\n";
$header.='Content-Transfer-Encoding: 8bit';

$message='
<html>
	<body>
		<div align="center">
			
			<br />
			J\'ai envoyé ce mail avec PHP !
		
			
		</div>
	</body>
</html>
';

mail("projet.hexagon@gmail.com", "Confirmation de l'inscription", $message, $header);

?>
<form method="POST" action="">
	<input type="text" name="nom" placeholder="Votre nom"><br /><br />
	<input type="email" name="mail" placeholder="Votre email"><br /><br />
	<textarea name="message" placeholder="Votre message"></textarea><br /><br />
	<input type="submit" value="Recevoir un mail !" name="mailform"/>
</form>