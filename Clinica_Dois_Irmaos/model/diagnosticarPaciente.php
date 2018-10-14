<?php

require_once "connectDB.php";

foreach ($_POST as $key => $value) {
    if(eh_diagnostico($key, $value)){
        $diagnostico = $value;
        $count = get_counter_diagnostico($key);

        $data = $_POST["data_consulta$count"];
        $hora = $_POST["hora_consulta$count"];
        $cpf_paciente = $_POST["cpf_paciente$count"];
        $cnpj_clinica = $_POST["cnpj_clinica$count"];
        $crm_medico = $_POST['crm'];

        $conn = connectToDB('root', 'Dijkstra');
        $conn->set_charset("utf8");
        
        $sql = "UPDATE consulta 
                SET diagnostico = '$diagnostico' 
                WHERE crm_medico = '$crm_medico' AND cpf_paciente = '$cpf_paciente' AND horario = '$hora' AND data = '$data' AND cnpj_clinica = '$cnpj_clinica'";
        
        submit($conn, $sql);

        $conn->close();
    }
}

########################################## functions ############################################
function eh_diagnostico($key, $value) {
    if($value != "" && ("diagnostico" == substr($key, 0, 11))){
        return 1;
    }
    return 0;
}

function get_counter_diagnostico($key) {
    $counter = substr($key, 11, strlen($key));
    return $counter;
}

?>