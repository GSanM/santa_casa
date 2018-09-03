<?php

    require_once "Medico.php";
    require_once "Atendente.php";
    require_once "Consulta.php";
    require_once "Paciente.php";
    require_once "Horario.php";

    $atendente = new Atendente();
    session_start();
    $nome = $_POST['name'];
    $idade = $_POST['age'];
    $cpf = $_SESSION['cpf'];
    $email = $_POST['email'];
    $endereco = $_POST['address'];
    $telefone = $_POST['phone'];
    $senha = $_POST['password'];

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

    /* Criando uma instancia de um Novo Médico */
    $novo_medico = new Medico($cpf, $senha);

    /* Inserindo os dados do Novo Médico */
    $novo_medico->nome = $nome;
    $novo_medico->idade = $idade;
    $novo_medico->endereco = $endereco;
    $novo_medico->telefone = $telefone;
    $novo_medico->email = $email;
    $novo_medico->crm = $crm;
    $novo_medico->especialidade = $especialidade;

    $novo_medico->inicio_expediente_seg = $inicio_expediente_seg;
    $novo_medico->fim_expediente_seg = $fim_expediente_seg;    

    $novo_medico->inicio_expediente_ter = $inicio_expediente_ter;
    $novo_medico->fim_expediente_ter = $fim_expediente_ter;    

    $novo_medico->inicio_expediente_qua = $inicio_expediente_qua;
    $novo_medico->fim_expediente_qua = $fim_expediente_qua;    

    $novo_medico->inicio_expediente_qui = $inicio_expediente_qui;
    $novo_medico->fim_expediente_qui = $fim_expediente_qui;    
    
    $novo_medico->inicio_expediente_sex = $inicio_expediente_sex;
    $novo_medico->fim_expediente_sex = $fim_expediente_sex;   
    

    if( $atendente->atualizarCadastroMedico($novo_medico) ) {
        echo "<p><br>Dados Atualizados.</p>";
    } else {
        echo "<p><br>Não foi possível atualizar o Cadastro.</p>";
    }
    

?>