$(document).ready(function(){
	//Menu principal 1
    $("#ver-perfil").click(function(){
		$("#perfil").collapse('toggle');
        $("#agendar-div").collapse('hide');
        $("#minhas-consultas-div").collapse('hide');
    });

    $("#agendar").click(function(){
		$("#perfil").collapse('hide');
        $("#agendar-div").collapse('toggle');
        $("#minhas-consultas-div").collapse('hide');
    });

    $("#minhas-consultas").click(function(){
		$("#perfil").collapse('hide');
        $("#agendar-div").collapse('hide');
        $("#minhas-consultas-div").collapse('toggle');
    });
});