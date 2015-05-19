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
