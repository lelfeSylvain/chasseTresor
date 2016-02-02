<?php 
    include_once 'class.session.inc.php'; Session::init();
	include_once 'class.pdoperi.inc.php';
	include 'v_entete.php';
	include 'v_titre.php';
	function calc($mot){
		$nb=0;
		for($i=0;$i<strlen($mot);$i++){
			$l=substr($mot,$i,1);
			$l=(int)(ord($l)/2-48);
			if ($l>9 || $l<1) $l=0;
			
			$nb+=$l;
		}
		return $nb;
	}
	
    if (!Session::isLogged()) {
        header('Location: login.php?uc='.$_REQUEST['uc']);
    }
    // on est normalement connecté
    $baseChemin="index.php?uc=";
    // initialisation de la connexion à la BD
    $instancePdoPeri = PdoPeri::getPdoPeri();
    //s'il n'y a pas d'uc alors on affiche le récapitulatif des indices trouvés
    if(!isset($_REQUEST['uc'])){ 
     $_REQUEST['uc'] = 'rec';
	}
	$uc = $_REQUEST['uc'];
	$selon=substr($uc,0,3);
	switch($selon){
		case 'rec':{// uc des récapitulatifs des indices trouvés
			$lesIndices=$instancePdoPeri->getLesIndices($_SESSION['username']);
			include("v_recap.php");break;
		}
		case 'ind' :{// uc des indices 
			// TODO : puisqu'il n'y a qu'un seul indice par lieu, le lieu n'est pas important 
			// on considère pour le moment, que un lieu donne un indice numéroté.
			// par la suite, il faudra trouver dans la base le prochain indice disponible 
			// pour ce lieu pour cette équipe (table trouver pour compter le nombre de visite d'un lieu)
			$num=substr($uc,3); // cette ligne devra être remplacé dans la seconde version 
			
			$unIndice=$instancePdoPeri->getUnIndice($num);
			
			$instancePdoPeri->setCollecterUnIndice($_SESSION['username'],$unIndice[0]['num']);
			include("v_indices.php");	 
			break;
		}
		case 'era' :{
			$instancePdoPeri->effacerCollecter();
			header('Location: index.php');
			break;
		}
		case 'cal' :{
			//echo "calcul : ".substr($uc,3)." = ".calc(substr($uc,3));
			break;
		}
		default : include("v_erreur.php");	
}
include("v_pied.php") ;
?>




