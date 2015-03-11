// Validar contraseña
function comprobarClave(){ 
   	var p1 = document.form_register.password1.value 
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
