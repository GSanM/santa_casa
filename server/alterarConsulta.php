<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
</head>
<body>
    <?php
        session_start();

        ini_set('display_error',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);

        require_once "Atendente.php";
        
        $atendente = new Atendente();

        $nome_paciente = $_POST['patient-name-alt'];
        $nome_medico = $_POST['doctor-name-alt'];

        $data_antiga = $_POST['appointment_day_alterar_antigo'];
        $horario_antigo = $_POST['appointment_hour_alterar_antigo'];
        $data_nova = $_POST['appointment_day_alterar_novo'];
        $horario_novo = $_POST['appointment_hour_alterar_novo'];
        $nome_medico_novo = $_POST['doctor-name-alterar'];


        if($atendente->alterarConsulta($nome_paciente, $nome_medico, $data_antiga, $horario_antigo, $data_nova, $horario_novo, $nome_medico_novo))
            echo "Consulta alterada com sucesso";
        else
            echo "Nao foi possivel alterar consulta";

        
    ?>
</body>
</html>