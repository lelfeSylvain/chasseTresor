<div id="main" role="main" class="line ptl">
	
	<p >Bonjour <?php print $_SESSION['username']; ?>, bienvenue. Voici les indices que vous avez récoltés jusqu'à présent :</p>
	<nav id="navigation" role="navigation">
		<ul class="ptm">
			<?php
				foreach($lesIndices as $unIndice){
					echo '<li class="pam inbl"><a href="'.$baseChemin."ind".$unIndice['code'].'">'.$unIndice['description'];
					if ($unIndice['mot']!="") { 
						echo " (<b>". $unIndice['mot']."</b>)";
					}
					echo "</a></li> \n ";
				}
			?>

		</ul>
	</nav>
</div>
