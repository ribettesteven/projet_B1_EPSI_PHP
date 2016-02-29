<?php
	function DebutPage(){
		print('<!DOCTYPE html>');
		print('<html>');
		print('<head>');
			print('<meta charset="utf-8" />');
			print('<link rel = "stylesheet" href = "css.css" />');
			print('<title>Comp-Fundation</title>');
		print('</head>');

		print('<body>');
			print('<header><img src="logo.jpg"/></header>');
			print('<div id="tableau">');
				print('<ul>');
					print('<li><a href="index.php"> Accueil </a> </li>');
					
					print('<li><a href="inscription.php"> Inscription</a></li>');
					
					print('<li><a href=> Recherche </a></li>');
					print('<li><a href=> Contact </a></li>');
				print('</ul>');
			print('</div>');
			print('<div id="milieu">');
			
	}
	function FinPage(){
		
			print('</div>');
			print('<footer>copyright</footer>');
		print('</body>');
	print('</html>');
	}
	function retour(){
		print('<form method="POST">');
			print('<input type="submit" value="retour" />');
		print('</form>');
	}
?>