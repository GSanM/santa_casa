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

$(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });


  $(function() {
    
    $( ".dialog" ).click(function(){        
        $('#horarioMedico').html($(this).html()); 

        alert($(this).html);
    });
});

