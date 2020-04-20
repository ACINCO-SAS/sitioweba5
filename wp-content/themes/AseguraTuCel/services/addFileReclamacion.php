<?php
$code = 200;
$msg = 'OK';
try {

    $URLGLOBAL = "http://190.248.157.219/tigo2/reclamacion_webservice.php";
    $URLGLOBALPRUEBAS = "http://190.248.157.219/tigo2/reclamacion_webservice.php";
    
    header("Access-Control-Allow-Origin:*");
    header('Access-Control-Allow-Headers: Content-Type');
    
    header('Content-Type: application/json');
    $request = file_get_contents('php://input');
    $params = json_decode($request, true);
    //$params =$params["data"];
    $b64File = $params['file'][0];
    $archivo = explode(',', $b64File);
    $nameFile = $params["archivo"];

    if( !(substr($b64File,0,20) === 'data:application/pdf') ) {
        throw new \Exception("File type not valid.", 406);
    }
    
    $dataSend["APIKEY"]='yNPlsmOGgZoGmH$6';
    $dataSend["moreFilesBase64"]='true';
    $dataSend["nombreArchivoBase64"]=$nameFile;
    $dataSend["numeroRadicacion"]=$params["radicado"];
    $dataSend["archivoBase64"]=$archivo[1];

	  //echo json_encode($dataSend);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $URLGLOBALPRUEBAS);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
    curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: multipart/form-data'));
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);   
    curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);  
    curl_setopt($ch, CURLOPT_TIMEOUT, 100);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataSend); 

    $result = curl_exec ($ch);
    $err = curl_error($ch);
    curl_close($ch);

    if ( $err ) {
        throw new \Exception("Error while it was sending the file. Try again later.", 502);
    }
    header("Content-Type: application/json");
    header("HTTP/1.1 $code $msg");
    echo $result;
} catch(\Exception $e) {
    $msg = $e->getMessage();
    $code = $e->getCode();
    header("HTTP/1.1 $code $msg");
}
exit;
?>