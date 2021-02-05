<?php 
require '../vendor/autoload.php';
require 'funciones.php';
require 'post.php';

session_start();
if (!chkVersion(basename($_SERVER['PHP_SELF']))) {
    header('Location: https://sispo.com.ar/paqueteria/tarifario/nuevo.php');
}

//// ACA PONER LAS CREDENCIALES CORRECTAS DE MERCADOPAGO -ESTAS SON LAS MIAS FRAZAG@YMAIL.COM-
//MercadoPago\SDK::setClientId("4330909661122183");
//MercadoPago\SDK::setClientSecret("NXrBxJ2gVyyZYUuY3qMIGFUfq4vh3rQ4");

// Logisitcas Inegrales (user:logisticasintegrales@correoflash.com  password:flash@1975)
MercadoPago\SDK::setClientId("6624189892408979");
MercadoPago\SDK::setClientSecret("xHXtEn7El0ijP7t9U36X7rjbef0EirEp");

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
        
<section id="intro">
    <div class="intro-container">
      <div id="introCarousel" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <!-- Slide 1 -->
          <div class="item active">
            <div class="carousel-background"><img src="../img/slide00.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animated fadeInDown">CORREO FLASH LOGISTICA INTEGRALES SRL</h2>        
        <!--
            "GET /tarifario/nuevopendiente
                ?collection_id=4448265772
                &collection_status=in_process
                &preference_id=157596880-31cef696-3ffa-4729-885d-e7df84639dff
                &external_reference=MP_R2VWK2RRNE
                &payment_type=debit_card
                &site_id=MLA"
        -->
        <?php
            $codigo_externo = isset($_GET["external_reference"])? $_GET["external_reference"]:null;
            // $merchant_order_id = isset($_GET["merchant_order_id"])? $_GET["merchant_order_id"]:null;
            $MYSQLI_ERROR = "";
            if (empty(($MYSQLI_ERROR = conectar($mysqli)))){
                mysqli_set_charset($mysqli, "utf8");   
                $sql = 'SELECT codigo_externo, sucursal_origen, descripcion_paquete, dimensiones,
                        peso, bultos, dias_entrega, nombres, apellidos, tipo_documento, documento, telefono,
                        mail, calle, numero, piso, depto, referencia_domicilio, codigo_postal, localidad_ciudad, provincia, provincia_id_afip,
                        sucursal_destino, tvdec, tcosto, pieza_id, mp_merchant_order_id, mp_merchant_order_status,
                        mp_merchant_order_paid_amount, mp_merchant_order_total_amount, tusfacturas_pdf_url
                        FROM tarifario_envios
                        WHERE codigo_externo = "'.$codigo_externo.'"';
                $result = $mysqli->query($sql);
                if ($result->num_rows>0) {
                    $row = $result->fetch_array();
                    ?>
                    <h4> Su pedido aun no fue acreditado, cuando lo sea se le enviara la factura correspondiente a la direccion email <label class="labelmessage"><?php echo $row[12]; ?></label> <br>
                            Codigo Externo <label class="labelmessage"> <?php echo $codigo_externo; ?> </label>
                    </h4>
                    <?php                    
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