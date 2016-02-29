<!DOCTYPE html>
<html>
	<?php
		$dbcom = mysqli_connect('localhost', 'root', '5603F84c33');
		mysqli_select_db($dbcom, 'sitephp');
	?>
    <head>
        <meta charset="utf-8" />
        <title>Shiro</title>
		<link href="cssphp.css" rel="stylesheet" type="text/css">
    </head>
    <body>	
		<div id="centre">
			<div id="bande">
				<img id="logo" src="images/logo.png"/>
				<p id="slogan"> Cloze un jour, Cloze toujours !</p>
			</div>
			<table id="barre" cellspacing="0" cellpadding="0" border="0">
				<tr><td ><a href="index.php"><p> Accueil </p></a></td>
					<td ><a href="liste.php"><p> Liste </p></a></td>
					<td ><a href="contact.php"><p> Contact </p></a></td></tr>
			</table>
			<h3 id="h3contact">Contact</h3>
			<div id="contact">
				<form method="post">
					<p> Votre nom : <input type="text" name="nomc"/> </p>
					<p> Votre Prénom : <input type="text" name="prenomc"/> </p>
					<p> Email : <input type="text" name="emailc" size="30"/></p>
					<p> Message : <textarea name="messagec"></textarea> </p>
					<input id="boutonenvoyer" type="submit" name="contactenvoyer" value="Envoyer"/>
				</form>
				<?php 

					if(isset($_POST['contactenvoyer']))
					{	
						$destinataire = 'quentinjost@hotmail.com';
						$expediteur = 'sitephpepsi@gmail.com';
						$objet = 'Message de contact du site !';
						$headers  = 'MIME-Version: 1.0' . "\n";
						$headers .= 'Reply-To: '.$expediteur."\n";
						$headers .= 'From: '. $_POST['nomc'] .'<'.$expediteur.'>'."\n";
						$headers .= 'Delivered-to: '.$destinataire."\n";
						$message = "'". $_POST['nomc'] ."' ' ' '". $_POST['prenomc'] ."' '\n' '". $_POST['emailc']."' '\n' '". $_POST['messagec']."'";
						if (mail($destinataire, $objet, $message, $headers))
						{
							echo "<script> alert('Message envoyé !');</script>";
						}
						else
						{
							echo "<script> alert('Votre message n'a pas pu être envoyé !');</script>";
						}
						
						$message = $_POST ['messagec'];
						$email = $_POST ['emailc'];
						$nom = $_POST['nomc'];
						$prenom = $_POST['prenomc'];
						$contact = fopen('contact.txt', 'a');
						fwrite($contact, $nom);
						fwrite($contact, " ");
						fwrite($contact, $prenom);
						fwrite($contact, "\r\n");
						fwrite($contact, $email);
						fwrite($contact, "\r\n");
						fwrite($contact, $message);
						fwrite($contact, "\r\n");
						fwrite($contact, "\r\n");
						fclose ($contact);
					}
				?>
				<br></br>
			</div>
		<br></br>
		</div>		
    </body>
	<?php 
			mysqli_close($dbcom);
	?>
</html>