function validateEmail()
{
	var email = document.form_cadastro.email.value;
	atpos = email.indexOf("@");
	dotpos = email.lastIndexOf(".");
	
	if (atpos < 1 || ( dotpos - atpos < 2 )) 
	{
		alert("Por favor entre com um email válido");
		document.form_cadastro.email.focus();
		return false;
	}
	return(true);
}