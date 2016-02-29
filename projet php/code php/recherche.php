<?php
	require('codehtml.php');
	require('connect.php');
	
	
		DebutPage();
		
		
		if(isset($_SESSION['logintype']) &&(!(isset($_POST['recherche']))))
		{
			if($_SESSION['logintype'] == 2)
			{
				print('<form method="post">');
				print('<p style="color:red"> Effectuez votre recherche ! </p>');
				print('<p style="color:red"> Domaine : <select name="domaine">
															<option value="01">nom1</option>
															<option value="02">nom2</option>
															<option value="03">nom3</option>
															<option value="04">nom4</option></select></p>');	
				print('<p style="color:red">Description : <textarea name="details"></textarea> </p>');
				print("<p style='color:red'>Date limite d'intervention : ");
					print('<select name="jours" >');				
						for ($j = 1; $j <= 9; $j++)
							echo '<option value="'.$j.'">0'.$j.'</option>';
						for ($j = 10; $j <= 31; $j++)
							echo '<option value="'.$j.'">'.$j.'</option>';
								
					print('</select>
							<select name="mois" >
								<option value="01">Janvier</option>
								<option value="02">Février</option>
								<option value="03">Mars</option>
								<option value="04">Avril</option>
								<option value="05">Mai</option>
								<option value="06">Juin</option>
								<option value="07">Juillet</option>
								<option value="08">Août</option>
								<option value="09">Septembre</option>
								<option value="10">Ocotbre</option>
								<option value="11">Novembre</option>
								<option value="12">Décembre</option>
							</select> 
								
							<select name="annees" >');
								for ($a = intval(date('Y')); $a >= 2016; $a--)
									echo '<option value="'.$a.'">'.$a.'</option>';
									
					print('</select></p>');
					
				print('<p style="color:red"> Nombre de jours <input type="text" name="nbrjours" maxlength="5" format="NNNNN"/></p>');
				
				print('<input button="submit" name="envoyer" value="Validez"/>');
				print('</form>');
				
				$returnListe = false;
				if(isset($_POST['envoyer'])
				{
					print('<table><tr><td><strong>Nom</strong></td><td><strong>Prénom</strong></td><td><strong>Email</strong></td><td><strong>Téléphone</strong></td></th>');
					$Resul = mysqli_query($dbcom,'SELECT int_nom, int_prenom, int_email, int_telephone FROM intervenant INNER JOIN estcompetent ON comp_idintervenant = int_id;');
					while($donnee = mysqli_fetch_array($Resul))
					{
						print('<tr><td>'.$donnee[1]).'</td><td>'.$donnee[2].'</td><td>'.$donnee[3].'</td><td>'.$donnee[4].'</td></th>');
					}
					print('</table>');
				}
				
			}	
					
		}
		if(isset($_SESSION['logintype']) &&(!(isset($_POST['recherche']))))
		{
			if ($_SESSION['logintype'] == 1)
			{
				
			}
		}
		
		FinPage ();
?>