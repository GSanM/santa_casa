<?php   

    require_once "../controller/LogicaAtendente.php";

    $atendente = new Atendente();

    $nome_paciente = $_POST['patient-name'];
    $nome_medico = $_POST['med-name'];
    $data = $_POST['appointment_day']; 
    $horario = $_POST['appointment_hour'];

    session_start();
    $clinica = $_SESSION['cnpj_clinica'];
    
    if( $atendente->adicionaConsulta($nome_medico, $nome_paciente, $horario, $data, $clinica ) ) {
        echo "<p><br>Agendamento realizado com sucesso.</p>";
    } else {
        echo "<p><br>Erro. Não foi possivel agendar a consulta.</p>";
    }
?>