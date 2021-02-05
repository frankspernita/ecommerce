<?php

// session_start();
// consultar esta parte de que se trata ..
function chk($var)
{
    if (isset($var) && !empty($var))
        return true;
    return false;
}

function generateRandomString($length = 10)
{
    $characters = '123456789ABCDEFGHJKLMNPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function logs($module, $s)
{
    //$logfilename = "mpipn.log";
    date_default_timezone_set("America/Argentina/Tucuman");
    $now = new DateTime();
    //logstr($logfilename, "\n\n" . $now->format('Y-m-d H:i:s') . "\n");
    $logfilename = "tarifario-" . $now->format('Ymd') . ".log";
    $logmessage = $module . " : " . $now->format('Y-m-d H:i:s') . " : " . $s . "\n";
    if (file_exists($logfilename))
        file_put_contents($logfilename, $logmessage, FILE_APPEND);
    else
        file_put_contents($logfilename, $logmessage);
}

function remove_accent($str){ 
  $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ',  'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ',          'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü',          'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ',  'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ',          'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü',          'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı',  'Ĳ',  'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő',  'Œ',  'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ',  'Ǽ',  'ǽ', 'Ǿ', 'ǿ', '!', '"'); 
  $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N tilde123', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U tilde123', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n tilde123', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u tilde123', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', ' ', ' '); 
  return str_replace($a, $b, $str); 
}

function limpiar_campo($str){
	$ret = remove_accent($str);
	$ret = preg_replace("/[^A-Za-z0-9._-']+/", "", $ret);
	$ret = addslashes($ret);
	$ret = str_replace(
		array('N tilde123', 'n tilde123', 'U tilde123', 'u tilde123'), 
		array('Ñ',          'ñ',          'Ü',          'ü'),
		$ret);
	return $ret;
}

function conectar(&$mysqli)
{
   
        $mysqli = new mysqli('sispo.com.ar', 'sispoc5_zonif', 'sispoZonificacion2017', "sispoc5_tarifario");
        if ($mysqli->connect_errno) {
            return 'Error: Fallo al conectarse a MySQL ' . $mysqli->connect_errno . ' ' . $mysqli->connect_error;
        }
   
    return null;

}

function conectar_sispo(&$mysqli)
{
   
        $mysqli = new mysqli('sispo.com.ar', 'sispoc5_user', 'v#LB+aPk}_84', "sispoc5_gestionpostal");
        if ($mysqli->connect_errno) {
            return 'Error: Fallo al conectarse a MySQL ' . $mysqli->connect_errno . ' ' . $mysqli->connect_error;
        }
   
    return null;
}

function getMercadoPagoTokens(&$ClientId, &$ClientSecret){

/*
    $ClientId = "4809453429839716";
    $ClientSecret = "TYi9QTrXft29fYXpvW32DSDlad3zYTgd";
*/
$ClientId = "2668196057851715";
$ClientSecret = "JKfbbaA1DCYyiQ5So3ML1ImWkm4k55pz";

}

function getTusFacturasTokens( &$punto_venta, &$APIkey, &$APIToken, &$UserToken ){
    // FRANZAG - prueba solo factura c
    //$punto_venta = "00678";
    //$APIkey = "13371";
    //$APIToken = "e71032402c9b970e6d5c401367e77e3c ";
    //$UserToken = "4c8b0f2187c390341ca6f80002080237";

    // LOGISTICAS INTEGRALES - no funcoiona
    //$punto_venta = "00678";
    //$APIkey = "13728";
    //$APIToken = "167e46bc01a13101775db5c30374af0e";
    //$UserToken = "0a2fb3b49906f021049c360a434e5b09";

    // JOSEGABRIELMARMOL@GMAIL.COM -- PARA PRUEBAS DESDE 16/02/2019
    //$punto_venta = "01234";
    //$APIkey = "14837";
    //$APIToken = "875ef710e74a2585ea76cb9c491e229b";
    //$UserToken = "c0b7bd6e21cd2581881adc2ff60af742";

    // LOGISITICAS INTEGRALES
    //LOGISTICAS INTEGRALES S.A.	
    //30710720661	
    //SAN MARTIN 677 Piso:3 Dpto:O	
    //Responsable Inscripto	
    //00019
    //-ACTIVO-	SI			API key: 13728
    //API Token: 167e46bc01a13101775db5c30374af0e 
    //UserToken: 56b6a188b8cfd27eaa3675e5ffcfa4bb
    $punto_venta = "00019";
    $APIkey = "13728";
    $APIToken = "167e46bc01a13101775db5c30374af0e";
    $UserToken = "56b6a188b8cfd27eaa3675e5ffcfa4bb";

}


?>