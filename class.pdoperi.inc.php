<?php
/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * pour l'application perijeux
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoPeri qui contiendra l'unique instance de la classe
 
 * @package default
 * @author Sylvain
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoPeri{   		
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=web8143_db';   		
      	private static $user='web8143_db' ;    		
      	private static $mdp='nDMOUtkAgpbV' ;	
		private static $monPdo;
		private static $monPdoPeri=null;
		private static $prefixe='peri_';
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 * pattern Singleton
 */				
	private function __construct(){
    	PdoPeri::$monPdo = new PDO(PdoPeri::$serveur.';'.PdoPeri::$bdd, PdoPeri::$user, PdoPeri::$mdp); 
		PdoPeri::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoPeri::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 
 * Appel : $instancePdoPeri = PdoPeri::getPdoPeri();
 
 * @return l'unique objet de la classe PdoPeri
 */
	public  static function getPdoPeri(){
		if(PdoPeri::$monPdoPeri==null){
			PdoPeri::$monPdoPeri= new PdoPeri();
		}
		return PdoPeri::$monPdoPeri;  
	}
	
	public function setTSConnexion($login){
		// TODO modifie le TSConnexion de la BD.
	}
/**
 * Retourne les informations d'un visiteur
 
 * @param $login 
 * 
 * @return le pseudo et mdp sous la forme d'un tableau associatif 
*/
	public function getInfosVisiteur($login){
		//$password=MD5($mdp);//TODO encoder en MD5 en JS plutôt
		
		$req = "select  pseudo, mdp FROM ".PdoPeri::$prefixe."users WHERE pseudo='".$login."' ";
		$rs = PdoPeri::$monPdo->query($req);
		$ligne = $rs->fetch();
		return $ligne;
	}

/**
 * 
 
 * @param $pseudo de l'équipe
 * 
 * @return tous les indices collectées par cette équipe sous la forme d'un tableau associatif 
*/
	public function getLesIndices($pseudo){
	    $req = "select i.* from ".PdoPeri::$prefixe."indices i, ".PdoPeri::$prefixe."collecter c where numindices = num and pseudousers = '".$pseudo."' ";	
		$res = PdoPeri::$monPdo->query($req);
		$lesLignes = $res->fetchAll();		
		return $lesLignes; 
	}
/**
 * Retourne toutes les infos d'un indice
 
 * @param $num est le code de l'indice 
 
 * @return toutes les caractéristiques de l'indice sous la forme d'un tableau associatif
*/
	public function getUnIndice($num) {
		$req = "select * from ".PdoPeri::$prefixe."indices where  code  = '".$num."' ";	
		
		$res = PdoPeri::$monPdo->query($req);
		$lesLignes = $res->fetchAll();		
		return $lesLignes;
	}

/**
 * enregistre l'indice $numIndice trouvé par l'équipe $pseudo dans la table collecter
 * TODO : que se passe-t-il lorsqu'il y est déjà ?
 * @param $login
 * @param $numIndice
 * 
*/
	public function setCollecterUnIndice($login, $numIndice){
		if (strcmp($login,"")!= 0) {
			$req = "insert into ".PdoPeri::$prefixe."collecter (pseudousers, numindices) values ('".$login."','".$numIndice."')";
		
			$res = PdoPeri::$monPdo->exec($req);
		}
	}
	
	/**
 * efface la table collecter
 * 
 * 
*/
	public function effacerCollecter(){
		$req = "delete from ".PdoPeri::$prefixe."collecter where pseudousers='équipe1'";
		$res = PdoPeri::$monPdo->exec($req);
		
	}
	
	public function ajouterEquipe($num,  $md5){
		$req="insert into ".PdoPeri::$prefixe."users (pseudo,mdp) values ('equipe".$num."','".$md5."')";
		$res = PdoPeri::$monPdo->exec($req);
	}
}
?>
