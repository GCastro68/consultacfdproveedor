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
////////// Guarda Registro /////////////////////////////////////////////////////////////////////////
	function Buscar_Facts() {
		var f=document.getElementById('forma');
        var url=url;
				if(f.frfc.value=="")
				  {
				  alert('Debe capturar al menos el rfc para poder hacer la busqueda');
				  f.frfc.focus();
				  return false;
				  }
				
				/*if(f.fserie.value=="")
				  {
				  alert('Capturar la serie de la factura');
				  f.serie.focus();
				  return false;
				  }*/
				  
				  
				  http.open('get', 'ajax_busca_fact.php?fr='+f.frfc.value+'&ff='+f.ffolio.value+'&fs='+f.fserie.value+'&ffofi='+f.fffiscal.value);
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
<body onLoad="foco('frfc');" > 
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
    <h2>Factura electronica </h2> 
    </div> 
	
	 
    <div class="feature"> <br>
   <h1>Temporalmente fuera de servicio</h1>
    </div> 
    
   <div id="siteInfo">     
     <div align="right"> | &copy;2005
      Coppel S.A de C.V. </div>
  </div> 
</div> 
<!--end pagecell1--> 
<br> 
</form>

</body>
</html>
