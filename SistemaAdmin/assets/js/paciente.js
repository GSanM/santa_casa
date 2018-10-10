$(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });

    document.getElementById("iMedico").value = sessionStorage.getItem("nome_medico");
  });

function getClinicasMedico(x) {
  var nome_medico = document.getElementById("iMedico").value;
  sessionStorage.setItem('nome_medico', nome_medico);

  document.getElementById("formAgendar").submit();

}

/*
  $(function() {
    
    $( ".dialog" ).click(function(){        

        //alert($(this).text);
    });
});
*/