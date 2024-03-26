<?php

	/*ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);*/

	header ('Content-type: text/html; charset=utf-8');

	require_once '../administracion/utilidadesweb/librerias/data/odbcclient.php';
	require_once '../administracion/utilidadesweb/librerias/cnfg/conexiones.php';
	
	
	
	$fr			= isset($_GET['fr'])    ? $_GET['fr']    : '';
	$ff			= isset($_GET['ff'])       ? $_GET['ff']       : '';
	$fs = isset($_GET['fs'])     ? $_GET['fs']     : '';
	$ffofi		= isset($_GET['ffofi'])     ? $_GET['ffofi']     : '';
	$ffechaini	= isset($_GET['ffechaini'])      ? $_GET['ffechaini']      : '';
	$ffechafin	= isset($_GET['ffechafin'])      ? $_GET['ffechafin']      : '';
	
	$fr=strtoupper($fr);
	$fs=strtoupper($fs);
	//$ffofi=strtoupper($ffofi);

	
	$CDB = obtenConexion(DBFACTURAFISCALPOSTGRESQL);
	$estado = $CDB['estado'];	
	$cadenaconexion_facturasfiscal_postgresql = $CDB['conexion'];
	$mensaje = $CDB['mensaje'];
	if($estado != 0)
	{
		$json->mensaje=$mensaje;
		$json->estado=$estado;
		echo json_encode($json);
		exit;
	}
	try {
			$con = new OdbcConnection($cadenaconexion_facturasfiscal_postgresql);
			$con->open();
			$cmd = $con->createCommand();
			//echo("SELECT keyx, emisorrfc, folio, serie, xml, version, foliofactura FROM fun_obtienedatosfacturasproveedores ('$fr', '$ff', '$fs', '$ffofi', '$ffechaini', '$ffechafin')");
			//exit();
			$cmd->setCommandText("SELECT keyx, emisorrfc, folio, serie, xml, version, foliofactura FROM fun_obtienedatosfacturasproveedores ('$fr', '$ff', '$fs', '$ffofi', '$ffechaini', '$ffechafin')");
			
			
			$ds = $cmd->executeDataSet();
			$con->close();
			$ROWSS=0;
			
				if(sizeof($ds) > 0)
			
				{
					foreach ($ds as $fila)	
					{
							
						$respuesta->rows[$ROWSS]['cell'] = [
							$fila['keyx'],
							$fila['emisorrfc'],
							$fila['folio'],
							$factura = $fila['folio'] . "-" . $fila['serie'],
							$fila['serie'],
							$fila['xml'],
							$fila['version'],
							$fila['foliofactura']
						];	
							$ROWSS++;
							
							
					}
					
					$estado = 0;	
					$mensaje="Ok";		
				}
		
	}
	catch(exception $ex)
	{
		$mensaje="";
		$mensaje = $ex->getMessage();
		$estado=-2;
	}
		
	echo json_encode($respuesta);
	
?>