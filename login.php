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
    <form  name="identification">
      <p class="ptl">Vous n'êtes pas encore connectés :</p>
      <p class="ptm">Pseudo : <input type="text" name="login" size=32 maxlength=32 value='equipe'> </p>
      <p class="ptm">Mot de passe : <input type="password" name="mot_de_passe" size=28 maxlength=32></p>
       <p class="ptl"><input onClick="doChallengeResponse();" type="submit" name="submitbtn" value="connexion">
		<input type="hidden" name="reponse"  value="" size=32>
		<?php if (isset($_REQUEST['uc']) && !strcmp($_REQUEST['uc'],"")==0)
			echo "<input type='hidden' name='uc'  value='".$_REQUEST['uc']."' size=32></p>\n";
		?>
    </form>
    </div>
<?php include("v_pied.php") ;
?>
