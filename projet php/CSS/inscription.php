<?php
	require('codehtml.php');
	require('connect.php');
	
	DebutPage();
	
	function champ(){print('<h4 style="color:red;">* : Champs obligatoire !');}
	
	function testchampinter() {
		if($_POST['interemail'] == "" || $_POST['interveremail'] == "" || $_POST['internom'] == "" || $_POST['interprenom'] == "" || $_POST['intertel'] == "" || $_POST['interfax'] == "")
			return false;
		else
			return true;
	}
	function testchamporg(){
		if($_POST['orgcd'] == "" || $_POST['orgemail'] == "" || $_POST['orgnom'] == "" || $_POST['orgtel'] == "" || $_POST['orgville'] == "" )
			return false;
		else
			return true;
	}
	
	
	
	
	print('<div id="inscription" >'); // id : #inscription dans le CSS
	session_start();
	if(count($_POST) == 0) //Choix type
	{
		print('<form method="POST">');
			print('<p> Choisir type : <select name="type">');
				print('<option value="1"> Intervenant </option>');
				print('<option value="2"> Organisme </option>');
			print('</select>');
			print('<input type="submit" value="Valider"></p>');
		print('</form>');
	}
	else if($_POST['type']==1) //Champs de saisie Intervenant
	{	
		retour();
		$Resul = mysqli_query($db, "SELECT * FROM domaine");
		$Resul2 = mysqli_query($db, "SELECT * FROM niveau");
		print('<br /><br />');
		champ();		
		print('<form method="POST">');
			print('<input type="hidden" name="type" value ="5">');
			print('<p>Nom* : <input type="text" name="internom"></p>');
			print('<p>Prénom* : <input type="text" name="interprenom"></p>');
			print('<p>Email* : <input type="text" name="interemail"></p>');
			print('<p>Confirmation Email* :<input type="text" name="interveremail"></p>');
			print('<p>Telephone* : <input type="text" name="intertel"></p>');
			print('<p>Fax* : <input type="text" name="interfax"></p>');
			print('<p>Domaine de Compétences* : ');
			
			print('<select name="iddom">');
				while($Row=mysqli_fetch_array($Resul))
				{
					print('<option value="'.$Row[0].'">'.$Row[1].'</option>');
				}
			print('</select>');
			print('<select name="idniv">');
				while($Row=mysqli_fetch_array($Resul2))
				{
					print('<option value="'.$Row[0].'">'.$Row[1].'</option>');
				}
			print('</select></p>');
			print('<input type="submit" value="Valider">');
		print('</form>');
	}
	else if($_POST['type']==2) //Champs de saisie Organisme
	{
		retour();
		print('<br /><br />');
		champ();
		print('<form method="POST">');
			print('<input type="hidden" name="type" value ="3">');
			print('<p>Nom Organisme*: <input type="text" name="orgnom"></p>');
			print('<p>Email* : <input type="text" name="orgemail"></p>');
			print('<p>Confirmation Email* :<input type="text" name="orgveremail"></p>');
			print('<p>Telephone* : <input type="text" name="orgtel"></p>');
			print('<p>Code Postal* : <input type="text" name="orgcd" ></p>');
			print('<p>Ville* : <input type="text" name="orgville"></p>');
			print('<p>Nombre de contact* : <input type="text" name="orgnbconctact" ></p>');
			print('<input type="submit" value="Valider">');
						
		print('</form>');
	}
	else if($_POST['type']==3) //Champs de saisie Contact
	{
		if($_POST['orgnbconctact'] >= 1 && testchamporg())
		{
			if($_POST['orgemail'] == $_POST['orgveremail']){
				$_SESSION['NomOrg'] = $_POST['orgnom'];
				$_SESSION['EmailOrg'] = $_POST['orgemail'];
				$_SESSION['Telephone'] = $_POST['orgtel'];
				$_SESSION['CD'] = $_POST['orgcd'];
				$_SESSION['Ville'] = $_POST['orgville'];
				$_SESSION['NbCon'] = $_POST['orgnbconctact'];
				
				print('<form method="POST">');
					print('<input type="hidden" name="type" value ="4">');
					for($i = 1; $i <= $_POST['orgnbconctact']; $i++){
						print('<br /><h1>Contact Numero : '. $i .'</h1>');
						print('<p>Nom* : <input type="text" name="contactnom'.$i.'"></p>');
						print('<p>Prénom* : <input type="text" name="contactprenom'.$i.'"></p>');
						print('<p>Email* : <input type="text" name="contactemail'.$i.'"></p>');
						print('<p>Telephone* : <input type="text" name="contacttel'.$i.'"></p>');
						
					}
					print('<input type="submit" value="Valider"> <br /><br >');
				print('</form>');
				}
		}
		else
		{
			print("<h1>Veuillez mettre au moin un contact et/ou vérifié l'adresse mail <h1>");
			
			retour();
		}
	}	
	else if($_POST['type']==4) // Inscription BD Organisme et contact
	{
		$sql ="INSERT INTO organisme SET org_nom='".$_SESSION['NomOrg']."', org_email='". $_SESSION['EmailOrg']."', org_telephone='".$_SESSION['Telephone']."', org_codepostal='".$_SESSION['CD']."', org_ville='". $_SESSION['Ville']."'";
		mysqli_query($db,$sql);
		$id = mysqli_query($db,'SELECT * FROM organisme WHERE org_nom="'.$_SESSION['NomOrg'].'"');
		if($Row=mysqli_fetch_array($id)){
			for($i = 1; $i <= $_SESSION['NbCon']; $i++){
				$sql2 ="INSERT INTO contact SET ctc_idorganisme='". $Row[0] ."' ,ctc_nom='". $_POST["contactnom".$i] ."', ctc_prenom='".$_POST["contactprenom".$i]."', ctc_email='".$_POST["contactemail".$i]."', ctc_telephone='".$_POST["contacttel".$i]."'";
				mysqli_query($db, $sql2);
			}
		}
		print('<h1>INSCRIPTION FAIT</h1>');
		retour();
	}
	else if($_POST['type']==5) //Inscription BD intervenant
	{
		if(testchampinter()){
			if($_POST['interemail']== $_POST['interveremail']){
					
					Print('<h1>Inscription réussie !</h1>');
									
					$sql = "INSERT INTO intervenant SET int_nom='". $_POST['internom'] ."', int_prenom='". $_POST['interprenom']."', int_email='".$_POST['interemail']."', int_telephone='". $_POST['intertel']."', int_fax='". $_POST['interfax']."'";
					mysqli_query($db, $sql);
					$id = mysqli_query($db,'SELECT * FROM intervenant WHERE int_nom="'.$_POST['internom'].'"');
					if($Row=mysqli_fetch_array($id)){
						$sql2 = "INSERT INTO estcompetent SET comp_iddomaine='". $_POST['iddom'] ."', comp_idniveau ='". $_POST['idniv'] ."', comp_idintervenant='".$Row[0]."'";
						mysqli_query($db, $sql2);
						
					}
					
			}	
			else if(!($_POST['interemail'] == $_POST['interveremail'])){
				Print("<h1>Veuillez vérifié l'email !</h1>");
				retour();
			}
		}
		else
		{
			print('<h4 style="color:red">Veuillez remplire les champs obligatoire !</h4>');
			retour();
		}
	}
	else //Erreur
	{
		print('<h1>ERROR 404</h1>');
		retour();
	}
	
	print('</div>');
	mysqli_close($db);
	FinPage();
?>