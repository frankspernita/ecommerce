<?php


require __DIR__ . '/vendor/autoload.php';
//require __DIR__ . '/tarifario_lib/post.php';
//require __DIR__ . '/tarifario_lib/funciones.php';

///////////////poner el dato de cliente !!!!!!!!!!!!!!!!!!!!!


            MercadoPago\SDK::setAccessToken('APP_USR-8433831666289664-040122-f2aabf7b066375b3431bec97edd513d0-61911852');
            
            
            $host = "localhost";
            $basededatos = "sppfla5_ecommercev2";
            $usuariodb = "sppfla5";
            $clavedb = "Sentey@82.";
            
            $conexion = new mysqli($host, $usuariodb, $clavedb, $basededatos);

            $order = $_GET['orders_id'];
            ////
            /*
            El solicitante (este es el que se usa para facturar en mercadopago), estos datos empiezan son ssnombre, ssapellido etc.
            Luego tenes los datos del Origen: sonombre, soapellido, etc
            Y los datos del Destino: snombre, sapellido
            
            ///// CARGA DATOS DEL DESTINATARIO!!!
            */
            
            $resultados = mysqli_query($conexion,"SELECT order_price FROM orders as O WHERE O.orders_id = $order");
            
            $row = mysqli_fetch_array($resultados);

				$preference = new MercadoPago\Preference();
				$item = new MercadoPago\Item();
				$item->id = 1;
				$item->title = "Pago total";
				$item->quantity = 1;
				$item->currency_id = "ARS";
				$item->unit_price = 1;

				$preference->items = array($item);

				$preference->external_reference = $order;
				
				$preference->back_urls = array(
					"success" => "http://ecommercev2.sppflash.com.ar/pagos/tarifario_lib/nuevoconfirmado.php"
				);
				
				$preference->auto_return = "approved";

				# Save and posting preference
				$preference->save();
				?>
				    
		
				<script>
					window.location = '<?php echo $preference->init_point; ?>';
				</script>
