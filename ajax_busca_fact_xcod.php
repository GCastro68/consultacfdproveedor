<?php
$fr = "1";
if ($fr == '') {
    $resp = "No se puede realizar la búsqueda sin RFC";
} else {
    $conn = pg_connect("host=pernominas.coppel.com dbname=facturafiscal user=sysinternet password=trny0011") or die("Error de Conexion");
    if ($area == "1") {
        $queryxcod = "select d.emisorrfc,d.folio,d.serie,d.foliofiscal,g.fechafactura from detallecfdmuebles d
        left join datoscfdgralmuebles g on g.foliofiscal=d.foliofiscal where codigo = $fcodigo and g.fechafactura <= '$ffecha' order by g.fechafactura desc limit 1";
        $bd = "proveedores";
        $host = "bdinternet.coppel.com";
    }
    if ($area == "2") {
        $queryxcod = "select d.e_rfc as emisorrfc,d.folio,d.serie,d.foliofiscal,g.fechafactura from cfd_detalle2 d
        left join cfd_general2 g on g.foliofiscal=d.foliofiscal where codigo = $fcodigo and g.fechafactura::date <= '$ffecha' order by g.fechafactura desc limit 1";
        $bd = "provropa";
        $host = "SCRMMX1PSQL0001.coppel.com";
    }
    $conn2 = pg_connect("host=$host dbname=$bd user=sysinternet password=82f96084e26db6299f73e442410e8557") or die("Error de Conexion 2");
    $execxcod = pg_query($conn2, $queryxcod);
    $nrxcod = pg_num_rows($execxcod);
    if ($nrxcod == 1) {
        $fr = trim(pg_fetch_result($execxcod, 0, "emisorrfc"));
        $ff = trim(pg_fetch_result($execxcod, 0, "folio"));
        $fs = trim(pg_fetch_result($execxcod, 0, "serie"));
        //$ffofi=strtoupper($ffofi);
        $consulta = "select keyx,emisorrfc,folio,serie,xml,version,foliofactura from faedatosproveedor where emisorrfc='$fr'";
        if ($ff != "") {
            $consulta .= " and folio=$ff ";
        }
        if ($fs != "") {
            $consulta .= " and serie='$fs' ";
        }
        if ($ffofi != "") {
            $consulta .= " and foliofactura='$ffofi' ";
        }
        $consulta .= "order by fecha desc limit 500 OFFSET 0";
        //echo $consulta; 
        $exec_consulta = pg_query($conn, $consulta);
        $nr = pg_num_rows($exec_consulta);
        if ($nr == 0) {
            $resp = "No se encontró información";
        } else {
            $resp = "<table border=\"3\" bordercolor=\"2169af\">
            <tr bgcolor=\"#2169af\" align=\"center\">
              <th  align=\"center\"><font color=\"#FFFFFF\" align=\"center\">FACTURA</font></th></tr>
           <tbody>";
            while ($ri = pg_fetch_array($exec_consulta)) {
                $dia = date("d");
                $mes = date("m");
                $year = date("Y");
                $lineatiempo = $dia * ($mes) * ($year - 1900);
                $campo1 = $ri['keyx'];
                $campo2 = $ri['folio'];
                $campo3 = $ri['serie'];
                $campo4 = $ri['foliofactura'];
                $factura = $ri['folio'] . "-" . $ri['serie'];
                if ($campo2 == 0) {
                    $factura = $campo4;
                }
                $camporfc = $ri['emisorrfc'];
                $campover = trim($ri['version']);
                $sesion = $campo1 . "%24" . $campo2 . "%24" . $lineatiempo;
                $href = "http://intranet.cln/factura/impresion/verfactura.php?sesion=$sesion";
                /*if($campover=="3.0" || $campover=="3.2")
                   {$href="http://10.44.15.35/factura/xsd/nvo/v3/index.php?sesion=$sesion";}   */
                //echo "factura:".$factura.$ri['folio']."-".$ri['serie'];
                $resp .= "<tr>
                        <td><div align=\"center\"><a href=\"$href\">$factura</a></div></td>
                       </tr>";
                // $resp="1|".pg_fetch_result($exec_consulta,0,'id_folio_coppel')."%24".pg_fetch_result($exec_consulta,0,'folio')."%24".$lineatiempo."|".trim(pg_fetch_result($exec_consulta,0,'version'));
            }
            $resp .= "</tbody></table>";
        }
    } else {
        $resp = "No se encontró información con ese código";
    }
}
echo $resp;
?>