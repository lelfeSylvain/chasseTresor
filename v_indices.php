
<?php if ($unIndice[0]['mot']!="") { ?>
	<div id="main" role="main" class="line pts">	
			<p>Indice important : <b>Prenez-vous en photo devant l'affiche.</b></p>
		<?php
			echo "<p>Mot : <b>".$unIndice[0]['mot']."</b></p>";
		?>
	</div>
<?php } ?>
<div id="main" role="main" class="line pts">	
	<?php
		if ($unIndice[0]['nature']==1) {
			echo '<img src="'.$unIndice[0]['chemin'].'" class="aligncenter" alt="'.$unIndice[0]['alt'].'"/>'."\n";
		}
		elseif ($unIndice[0]['nature']==0) {
			include $unIndice[0]['chemin'];
		}
		elseif ($unIndice[0]['nature']==3) {//mp3
			echo "<audio src='".$unIndice[0]['chemin']."' controls preload='none'></audio>";
		}
		elseif ($unIndice[0]['nature']==4) {//pdf
			//echo '<iframe src="'.$unIndice[0]['chemin'].'" width="500px" height="450px" alt="'.$unIndice[0]['alt'].'"></iframe> '."\n";
			echo "<a href='".$unIndice[0]['chemin']."' target='blank'>Téléchargez l'indice en PDF</a>";
		}else echo "je ne sais pas.";
		echo "<p class='ptm'>source : <i>".$unIndice[0]['source']."</i></p>";
	?>
</div>

