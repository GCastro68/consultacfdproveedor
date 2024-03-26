<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<!-- DW6 -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<link rel="stylesheet" href="emx_nav_left.css" type="text/css">
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
</style>
<script type="text/javascript">
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
////////////////////////////////////////////////////////////////////////
function Envia_form(e){
	var key = window.event ? e.keyCode : e.which;
	if(key==13){
		Buscar_Facts();
		return(key!=13);
	}
}
////////// Guarda Registro /////////////////////////////////////////////////////////////////////////
	function Buscar_Facts() {
		var f=document.getElementById('forma');
        var url=url;       
                            if(f.area.value=="0")
				  {
				  alert('Debe capturar el area para poder hacer la busqueda');
				  f.codigo.focus();
				  return false;
				  }
                             
                             if(f.fecha.value=="")
				  {
				  alert('Capture la fecha de busqueda');
				  f.serie.focus();
				  return false;
				  }

				if(f.codigo.value=="")
				  {
				  alert('Debe capturar el codigo para poder hacer la busqueda');
				  f.codigo.focus();
				  return false;
				  }
                             
                               				
								  
				 // alert('ajax_busca_fact_xcod.php?fcodigo='+f.codigo.value+'&ffecha='+f.fecha.value+'&area='+f.area.value);
				  http.open('get', 'ajax_busca_fact_xcod.php?fcodigo='+f.codigo.value+'&ffecha='+f.fecha.value+'&area='+f.area.value);
				  http.onreadystatechange = respuestaBuscaFacts;
				  http.send(null);
				
				
         	
	}
	/////////////////////////////////////////////////////////////////////////////
	function respuestaBuscaFacts()
	          {
				  if(http.readyState==4)
				         {
							   if(http.status==200)
							      {
									 
									  var resp=http.responseText;
									  //alert(resp);
									  document.getElementById('facturas').innerHTML=resp;
									
									  }
								  else{
									    alert('Ha ocurrido un error,intente de nuevo');
										document.getElementById('facturas').innerHTML='';
										
										return false;
									  }	  
							 
							 }//fin if readystate
					 else
					     {
							 document.getElementById('facturas').innerHTML='<center><b>Buscando Factura...</b></center>';
							 }//fin else readystate
				  }
	//////////////////////////////////////////////////////
	function foco(lmntid)
	         {
		  
 document.getElementById(lmntid).focus();			 
			 }
</script>
</head>
<body onLoad="foco('codigo');" > 


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
    <h2>Factura electronica </h2> 
    </div> 
	
	 
    <div class="feature"> <br>
<form  name="forma" id="forma" >
      <table>
	     <tr><td>
	           <table width="100%">
	             <!--DWLayoutTable-->
			     
			       <tr><td height="19" width="100%" colspan="3"><b>Buscar Facturas:<b></td></tr>
                            <tr>
				       <td>Area:</td>
					   <td>
                                        <select name="area" id="area">
                                          <option value="0" selected>Seleccionar</option>
                                          <option value="1">Muebles</option>
                                          <option value="2">Ropa</option>
                                        </select>
                                     </td>
                                     <td></td>
				  </tr>
                             <tr><td colspan="3" height="5"></td></tr>

			       <tr>
				       <td>FECHA:</td>
					   <td> <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.getElementById('fecha'));return false;" >
							<img class="PopcalTrigger" align="absmiddle" src="calendario/calbtn.gif" width="34" height="22" border="0" alt="">
							</a></td><td></td>
				  </tr>
				  <tr>
				      <td colspan="3"><input type="text" name="fecha" id="fecha" maxlength="10" size="8" disabled="disabled"/></td>
				 </tr>

                             <tr>
				        
						<td>Codigo:</td>
						<td></td>
						<td></td>
				  </tr>
						<tr>
						<td><input type="text" name="codigo" id="codigo" size="8" maxlength="6" onkeypress=" return Envia_form(event);"></td>	
					       <td valign="top"></td> 
						<td width="55" valign="top"  align="right">
					        <input type="button" onClick="Buscar_Facts();" value='Buscar'>
						</td>
			       </tr>
						<tr><td  id="result" height="15" colspan="3" width="100%"> </td>
						  
						</tr>
				</table>
<iframe width=74 height=89 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendario/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">					</iframe>
		</td></tr>
		<tr><td align="center"><!--&Uacute;ltimas 500 facturas recibidas.--></td></tr>
		<tr><td align="center" id="facturas">
     
	  </td></tr>
	 </table>
	 </form>
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


</body>
</html>
