<?php
    require_once "../controller/LogicaAtendente.php";

    $paciente = new Paciente();
      
    $nome_paciente = $_POST['patient-name'];
    $nome_medico = $_POST['med-name'];
    $data = $_POST['appointment_day']; 
    $horario = $_POST['appointment_hour'];
    
    if( $paciente->adicionaConsulta($nova_consulta) ) {
        echo "<p><br>Agendado! Aguardando aprovação.</p>";
    } else {
        echo "<p><br>Erro. Não foi possivel agendar a consulta.</p>";
    }

?>