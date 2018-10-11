<?php   
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once "../controller/LogicaPaciente.php";
    require_once "../controller/LogicaAtendente.php";
    require_once "../model/connectDB.php";

    $lpaciente = new LogicaPaciente();
    $atendente = new Atendente();
    
    $conn = connectToDB('root', 'Dijkstra');
    $conn->set_charset("utf8");
    
    $nome_paciente = $_POST['patient-name-ver-agenda'];

    $crm = $atendente->get_crm_doctor_by_name($nome_medico);

    $lMedico->veAgenda(preg_replace('/[^A-Za-z0-9]/', '', $crm));


?>