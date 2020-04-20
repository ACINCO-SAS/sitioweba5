<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
    $URLGLOBAL = "http://190.248.157.219/tigo2/reclamacion_webservice.php";
    $URLGLOBALPRUEBAS = "http://190.248.157.219/tigo2/reclamacion_webservice.php";
    
    header("Access-Control-Allow-Origin:*");
    header('Access-Control-Allow-Headers: Content-Type');
    
    header('Content-Type: application/json');
    //$request = file_get_contents('php://input');
    $params = $_REQUEST;//json_decode($request, true);
    //$params =$params["data"];
    
    $archivo = explode(',', $params["archivo"][0]);
    $nameFile = $params["nombreArchivo"];
    /*$contentFile = $params["files"][1];
    $nameFile = $params["files"][0];
    //$file = $params["archivo"][0];
    $content = explode(';', $contentFile);
    $type = explode('/', $content[0])[1];
    $archivo = explode(',', $content[1])[1];
    //$name = 'archivoTemporal.'.$type;
    
    $ifp = fopen( $nameFile, 'wb' );
    //$data = explode( ',', $params["archivo"][0] );
    $data = explode(',', $contentFile);
    fwrite( $ifp, base64_decode( $data[1] ) );
    fclose( $ifp );*/
    
    //$cfile = "@".$name.';filename='.dirname(__FILE__)."/".$name;
    
    $dataSend["APIKEY"]='yNPlsmOGgZoGmH$6';
    $dataSend["reclamacion_tradicional"]="true";
    $dataSend["idCobertura"]="0";
    $dataSend["id_Tipo_incidencia"]=$params["tipoIncidencia"];
    $dataSend["descripcion"]=$params["descripcion"];
    $dataSend["archivoBase64"]=$archivo[1];
    $dataSend["nombreArchivoBase64"]=$nameFile;

    $dataSend["min"]=$params["numerocel"];
    $dataSend["apellidos"]=$params["apellidos"];
    $dataSend["correo"]=$params["correo"];
    $dataSend["nombres"]=$params["nombres"];
    $dataSend["numero"]=$params["numdocument"];
    $dataSend["tipo"]=$params["tipodocum"];
    //$dataSend["archivo"]=curl_file_create(dirname(__FILE__).'/'.$nameFile, $type ,$nameFile);
    
    //echo json_encode($dataSend);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $URLGLOBAL);
    //curl_setopt($ch, CURLOPT_URL, $URLGLOBALPRUEBAS);
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

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      header('Content-Type: application/json');
      echo $result;
    }
?>