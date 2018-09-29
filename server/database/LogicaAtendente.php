<?php

require_once "connectDB.php";

class LogicaAtendente
{
    private $conn;

    function __construct()
    {
        $this->conn = connectToDB('root', 'Dijkstra');
        $this->conn->set_charset("utf8");
    }

    // ADICIONA
    public function adicionaPaciente($cpf, $nome, $data_nas, $email, $end, $tel, $usuario, $senha)
    {   
        $sql = "INSERT INTO paciente (cpf, nome, data_nas, email, endereco, telefone, senha, usuario) VALUES ('$cpf', '$nome', '$data_nas', '$email', '$end', '$tel', '$senha', '$usuario')";
    
        return submit($this->conn, $sql);
    }

    public function adicionaMedico($crm, $cpf, $nome, $data_nas, $email, $end, $tel, $especialidade, $usuario, $senha)
    {
        $sql = "INSERT INTO medico (crm, cpf, nome, data_nas, email, endereco, telefone, especialidade, senha, usuario) VALUES ('$crm', '$cpf', '$nome', '$data_nas', '$email', '$end', '$tel', '$especialidade', '$senha', '$usuario');";

        return submit($this->conn, $sql);
    }
    
    public function adicionaConsulta($crm_medico, $cpf_paciente, $horario, $data, $clinica)
    {
        $sql = "INSERT INTO consulta (crm_medico, cpf_paciente, horario, data, clinica) VALUES ('$crm_medico', '$cpf_paciente', '$horario', '$data', '$clinica')";

        $answer = submit($this->conn, $sql);
    }
    
    // ALTERA
    public function alteraPaciente($cpf, $nome, $data_nas, $email, $end, $tel, $usuario, $senha)
    {   
        $sql = "UPDATE paciente SET nome=$nome, data_nas=$data_nas, email=$email, endereco=$end, telefone=$tel, senha=$senha WHERE cpf = $cpf";
       
        return submit($this->conn, $sql);
    }
    
    public function alteraConsulta($id, $crm_medico, $cpf_paciente, $horario, $data, $clinica)
    {
        $sql = "UPDATE consulta SET crm_medico=$crm_medico, cpf_paciente=$cpf_paciente, horario=$horario, data=$data, clinica=$clinica WHERE id = $id";

        $answer = submit($this->conn, $sql);
    }

    // DELETA
    public function deletaPaciente($cpf)
    {   
        // Procura por consultas do paciente a ser deletado
        $sql = "SELECT * FROM consulta WHERE cpf_paciente = $cpf";
        $result = $this->conn->query($sql);

        // Caso não tenha consultas pendentes
        if($result->num_rows == 0)
        {
            $sql2 = "DELETE FROM paciente WHERE cpf = $cpf";
            return submit($this->conn, $sql2);
        }
        else
        {
            echo "O paciente não pôde ser deletado, pois tem consultas pendentes";
            return 0;
        }

    }

    public function deletaMedico($crm)
    {
        // Procura por consultas do medico a ser deletado
        $sql = "SELECT * FROM consulta WHERE crm_medico = $crm";
        $result = $this->conn->query($sql);

        // Caso não tenha consultas pendentes
        if($result->num_rows == 0)
        {
            $sql2 = "DELETE FROM paciente WHERE crm = $crm";
            return submit($this->conn, $sql2);
        }
        else
        {
            echo "O médico não pôde ser deletado, pois tem consultas pendentes";
            return 0;
        }
        
        return submit($this->conn, $sql);
    }
    
    public function deletaConsulta($id)
    {
        $sql = "DELETE FROM consulta WHERE id = $id";

        $answer = submit($this->conn, $sql);
    }

    function __destruct()
    {
        $this->conn->close();
    }

    public function verTodosMedicos()
    {
        $sql = "SELECT nome, especialidade FROM medico";

        $result = $this->conn->query($sql);
        if ($result->num_rows > 0)
        {   
            echo '  <head>
                        <link rel="stylesheet" type="text/css" href="database/table.css">
                    </head>';
            echo '<table class="table-fill">
                    <thead>
                        <tr>
                            <th class="text-left">Nome</th>
                            <th class="text-left">Especialidade</th>
                        </tr>
                    </thead>';
    
            while($row = $result->fetch_assoc())
            {
                $nome =  $row['nome'];
                $especialidade =  $row['especialidade'];

                echo "<tbody class=\"table-hover\">
                        <tr>
                            <td>$nome</td>
                            <td>$especialidade</td>";
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

}

?>