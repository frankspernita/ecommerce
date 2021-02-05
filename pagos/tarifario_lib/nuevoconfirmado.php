<?php
require 'funciones.php';
require 'post.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';




?>
<!DOCTYPE html>
<html lang="es">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">


 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- css -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,300,700,800" rel="stylesheet" media="screen">
  <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="../css/style.css" rel="stylesheet" media="screen">
  <link href="../color/default.css" rel="stylesheet" media="screen">


	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-141619340-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());
		gtag('config', 'UA-141619340-1');
	</script>  
	
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Envio Confirmado</title>
<!--	<link rel="stylesheet" href="return/../../tarifario_res/bootstrap.css"> -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<!--	<link rel="stylesheet" href="return/../../tarifario_res/tarifario.css"> -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

</head>

<body>
   
    
	<!--
            "GET /tarifario/nuevoconfirmado
                ?collection_id=4448392586&collection_status=approved
                &preference_id=157596880-f9abead7-68d9-4e64-b183-5aa04ee3fa41
                &external_reference=MP_ZTS6YWV6M3
                &payment_type=debit_card
                &merchant_order_id=949303058"
        -->

	<?php
	
	
///////////////DATOS DE PRUEBA el get token deben ir datos del que quiera recibir la plata

$order = $_GET['external_reference'];

//// como mensaje es un string que trae muchos datos solo necesito los dias habiles, los extraigos

///////////////CONEXION A LA BD EL FARO

$host = "localhost";
$basededatos = "sppfla5_ecommercev2";
$usuariodb = "sppfla5";
$clavedb = "Sentey@82.";

//Lista de Tablas si quiero meterlas en una variable y reutilizarlas
//error_reporting(0); // no muestra errores

$conexion = new mysqli($host, $usuariodb, $clavedb, $basededatos);


//$conexion = mysqli_query("SET NAMES 'utf8'");

if ($conexion ->connect_error) {
    echo "Nuestro sitio experimento fallos...";
    exit();
}

/*
$dato = "http://ecommercev2.sppflash.com.ar/pagos/index.php?precio=".$total."&entrega=".$entrega."&orden=".$orden."&envio=".$envio;



            $sql = "UPDATE tbl_order_translated SET shipping_comments = '".$dato."'  WHERE id = $orden";
      
            if ($conexion->query($sql) === TRUE) {
                echo "";
            } else {
                echo "Error updating record: " . $conexion->error;
            }

*/


////
/*
El solicitante (este es el que se usa para facturar en mercadopago), estos datos empiezan son ssnombre, ssapellido etc.
Luego tenes los datos del Origen: sonombre, soapellido, etc
Y los datos del Destino: snombre, sapellido

///// CARGA DATOS DEL DESTINATARIO!!!
*/

$resultados = mysqli_query($conexion,"
SELECT * FROM
orders INNER JOIN orders_products ON orders.orders_id = orders_products.orders_id
INNER JOIN products ON orders_products.products_id = products.products_id
INNER JOIN customers ON orders.customers_id = customers.customers_id
WHERE orders.orders_id = $order");

while ( $row = mysqli_fetch_array($resultados)) 
{
$sdescripcion_paquete = $row['products_model'];
$sdimensiones = $row['products_weight']."Kgs";
$sdetalle = $row['products_name'];
$speso = $row['products_weight'];
$snombres = $row['delivery_name'];
$sapellidos = $row['delivery_name'];
$sdocumento = "Sin dato";
$stelefono = $row['delivery_phone'];
$smail = $row['email'];
$scalle = $row['delivery_street_adress'];
$scodigo_postal = $row['delivery_postcode'];
$slocalidad_ciudad = $row['delivery_city'];
$sprovincia = $row['delivery_state'];
$tcosto = $row['order_price'];
$tcosto_neto = $row['shipping_cost'];
}
        $sdescripcion_paquete = 'ropa o accesorio';
		$stipo_documento = 'DNI';
		$sbultos = 1;
        $sdias_entrega = $entrega;
		$snumero = 000;
		$spiso = 000;
		$sdepto = 000;
		$sreferencia_domicilio = 'observaciones';
		$sprovincia_id = 4;
		$ssucursal_destino = 4;
		$sdetalle = 'ropa o accesorio';
        $sprovincia_id_afip = 4;

// ACA VA CARGADA DE DATOS DE ORIGEN

$resultados2 = mysqli_query($conexion,"
SELECT * FROM
orders INNER JOIN orders_products ON orders.orders_id = orders_products.orders_id
INNER JOIN products ON orders_products.products_id = products.products_id
INNER JOIN customers ON orders.customers_id = customers.customers_id
WHERE orders.orders_id = $order");


//muestra y toma de datos en un array
while ( $row2 = mysqli_fetch_array($resultados2)) 
{
    
$sonombres = $row2['customers_firstname'];
$soapellidos = $row2['customers_lastname'];
$sodocumento = "Sin dato";
$sotelefono = $row2['customers_telephone'];
$somail = $row2['email'];
$socalle = $row2['customers_street_address'];
$socodigo_postal = $row2['customers_postcode'];
$solocalidad_ciudad = $row2['customers_city'];
$soprovincia = $row2['customers_state'];

}

		$sotipo_documento = 'DNI';
		$sonumero = '000';
		$sopiso = '000';
		$sodepto = '000';
		$soreferencia_domicilio = 'observaciones';
		$soprovincia_id = 4;
		$soprovincia_id_afip = 4;

//DISTINTOS TIPOS DE COSTOS A LLENAR		
		
		$tvdec = 0.00;
		$tcosto_iva = 0.00;
		$tcosto_aseg = 0.00;

//DATOS FIJOS PARA EL ALTA DEL SISPO !!!!!!!!!!!!!! observacion del cliente final!!!!!!!!!!!!!!!!


		$scodigo_externo = null;
		$scodigo_externo = "PAQMP_" . generateRandomString(10); //hacer codigo aleatorio
		$ssucursal_origen = 4;
		$sscondiva = 'CF';
		$codigo = "http://mwaccesorios.sppflash.com.ar/";
		
// DATOS DEL USUARIO SOLICITANTE DE MERCADO PAGO - CARGAR A TRAVES DE UN FORMULARIO WEB

		$ssmail = 'm.w73@hotmail.com';
        $ssapellidos = 'Av Aconquija 1620 paseo francés';
        $ssnombres = 'Av Aconquija 1620 paseo francés';
        $ssdocumento = 35053399;
        $sstelefono = 5546464;
        $ssprovincia = 'tomar todos los datos de una consulta!!!!!!!!!!';
        $ssprovincia_id = 4;
        $ssprovincia_id_afip = 4;
        $sstipo_documento = 'DNI';
        
        


		// conectar con sispo, buscar $codigo en observaciones de flash_clientes
		
		$MYSQLI_ERROR = "";
		if (empty(($MYSQLI_ERROR = conectar_sispo($mysqli_sispo)))) {
			mysqli_set_charset($mysqli_sispo, "utf8");
			$sql = 'SELECT id, nombre, cuit
				FROM flash_clientes
				WHERE observaciones LIKE \'%' . $codigo . '%\'	';
			$result = $mysqli_sispo->query($sql);
			if ($result->num_rows <= 0) {
				echo 'No se encontro cliente de sispo con observaciones con codigo ' . $codigo;
				exit;
			} else {
				$row = $result->fetch_array();
				$cliente_id = $row[0];
				$cliente_desc = $row[0] . " - " . $row[1] . " - " . $row[2];
				$sql2 = 'SELECT api_key, secret_key
					FROM flash_clientes_api
					WHERE cliente_id = ' . $cliente_id;
				$result2 = $mysqli_sispo->query($sql2);
				if ($result2->num_rows <= 0) {
					echo 'No se encontr贸 api_token de cliente ' . $cliente_desc . ' con c贸digo ' . $codigo;
					exit;
				} else {
					$row2 = $result2->fetch_array();
					$api_key = $row2[0];
					$secret_key = $row2[1];
					$tokens = array(
						"api-key" => $api_key,
						"secret-key" => $secret_key
					);
					$error = "";
					//logs('nuevoconfirmar.php','$tokens[] = ' . print_r($tokens,true));
					$sispo_token = sispo_get_token($error, $tokens);
					//logs('nuevoconfirmar.php','$sispo_tokens[] = ' . print_r($sispo_tokens,true));

					echo $error;
					if(empty($sdocumento))
						$sdocumento = '12345678';
					$arr = array(
						"access_token" => empty($sispo_token) ? "-" : $sispo_token,
						"sucursal_origen" => empty($ssucursal_origen) ? "-" : $ssucursal_origen,
						"codigo_externo" => empty($scodigo_externo) ? "-" : $scodigo_externo,
						"codigo" => $codigo,
						"descripcion_paquete" => empty($sdescripcion_paquete) ? "-" : $sdescripcion_paquete,
						"dimensiones" => empty($sdimensiones) ? "-" : $sdimensiones,
						"peso" => empty($speso) ? "-" : $speso,
						"bultos" => empty($sbultos) ? "-" : $sbultos,
						"dias_entrega" => empty($sdias_entrega) ? "-" : $sdias_entrega,
						"nombres" => empty($snombres) ? "-" : $snombres,
						"apellidos" => empty($sapellidos) ? "-" : $sapellidos,
						"tipo_documento" => empty($stipo_documento) ? "-" : $stipo_documento,
						"documento" => empty($sdocumento) ? "-" : $sdocumento,
						"telefono" => empty($stelefono) ? "-" : $stelefono,
						"mail" => empty($smail) ? "-" : $smail,
						"calle" => empty($scalle) ? "-" : $scalle,
						"numero" => empty($snumero) ? "-" : $snumero,
						"piso" => empty($spiso) ? "-" : $spiso,
						"depto" => empty($sdepto) ? "-" : $sdepto,
						"referencia_domicilio" => empty($sreferencia_domicilio) ? "-" : $sreferencia_domicilio,
						"codigo_postal" => empty($scodigo_postal) ? "-" : $scodigo_postal,
						"localidad_ciudad" => empty($slocalidad_ciudad) ? "-" : $slocalidad_ciudad,
						"provincia" => empty($sprovincia) ? "-" : $sprovincia,
						"sucursal_destino" => empty($ssucursal_destino) ? "-" : $ssucursal_destino,
					);
					

					$pieza_id = null;
					$res = CallAPI("POST", "https://clientes.sispo.com.ar/api/envios", $arr);
					if ($res) {
						$arrres = json_decode($res, true);
						if (isset($arrres["codigo"])) {
							if ($arrres["codigo"] == 200) {
								date_default_timezone_set("America/Argentina/Tucuman");
								$pieza_id = $arrres["pieza_id"];
								$codext = $arrres["codigo_externo"];
							} else {
								$error = "Ocurrio un error al conectar con SISPO!=200: " . isset($arrres["mensaje"]) ? $arrres["mensaje"] : "";
								exit;
							}
						} else {
							$error = "Ocurrio un error al conectar con SISPO: " . isset($arrres["mensaje"]) ? $arrres["mensaje"] : "";
							exit;
						}
					}
	

					// alta tarifario_codigos_usados //////////////////////////////////////////////////////////////////////////
					$MYSQLI_ERROR = "";
					if (empty(($MYSQLI_ERROR = conectar($mysqli)))) {
						mysqli_set_charset($mysqli, "utf8");
						date_default_timezone_set("America/Argentina/Tucuman");
						$now = new DateTime();
						$fechahora = $now->format('YmdHis');
						/* Prepared statement, stage 1: prepare */
						if (!($stmt = $mysqli->prepare(
							"INSERT INTO tarifario_codigos_usados (codigo, fechahora, flash_cliente_id, pieza_id, codigo_externo, importe) 
																VALUES (?,?,?,?,?,?)"
						))) {
							echo ("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "<br>");
						} else {
							if (!$stmt->bind_param("ssiisi", $codigo, $fechahora, $cliente_id, $pieza_id, $scodigo_externo, $tcosto)) {
								echo ("Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error . "<br>");
							} else {
								if (!$stmt->execute()) {
									echo ("Execute failed: (" . $stmt->errno . ") " . $stmt->error . "<br>");
								} else {
									$sql = 'UPDATE tarifario_codigos SET usos = 0 WHERE codigo = "' . $codigo . '" AND usos > 0';
									$result = $mysqli->query($sql);
								}
							}
						}
					}
				}
			}
		} else {
			echo "Error al conectar sispo:" . $MYSQLI_ERROR;
			exit;
		}



	// SI SE PUSO EMAIL EN SISPO TEMPORAL -> LLENO DATOS EN FORMULARIO, IR A MERCADOPAGO. CONSULTAR CON ALVARO SOBRE QUE CAMPO DEJAR NULOS
	
	if (chk($ssmail)) {
	  //  echo "entro";
		$MYSQLI_ERROR = "";
		if (empty(($MYSQLI_ERROR = conectar($mysqli))))
			mysqli_set_charset($mysqli, "utf8");
		if (!empty($MYSQLI_ERROR)) {
	//		logs("nuevoconfirmar.php", "Error al conectar mysql:" . $MYSQLI_ERROR);
			echo "Error al conectar mysql:" . $MYSQLI_ERROR;
			exit;
		} else {
			date_default_timezone_set("America/Argentina/Tucuman");
			$now = new DateTime();
			$fechahora_alta = $now->format('YmdHis');
			//echo $fecha_ymd;
			/* Prepared statement, stage 1: prepare */
			if (!($stmt = $mysqli->prepare(
				"INSERT INTO tarifario_envios 
            (codigo_externo,    fechahora_alta,                     sucursal_origen,    descripcion_paquete,    dimensiones,
            detalle,            peso,                               bultos,             dias_entrega,           snombres,
            nombres,            onombres,                           sapellidos,         apellidos,              oapellidos,
            stipo_documento,    tipo_documento,                     otipo_documento,    scondiva,               sdocumento,
            documento,          odocumento,                         stelefono,          telefono,               otelefono,
            smail,              mail,                               omail,              calle,                  ocalle,
            numero,             onumero,                            piso,               opiso,                  depto,
            odepto,             referencia_domicilio,               oreferencia_domicilio, codigo_postal,       ocodigo_postal,
            localidad_ciudad,   olocalidad_ciudad,                  sprovincia,         provincia,              oprovincia,
            sprovincia_id,      provincia_id,                       oprovincia_id,      sprovincia_id_afip,     provincia_id_afip,
            oprovincia_id_afip, sucursal_destino,                   tvdec,              tcosto,                 tcosto_neto,
            tcosto_iva,         tcosto_aseg,						pieza_id     )
            VALUES (?,?,?,?,?,   ?,?,?,?,?,   ?,?,?,?,?,   ?,?,?,?,?,   ?,?,?,?,?, 
                    ?,?,?,?,?,   ?,?,?,?,?,   ?,?,?,?,?,   ?,?,?,?,?,   ?,?,?,?,?, 
                    ?,?,?,?,?,   ?,?,?)"
			))) {
	//			logs("nuevoconfirmar.php", "line 570:Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
				echo ("lin 570 Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
				exit;
			}
			/* Prepared statement, stage 2: bind and execute */
			if (!$stmt->bind_param(
				"ssissssssssssssssssssssssssssssssssssssssssssiiiiiiiiiiiii",
				$scodigo_externo,$fechahora_alta,$ssucursal_origen,	$sdescripcion_paquete,	$sdimensiones,$sdetalle,$speso,$sbultos,$sdias_entrega,$ssnombres,
				$snombres,$sonombres,$ssapellidos,$sapellidos,$soapellidos,$sstipo_documento,$stipo_documento,$sotipo_documento,$sscondiva,$ssdocumento,
				$sdocumento,$sodocumento,$sstelefono,$stelefono,$sotelefono,$ssmail,$smail,$somail,$scalle,$socalle,$snumero,$sonumero,$orden,$sopiso,$sdepto,
				$sodepto,$sreferencia_domicilio,$soreferencia_domicilio,$scodigo_postal,$socodigo_postal,$slocalidad_ciudad,$solocalidad_ciudad,$ssprovincia,
				$sprovincia,$soprovincia,$ssprovincia_id,$sprovincia_id,$soprovincia_id,$ssprovincia_id_afip,$sprovincia_id_afip,$soprovincia_id_afip,
				$ssucursal_destino,$tvdec,$tcosto,$tcosto_neto,$tcosto_iva,$tcosto_aseg,$pieza_id
			)) {
	//			logs("nuevoconfirmar.php", "line 592: Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error);
				echo ("line 592: Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error);
				//header('Location: ' . $tarifario_url . 'nuevo');
				exit;
			}

			if (!$stmt->execute()) {
	//			logs("nuevoconfirmar.php", "Execute failed: (" . $stmt->errno . ") " . $stmt->error);
				echo ("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
				//header('Location: ' . $tarifario_url . 'nuevo');
				exit;
			}

			// echo $stmt->fullQuery;
			//logs("nuevoconfirmar.php", "\$stmt->fullQuery: '" . $stmt->fullQuery . "'");


			// if (!chk($codigo) || ($codigo != $codigo_confirmado)) {

				//logs("nuevoconfirmar.php", "Precio a facturar cambiado de $" . $tcosto . " a $4 ...");
				//$precio = 4; // $tcosto;
				$precio = $tcosto;
				//logs("nuevoconfirmar.php", "Cantidad a facturar cambiado de * a 1 ...");
				$cantidad = 1;
			//	$producto = $sdimensiones . " a " . $scalle . " " . $snumero . " " . $spiso . " " . $sdepto . "," . $slocalidad_ciudad . "," . $sprovincia . "," . $scodigo_postal . " Cod.Referencia:" . $scodigo_externo;
	            $producto = $sdescripcion_paquete;

	//			logs("nuevoconfirmar.php", "Producto a facturar: '" . $producto . "'");
				// echo($producto);

}
}
	
	
	
	
	
//	$scodigo_externo = isset($_GET["external_reference"]) ? $_GET["external_reference"] : null;
	$merchant_order_id = isset($_GET["merchant_order_id"]) ? $_GET["merchant_order_id"] : null;
	

	$conexion = new mysqli('sispo.com.ar', 'sispoc5_zonif', 'sispoZonificacion2017', 'sispoc5_tarifario');

            $resultados = mysqli_query($conexion,"
                        SELECT *
                        FROM tarifario_envios
                        WHERE codigo_externo = '$scodigo_externo'
                        ");
                    
                        //muestra y toma de datos en un array
                        while ( $consulta = mysqli_fetch_array($resultados)) 
                        {
                            
                            $idOrden = $consulta['piso'];
                            $pieza = $consulta['pieza_id'];
                            
                            $sfechahora_alta = $consulta['fechahora_alta'];
                            $ssucursal_origen = $consulta['sucursal_origen'];
                            $sdescripcion_paquete = $consulta['descripcion_paquete'];
                            $sdimensiones = $consulta['dimensiones'];
                            $sdetalle = $consulta['detalle'];
                            $speso = $consulta['peso'];
                            $sbultos = $consulta['bultos'];
                            $sdias_entrega = $consulta['dias_entrega'];
                            $snombres = $consulta['nombres'];
                            $sapellidos = $consulta['apellidos'];
                            $sscondiva = $consulta['scondiva'];
                            $stipodocumento = $consulta['tipo_documento'];
                            $sdocumento = $consulta['documento'];
                            $stelefono = $consulta['telefono'];
                            $smail = $consulta['mail'];
                            $sreferencia_domicilio = $consulta['referencia_domicilio'];
                            $scalle = $consulta['calle'];
                            $scodigo_postal = $consulta['codigo_postal'];
                            $slocalidad_ciudad = $consulta['localidad_ciudad'];
                            $sprovincia = $consulta['provincia'];
                            $ssucursal_destino = $consulta['sucursal_destino'];
                            $stvdec = $consulta['tvdec'];
                            $stcosto = $consulta['tcosto'];
                            $stcosto_envio = $consulta['tcosto_neto'];
                        }
                        
                        //definir el resto de los datos de mercado pago
                        $sbarcode = $scodigo_externo;
                        $smp_merchant_order_id = $merchant_order_id;
                        $smp_merchant_order_status = 'Aprobado';
                        $smp_merchant_order_total_amount = $stcosto;
                        
                        //actualizar datos del estatus de la orden de compra

            $sql = "UPDATE tarifario_envios SET mp_merchant_order_id = $merchant_order_id, mp_merchant_order_status = 'Aprobado'  WHERE codigo_externo = '$scodigo_externo'";
           
            if ($conexion->query($sql) === TRUE) {
                echo "";
            } else {
                echo "Error updating record: " . $conexion->error;
            }
            
            
            
            
            
            
            
            
            
            //colocar el id de la empresa segun el tarifario mnualmente!!!!
            
            $conexion = new mysqli('localhost', 'sppfla5', 'Sentey@82.', 'sppfla5_tarifario');


            $sql = "INSERT INTO `tarifario_envios`(`codigo_externo`, `idEmpresa`, `sucursal_origen`, `descripcion_paquete`,
            `dimensiones`, `detalle`, `peso`, `bultos`, `dias_entrega`, `nombres`, `apellidos`, `tipo_documento`, `scondiva`, `documento`, `telefono`,
            `mail`, `referencia_domicilio`, `calle`, `codigo_postal`, `localidad_ciudad`, `provincia`, `sucursal_destino`, `tvdec`, `tcosto`, `pieza_id`,
            `barcode`, `mp_merchant_order_id`, `mp_merchant_order_status`, `mp_merchant_order_total_amount`, `tcosto_envio`) 
            
            VALUES ('$scodigo_externo', '6', '$ssucursal_origen', '$sdescripcion_paquete',
            
            '$sdimensiones', '$sdetalle', '$speso', '$sbultos', '$sdias_entrega', '$snombres', '$sapellidos', '$stipodocumento', '$sscondiva', '$sdocumento', '$stelefono',
            '$smail', '$sreferencia_domicilio', '$scalle', '$scodigo_postal', '$slocalidad_ciudad', '$sprovincia', '$ssucursal_destino', '$stvdec', '$stcosto', '$pieza',
            '$scodigo_externo','$smp_merchant_order_id','$smp_merchant_order_status','$smp_merchant_order_total_amount','$stcosto_envio')";   
            
            
            if ($conexion->query($sql) === TRUE) {
                echo "";
            } else {
                echo "Error updating record: " . $conexion->error;
            }
            
            
            
            /*
            $conexion = new mysqli('sispo.com.ar', 'sispoc5_zonif', 'sispoZonificacion2017', 'sispoc5_gestionpostal');


            $sql = "UPDATE flash_piezas_paquetes SET peso = $envio WHERE pieza_id = $pieza";   
            
            if ($conexion->query($sql) === TRUE) {
                echo "Record updated successfully2";
            } else {
                echo "Error updating record: " . $conexion->error;
            }
            */
           
//echo "$scodigo_externo";
//echo "$merchant_order_id";

//echo 'estos datos son los que importan1';
	if (is_null($scodigo_externo)) {
		echo "No se paso codigo externo: '...&external_reference=MP_XXXXXXXX...'";
		logs("nuevoconfirmado.php", "No se paso codigo externo: '...&external_reference=MP_XXXXXXXX...'");
		exit;
	}
	if (is_null($merchant_order_id)) {
		echo "No se paso merchant_order: ' ...&merchant_order_id=XXXXXXXXX ...'";
		logs("nuevoconfirmado.php", "No se paso merchant_order: ' ...&merchant_order_id=XXXXXXXXX ...'");
		exit;
	}

	
//	$merchant_order = MercadoPago\MerchantOrder::find_by_id($merchant_order_id);
	
?>
  <section id="intro">
    <div class="intro-container">
      <div id="introCarousel" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <!-- Slide 1 -->
          <div class="item active">
            <div class="carousel-background"><img src="../img/slide00.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <img src="../img/logo_blanco.png" alt="Logo de correo flash">

<?php
	$MYSQLI_ERROR = "";

	if (empty(($MYSQLI_ERROR = conectar($mysqli)))) {
		mysqli_set_charset($mysqli, "utf8");
		$sql = 'SELECT * FROM tarifario_envios WHERE codigo_externo = "' . $scodigo_externo . '"';
		$result = $mysqli->query($sql);
    //    echo 'aca se conecto a al sispo para el insert';
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			if ($merchant_order->paid_amount >= $merchant_order->total_amount) {
				?>
				<h4 style="color: #fff;"> Su pedido fue acreditado:<br>
				
					Codigo de Seguimiento: "<label class="labelmm"> <?php echo $scodigo_externo; ?> </label>"<br>
				<!--	La factura sera enviada a la direccion email <label class="labelmm"><?php echo $row['mail']; ?></label> <br> -->
					Seguí tu pedido aquí <a href='http://www.correoflash.com/segpieza?codigo=<?php echo $scodigo_externo; ?>'>Seguimiento CorreoFlash</a><br><br> 
					Su pedido sera entregado hasta la fecha 
					
					<?php    
					
    				$año = substr($row['fechahora_alta'], 0,4); // Devuelve itr
                    $mes = substr($row['fechahora_alta'], 4,2); // Devuelve itr
                    $dia = substr($row['fechahora_alta'], 6,2); // Devuelve itr
                    $fecha_final = $año."-".$mes."-".$dia;
                    $mod_date = strtotime($fecha_final."+ ".$row['dias_entrega']." days");
                    echo date("d-m-Y",$mod_date) . "\n";
					
					?>
					<br><br> 
				<!--	<button id="btn_refrescar" class="btn btn-info btn-lg" type="button" onClick="window.location.reload()">Refrescar pagina</button> -->
				</h4>
				
				
			<?php
					} else {
						?>
				<h4 style="color: #f60;"> Su pedido aun no fue acreditado, cuando lo sea se le enviara el mail correspondiente a la direccion <label class="labelmessage"><?php echo $row['mail']; ?></label> <br>  
					Codigo Externo <label class="labelmm"> <?php echo $scodigo_externo; ?> </label>
				
					Puedes usar el número de seguimiento para realizar el seguimiento de tu envio de paqueteria en <a href='http://www.correoflash.com/segpieza'>Seguimiento CorreoFlash</a><br><br>" .
				</h4>
	<?php
			}
		}
	}
	
	

	?>
                </div>
            </div>
          </div>
      </div>
    </div>
  </section><!-- #intro -->

</body>

<script>
	var d = new Date();
	var n = d.valueOf();
	<?php $producto = $row['detalle'] . "(" . $row['dimensiones'] . ") a " . $row['calle'] . " " . $row['numero'] . " "
		. $row['piso'] . " " . $row['depto'] . "," . $row['localidad_ciudad'] . "," . $row['provincia'] . "," . $row['codigo_postal']
		. " Cod.Referencia:" . $row['codigo_externo']; ?>
	gtag('event', 'purchase', {
		"transaction_id": n,
		"affiliation": "Paqueteria Web",
		"value": <?php $row['tcosto'] ?>,
		"currency": "ARS",
		"tax": <?php $row['tcosto_iva'] ?>,
		"shipping": <?php $row['tcosto_aseg'] ?>,
		"items": [{
			"id": "<?php echo $row['codigo_externo']; ?>",
			"name": "<?php echo $producto; ?>",
			"list_name": "Paqueteria Web",
			"brand": "Correoflash",
			"category": "Paqueteria Web",
			"quantity": 1,
			"price": <?php $row['tcosto'] ?>
		}]
	});
</script>


  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/wow.min.js"></script>
  <script src="../js/jquery.scrollTo.min.js"></script>
  <script src="../js/jquery.nav.js"></script>
  <script src="../js/modernizr.custom.js"></script>
  <script src="../js/grid.js"></script>
  <script src="../js/stellar.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="../contactform/contactform.js"></script>

  <!-- Template Custom Javascript File -->
  <script src="../js/custom.js"></script>

</html>


<?php



	$conexion = new mysqli('sispo.com.ar', 'sispoc5_zonif', 'sispoZonificacion2017', 'sispoc5_tarifario');



          
            //// aca comienza el envio de mail ... si hay un error ver aca   EMAIL AL CLIENTE
            
            
                //$scodigo_externo = $merchant_order->external_reference;
     $sql = 'SELECT  codigo_externo, fechahora_alta, fechahora_pago, sucursal_origen, descripcion_paquete,
			/*  5*/	dimensiones, peso, bultos, dias_entrega, nombres,
			/* 10*/	apellidos, tipo_documento, documento, telefono, otelefono,
            /* 15*/ mail, omail, calle, ocalle, numero,
			/* 20*/ onumero, piso, opiso, depto, odepto,
			/* 25*/ referencia_domicilio, oreferencia_domicilio, codigo_postal, ocodigo_postal, localidad_ciudad,
			/* 30*/ provincia, provincia_id_afip, sucursal_destino, tvdec, tcosto,
			/* 35*/ pieza_id, mp_merchant_order_id, mp_merchant_order_status, mp_merchant_order_paid_amount, mp_merchant_order_total_amount,
			/* 40*/ tusfacturas_pdf_url, olocalidad_ciudad, oprovincia, onombres, oapellidos,
			/* 45*/ otipo_documento, odocumento, sprovincia, snombres, sapellidos,
			/* 50*/ stipo_documento, sdocumento, stelefono, smail
                FROM tarifario_envios
                WHERE codigo_externo = "' . $scodigo_externo . '"';
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_array();
    } else {
        $error = "No se encontro pedido con codigo:" . $scodigo_externo;
        return;
	}
	$email = $row[53];
	$emaild = $row[15];
	$emailo = $row[16];
	//$subject = "Pedido web facturado Cod.Externo:" . $scodigo_externo . " Nro.Pieza SISPO:" . $row[35];
	$subject = "Su envio con codigo " . $scodigo_externo . " fue facturado y sera procesado a la brevedad.";
	$text =
		"<h2><u><b>Pedido web de <a href='http://mwaccesorios.sppflash.com.ar/'>mwaccesorios.sppflash.com.ar</a></b></u></h2>" .
		"Cod. de Seguimiento: <b>" . $scodigo_externo ."</b><br>" .
		"<h2><b>Puedes usar este codigo para realizar el seguimiento de tu paquete en </b></h2>
		<br><a href='http://www.correoflash.com/segpieza?codigo=". $scodigo_externo ."'><b><u> CorreoFlash Seguimiento de Envios</u></b></a><br><br>" .

        "DESCRIPCION DEL PRODUCTO: <b>" . $row[4] . "</b><br>" .
		"Dimensiones: <b>" . $row[5] . "</b> Peso: <b>" . $row[6] . " [Kg]</b><br><br>" .
		"PLAZO DE ENTREGA: <b>" . $row[8] . " dias hábiles.</b><br>" .
		
/*
		"<h2><u>SOLICITANTE:</u></h2>".
		"Provincia: <b>" . $row[47] . "</b><br>" .
		"Apellidos: <b>" . $row[49] . "</b>,  Nombres: <b>" . $row[48] . "</b><br>" .
		"Tipo Doc.: <b>" . $row[50] . "</b>,  Número Doc.: <b>" . $row[51] . "</b><br>" .
		"Teléfono: <b>" . $row[52] . "</b>,  Email: <b>" . $row[53] . "</b><br><br>" .

		"<h2><u>RETIRO:</u></h2>".
		"Calle: <b>" . $row[18] . "</b>,  Nro: <b>" . $row[20] . "</b>,  Piso: <b>" . $row[22] . "</b>,  Depto:<b>" . $row[24] . "</b><br>" .
		"Referencia Domicilio: <b>'" . $row[26] . "'</b><br>" .
		"CP: <b>" . $row[28] . "</b>,  Localidad: <b>" . $row[41] . "</b>,  Provincia: <b>" . $row[42] . "</b><br>" .
		"<u>Remitente:</u><br>".
		"Apellidos: <b>" . $row[44] . "</b>,  Nombres: <b>" . $row[43] . "</b><br>" .
		"Tipo Doc.: <b>" . $row[45] . "</b>,  Número Doc.: <b>" . $row[46] . "</b><br>" .
		"Teléfono: <b>" . $row[14] . "</b>,  Email: <b>" . $row[16] . "</b><br><br>" .
*/		
		"<h2><u>DOMICILIO DE ENTREGA:</u></h2>" .
		"Calle: <b>" . $row[17] . "</b>,  Nro: <b>" . $row[19] . "</b>,  Piso: <b>" . $row[21] . "</b>,  Depto:<b>" . $row[23] . "</b><br>" .
		"Referencia Domicilio: <b>'" . $row[25] . "'</b><br>" .
		"CP: <b>" . $row[27] . "</b>,  Localidad: <b>" . $row[29] . "</b>,  Provincia: <b>" . $row[30] . "</b><br>" .
		"<u>Destinatario:</u><br>" . 
		"Apellidos: <b>" . $row[10] . "</b>,  Nombres: <b>" . $row[9] . "</b><br>" .
		"Tipo Doc.: <b>" . $row[11] . "</b>,  Número Doc.: <b>" . $row[12] . "</b><br>" .
		"Teléfono: <b>" . $row[13] . "</b>,  Email: <b>" . $row[15] . "</b><br>";
		
		
    $error = "";
    $mail = new PHPMailer(true);
    try {
        //$titulo = '';
        $text = html_entity_decode($text);
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'tls'; // AUTH smtp login, insecure, no funciona con tls/ssl
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'quoted-printable';
        $mail->Username = 'intranetflash@gmail.com';
        $mail->Password = 'Abcd1234!'; // gmail USER APP password
        $mail->SetFrom('intranetflash@gmail.com', 'Logisiticas Integrales SA', 0);
        $subject = html_entity_decode($subject);
        $mail->Subject = '$subject';
        $mail->Body = $text;
        /*
        //$mail->AddAttachment($tusfacturas_pdf, $name = 'tusfacturas_pdf.pdf', $encoding = 'base64', $type = 'application/pdf');
        //$url = 'http://mywebsite/webservices/report/sales_invoice.php?company=development&sale_id=2'; // $tusfacturas_pdf
        if(!get_remote_file($tusfacturas_pdf,$binary_content,$error))
            return false;
        //$binary_content = file_get_contents($tusfacturas_pdf);
        if ($binary_content === false) {
            $error = "Could not fetch remote content from: '$tusfacturas_pdf'";
            return false;
        }
        $mail->AddStringAttachment($binary_content, "tusfacturas.pdf", $encoding = 'base64', $type = 'application/pdf');
        */
		$mail->AddAddress($email);  // solicitante
		$mail->AddAddress($emailo); // origen
		$mail->AddAddress($emaild); // destino
		$mail->AddAddress('administracion2@correoflash.com'); // destino
		$mail->AddAddress('m.w73@hotmail.com'); // destino*/
		$mail->AddAddress('sistemas2@correoflash.com'); // destino
		$mail->AddAddress('correflash2017@gmail.com'); // destino
//		$mail->addBCC('ojeador6@gmail.com');
//		$mail->addBCC('sistemas@correoflash.com');
         $mail->send();
                        
                        //echo 'Message has been sent';
                    } catch (Exception $e) {
                        error_reporting(0);
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        exit;
                    }
   

            
            
            //EMAIL INTERNO COMIENZA ACA
            
            
            
                //$scodigo_externo = $merchant_order->external_reference;
     $sql = 'SELECT  codigo_externo, fechahora_alta, fechahora_pago, sucursal_origen, descripcion_paquete,
			/*  5*/	dimensiones, peso, bultos, dias_entrega, nombres,
			/* 10*/	apellidos, tipo_documento, documento, telefono, otelefono,
            /* 15*/ mail, omail, calle, ocalle, numero,
			/* 20*/ onumero, piso, opiso, depto, odepto,
			/* 25*/ referencia_domicilio, oreferencia_domicilio, codigo_postal, ocodigo_postal, localidad_ciudad,
			/* 30*/ provincia, provincia_id_afip, sucursal_destino, tvdec, tcosto,
			/* 35*/ pieza_id, mp_merchant_order_id, mp_merchant_order_status, mp_merchant_order_paid_amount, mp_merchant_order_total_amount,
			/* 40*/ tusfacturas_pdf_url, olocalidad_ciudad, oprovincia, onombres, oapellidos,
			/* 45*/ otipo_documento, odocumento, sprovincia, snombres, sapellidos,
			/* 50*/ stipo_documento, sdocumento, stelefono, smail
                FROM tarifario_envios
                WHERE codigo_externo = "' . $scodigo_externo . '"';
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_array();
    } else {
        $error = "No se encontro pedido con codigo:" . $scodigo_externo;
        return;
    }
    $subject = "Pedido web facturado Cod.Externo:" . $scodigo_externo . " Nro.Pieza SISPO:" . $row[35];
	$text =
		"<h2><u>Pedido web facturado</u></h2>" .
		"Cod.Externo: <b>" . $scodigo_externo ."</b><br>" .
		"Nro.Pieza SISPO: <b>" . $row[35] . "</b><br><br>" .
		"Tiempo de Entrega: <b>" . $row[8] . "</b><br><br>" .

      //  "Factura: <a href='" . $row[40] . "'>" . $row[40] . "</a><br>" .
        "Detalle/s producto/s: <b>" . $row[54] . "</b> Modelo/s: <b>" . $row[4] . " </b><br><br>" .
		"Dimensiones: <b>" . $row[5] . "</b> Peso: <b>" . $row[6] . "</b><br><br>" .

		"<h2><u>RETIRO:</u></h2>".
		"Dirección: <b>" . $row[49] . "</b>,  Lugar: <b> MW Accesorios</b><br>" .
		"Nº de Orden del Pedido: <b>" . $idOrden . "</b><br><br>" .
		
		"<h2><u>DESTINO:</u></h2>" .
		"Calle: <b>" . $row[17] . "</b>,  Nro: <b>" . $row[19] . "</b>,  Piso: <b>" . $row[21] . "</b>,  Depto:<b>" . $row[23] . "</b><br>" .
//		"Referencia Domicilio: <b>'" . $row[25] . "'</b><br>" .
		"CP: <b>" . $row[27] . "</b>,  Localidad: <b>" . $row[29] . "</b>,  Provincia: <b>" . $row[30] . "</b><br>" .
		"<u>Destinatario:</u><br>" . 
		"Apellidos: <b>" . $row[10] . "</b>,  Nombres: <b>" . $row[9] . "</b><br>" .
		"Tipo Doc.: <b>" . $row[11] . "</b>,  Número Doc.: <b>" . $row[12] . "</b><br>" .
		"Teléfono: <b>" . $row[13] . "</b>,  Email: <b>" . $row[15] . "</b<br>";
    $error = "";
    $mail = new PHPMailer(true);
    try {
        $text = html_entity_decode($text);
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'tls'; // AUTH smtp login, insecure, no funciona con tls/ssl
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'quoted-printable';
        $mail->Username = 'intranetflash@gmail.com';
        $mail->Password = 'Abcd1234!'; // gmail USER APP password
        $mail->SetFrom('intranetflash@gmail.com', 'Logisiticas Integrales SA', 0);
        $subject = html_entity_decode($subject);
        $mail->Subject = $subject;
        $mail->Body = $text;
        $mail->AddAddress('trafico@correoflash.com');
        $mail->AddAddress('despachos@correoflash.com');
        $mail->AddAddress('logistica@correoflash.com');
        $mail->AddAddress('paqueteria@correoflash.com');
//        $mail->AddAddress('sistemas@correoflash.com');
        $mail->AddAddress('administracion2@correoflash.com');
//        $mail->AddAddress('ojeador6@gmail.com');
//        $mail->addBCC('ojeador6@gmail.com');
//        $mail->addBCC('sistemas@correoflash.com');
         $mail->send();
                        
                        //echo 'Message has been sent';
                    } catch (Exception $e) {
                        error_reporting(0);
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        exit;
                    }
            
            
            
            

?>
