<?php

require_once "connectDB.php";

foreach ($_POST as $key => $value) {
    if(eh_receita($key, $value)){
        $receita = $value;
        $count = get_counter_receita($key);

        $data = $_POST["data_consulta$count"];
        $hora = $_POST["hora_consulta$count"];
        $cpf_paciente = $_POST["cpf_paciente$count"];
        $cnpj_clinica = $_POST["cnpj_clinica$count"];
        $crm_medico = $_POST['crm'];

        $conn = connectToDB('root', 'Dijkstra');
        $conn->set_charset("utf8");
        
        $sql = "UPDATE consulta 
                SET receita = '$receita' 
                WHERE crm_medico = '$crm_medico' AND cpf_paciente = '$cpf_paciente' AND horario = '$hora' AND data = '$data' AND cnpj_clinica = '$cnpj_clinica'";
        
        submit($conn, $sql);

        $conn->close();
    }
}

########################################## functions ############################################
function eh_receita($key, $value) {
    if($value != "" && ("receita" == substr($key, 0, 7))){
        return 1;
    }
    return 0;
}

function get_counter_receita($key) {
    $counter = substr($key, 7, strlen($key));
    return $counter;
}

?>