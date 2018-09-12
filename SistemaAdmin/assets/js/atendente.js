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

//Mascaras
function aplicaMascara(objeto,func)
{
    v_obj=objeto;
    v_fun=func;
    setTimeout('execmascara()',1);
}

function execmascara()
{
    v_obj.value=v_fun(v_obj.value);
}

//Mascara CPF
function cpfMask(v)
{
    v=v.replace(/\D/g,"");

	v=v.replace(/(\d{3})(\d)/,"$1.$2");

	v=v.replace(/(\d{3})(\d)/,"$1.$2");

	v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2");

	return v;
}

function telMask(v)
{
	v=v.replace(/\D/g, "");

	v=v.replace(/(\d{0})(\d)/, "$1($2");

	v=v.replace(/(\d{2})(\d)/, "$1)$2");

	if(v[4].search(9) == 0)
	{
		v=v.replace(/(\d{5})(\d)/, "$1-$2");
	}
	else
	{
		v=v.replace(/(\d{4})(\d)/, "$1-$2");
	}

	return v;
}

function ageMask(v)
{
	v=v.replace(/\D/g, "");

	return v;
}

function goToHome()
{
	document.location.href="teste.html";
}

function showAgenda(method, file)
{
	var i = 0;
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			myFunction(this, i);
		}
	};
	xhttp.open(method, file, true);
	xhttp.send();
}

function myFunction(xml, i)
{
	var j;
	var print = "";
	var medico = "";
	var xmlDoc = xml.responseXML;
	x = xmlDoc.getElementsByTagName("Consulta");

	for(j = 0; j < x.length; j++)
	{
		medico = x[j].getElementsByTagName("medico")[0].childNodes[0].nodeValue;
		if(medico == document.getElementById("doctor-name-ver").value)
		{
			print += "Hora: ";
			print += x[j].getElementsByTagName("hora")[0].childNodes[0].nodeValue + "<br>";
			print += "Paciente: ";
			print += x[j].getElementsByTagName("paciente")[0].childNodes[0].nodeValue + "<br><br>";
		}
		else
		{
			print = "Nenhuma consulta encontrada";
		}
	}

	document.getElementById("_agenda").innerHTML = print;
}

function sair()
{
	window.location = "../front/login.html";
}

$(document).ready(function(){
	//Menu principal 1
    $("#cadastrar").click(function(){
		$("#cadastro").collapse('toggle');
		$("#agenda-div").collapse('hide');
	});

	//Menu secundario 1
	$("#doctor").click(function(){
		$("#doctor-div").collapse('show');
	});
	$("#patient").click(function(){
		$("#doctor-div").collapse('hide');
	});

	//Menu principal 2
	$("#agenda").click(function(){
		$("#agenda-div").collapse('toggle');
		$("#cadastro").collapse('hide');
	});

	//Menu secundario 2
	$("#agendar").click(function(){
		$("#agendar-div").collapse('toggle');
		$("#alterar-consulta-div").collapse('hide');
		$("#ver-agenda-medico-div").collapse('hide');
		$("#ver-agenda-paciente-div").collapse('hide');
		$("#resultado-consulta-pendente").collapse('hide');
	});
	$("#alterar-consulta").click(function(){
		$("#agendar-div").collapse('hide');
		$("#alterar-consulta-div").collapse('toggle');
		$("#ver-agenda-medico-div").collapse('hide');
		$("#ver-agenda-paciente-div").collapse('hide');
		$("#resultado-consulta-pendente").collapse('hide');
	});

	$("#confirmar-consulta").click(function(){
		$("#resultado-consulta-pendente").collapse('toggle');
		$("#agendar-div").collapse('hide');
		$("#alterar-consulta-div").collapse('hide');
		$("#ver-agenda-medico-div").collapse('hide');
		$("#ver-agenda-paciente-div").collapse('hide');
	});

	$("#ver-agenda-medico").click(function(){
		$("#ver-agenda-medico-div").collapse('toggle');
		$("#agendar-div").collapse('hide');
		$("#alterar-consulta-div").collapse('hide');
		$("#ver-agenda-paciente-div").collapse('hide');
		$("#resultado-consulta-pendente").collapse('hide');
	});

	$("#ver-agenda-paciente").click(function(){
		$("#agendar-div").collapse('hide');
		$("#ver-agenda-paciente-div").collapse('toggle');
		$("#alterar-consulta-div").collapse('hide');
		$("#ver-agenda-medico-div").collapse('hide');
		$("#resultado-consulta-pendente").collapse('hide');
	});


	$("#show_all_days").click(function(){
		$("#week_days").collapse('toggle');
	});
});
