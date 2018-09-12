function sair()
{
	window.location = "../front/login.html";
}

$(document).ready(function(){
    $("#agenda").click(function(){
        $("#agenda_div").collapse('toggle');
        $("#cadastro_div").collapse('hide');
        $("#alt-cadastro").collapse('hide');
        $("#ver-historico-div").collapse('hide');
    });

    $("#perfil").click(function(){
        $("#cadastro_div").collapse('toggle');
        $("#agenda_div").collapse('hide');
        $("#alt-cadastro").collapse('hide');
        $("#ver-historico-div").collapse('hide');
    });

    $("#ver-historico").click(function(){
        $("#ver-historico-div").collapse('toggle');
        $("#cadastro_div").collapse('hide');
        $("#agenda_div").collapse('hide');
        $("#alt-cadastro").collapse('hide');
    });

    $("#alt-cadastro").click(function(){
        $("#agenda_div").collapse('hide');
        $("#cadastro_div").collapse('hide');
        $("#alt-cadastro_div").collapse('toggle');
        $("#ver-historico-div").collapse('hide');
    });

    $("#show_details").click(function(){
        $(".teste").collapse('toggle');
    });

    $("#show_all_days").click(function(){
		$("#week_days").collapse('toggle');
    });

});