<?php

    require_once "Medico.php";
    require_once "Atendente.php";
    require_once "Consulta.php";
    require_once "Paciente.php";

    $atendente = new Atendente();
      
    $nome_paciente = $_POST['patient-name'];
    $nome_medico = $_POST['med-name'];
    $data = $_POST['appointment_day']; 
    $horario = $_POST['appointment_hour'];
    
    $nova_consulta = new Consulta($nome_paciente, $nome_medico, $data, $horario);

    if( $atendente->agendarConsultaPendente($nova_consulta) ) {
        echo "<p><br>Agendado! Aguardando aprovação.</p>";
    } else {
        echo "<p><br>Erro. Não foi possivel agendar a consulta.</p>";
    }

?>