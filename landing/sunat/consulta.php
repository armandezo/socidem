<?php 
$token = 'apis-token-360.pOaErU0Bib0EE4I4dj5eDJLwL3M5PGGG';
$documento =  $_POST['ruc'];

$tipo_doc = strlen($documento);

// Iniciar llamada a API
$curl = curl_init();


    if($tipo_doc <= 8){
        // Buscar dni
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.apis.net.pe/v1/dni?numero=' . $documento,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
            'Referer: https://apis.net.pe/consulta-dni-api',
            'Authorization: Bearer ' . $token
            ),
        )); 
    }elseif ($tipo_doc >= 11) {

        // Buscar ruc sunat
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.apis.net.pe/v1/ruc?numero=' . $documento,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Referer: http://apis.net.pe/api-ruc',
            'Authorization: Bearer ' . $token
        ),
        ));
    }


$response = curl_exec($curl);

curl_close($curl);
// Datos de empresas según padron reducido
$empresa = json_decode($response);

echo json_encode($empresa);
 
	
?>
