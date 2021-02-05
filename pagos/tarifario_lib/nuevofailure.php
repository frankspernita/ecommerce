<?php
require '../vendor/autoload.php';
require 'funciones.php';
//require 'post.php';
/*
session_start();
if (!chkVersion(basename($_SERVER['PHP_SELF']))) {
    header('Location: https://sispo.com.ar/paqueteria/tarifario/nuevo.php');
}*/
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
                
                
    <body>        
        <h4>Ocurrio un eror al acreditar su pago, ponganse en contacto.</h4>
        
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