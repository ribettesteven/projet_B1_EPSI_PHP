<?php
	function login(){
		require('connect.php');
		session_start();
		$MesErreur = "";
		$status = 0;
		
		
		if(isset($_POST['logout']))
			$logout = "true";
		else
			$logout = "false";
		
		
		if(!(isset($_SESSION['login'])) && count($_POST) == 0)
		{
			$status = 0;
			$_SESSION['on'] ="false";
		}
		else if(!(isset($_SESSION['login'])) && isset($_POST['login']))
		{
			$Resul = mysqli_query($db, 'SELECT * FROM compte');
			while($Row=mysqli_fetch_array($Resul)){
				if($Row[1] == $_POST['identifiant'] && $Row[2] == sha1($_POST['password'])){
					$_SESSION['login'] = $Row[0];
					print('<meta http-equiv="refresh" content="0;URL=index.php">');
				}
			}
		}
		else if($logout == "true"){
			$_SESSION = array();
			session_destroy(); 
		}
		else if(isset($_SESSION['login']))
		{
			$status = 1;
			$resultat = mysqli_query($db, 'SELECT * FROM compte WHERE cmp_id="'. $_SESSION['login'].'"');
			while($Row=mysqli_fetch_array($resultat)){
				$Nom = $Row[1];
				$_SESSION['Level'] = $Row['cmp_level'];
			}
		}
		print('<div id="login" >');
			if($status == 0){
				print('<form method="POST" >');
					print('<input type="hidden" name="login" value="true" />');
					print('<h4>Identifiant :<input type="text" name="identifiant" /></h4>');
					print('<h4>Mot de passe :<input type="password" name="password" /></h4>');
					print('<input type="submit" value="Se connecter" />');
					print('<h4>'.$MesErreur.'</h4>');
				print('</form>');
				
			}
			else if($status == 1)
			{
				print('<div id="loginOn" >');
					print('<h4>Bonjours '.$Nom .'</h4>');
					print('<a href="moncompte.php" >Mon Compte</a><br/>');
					if($_SESSION['Level'] == 4){
						print('<a href="administration.php" >Administration</a>');
					print('<a href="compte.php" >Compte</a>');}
					else
						print('<br />');
					
					
					print('<form method="POST" >');
						print('<input type="hidden" name="logout" value="true" />');
						print('<input type="submit" value="Déconnecter" />');
					print('</form>');
				print('</div>');
			}
		print('</div>');
	}
?>