<?php
    require_once "../controller/LogicaAtendente.php";
    require_once "../controller/LogicaPaciente.php";

    $paciente = new Paciente();
    
    $nome_paciente = $_POST['patient-name'];
    $nome_medico = $_POST['med-name'];
    $data = $_POST['appointment_day']; 
    $horario = $_POST['appointment_hour'];
    $clinica = $_POST['clinica'];

    if( $paciente->adicionaConsulta($nome_medico, $nome_paciente, $horario, $data, $clinica) ) {
        echo "<p><br>Agendado! Aguardando aprovação.</p>";
    } 
    else {
        echo "<p><br>Erro. Não foi possivel agendar a consulta. Verifique os dados novamente.</p>";
    }

?>