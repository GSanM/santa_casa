<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
</head>
<body>
    
<?php
    require_once "database/LogicaAtendente.php";

    $lAtendente = new LogicaAtendente();
    
    $nome = $_POST['name'];
    $data_nas = $_POST['age'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $endereco = $_POST['address'];
    $telefone = $_POST['phone'];
    $usuario = $_POST['username'];
    $senha = $_POST['password'];


    if($_POST['pac_doc'] == 'doctor') {
 
        $crm = $_POST['crm'];
        $especialidade = $_POST['spec'];
        $inicio_expediente = $_POST['appointment_hour_start_all'];
        $fim_expediente = $_POST['appointment_hour_end_all'];

        if($inicio_expediente == "") {
            $inicio_expediente_seg = $_POST['appointment_hour_start_mon'];
            $fim_expediente_seg = $_POST['appointment_hour_end_mon'];

            $inicio_expediente_ter = $_POST['appointment_hour_start_tue'];
            $fim_expediente_ter = $_POST['appointment_hour_end_tue'];

            $inicio_expediente_qua = $_POST['appointment_hour_start_wed'];
            $fim_expediente_qua = $_POST['appointment_hour_end_wed'];

            $inicio_expediente_qui = $_POST['appointment_hour_start_thu'];
            $fim_expediente_qui = $_POST['appointment_hour_end_thu'];

            $inicio_expediente_sex = $_POST['appointment_hour_start_fri'];
            $fim_expediente_sex = $_POST['appointment_hour_end_fri'];

        } else {
            $inicio_expediente_seg = $_POST['appointment_hour_start_all'];
            $fim_expediente_seg = $_POST['appointment_hour_end_all'];

            $inicio_expediente_ter = $_POST['appointment_hour_start_all'];
            $fim_expediente_ter = $_POST['appointment_hour_end_all'];

            $inicio_expediente_qua = $_POST['appointment_hour_start_all'];
            $fim_expediente_qua = $_POST['appointment_hour_end_all'];

            $inicio_expediente_qui = $_POST['appointment_hour_start_all'];
            $fim_expediente_qui = $_POST['appointment_hour_end_all'];

            $inicio_expediente_sex = $_POST['appointment_hour_start_all'];
            $fim_expediente_sex = $_POST['appointment_hour_end_all'];
        }

        // Atendente é a responsável por cadastrar o Médico //
        if( $lAtendente->adicionaMedico($crm, $cpf, $nome, $data_nas, $email, $endereco, $telefone, $especialidade, $usuario, $senha)) {
            echo "<script>alert('Medico Cadastrado.');
                window.location = '../front/atendente.php';</script>";
            
        } else {
            echo "<script>alert('Erro. Médico já cadastrado.');
                window.location = '../front/atendente.php';</script>";
        }
        return;
    } 
  

    // Atendente é a responsável por cadastrar o Paciente //
    if( $lAtendente->adicionaPaciente($cpf, $nome, $data_nas, $email, $endereco, $telefone, $usuario, $senha) ) {
        echo "<script>alert('Paciente Cadastrado.');
            window.location = '../front/atendente.php';</script>";
    } else {
        echo "<script>alert('Erro. Paciente já cadastrado.');
            window.location = '../front/atendente.php';</script>";
    }
    

    
  
    
   
?>

</body>
</html>