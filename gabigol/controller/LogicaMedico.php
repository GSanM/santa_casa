<?php

require_once "../model/connectDB.php";

class LogicaMedico
{
    private $conn;

    function __construct()
    {
        $this->conn = connectToDB('root', 'Dijkstra');
        $this->conn->set_charset("utf8");
    }

    public function vePerfil($crm)
    {
        $sql = "SELECT * FROM medico WHERE crm = $crm";

        $result = $this->conn->query($sql);
        if ($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            
            $crm =  $row['crm'];
            $cpf =  $row['cpf'];
            $nome = $row['nome'];
            $data_nas = $row['data_nas'];
            $email =  $row['email'];
            $end =  $row['endereco'];
            $tel = $row['telefone'];
            $especialidade = $row['especialidade'];

            $array = ["crm" => $crm,
                        "cpf" => $cpf, 
                        "nome" => $nome, 
                        "data_nas" => $data_nas,
                        "email" => $email, 
                        "endereco" => $end, 
                        "telefone" => $tel,
                        "especialidade" => $especialidade];
            
            return $array;
        }
    }
    
    public function alteraPerfil($crm, $cpf, $nome, $data_nas, $email, $end, $tel, $especialidade, $senha, $cnpj_clinica)
    {
        $sql = "UPDATE medico SET nome=$nome, data_nas=$data_nas, email=$email, endereco=$end, telefone=$tel, especialidade=$especialidade, senha=$senha, cnpj_clinica=$cnpj_clinica WHERE crm = $crm";
       
        return submit($this->conn, $sql);
    }

    public function veAgenda($crm)
    {
        $sql = "SELECT cpf_paciente, horario, data, cnpj_clinica FROM consulta WHERE crm_medico = $crm";

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
                            <th class="text-left">Paciente</th>
                            <th class="text-left">Clínica</th>
                        </tr>
                    </thead>';
    
            while($row = $result->fetch_assoc())
            {
                $data =  $row['data'];
                $hora =  $row['horario'];
                $paciente = $row['cpf_paciente'];
                $clinica = $row['cnpj_clinica'];

                echo "<tbody class=\"table-hover\">
                        <tr>
                            <td>$data</td>
                            <td>$hora</td>";
                
                //Procura nome do cliente pelo CPF
                $sql2 = "SELECT nome FROM paciente WHERE cpf = $paciente";
                $result2 = $this->conn->query($sql2);
                
                if ($result2->num_rows > 0)
                {
                    $nome_paciente = $result2->fetch_assoc()['nome'];
                    echo "<td class=\"text-left\">$nome_paciente</td>";
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

    public function veHistoricoPaciente($cpf)
    {
        $sql = "SELECT cpf_paciente, data, diagnostico, receita FROM consulta WHERE cpf_paciente = $cpf AND data < CURDATE()";

        $result = $this->conn->query($sql);
        if ($result->num_rows > 0)
        {   
            echo '  <head>
                        <link rel="stylesheet" type="text/css" href="../view/css/table.css">
                        <script src="../front/js/modal.js"></script>
                    </head>';
            echo '<table style="margin-top: 20px;" class="table-fill" id="table-historico">
                    <thead>
                        <tr>
                            <th class="text-left">Data</th>
                            <th class="text-left">Paciente</th>
                            <th class="text-left">Diagnóstico</th>
                            <th class="text-left">Receita</th>
                        </tr>
                    </thead>';
    
            while($row = $result->fetch_assoc())
            {
                $data =  $row['data'];
                $paciente = $row['cpf_paciente'];
                $diagnostico = $row['diagnostico'];
                $receita = $row['receita'];

                echo "<tbody class=\"table-hover\">
                        <tr>
                            <td>$data</td>";
                
                //Procura nome do cliente pelo CPF
                $sql2 = "SELECT nome FROM paciente WHERE cpf = $paciente";
                $result2 = $this->conn->query($sql2);
            
                if ($result2->num_rows > 0)
                {
                    $nome_paciente = $result2->fetch_assoc()['nome'];
                    echo "<td class=\"text-left\">$nome_paciente</td>";
                }
                else
                {
                    echo "<td class=\"text-left\">Paciente não encontrado.</td>";
                }
                $result2->close();
                
                echo "  <td>$diagnostico</td>
                        <td>$receita</td>";
                echo '</tr>';
            }
            $result->close();
            echo '</tbody>
                </table>';
        }
        else
        {
            echo "<p>O paciente não possui consultas anteriores.</p>";
        }
    }

    public function receitar($receita, $horario, $data)
    {
        $sql = "UPDATE consulta SET receita=$receita WHERE horario LIKE $horario AND data LIKE $data";
       
        return submit($this->conn, $sql);
    }

    public function diagnosticar($diagnostico, $horario, $data)
    {
        $sql = "UPDATE consulta SET diagnostico=$diagnostico WHERE horario LIKE $horario AND data LIKE $data";
       
        return submit($this->conn, $sql);
    }

    function __destruct()
    {
        $this->conn->close();
    }
}

?>