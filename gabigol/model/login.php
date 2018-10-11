<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../controller/autenticador.php";

$autenticador = new Autenticador();


$cpf = $_POST['cpf'];
$senha = $_POST['password'];

if($_POST['pac_doc'] == 'patient') 
{
    if($autenticador->login(preg_replace('/[^A-Za-z0-9]/', '', $cpf), $senha, 'paciente'))
    {
        session_start();
        $_SESSION['cpf']   = $cpf;
        $_SESSION['senha'] = $senha;


        header("Location: ../front/paciente.php");
    }
    else 
    {
        session_destroy();
        echo "<script>alert(\"CPF ou Senha Incorretos!\");
            window.location = \"../front/login.html\"</script>";
    }
}
else if($_POST['pac_doc'] == 'doctor') 
{
    if($autenticador->login(preg_replace('/[^A-Za-z0-9]/', '', $cpf), $senha, 'medico'))
    {
        header('Location:../front/medico.php');
    } 
    else
    {
        session_destroy();
        echo "<script>alert(\"CPF ou Senha Incorretos!\");
            window.location = \"../front/login.html\"</script>";
    }
}
else if($_POST['pac_doc'] == 'clerk') 
{   
    if($autenticador->login(preg_replace('/[^A-Za-z0-9]/', '', $cpf), $senha, 'atendente')) 
    {
        //print_r($_SESSION);

        header("Location: ../front/atendente.php");
    }
}

?>