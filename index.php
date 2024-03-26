<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<!--Hoja de estilos del calendario - PROBAR CRA de BITO -->
      <!--link rel="stylesheet" type="text/css" media="all" href="calendarionuevo/calendar-green.css" title="win2k-cold-1" /-->
<!-- DW6 -->

<!--Hoja de estilos del calendario -->
      <link rel="stylesheet" type="text/css" media="all" href="calendario/calendar-blue.css" title="win2k-cold-1" />

      <!-- librer?a principal del calendario -->
      <script language=javascript type="text/javascript" src="calendario/calendar.js"></script>

      <!-- librer?a para cargar el lenguaje deseado -->
      <script language=javascript type="text/javascript" src="calendario/calendar-es.js"></script>

      <!-- librer?a que declara la funci?n Calendar.setup, que ayuda a generar un calendario en unas pocas l?neas de c?digo -->
      <script language=javascript type="text/javascript" src="calendario/calendar-setup.js"></script>
	  

	<SCRIPT language="javascript" type="text/javascript" src="jquery/jquery-1.7.1.js"></SCRIPT>
	
	<link rel="stylesheet" type="text/css" media="screen" href="files/css/jquery-ui-1.8.18.custom.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="files/plugins/jqgrid/css/ui.jqgrid.css" />
	
	 <script src="files/plugins/jqgrid/js/i18n/grid.locale-es.js" type="text/javascript"></script>
    <script src="files/plugins/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>
	<SCRIPT language="javascript" type="text/javascript" src="class.ajax.js"></SCRIPT>

<link rel="stylesheet" href="ace-responsive.min.css" />

<link rel="stylesheet" href="ace-skins.min.css" />

<link rel="stylesheet" href="font-awesome.min.css" />
	
	
	<link rel="stylesheet" href="themes/base/jquery.ui.all.css">

	<script src="ui/jquery-ui-1.10.3.full.min.js"></script>
	<script src="ui/jquery.ui.core.js"></script>
	<script src="ui/jquery.ui.widget.js"></script>
	<script src="ui/jquery.ui.mouse.js"></script>
	<script src="ui/jquery.ui.draggable.js"></script>
	<script src="ui/jquery.ui.position.js"></script>
	<script src="ui/jquery.ui.resizable.js"></script>
	<script src="ui/jquery.ui.dialog.js"></script>
	
	<!--// PONE TAMAÑO DE LETRAS	//<link rel="stylesheet" href="css/demos.css">-->
	  
	  
	  
<head>
<meta http-equiv="Content-Type" content="text/html; ciso-8859-1">
<title>Untitled Document</title>
<link rel="stylesheet" href="emx_nav_left.css" type="text/css">

<link rel="stylesheet" href="css/modal.css" type="text/css">
<script src="js/animatedModal.min.js"></script>

<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
</style>
<script type="text/javascript">
function myFunction(){
	$("#demo01").animatedModal();
}

/////////////////// CLASE PARA AJAX ////////////////////////////////
    function createRequestObject() {
        var ro;
        var browser = navigator.appName;
        if(browser == "Microsoft Internet Explorer"){
            ro = new ActiveXObject("Microsoft.XMLHTTP");
        }else{
            ro = new XMLHttpRequest();
        }
        return ro;
    }
    
    var http = createRequestObject();
	
	var KEYX = 0;
	var FOLIO = 0;
	//$("#btn_cerrar").hide();
	//$('#btn_cerrar').css('display','none');
	
	
$(document).ready(function() {
  // Instrucciones a ejecutar al terminar la carga
  $("#btn_cerrar").hide();
  //document.getElementById("content").remove();
  $('#id_td').css('display','none');
  $('#contenido').css('display','none');
  //$('#content').css('display','none');
  $('#fechainicial').val('');
  $('#fechafinal').val('');
});
	
function bloquea(){
	f=document.forma;
	if($("#frfc").val() !=0)
	{
		//alert($("#lanzador01").val());
		//$("#lanzador02").css('display','block');
		//$('#lanzador1').attr('disabled', false);
		//$('#lanzador2').attr('disabled', false);
		
		 //onKeypress = "var tecla = (event.keyCode ? event.keyCode : event.which); if (tecla == '13') {if($("#frfc").val() !=0) {lanzador1.disabled=false;	lanzador2.disabled=false; foco('ffolio');}}"
		
		lanzador1.disabled=false;
		lanzador2.disabled=false;
		
		$('#fechainicial').val('');
		$('#fechafinal').val('');
		//document.getElementById('lanzador01').disabled = true;
	}
	else
	{
	
		$('#lanzador1').attr('disabled', true);
		$('#lanzador2').attr('disabled', true);
		document.getElementById("fechainicial").value=f.fechaactual.value;
		document.getElementById("fechafinal").value=f.fechaactual.value;
		$('#fechainicial').val('');
		$('#fechafinal').val('');
		//$('#facturas').css('display','none');
	}
}
	
	
	
////////////////////////////////////////////////////////////////////////
////////// Guarda Registro /////////////////////////////////////////////////////////////////////////
    function Buscar_Facts() {
        var f=document.getElementById('forma');
        var url=url;
		//$('#facturas').css('display','block');
                if($("#frfc").val()=="")
                  {
                  alert('Debe capturar al menos el rfc para poder hacer la b\u00fasqueda');
				  Limpiar_Datos();
                  f.frfc.focus();
                  return false;
                  }
				  //&& && f.ffolio.value != '' || f.fserie.value != '' || f.fffiscal.value != ''
				  //alert(document.getElementById('fechainicial').value);
				  //if($("#frfc").val() != "" && f.ffolio.value == "" || f.fserie.value == "" || f.fffiscal.value == "")
				  
					if(f.ffolio.value != '' || f.fserie.value != '' || f.fffiscal.value != '')
				  {
					$("#fechainicial").val('');
					$("#fechafinal").val('');
				  }
				  else
				  {
					$("#fechainicial").val();
					$("#fechafinal").val();
					if($("#fechafinal").val() == "" || $("#fechainicial").val() == "" )
					  {
						alert('Favor de seleccionar un rango de fechas v\u00e1lido');
						f.frfc.focus();
						return false;
					  }
				  }  
					
					if($("#fechainicial").val() > $("#fechafinal").val())
                  {
				  //alert($("#fechafinal").val());
                    alert('La fecha final es menor a la fecha inicial, seleccione fechas v\u00e1lidas para poder hacer la b\u00fasqueda');
                    f.frfc.focus();
                    return false;
                  }
				  
				
				  //alert(f.fechainicial.value);
					
					$("#id_td").css("display","none");
					jQuery("#gridFactura").GridUnload();
					jQuery("#gridFactura").jqGrid({
						url:'ajax_busca_fact.php?fr='+ encodeURIComponent(f.frfc.value) + '&ff=' + f.ffolio.value + '&fs=' + f.fserie.value + '&ffofi=' + f.fffiscal.value + '&ffechaini=' + f.fechainicial.value + '&ffechafin=' + f.fechafinal.value,
						datatype: 'json',
						closeAfterAdd: 'true',
						mtype: '_GET',
						colNames:['KEYX','EMISORRFC','FOLIO','FACTURA','SERIE','XML','VERSION','FOLIOFACTURA'],
						colModel:[//shrinkToFit: false -buscar funcionamiento
							{name:'KEYX', index:'KEYX', resizable:true, align:"center",width:110, sortable:false,autowidth: true,hidden:true},
							{name:'EMISORRFC', index:'EMISORRFC', resizable:true, align:"center",width:110, sortable:false,autowidth: true,hidden:true},
							{name:'FOLIO', index:'FOLIO', resizable:true, align:"center",width:110, sortable:false,autowidth: true,hidden:true},
							{name:'FACTURA', index:'FACTURA', resizable:true, align:"center",width:110, sortable:false,autowidth: true},
							{name:'SERIE', index:'SERIE', resizable:true, align:"center",width:110, sortable:false,autowidth: true,hidden:true},
							{name:'XML', index:'XML', resizable:true, align:"center",width:110, sortable:false,autowidth: true,hidden:true},
							{name:'VERSION', index:'VERSION', resizable:true, align:"center",width:110, sortable:false,autowidth: true,hidden:true},
							{name:'FOLIOFACTURA', index:'FOLIOFACTURA', resizable:true, align:"center",width:110, sortable:false,autowidth: true,hidden:true}
						],
					   // pager: '#pag',
						rowNum:-1,
						rowList:[],
						scrollrows: true,
						viewrecords: true,//es el texto de mostrado 1 - 2 de 2
						width: 100,//ancho
						height: 300,//altura
						hidegrid: false, 
						shrinkToFit: false,             
						//caption: 'Resultado de Consulta',
						loadComplete : function(data) {
						$("#id_td").css("display","block");
						ObtieneIp();
						registros = jQuery("#gridFactura").jqGrid('getGridParam', 'reccount');
							if(!registros)
							{
								alert("No se encontraron registros!");
								$("#id_td").css("display","none");
							}
							else
							{
								
							}
						
						},
						
						ondblClickRow: function(id){
							var Data = jQuery("#gridFactura").jqGrid('getRowData',id);
							KEYX = $.trim(Data.KEYX);
							FOLIO = $.trim(Data.FOLIO);
							//$("#div_modal_factura").dialog("open");
							obtenerFactura(KEYX,FOLIO);
							//myFunction();
							
						},
				   });
    }
	/*		CONSULTA FACTURA	*/
var DireccionIp = '';
var clave = 132; //clave de ip en tabla
	
function ObtieneIp()
{
	$.ajax({type: "POST",
	url: "json_ObtieneDireccionlp.php",
	data: {	
		'clave':clave}
		}).done(function(data){
		var dataJson = jQuery.parseJSON(data);
		if (dataJson.estado == 0)
		{
			 //message("OK");
			 DireccionIp = dataJson.ip;
		}
		 
	})
	.fail(function(s) {message("Error al cargar " + url ); $('#pag_content').fadeOut();})
	.always(function() {});
}
	
	
function obtenerFactura(FOLIO,FOLIO){
		$.ajax({type: "POST",
		url: "json_obtenerfechaformula.php",
		data: {}
			})
	.done(function(data){
		
		var dataJson = jQuery.parseJSON(data);
		var sesion = KEYX + "%24" + FOLIO + "%24" + dataJson.fecha;
		console.log(DireccionIp+"factura/impresion/verfactura.php?sesion="+ sesion);
		/*document.getElementById("form_factura").action="http://10.44.15.35/factura/xsd/nvo/index.php?sesion="+ sesion;
		document.getElementById("form_factura").submit();*/
		//$("#contenido").attr("src","http://10.44.15.35/factura/xsd/nvo/index.php?sesion="+ sesion);//			SI FUNCIONA
		$("#contenido").attr("src",DireccionIp+"factura/impresion/verfactura.php?sesion="+ sesion);	
		//$("#contenido").attr("src","http://intranet.cln/factura/impresion/verfactura.php?sesion="+ sesion);
		 $("#open").click();
		 $("#demo01").click();
		 $("#content").css('display','block');
		 $("#animatedModal").css('display','block');
		 $("#contenido").css('display','block');
		 
		 $("#btn_cerrar").show();
	})
		.fail(function(s) {message("Error al cargar " + url ); $('#pag_content').fadeOut();})
		.always(function() {});
}
	
    //////////////////////////////////////////////////////
    function foco(lmntid)
             {
               document.getElementById(lmntid).focus();            
             }
    //////////////////////////////////////////////////////
    function Limpiar_Datos(){
        f=document.forma;

            document.getElementById("frfc").value="";
            document.getElementById("ffolio").value="";
            document.getElementById("fserie").value="";
            document.getElementById("fffiscal").value="";
            //document.getElementById("fechainicial").value="";
            //document.getElementById("fechafinal").value="";
            document.getElementById("fechainicial").value=f.fechaactual.value;
            document.getElementById("fechafinal").value=f.fechaactual.value;
			bloquea();
			$('#id_td').css('display','none');
/*
            document.getElementById("divencabezadoregistros").innerHTML="";
            document.getElementById("divregistros").innerHTML="";*/
    }
	</script>
</head>

<body onLoad="foco('frfc');" >

 <!--Call your modal-->
    <a id="demo01" href="#animatedModal"  style ="visibility : hidden" TYPE="hidden">DEMO01</a>

    <!--DEMO01-->
    <div id="animatedModal" >
		
        <!--THIS IS IMPORTANT! to close the modal, the class name has to match the name given on the ID  class="close-animatedModal" -->
        <!--<div class="close-animatedModal"> 
            CLOSE MODAL
        </div>-->
            
        <div id="content" class="modal-content" >
                  <!--Your modal content goes here-->
				  
				  <iframe id="contenido" src="about:blank" style="position: fixed; width: 100%; height: 100%; top: 0px; left: 0px; overflow-y: auto;" ></iframe>
				  
        </div>
		<div id="content1" class="modal-content" align="center" style="position: fixed; z-index: 9999; width: 5%; height: 5%; right: 10px; overflow-y: auto;">
			<button id="btn_cerrar" class="close-animatedModal" style = "z-index: 9999;">Cerrar</button>
		</div>
	</div>

<input id="open" onClick="myFunction();"  style ="visibility : hidden" type="button" value='Open'/>
<input id="close" type="button" value='Close' style ="visibility : hidden"/>









<form action="impfact.php" method="post" enctype="multipart/form-data" name="forma" id="forma" target="_self">

<div id="masthead">
  <!--<h1 id="siteName"><a href="http://seguro.coppel.com/" ><font color="#FFFFFF">www.coppel.com</font></a></h1> -->
  <div id="globalNav">
    <img alt="" src="gblnav_left.gif" height="32" width="4" id="gnl"> <img alt="" src="glbnav_right.gif" height="32" width="4" id="gnr">
    <!--end globalLinks-->
  </div>
  <!-- end globalNav -->
 
</div>
<!-- end masthead -->
<div id="pagecell1">
  <!--pagecell1-->
  <img alt="" src="tl_curve_white.gif" height="6" width="6" id="tl"> <img alt="" src="tr_curve_white.gif" height="6" width="6" id="tr">
  <div id="pageName">
    <h2>Factura electr&oacutenica </h2>
    </div>
    
    
    <div class="feature"> <br>
      <table>
               <table width="100%">
                    <!--DWLayoutTable-->

                    <tr><td height="19" width="100%" colspan="3"><b>Buscar Facturas:<b></td></tr>
                    <tr>
					<INPUT TYPE="hidden" id="fechaactual" name='fechaactual' value="<?echo date('Y-m-d')?>" />
                        <td width="33%" height="26">Rfc:</td>
                        <td>Folio:</td>
                        <td>Serie:</td>
                        <td>Folio Fiscal:</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="frfc" id="frfc" onKeyUp = "bloquea()" size="14" maxlength="13" style="text-transform:uppercase">
                        </td>
                        <td>
                            <input type="text" name="ffolio" id="ffolio" size="10"  maxlength="20">
                        </td>    
                        <td valign="top">
                            <input type="text" name="fserie" id="fserie" style="text-transform:uppercase" size="12" maxlength="20">
                        </td>
                        <td valign="top">
                            <input type="text" name="fffiscal" id="fffiscal" size="36" maxlength="36">
                        </td>
                        <td width="55" valign="top" colspan="2" align="right">
                            <input type="button" onClick="Buscar_Facts();" value='Buscar'>
                        </td>
						
                    </tr>
                    <tr></tr><td></td>
                    <tr>
                        <td height='30' colspan="2" align='left'>
                        Fecha Inicial:&nbsp;
                            <input TYPE='text' id="fechainicial" NAME='fechainicial' size='11' value="<?echo date("Y-m-d H:i:s");?>" style='font-family:verdana; font-size:10px;' readonly>&nbsp;
                                
                            </input>
                            <input  id="lanzador1" type="image" disabled="true"  src="calendario/img.gif" />&nbsp;&nbsp;
                        </td>
                        <td colspan="2" >
                        Fecha Final:&nbsp;
                        <input TYPE='text' id="fechafinal" NAME='fechafinal' size='11' value="<?echo date("Y-m-d H:i:s");?>" style='font-family:verdana; font-size:10px;' readonly >&nbsp;
                        </input>
                        <input id="lanzador2" type="image"  disabled="true" src="calendario/img.gif" />
                            <script type="text/javascript">
                             //function date1(){
                                Calendar.setup({
                                    inputField:"fechainicial",// id del campo de texto
                                    ifFormat:"%Y-%m-%d 01:00",// formato de la fecha, cuando se escriba en el campo de texto
                                    button:"lanzador1"// el id del bot?n que lanzar? el calendario
                                });
                                //}
                            </script>
                        
                            <script type="text/javascript">
                               Calendar.setup({
                                    inputField:"fechafinal",// id del campo de texto
                                    ifFormat:"%Y-%m-%d 24:00",// formato de la fecha, cuando se escriba en el campo de texto
                                    button:"lanzador2"// el id del bot?n que lanzar? el calendario
                                });
                            </script>
                        </td>
                        
                        <td width="55" valign="top" colspan="2" align="right">
                            <input type="button" onClick="Limpiar_Datos();" value='Limpiar'>
                        </td>
                        
                    </tr>
                    
                    <tr><td  id="result" height="15" colspan="3" width="100%"> </td>

                    </tr>
                </table>
				
				<TABLE align='center'>
					<tr>
						<td id= "id_td">
							<br><br>
								<div id="tabla"/>
									<table id="gridFactura"></table>
								<div id="pag"> </div>
						</td>
					</tr>
				</TABLE>
				<!--<div id="div_modal_factura">
				</div>-->
					<!--<iframe id="content" src="about:blank" width="100%"  height='100%' style="border:none; z-index:10000 !important; left:500px;" ></iframe>-->
					
					<!--<iframe width="74" height="89" id="content" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>-->
				
				
				
                    <!--<iframe width=74 height=89 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendario/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>-->
       
        <!--<tr><td align="center" id="facturas">
     
      </td></tr>-->
     </table>
    
      <p>De click en el folio que desee consultar.</p>
     
     
      <p>&nbsp;
       </p>
    </div>
    
   <div id="siteInfo">     
     <div align="right"> | &copy;2005
      Coppel S.A de C.V. </div>
  </div>
</div>
<!--end pagecell1-->
<br>
</form>
<!--<iframe id="content" src="about:blank" width="1000"  height='940' style="border:none; z-index:10000 !important; left:500px;" ></iframe>-->

</body>
</html>

