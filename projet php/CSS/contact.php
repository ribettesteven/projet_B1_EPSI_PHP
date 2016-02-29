<?php
	require ('login.php');
	require('connect.php');
	require('codehtml.php');
	DebutPage();
			print('<p>Contact</p>');
			print('<p>');
			print('<form method="post">');
			print('Nom:');
			print('<input type="text" name="nomc" id="Nom" />');
			print('<br />');
			print('Mail:');
			print('<input type="email" name="emailc" id="email" />');
			print('<br />');
			print('<textarea name="messagec" rows="8" cols="45"></textarea>');
			print('<br />');
			print(' <p>');
			print('<button <input type ="submit" value ="envoyer" name="contactenvoyer" id="valider"/>valider</button>');
			print('</form>');
			print ('</p>');
					
					if(isset($_POST['contactenvoyer']))
					{	
						$destinataire = 'steven.r.japan@gmail.com';
						$expediteur = 'sitephpepsi@gmail.com';
						$objet = 'Message de contact du site !';
						$headers  = 'MIME-Version: 1.0' . "\n";
						$headers .= 'Reply-To: '.$expediteur."\n";
						$headers .= 'From: '. $_POST['nomc'] .'<'.$expediteur.'>'."\n";
						$headers .= 'Delivered-to: '.$destinataire."\n";
						$message = "'". $_POST['nomc'] ."' '\n' '". $_POST['emailc']."' '\n' '". $_POST['messagec']."'";
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
						$contact = fopen('contact.txt', 'a');
						fwrite($contact, $nom);
						fwrite($contact, " ");
						fwrite($contact, $email);
						fwrite($contact, "\r\n");
						fwrite($contact, $message);
						fwrite($contact, "\r\n");
						fwrite($contact, "\r\n");
						fclose ($contact);
					}
	FinPage();
?>