/*
AJAX={

//   Funciones q implementan AJAX solo mandando la URL como parametro 

  ajax: "",

 contesta:function(url){

  if(window.XMLHttpRequest){//creaamos el control XMLHttpRequest segun el navegador que usemos
  
    ajax=new XMLHttpRequest(); //No Internet Explorer
   
    }else{

     ajax=new ActiveXObject("Microsoft.XMLHTTP");//Si Internet Explorer
  
   } //fin else window 

   //Almacenamos en el control la funcion que se llamara cuando la peticion cambie de estado
   ajax.open("GET",url+"ms="+new Date().getTime(),true);//se envia peticion
   ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
   ajax.onreadystatechange=consultar;
   ajax.send("");

 }//fin contesta

}//Fin Clase AJAX
*/

AJAX={

//   Funciones q implementan AJAX solo mandando la URL como parametro  

  ajax: "",

 contesta:function(url,parametros){

  if(window.XMLHttpRequest){//creaamos el control XMLHttpRequest segun el navegador que usemos
  
    ajax=new XMLHttpRequest(); //No Internet Explorer
   
    }else{

     ajax=new ActiveXObject("Microsoft.XMLHTTP");//Si Internet Explorer
  
   } //fin else window 

	var tiempo="&ms="+new Date().getTime();
   //Almacenamos en el control la funcion que se llamara cuando la peticion cambie de estado
   ajax.open("POST",url,true);//se envia peticion
   ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
   ajax.onreadystatechange=consultar;
   ajax.send(parametros+tiempo);

 }//fin contesta

}//Fin Clase AJAX
