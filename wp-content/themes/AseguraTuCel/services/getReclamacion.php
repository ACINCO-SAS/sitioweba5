<?php

	$req = file_get_contents("php://input");
	//$req = json_decode($req);
	
    $APIKEY = $_POST["APIKEY"];
	$reclamacion_tradicional = $_POST["reclamacion_tradicional"];
	$min = $_POST["min"];
	$nombres = $_POST["nombres"];
	$apellidos = $_POST["apellidos"];
	$tipo = $_POST["tipo"];
	$numero = $_POST["numero"];
	$correo = $_POST["correo"];
	$id_Tipo_incidencia = $_POST["id_Tipo_incidencia"];
	$descripcion = $_POST["descripcion"];
	$archivo = $_POST["archivo"];
	
	//echo $APIKEY.', '.$reclamacion_tradicional.', '.$min.', '.$nombres.', '.$apellidos.', '.$tipo.', '.$numero.', '.$correo.', '.$id_Tipo_incidencia.', '.$descripcion.', '.$archivo;
	$str = split('archivo=', $req);
	$archivos = json_encode($str);
	echo $archivos;
?>