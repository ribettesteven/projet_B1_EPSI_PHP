<?php
	function DebutPage(){
		print('<!DOCTYPE html>');
		print('<html>');
		print('<head>');
			print('<meta charset="utf-8" />');
			print('<link href ="css.css" rel ="stylesheet" type="text/css"/>');
			print('<title>Comp-Fundation</title>');
		print('</head>');

		print('<body>');
			print('<header><div id="head"><img src="images/Logo.jpg"/></div></header>');
			print('<div id="tableau">');
				print('<ul>');
					print('<li><a href="index.php"> Accueil </a> </li>');
					
					print('<li><a href="inscription.php"> Inscription</a></li>');
					
					print('<li><a href=recherche.php> Recherche </a></li>');
					print('<li><a href=contact.php> Contact </a></li>');
				print('</ul>');
			print('</div>');
			print('<div id="centre">');
			
	}
	function FinPage(){
		
			print('</div>');
			print('<footer>');
			print('<div id=foot>copyright</div>');
			print('</footer>');
		print('</body>');
	print('</html>');
	}
	function retour(){
		print('<form method="POST">');
			print('<input type="submit" value="retour" />');
		print('</form>');
	}
?>