<?php

  $URLGLOBAL = "http://190.248.157.219/reclamaciones/ReclamacionServices.php";
  $URLGLOBALPRUEBAS = "http://190.248.157.219/tigo2/reclamacion_webservice.php";
  
  header("Access-Control-Allow-Origin:*");
  header('Access-Control-Allow-Headers: Content-Type');
      
  $request=file_get_contents('php://input');

  $params = json_decode($request, true);
  
  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    //CURLOPT_URL => $URLGLOBAL,
    CURLOPT_URL => $URLGLOBALPRUEBAS,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "get_requirements=1&documento=".$params["documento"],
    CURLOPT_HTTPHEADER => array(
      "cache-control: no-cache",
      "content-type: application/x-www-form-urlencoded"
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);
  
  curl_close($curl);
  
  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    echo $response;
  }

?>