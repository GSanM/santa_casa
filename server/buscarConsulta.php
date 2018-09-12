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

        if(!$atendente->buscarConsulta($nome_paciente, $nome_medico))
            exit(0);

        $_SESSION['nome_medico_antigo'] = $nome_medico;
        $_SESSION['nome_paciente'] = $nome_paciente;

        echo '';
        
    ?>
</body>
</html>