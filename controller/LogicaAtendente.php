<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../model/connectDB.php";

class Atendente
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectToDB('root', 'Dijkstra');
        $this->conn->set_charset("utf8");
    }

    // ADICIONA
    public function adicionaPaciente($cpf, $nome, $data_nas, $email, $end, $tel, $usuario, $senha)
    {   
        $sql = "INSERT INTO paciente VALUES ($cpf, '$nome', '$data_nas', '$email', '$end', '$tel', '$usuario', '$senha')";
       
        return submit($this->conn, $sql);
    }

    public function adicionaMedico($crm, $cpf, $nome, $data_nas, $email, $end, $tel, $especialidade, $usuario, $senha)
    {
        
        $sql = "INSERT INTO medico VALUES ($crm, $cpf, '$nome', '$data_nas', '$email', '$end', '$tel', '$especialidade', '$usuario', '$senha')";
        $answer = submit($this->conn, $sql);
        $answer2 = $this->horariosMedico($crm);
        
        if($answer && $answer2)
            return 1;
        else
            return 0;
    }
    
    public function adicionaConsulta($crm_medico, $cpf_paciente, $horario, $data, $clinica)
    {
        $sql = "INSERT INTO consulta (crm_medico, cpf_paciente, horario, data, clinica) VALUES ($crm_medico, $cpf_paciente, '$horario', '$data', $clinica)";

        return submit($this->conn, $sql);
    }
    
    // ALTERA
    public function alteraPaciente($cpf, $nome, $data_nas, $email, $end, $tel, $senha)
    {   
        $sql = "UPDATE paciente SET nome='$nome', data_nas='$data_nas', email='$email', endereco='$end', telefone='$tel', senha='$senha' WHERE cpf = $cpf";
       
        return submit($this->conn, $sql);
    }
    
    public function alteraConsulta($id, $crm_medico, $cpf_paciente, $horario, $data, $clinica)
    {
        $sql = "UPDATE consulta SET crm_medico=$crm_medico, cpf_paciente=$cpf_paciente, horario='$horario', data='$data', clinica=$clinica WHERE id = $id";

        return submit($this->conn, $sql);
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

        return submit($this->conn, $sql);
    }

    public function horariosMedico($crm)
    {
        $sql = "INSERT INTO horarios (  crm_medico,
                                        seg8  , ter8  , qua8  , qui8  , sex8  ,
                                        seg9  , ter9  , qua9  , qui9  , sex9  ,
                                        seg10 , ter10 , qua10 , qui10 , sex10 ,
                                        seg11 , ter11 , qua11 , qui11 , sex11 ,
                                        seg12 , ter12 , qua12 , qui12 , sex12 ,
                                        seg13 , ter13 , qua13 , qui13 , sex13 ,
                                        seg14 , ter14 , qua14 , qui14 , sex14 ,
                                        seg15 , ter15 , qua15 , qui15 , sex15 ,
                                        seg16 , ter16 , qua16 , qui16 , sex16 ,
                                        seg17 , ter17 , qua17 , qui17 , sex17 ,
                                        seg18 , ter18 , qua18 , qui18 , sex18) 
                                        VALUES ($crm, 
                                        {$_POST['iseg8']},  {$_POST['iter8']},  {$_POST['iqua8']},  {$_POST['iqui8']},  {$_POST['isex8']},
                                        {$_POST['iseg9']},  {$_POST['iter9']},  {$_POST['iqua9']},  {$_POST['iqui9']},  {$_POST['isex9']},
                                        {$_POST['iseg10']}, {$_POST['iter10']}, {$_POST['iqua10']}, {$_POST['iqui10']}, {$_POST['isex10']},
                                        {$_POST['iseg11']}, {$_POST['iter11']}, {$_POST['iqua11']}, {$_POST['iqui11']}, {$_POST['isex11']},
                                        {$_POST['iseg12']}, {$_POST['iter12']}, {$_POST['iqua12']}, {$_POST['iqui12']}, {$_POST['isex12']},
                                        {$_POST['iseg13']}, {$_POST['iter13']}, {$_POST['iqua13']}, {$_POST['iqui13']}, {$_POST['isex13']},
                                        {$_POST['iseg14']}, {$_POST['iter14']}, {$_POST['iqua14']}, {$_POST['iqui14']}, {$_POST['isex14']},
                                        {$_POST['iseg15']}, {$_POST['iter15']}, {$_POST['iqua15']}, {$_POST['iqui15']}, {$_POST['isex15']},
                                        {$_POST['iseg16']}, {$_POST['iter16']}, {$_POST['iqua16']}, {$_POST['iqui16']}, {$_POST['isex16']},
                                        {$_POST['iseg17']}, {$_POST['iter17']}, {$_POST['iqua17']}, {$_POST['iqui17']}, {$_POST['isex17']},
                                        {$_POST['iseg18']}, {$_POST['iter18']}, {$_POST['iqua18']}, {$_POST['iqui18']}, {$_POST['isex18']})";
        return $this->conn->query($sql);
    }

    function __destruct()
    {
        $this->conn->close();
    }
}

?>