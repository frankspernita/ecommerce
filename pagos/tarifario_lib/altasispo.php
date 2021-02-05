<?php
/*
$nombre_fichero = 'post.php';

if (file_exists($nombre_fichero)) {
    echo "El fichero $nombre_fichero existe";
} else {
    echo "El fichero $nombre_fichero no existe";
}

*/
require '../vendor/autoload.php';

require 'post.php';



// // Logisitcas Inegrales (user:logisticasintegrales@correoflash.com  password:flash@1975)

// MercadoPago\SDK::setClientId("6624189892408979");

// MercadoPago\SDK::setClientSecret("xHXtEn7El0ijP7t9U36X7rjbef0EirEp");

$ClientId = "";

$ClientSecret = "";

getMercadoPagoTokens($ClientId, $ClientSecret);

MercadoPago\SDK::setClientId($ClientId);

MercadoPago\SDK::setClientSecret($ClientSecret);



function altasispo($merchant_order, &$row, &$error)

{

    $row = null;

    $error = "";

    $pieza_id = null;

    if (empty(($error = conectar($mysqli)))) {

        mysqli_set_charset($mysqli, "utf8");

        //$merchant_order = MercadoPago\MerchantOrder::find_by_id($merchant_order_id);

        $codigo_externo = $merchant_order->external_reference;

        //incrustar la consulta mas larga de la vida ....

        $sql = 'SELECT codigo_externo, sucursal_origen, descripcion_paquete, dimensiones,  /* 0, 1, 2, 3 */

                peso, bultos, dias_entrega, nombres, apellidos, tipo_documento, documento, telefono, /* 4 ... 11 */

                mail, calle, numero, piso, depto, referencia_domicilio, codigo_postal, localidad_ciudad, provincia, provincia_id_afip, /* 12. 21 */

                sucursal_destino, tvdec, tcosto, pieza_id, mp_merchant_order_id, mp_merchant_order_status, /* 22 27*/

                mp_merchant_order_paid_amount, mp_merchant_order_total_amount, tusfacturas_pdf_url, /* 28 30 */

                tcosto_neto, tcosto_iva, tcosto_aseg /*31 33*/

                FROM tarifario_envios

                WHERE codigo_externo = "' . $codigo_externo . '"';

        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {

            $row = $result->fetch_array();

            if ($merchant_order->paid_amount - $merchant_order->refunded_amount >= $merchant_order->total_amount) {

                $sispo_token = sispo_get_token($error);

                $arr = array(

                    "access_token" => $sispo_token,

                    "sucursal_origen" => $row[1],

                    "codigo_externo" => $row[0],

                    "descripcion_paquete" => empty($row[2]) ? "-" : $row[2],

                    "dimensiones" => empty($row[3]) ? "-" : $row[3],

                    "peso" => $row[4],

                    "bultos" => empty($row[5]) ? "-" : $row[5],

                    "dias_entrega" => empty($row[6]) ? "-" : $row[6],

                    "nombres" => $row[7],

                    "apellidos" => $row[8],

                    "tipo_documento" => $row[9],

                    "documento" => $row[10],

                    "telefono" => $row[11],

                    "mail" => $row[12],

                    "calle" => $row[13],

                    "numero" => $row[14],

                    "piso" => $row[15],

                    "depto" => $row[16],

                    "referencia_domicilio" => $row[17],

                    "codigo_postal" => $row[18],

                    "localidad_ciudad" => $row[19],

                    "provincia" => $row[20],

                            // provincia_id_afip --

                    "sucursal_destino" => $row[22]

                );

                $res = CallAPI("POST", "https://clientes.sispo.com.ar/api/envios", $arr);

                if ($res) {

                    $arrres = json_decode($res, true);

                    if (isset($arrres["codigo"])) {

                        if ($arrres["codigo"] == 200) {

                            date_default_timezone_set("America/Argentina/Tucuman");

                            $now = new DateTime();

                            $fechahora_pago = $now->format('YmdHis');

                            $pieza_id = $arrres["pieza_id"];

                            $codext = $arrres["codigo_externo"];

                            $sql = 'UPDATE tarifario_envios

                                    SET fechahora_pago=\'' . $fechahora_pago . '\', pieza_id=' . $pieza_id . ', mp_merchant_order_id=' . $merchant_order->id . ',

                                    mp_merchant_order_status=\'' . $merchant_order->status . '\',

                                    mp_merchant_order_paid_amount=' . $merchant_order->paid_amount . ',

                                    mp_merchant_order_total_amount=' . $merchant_order->total_amount . ' 

                                    WHERE codigo_externo LIKE \'' . $codext . '\'';

                            $result = $mysqli->query($sql);

                            if ($result) {

                                $error = "Nro. de pieza:" . $pieza_id . " cod.externo:" . $codext;

                                return true;

                            } else {

                                $error = "Ocurrio un error al actualizar tarifario_envios: " . $mysqli->error;

                            }

                        } else {

                            $error = "Ocurrio un error al conectar con SISPO!=200: " . isset($arrres["mensaje"]) ? $arrres["mensaje"] : "";

                        }

                    } else {

                        $error = "Ocurrio un error al conectar con SISPO: " . isset($arrres["mensaje"]) ? $arrres["mensaje"] : "";

                    }

                } else {

                    $error = "Ocurrio un error al tratar de conectar con SISPO.";

                }

            } else {

                $error = "No inesperado! order " . $merchant_order->id . " paid:" . $merchant_order->paid_amount . " total:" . $merchant_order->total_amount;

            }

        } else {

            $error = "No se encontro envio con codigo: " . $codigo_externo;

        }

    }

    return false;

}





?>