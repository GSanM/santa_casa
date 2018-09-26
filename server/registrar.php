<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
</head>
<body>
    
<?php

    require_once "Medico.php";
    require_once "Atendente.php";
    require_once "Consulta.php";
    require_once "Paciente.php";
    require_once "Horario.php";
    
    $atendente = new Atendente();
    
    $nome = $_POST['name'];
    $idade = $_POST['age'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $endereco = $_POST['address'];
    $telefone = $_POST['phone'];
    $senha = $_POST['password'];

    // Criando uma instancia de um Novo Paciente //
    $novo_paciente = new Paciente($cpf, $senha);

    // Inserindo os dados do Novo Paciente //
    $novo_paciente->nome = $nome;
    $novo_paciente->idade = $idade;
    $novo_paciente->endereco = $endereco;
    $novo_paciente->telefone = $telefone;
    $novo_paciente->email = $email;
        
    // Atendente é a responsável por cadastrar o Paciente //
    //
    if( $atendente->cadastrarPaciente($novo_paciente) ) {
        echo "<script>alert(\"Cadastro realizado com sucesso!\");
                window.location = \"../front/login.html\" </script>";
    } else {
        echo "<script>alert(\"Erro. Paciente já cadastrado.\");
                window.location = \"../front/registro.html\"</script>";
    }
?>