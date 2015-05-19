function number(e){
	var num = window.event ? window.event.keyCode : e.which;
	if ((num == 8) || (num == 46))
	return true;
	 
	return /\d/.test(String.fromCharCode(num));
}

function letter(e){
    var tecla = window.event ? window.event.keyCode : e.which;
    if (tecla==8) return true;
    patron =/[A-Z a-z]/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}
<<<<<<< HEAD
=======

 



function comprueba_extension(formulario, archivo) { 
   extensiones_permitidas = new Array(".gif", ".jpg", ".png", ".jpeg"); 
   mierror = ""; 
   if (!archivo) { 
		return true;
   }else{ 
      //recupero la extensión de este nombre de archivo 
      extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase(); 
      //alert (extension); 
      //compruebo si la extensión está entre las permitidas 
      permitida = false; 
      for (var i = 0; i < extensiones_permitidas.length; i++) { 
         if (extensiones_permitidas[i] == extension) { 
         permitida = true; 
         break; 
         } 
      } 
      if (!permitida) { 
	  	 alert("Estension de archivo no permitida");
		 return false;
		 
      	}else{ 
         	//submito! 
         alert ("Todo correcto. Voy a submitir el formulario."); 
         formulario.submit(); 
         return true; 
      	} 
   } 
   //si estoy aqui es que no se ha podido submitir 
   alert ("Estension de archivo no permitida"); 
   return false; 
}






































>>>>>>> origin/master
