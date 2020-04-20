<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ClaimsApi {

    public function create($params, $files = []) {
        try {

            $mode = a5getOption('a5cinco_devmode','development');

            $urlGlobal = a5getOption('a5cinco_vtigo_apiurl_claims','');
            $urlGlobalTest = a5getOption('a5cinco_vtigo_api_test_url_claims','');

            $urlEndPoint = $mode === 'production' ? $urlGlobal : $urlGlobalTest;
            
            
            $dataSend["APIKEY"]                     = a5getOption('a5cinco_apikey_claims','yNPlsmOGgZoGmH$6');
            $dataSend["reclamacion_tradicional"]    = "true";
            $dataSend["idCobertura"]                = "0";

            $dataSend["id_Tipo_incidencia"] = $params["type_request"];
            $dataSend["descripcion"]        = $params["description"];

            if( count($files) > 0 ) {
                $i = 0;
                foreach($files as $file) {
                    $nameFile = basename($file['path']);
                    $path = $file['path'];
                    $type = $file['type'];

                    $cFile = function_exists('curl_file_create') ? curl_file_create($path,$type) : '@'.realpath($path);
                    
                    $dataSend['extraArchivos'.(++$i)] = $cFile;//"@$path;filename=$nameFile;type=$type";
                }
            }
    
            $dataSend["min"]        = $params["num_line"];
            $dataSend["apellidos"]  = $params["lastname"];
            $dataSend["correo"]     = $params["email"];
            $dataSend["nombres"]    = $params["fullname"];
            $dataSend["numero"]     = $params["dni"];
            $dataSend["tipo"]       = $params["type_dni"];
            $dataSend["origen"]     = $params["source"];
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $urlEndPoint);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: multipart/form-data'));
            curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);   
            curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);  
            curl_setopt($ch, CURLOPT_TIMEOUT, 100);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataSend);
    
            $result = curl_exec($ch);
            $err = curl_error($ch);

            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);
    
            if ($err) {
                throw new \Exception( a5error("cURL Error #:" . $err) );
            }
            if( $httpcode != 200 ) {
                throw new \Exception( $result );
            }
            return $result;
        } catch(\Exception $e) {
            return null;
        }
    }

    public static function base65file($pathFile) {
        $type = pathinfo($pathFile, PATHINFO_EXTENSION);
        $data = file_get_contents($pathFile);
        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
}