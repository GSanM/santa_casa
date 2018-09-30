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