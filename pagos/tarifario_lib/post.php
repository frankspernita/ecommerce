<?php

require  'return/../../vendor/autoload.php';


function CallAPI($method, $url, $data = false){
    $curl = curl_init();
    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // Optional Authentication:
    //curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    //curl_setopt($curl, CURLOPT_USERPWD, "username:password");
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

function RecuperarToken($fn){
	if (!file_exists($fn)){
		return false;
	}
	$fcont = file_get_contents($fn);
	$arr = explode("\n",$fcont);
	//echo "token=" . $arr[0] . "<br>";
	//echo "ts=" . $arr[1] . "<br>";
	return $arr;
}

function GuardarToken($fn, $token){
	$ts = time();
	$filecon = $token . "\n" . $ts;
	if(!file_put_contents($fn, $filecon)){
		return false;
	}else{
		return true;
	}
}

function sispo_get_token(&$error, $arr=null){

	logs('post.php', '$arr=' . print_r($arr, true));

	$tokenfn = 'sispo_token_';
	if(!chk($arr)){
    	// CLIENTES PAQUETERIA WEB / LAS PIEDRAS 1284 / San Miguel de Tucuman / Tucumán
    	$arr = array(
        	'api-key' => 'c263966a2c639520a55937816395ed73',
        	'secret-key' => '93a7fe9dc7f60598c0cabac9f66e26f6'
		);
		$tokenfn = $tokenfn . 'c263966a2c639520a55937816395ed73.txt';
		logs('post.php', 'usa token de paqueteria en archivo ' . $tokenfn);
	}else{
		$tokenfn = $tokenfn . $arr['api-key'] . '.txt';
		logs('post.php', 'usa token de cliente en archivo ' . $tokenfn);
	}
	logs('post.php', print_r($arr, true));

    $obtener_nuevo = false;

    if(!($fc=RecuperarToken($tokenfn))){
        $obtener_nuevo = true;
    }else{
        $ts = time();
        if( ($ts - $fc[1]) >=12590 )
            $obtener_nuevo = true;
        else {
     //       $error = "Recuperado token de archivo.";
            return $fc[0];
        }
    }

    if($obtener_nuevo){
        $res = CallAPI("POST", "https://clientes.sispo.com.ar/api/tokens", $arr);
        if ($res) {
            $arrres = json_decode($res, true);
            if (isset($arrres["codigo"])){
                if($arrres["codigo"]==200){
                  //  $error = "Token Sispo nuevo.";
                    GuardarToken($tokenfn,$arrres["access_token"]);
                    return $arrres["access_token"];
                }
            }
        }
    }

	return null;

}
?>