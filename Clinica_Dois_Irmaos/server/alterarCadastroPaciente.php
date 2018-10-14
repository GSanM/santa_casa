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

    $novo_paciente = new Paciente($cpf, $senha);

    $novo_paciente->nome = $nome;
    $novo_paciente->idade = $idade;
    $novo_paciente->endereco = $endereco;
    $novo_paciente->telefone = $telefone;
    $novo_paciente->email = $email;

    if (empty($senha)) {
        echo "<script>alert(\"Por favor, insira a sua senha!\");</script>";
    }
    else if( $atendente->atualizarCadastroPaciente($novo_paciente) ) {
        echo "<p><br>Dados Atualizados.</p>";
    }
    else {
        echo "<p><br>Não foi possível atualizar o cadastro.</p>";
    }
?>
