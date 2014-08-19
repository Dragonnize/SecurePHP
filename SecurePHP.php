<?php
class SecurePHP
{
	public charset = 'UTF-8';
	
	
	function __construct(){	
		if($min != null and $max != null){
			if($min > strlen($variable) or $max < strlen($variable)){
				return false;
			}
		}
	}
	
	
	/**
	 * Cette fonction permet de compter le nombre de caractére d'une chaîne de caractére.
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	public function count_string($variable,$min,$max){
		if($min != null and $max != null){
			if($min > strlen($variable) or $max < strlen($variable)){
				return false;
			}else{
				return true;
			}
		}
	}
	
	
	/**
	 * Cette fonction permet de formater un texte.
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function text($variable){
		$variable		= html_entity_decode(trim($variable), ENT_QUOTES, 'UTF-8'); 		// convertit les entités HTML spéciales en caractères 
		$variable 		= htmlspecialchars(stripslashes(trim($variable)), ENT_NOQUOTES, 'UTF-8');
		$variable 		= str_replace('&amp;','&',$variable); // on garde l'&
		return $variable;
	}
	
	
	/**
	 * Cette fonction permet de savoir si c'est un booléen ou non.
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function booleen($variable){
		if($variable == '1' or $variable == '0'){
			return true;
		}else{
			return false;
		}
	}
	
	
	/**
	 * Cette fonction permet de savoir si c'est un nombre entier ou non.
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function nombre_int($variable){
		if(filter_var($variable, FILTER_VALIDATE_INT)){
			return true;
		}else{
			return false;
		}
	}
	
	
	/**
	 * Cette fonction permet de savoir si c'est un nombre décimal ou non
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function nombre_float($variable){
		if(filter_var($variable, FILTER_VALIDATE_FLOAT)){
			return true;
		}else{
			return false;
		}
	}
	
	
	/**
	 * Check url
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	public function url($variable,$min,$max){
		if(filter_var($variable, FILTER_VALIDATE_URL)){
			return true;
		}else{
			return false;
		}
	}
	
	
	/**
	 * Check mail
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	public function email($variable,$min,$max){
		if(filter_var($variable, FILTER_VALIDATE_EMAIL)){
			return true;
		}else{
			return false;
		}
	}

	
	/**
	 * Check username.
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function pseudo($variable){
		$syntaxe='#^[A-Za-z0-9]{3,15}$#';
		if(preg_match($syntaxe,$variable)){
			return true;
		}else{
			return false;
		}
	}

	
	/**
	 * Check password.
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function password($variable){
		$syntaxe='#^[A-Za-z0-9]{6,30}$#';
		if(preg_match($syntaxe,$variable)){
			return true;  
		}else{
			return false;
		}
	}
	
	
	/**
	 * Fonction empêchant le flood sur le site.
	 *
	 * @access	public
	 * @return	bool
	 */
	public function NotFlood(){
		// anti flood protection
		if($_SESSION['last_session_request'] < time() - 2){
			// users will be redirected to this page if it makes requests faster than 2 seconds
			header("location: http://www.example.com/403.html");
			exit;
		}
		$_SESSION['last_session_request'] = time();
	}
	
	
	/**
	 * Display the text.
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function affiche_text($chaine){
		$chaine 		= htmlspecialchars($chaine, ENT_QUOTES);
		// -------------
		// replacement : caractères "mal décodés" (< et >)
		$NON_array		= array('&amp;lt;','&amp;gt;');
		$OUI_array		= array('&lt;'    ,'&gt;');
		$chaine 		= str_replace($NON_array, $OUI_array, $chaine);
		// -------------
		return $chaine;
	}
	
	
	/**
	 * formate the text.
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function formatage_from_textarea($chaine) 
	{
		$chaine			= stripslashes(trim($chaine));
		// convertit les entités HTML spéciales en caractères 
		$chaine			= html_entity_decode($chaine, ENT_QUOTES, 'UTF-8');
		// -------------
		// remplacement : lien vers nouvelle page
		$chaine			= str_replace(array('target=', '_blank'), array('onclick=', 'window.open(this.href); return false;'), $chaine);
		// -------------
		// balises qui seront conservees
		// (ajoutez ou supprimez des balises a votre convenance)
		$allowable_tags  = '<abbr><acronym><a><b><br><blockquote><cite><code><dl><dt><dd>';
		$allowable_tags .= '<em><strong><small><pre><u><ul><ol><li>';
		$allowable_tags .= '<div><i><img><h1><h2><h3><h4><h5><h6><hr><p><span>';						// titres
		$allowable_tags .= '<table><caption><legend><thead><tfoot><tbody><tr><th><td><colgroup><col>';	// tableau
		$allowable_tags .= '<audio><video><object><param><embed>';										// audio/video
		$chaine			= strip_tags($chaine, $allowable_tags);
		// -------------
		return $chaine;
	}

	
	/**
	 * Display the text.
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function formatage_to_textarea($chaine) 
	{
		$chaine			= stripslashes(trim($chaine));
		$chaine			= html_entity_decode($chaine); 		// convertit les entités HTML spéciales en caractères 
		// -------------
		// replacement : caractères "dans le texte" (< et >, hors balises html)
		$NON_array		= array('&lt;'    ,'&gt;');
		$OUI_array		= array('&amp;lt;','&amp;gt;');
		$chaine 		= str_replace($NON_array, $OUI_array, $chaine);
		// -------------
		return $chaine;
	}
	
	
	/**
	 * Create rand alphanumerique.
	 *
	 * @access	public
	 * @param	string
	 * @param	bool
	 * @return	string
	 */
	public function MakeRandomString($stringLength=8, $noCaps=false)
	{
		if ($noCaps) { 	$chars = 'abchefghjkmnpqrstuvwxyz0123456789';
		} else { 		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		}
		$len = strlen( $chars );
		$rndString = '';
		for ( $i = 0; $i < $stringLength; $i++ ) {
			$rndString	.=	$chars[mt_rand( 0, $len - 1 )];
		}
		return $rndString;
	}
}
?>