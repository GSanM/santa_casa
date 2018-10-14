<?php

require_once "../controller/LogicaAtendente.php";

$atendente = new Atendente();

$cpf = $_POST['cpf'];
$nome = $_POST['name'];
$data_nas = $_POST['age'];
$email = $_POST['email'];
$endereco = $_POST['address'];
$telefone = $_POST['phone'];
$senha = $_POST['password'];
$usuario = $_POST['username'];

if($_POST['pac_doc'] == 'patient')
{
    if( $atendente->adicionaPaciente(preg_replace('/[^A-Za-z0-9]/', '', $cpf), $nome, $data_nas, $email, $endereco, $telefone, $usuario, $senha) ) 
    {
        echo "<script>alert(\"Cadastro realizado com sucesso!\");
                window.location = \"../front/atendente.php\" </script>";
    } 
    else 
    {
        echo "<script>alert(\"Erro. Paciente já cadastrado.\");
                window.location = \"../front/atendente.php\"</script>";
    }
}
elseif($_POST['pac_doc'] == 'doctor')
{
    $crm = $_POST['crm'];
    $especialidade = $_POST['spec'];

    if( $atendente->adicionaMedico($crm, preg_replace('/[^A-Za-z0-9]/', '', $cpf), $nome, $data_nas, $email, $endereco, $telefone, $especialidade, $usuario, $senha) ) 
    {
        echo "<script>alert(\"Cadastro realizado com sucesso!\");
             window.location = \"../front/atendente.php\" </script>";        
    } 
    else 
    {
        echo "<script>alert(\"Erro. Médico já cadastrado.\");
            window.location = \"../front/atendente.php\"</script>";
    }
}

?>