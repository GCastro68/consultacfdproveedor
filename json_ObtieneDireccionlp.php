<?php
	//session_name("Session-reembolsoscajachica"); 
	session_start();
	//$Session = $_POST['session_name'];
	header ('Content-type: text/html; charset=utf-8');
	
	//require("../../../utilidadesweb/core/LoadCore.php");
	require_once '../administracion/utilidadesweb/librerias/data/odbcclient.php';
	require_once '../administracion/utilidadesweb/librerias/cnfg/conexiones.php';
	
	 
	$CDB = obtenConexion(BDPERSONALSQLSERVER);
	$estado = $CDB['estado'];	
	$cadenaconexion = $CDB['conexion'];
	$mensaje = $CDB['mensaje'];	
	//$iMensaje = (isset($_POST['iMensaje']))?$_POST['iMensaje']:0;
	$json = new stdClass(); 
	$clave = isset($_POST['clave'])?$_POST['clave']:'';
	
	if($estado != 0)
	{
		$json->mensaje=$mensaje;
		$json->estado=$estado;
		echo json_encode($json);
		exit;
	}	
	try
	{
		$con = new OdbcConnection($cadenaconexion);
		$con->open();
		$cmd = $con->createCommand();		
		$cmd->setCommandText("{CALL  SAPACCESOSDATOS($clave)}");		 
	     $ds = $cmd->executeDataSet();
              
             //print_r($ds);

		$estado=0;
		$mensaje="Ok";	 
		$json->ip=$ds[0]['IP'];
		$con->close();
	}
	catch(exception $ex)
	{
		$mensaje="";
		$mensaje = $ex->getMessage();
		$estado=-2;
	}	 
	 
	$json->estado = $estado;
	$json->mensaje = $mensaje;	 
	echo json_encode($json);
	
?>