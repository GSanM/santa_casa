$(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });

    document.getElementById("iMedico").value = sessionStorage.getItem("nome_medico");
    document.getElementById("iClinica").value = sessionStorage.getItem("nome_clinica");
    document.getElementById("iData").value = sessionStorage.getItem("data");
  });

function getClinicasMedico() {
  var nome_medico = document.getElementById("iMedico").value;
  sessionStorage.setItem('nome_medico', nome_medico);

  document.getElementById("formAgendar").submit();

}

function getHorariosMedico() {
  var nome_medico = document.getElementById("iMedico").value;
  var nome_clinica = document.getElementById("iClinica").value;
  var data = document.getElementById("iData").value;

  sessionStorage.setItem('nome_medico', nome_medico);
  sessionStorage.setItem('nome_clinica', nome_clinica);
  sessionStorage.setItem('data', data);

  document.getElementById("formAgendar").submit();

}

function clearForm() {
  document.getElementById('iMedico').value = "";
  document.getElementById('iClinica').value = "";
  document.getElementById('iData').value = "";
  document.getElementById('iHorario').value = "";
}