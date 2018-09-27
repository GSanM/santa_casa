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


if( $atendente->adicionaPaciente(preg_replace('/[^A-Za-z0-9]/', '', $cpf), $nome, $data_nas, $email, $endereco, $telefone, $senha) ) 
{
    echo "<script>alert(\"Cadastro realizado com sucesso!\");
            window.location = \"../front/login.html\" </script>";
} 
else 
{
    echo "<script>alert(\"Erro. Paciente já cadastrado.\");
            window.location = \"../front/registro.html\"</script>";
}
?>