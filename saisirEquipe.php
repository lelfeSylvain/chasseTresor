<?php 
    include_once 'class.session.inc.php'; Session::init();
    include_once 'class.pdoperi.inc.php';    
	
	if ( isset($_REQUEST['uc']))
		$uc="?uc=".$_REQUEST['uc'];
	$instancePdoPeri = PdoPeri::getPdoPeri();
	$visiteur=$instancePdoPeri->getInfosVisiteur($_REQUEST['login']);
	//echo $visiteur["pseudo"]." - ".$visiteur["mdp"];
    if (isset($_REQUEST['login']) && isset($_REQUEST['reponse'])
		&& Session::login($_REQUEST['login'], $_REQUEST['reponse'], $visiteur["pseudo"], $visiteur["mdp"])) {
		$instancePdoPeri->setTSConnexion($visiteur["pseudo"]);	
       header('Location: index.php'.$uc);
    }
    include 'v_entete.php';
?>

  <script language="javascript" src="js/md5.js"></script>
<script language="javascript">
<!--
  function doChallengeResponse() {
    str = "*355"+document.identification.mot_de_passe.value;
    document.identification.reponse.value = MD5(str);
    document.identification.mot_de_passe.value = "";

  }
// -->
</script>
<?php include 'v_titre.php'; ?>
<div id="main" role="main" class="line pal">
	<?php
	$mot=array("asperge","chateau","puits", "cadeau", "parasol", "anglaise", "bizarre","tomate","ordinateur","potiron", "jardinage","voiture","haricot"
	,"rhubarbe","olive","caramel","potage","mouton", "romarin","marguerite", "radiateur","limace","guitare","olivier","seconde","information","invitation"
	,"majuscule","minuscule","dispositif","famille","assurance","retenue","festival","manifestation","tableau","usage","canard","mouette"
	,"financier","routard", "wagon","fouille","diplomate","disquette","support","concombre","suitcase","barbara","opidum","probable","lettre"
	,"entretien","velours","chauffeuse","maquette", "banquette", "ampoule","mazzanine","poivron","artichaut","champignon","reponsable","utilisation"
	,"tiramisu", "chataigne", "rencontre", "desormais", "personne", "fantome","faucon", "italien","berlinois", "documentaire", "autrichien");
	
	$nb=count($mot);
	$ptr=0;
    for ($i=2;$i<100;$i++){
		$r=rand(100,999);
		$mdp=$r."-".$mot[$ptr++];
		if ($ptr==$nb) $ptr=0;
		echo "equipe".$i." ; ".$mdp." - ".md5("*355".$mdp)."<br>\n";
		$instancePdoPeri->ajouterEquipe($i,md5("*355".$mdp));
	}
	?>
</div>
<?php include("v_pied.php") ;
?>
