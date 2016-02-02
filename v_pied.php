	<footer id="footer" role="contentinfo" class="line ptm txtcenter">
		
		<?php  
			if (Session::isLogged()) {
				if ($_REQUEST['uc']!='rec') 
					echo "<a href='index.php?uc=rec'><big><big>Retourner au récapitulatif</big></big></a> - ";
				echo "<a href='logout.php'>Déconnexion</a> <br />\n";
				if (strcmp($_SESSION['username'],"équipe1")==0) {
					echo "<p class='line pts'>\n";
					echo "<a href='index.php?uc=erase'> Effacer les indices pour retester</a>\n</p>";
				}	
			} 
		?>
		Association Avalon - Périjeux 2015
		
	</footer>

</body>
</html>
