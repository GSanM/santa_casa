
<?php
    require_once "../controller/LogicaAtendente.php";

    $lAtendente = new Atendente();

    $nome     = $_POST['name'];
    $data_nas = $_POST['age'];
    $cpf      = $_POST['cpf'];
    $cpf = str_replace(".", "", $cpf);
    $cpf = str_replace("-", "", $cpf);
    $email    = $_POST['email'];
    $endereco = $_POST['address'];
    $telefone = $_POST['phone'];
    $usuario  = $_POST['username'];
    $senha    = $_POST['password'];


    if($_POST['pac_doc'] == 'doctor') {
        $crm           = $_POST['crm'];
        $especialidade = $_POST['spec'];

        // Atendente é a responsável por cadastrar o Médico //
        if( $lAtendente->adicionaMedico($crm, $cpf, $nome, $data_nas, $email, $endereco, $telefone, $especialidade, $usuario, $senha)) {
            echo "<script>alert('Medico Cadastrado.');
                window.location = '../front/atendente.php';</script>";
            
        } else {
            echo "<script>alert('Erro. Não foi possível registrar o Médico.');
                window.location = '../front/atendente.php';</script>";
        }
        
        return;
    } 
  

    // Atendente é a responsável por cadastrar o Paciente //
    if( $lAtendente->adicionaPaciente($cpf, $nome, $data_nas, $email, $endereco, $telefone, $usuario, $senha) ) {
        echo "<script>alert('Paciente Cadastrado.');
            window.location = '../front/atendente.php';</script>";
    } else {
        echo "<script>alert('Erro. Não foi possível registrar o Paciente.');
           window.location = '../front/atendente.php';</script>";
    }
    
?>

