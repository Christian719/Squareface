// Validar contraseña
function comprobarClave(){ 
   	var p1 = document.form_register.password1_new.value 
   	var p2 = document.form_register.password2.value 

   	var espacios = false;
	var cont = 0;
	 
	while (!espacios && (cont < p1.length)) {
	  if (p1.charAt(cont) == " ")
		espacios = true;
	  	cont++;
	}
	 
	if (espacios) {
	  alert ("La contraseña no puede contener espacios");
	  return false;
	}
	
	if (p1.length <= 5 || p2.length <= 5) {
	  alert("La contraseña debe tener al menos 6 caracteres");
	  return false;
	}
	
	if (p1 != p2) {
	  alert("Las passwords no coinciden");
	  return false;
	} else {
	  return true; 
	}		
} 

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
