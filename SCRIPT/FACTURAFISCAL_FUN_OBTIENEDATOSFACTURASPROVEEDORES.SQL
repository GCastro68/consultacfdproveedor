DROP FUNCTION fun_obtienedatosfacturasproveedores(character varying, character varying, character varying, character varying, timestamp without time zone, timestamp without time zone);
 
CREATE OR REPLACE FUNCTION fun_obtienedatosfacturasproveedores(character varying, character varying, character varying, character varying, character varying, character varying)
  RETURNS SETOF typ_datosfacturasproveedores AS
$BODY$
DECLARE
/*
	NOMBRE              : Victor Manuel Vizcarra Bejarano 97295493
	BD                  : facturafiscal POSGRESQL
	FECHA               : 19/01/2017
	SERVIDOR PRUEBAS    : 10.44.15.182
	SERVIDOR PRODUCCION : 10.44.1.12
	DESCRIPCION         : Se encarga de 
	MODULO              : 
	RUTA                : svn://10.44.15.239/sysx/administracion/NominaGeneral/NOMG0010/SCRIPTS
*/
	sRfc 			ALIAS FOR $1;
	sFolio 			ALIAS FOR $2;
	sSerie 			ALIAS FOR $3;
	sFolioFacturaCFDI 	ALIAS FOR $4;
	sFechaInicio 		ALIAS FOR $5;
	sFechaFin 		ALIAS FOR $6;

	rRegistros typ_datosfacturasproveedores;
	sSQL VARCHAR;
BEGIN
	sSQL := 'SELECT keyx, emisorrfc, folio, serie, xml, version, foliofactura'
	|| ' FROM faedatosproveedor'
	|| ' WHERE emisorrfc = ''' || sRfc || ''' '
	|| ' AND receptorrfc = ''COP920428Q20'' ';

	IF(sFolio != '')
	THEN
		sSQL := sSQL || ' AND folio = ' || sFolio;
	END IF;

	IF(sSerie != '')
	THEN
		sSQL := sSQL || ' AND serie = ''' || sSerie || ''' ';
	END IF;

	IF(sFolioFacturaCFDI != '')
	THEN
		sSQL := sSQL || ' AND foliofactura = ''' || sFolioFacturaCFDI || ''' ';
	END IF;

	IF(sFechaInicio != '')
	THEN
		sSQL := sSQL || ' AND fecha BETWEEN ''' || sFechaInicio || ''' AND ''' || sFechaFin || ''' ';
	END IF;

	sSQL := sSQL || ' ORDER BY fecha DESC LIMIT 500 OFFSET 0 ';

	FOR rRegistros IN EXECUTE sSQL
			  
	LOOP
		RETURN NEXT rRegistros;
	END LOOP;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE SECURITY DEFINER;
  
  GRANT EXECUTE ON FUNCTION fun_obtienedatosfacturasproveedores(character varying, character varying, character varying, character varying, character varying, character varying) TO sysfactura;
COMMENT ON FUNCTION fun_obtienedatosfacturasproveedores(character varying, character varying, character varying, character varying, character varying, character varying) IS 'SE USA PARA OBTENER LOS DATOS DE PROVEEDORES,
sRfc = Valor del RFC,
sFolio = Numero del folio,
sSerie = Numero de la serie,
sFolioFacturaCFDI = Numero del folio fiscal,
sFechaInicio = Fecha inicio de la busqueda,
sFechaFin = fecha fin de la busquda';