<?php

require_once "connectDB.php";

class Autenticador
{
    private $conn;

    function __construct()
    {
        $this->conn = connectToDB('root', 'Dijkstra');
        $this->conn->set_charset("utf8");
    }

    public function login($cpf, $senha, $cargo)
    {
        $sql = "SELECT * FROM $cargo WHERE cpf LIKE '$cpf' AND senha LIKE '$senha'";
        
        $result = $this->conn->query($sql);
        if ($result->num_rows == 1)
        {
            $row = $result->fetch_assoc();

            session_start();
            $_SESSION['id'] = $cargo;
            $_SESSION['cpf'] = $cpf;
            $_SESSION['senha'] = $senha;
            $_SESSION['nome'] = $row['nome'];
            $_SESSION['idade'] = $row['data_nas'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['endereco'] = $row['endereco'];
            $_SESSION['telefone'] = $row['telefone'];

            if ($cargo == 'medico')
            {
                $_SESSION['crm'] = $row['crm'];
                $_SESSION['especialidade'] = $row['especialidade'];
            } 
            elseif ($cargo == 'atendente') 
            {
                $_SESSION['cnpj_clinica'] = $row['cnpj_clinica'];
            }

            return 1;
        }
            
        return 0;
    }

    public function inicia_sessao($cpf)
    {
        $sql = "SELECT * FROM $cargo WHERE cpf LIKE '$cpf'";
        
        $result = $this->conn->query($sql);
        if ($result->num_rows == 1)
        {
            return 1;
        }
    }

}

?>