<?php

require_once "../model/connectDB.php";

class Paciente
{
    private $conn;

    function __construct()
    {
        $this->conn = connectToDB('root', 'Dijkstra');
        $this->conn->set_charset("utf8");
    }

    public function veAgenda($cpf)
    {
        $sql = "SELECT crm_medico, horario, data, cnpj_clinica FROM consulta WHERE cpf_paciente = $cpf";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0)
        {   
            echo '  <head>
                        <link rel="stylesheet" type="text/css" href="../view/css/table.css">
                    </head>';
            echo '<table class="table-fill">
                    <thead>
                        <tr>
                            <th class="text-left">Data</th>
                            <th class="text-left">Hora</th>
                            <th class="text-left">Médico</th>
                            <th class="text-left">Clínica</th>
                        </tr>
                    </thead>';
    
            while($row = $result->fetch_assoc())
            {
                $data =  $row['data'];
                $hora =  $row['horario'];
                $medico = $row['crm_medico'];
                $clinica = $row['cnpj_clinica'];

                echo "<tbody class=\"table-hover\">
                        <tr>
                            <td>$data</td>
                            <td>$hora</td>";
                
                //Procura nome do medico pelo CRM
                $sql2 = "SELECT nome FROM medico WHERE crm = $medico";
                $result2 = $this->conn->query($sql2);
                
                if ($result2->num_rows > 0)
                {
                    $nome_medico = $result2->fetch_assoc()['nome'];
                    echo "<td class=\"text-left\">$nome_medico</td>";
                }
                else
                {
                    echo "Paciente não encontrado.";
                }
                $result2->close();
                
                //Procura nome da clinica pelo CNPJ
                $sql3 = "SELECT nome FROM clinica WHERE cnpj = $clinica";
                
                $result3 = $this->conn->query($sql3);
                if ($result3->num_rows > 0)
                {
                    $nome_clinica = $result3->fetch_assoc()['nome'];
                    echo "<td class=\"text-left\">$nome_clinica</td>";
                }
                else
                {
                    echo "Clinica não encontrada.";
                }
                $result3->close();
                
                echo '</tr>';
            }
            $result->close();
            echo '</tbody>
                </table>';  
        }
        else
        {
            echo "Nenhuma consulta encontrada.";
        }
    }

    public function adicionaConsulta($nome_medico, $nome_paciente, $horario, $data, $clinica)
    {
        //Buscar crm medico 

        $sql = "SELECT crm FROM medico WHERE nome = '$nome_medico'"; 
        $crm_consulta = $this->conn->query($sql);
        $result_crm = $crm_consulta->fetch_array()['crm'];

        //Buscar cpf paciente

        $sql = "SELECT cpf FROM paciente WHERE nome = '$nome_paciente'"; 
        $cpf_consulta = $this->conn->query($sql);
        $result_cpf = $cpf_consulta->fetch_array()['cpf'];

        $sql = "INSERT INTO consulta_pendente (crm_medico, cpf_paciente, horario, data, cnpj_clinica) VALUES ('$result_crm', '$result_cpf', '$horario', '$data', '$clinica')";

        return submit($this->conn, $sql);
    }

    function __destruct()
    {
        $this->conn->close();
    }
}

?>