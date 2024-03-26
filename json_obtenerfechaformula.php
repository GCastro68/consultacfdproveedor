<?php
	header ('Content-type: text/html; charset=utf-8');
	
	$json = new stdClass();
	$json->mensaje="Ok";
	$json->estado = 0;
		
	$dia=date("d");
	$mes=date("m");
	$year=date("Y");
	$variable = $dia*($mes)*($year-1900);	
	$json->fecha = $variable;
		
	echo json_encode($json);
?>