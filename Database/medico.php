<?php

require_once "connectDB.php";

class Medico
{
    private $conn;

    function __construct()
    {
        $this->$conn = connectToDB('root', 'Dijkstra');
        $this->$conn->set_charset("utf8");
    }

    public function alteraCadastro($crm, $cpf, $nome, $data_nas, $email, $end, $tel, $especialidade, $senha, $cnpj_clinica)
    {
        $sql = "UPDATE medico SET nome=$nome, data_nas=$data_nas, email=$email, endereco=$end, telefone=$tel, especialidade=$especialidade, senha=$senha, cnpj_clinica=$cnpj_clinica WHERE crm = $crm";
       
        return submit($this->$conn, $sql);
    }

    public function veAgenda($crm)
    {
        $sql = "SELECT cpf_paciente, horario, data, clinica FROM consulta WHERE crm_medico = $crm";

        $result = $this->$conn->query($sql);
        if ($result->num_rows > 0)
        {   
            $i = 0;
            while($i < $result->num_rows)
            {
                //Procura nome do cliente pelo CPF
                $paciente = $result->fetch_assoc()['cpf_paciente'];
                
                $sql2 = "SELECT nome FROM paciente WHERE cpf = $paciente";
                
                $result2 = $this->$conn->query($sql2);
                if ($result2->num_rows > 0)
                {
                    echo $result2->fetch_assoc()['nome'];
                }
                else
                {
                    echo "Cliente não encontrado.";
                }
                
                //Procura nome da clinica pelo CNPJ
                $result = $this->$conn->query($sql);

                $clinica = $result->fetch_assoc()['clinica'];
                $sql3 = "SELECT nome FROM clinica WHERE cnpj = $clinica";
                
                $result3 = $this->$conn->query($sql3);
                if ($result3->num_rows > 0)
                {
                    echo $result3->fetch_assoc()['nome'];
                }
                else
                {
                    echo "Clinica não encontrada.";
                }
                $i += 1;
            }   
        }
        else
        {
            echo "Nenhuma consulta encontrada.";
        }
    }

    function __destruct()
    {
        $conn->close();
    }
}

?>