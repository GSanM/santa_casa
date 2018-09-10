<?php
    
    session_start();
    $GLOBALS['cpf'] = $_POST['cpf'];
    $GLOBALS['senha'] = $_POST['password'];
    
    if($_POST['pac_doc'] == 'patient') {
        if(pacienteEhCadastrado()) {
            $_SESSION['id'] = 'paciente';
            $_SESSION['cpf'] = $GLOBALS['cpf'];
            $_SESSION['senha'] = $GLOBALS['senha'];
            header('location:../front/paciente.php');
        } else {
            session_destroy();
            echo "<script>alert(\"CPF ou Senha Incorretos!\");
                window.location = \"../front/login.html\"</script>";
        }
    }
    elseif($_POST['pac_doc'] == 'doctor') {
        if(medicoEhCadastrado()) {
            header('location:../front/medico.php');
        } else {
            session_destroy();
            echo "<script>alert(\"CPF ou Senha Incorretos!\");
                window.location = \"../front/login.html\"</script>";
        }
    }
    elseif($_POST['pac_doc'] == 'clerk') {    
        if(atendenteEhCadastrado()) {
            $_SESSION['id'] = 'atendente';
            $_SESSION['cpf'] = $GLOBALS['cpf'];
            $_SESSION['senha'] = $GLOBALS['senha'];
            header('location:../front/atendente.php');
        } else {
            session_destroy();
            echo "<script>alert(\"CPF ou Senha Incorretos!\");
                window.location = \"../front/login.html\"</script>";
        }
    }
    
    function pacienteEhCadastrado() { 
        $dom_xml = new DOMDocument();
        
        $dom_xml->load("database/Pacientes.xml");
        
        $pacientes = $dom_xml->getElementsByTagName( "Paciente" );
        foreach( $pacientes as $paciente ) {
            $cpfs = $paciente->getElementsByTagName("cpf");
            $cpf = $cpfs->item(0)->nodeValue;

            $senhas = $paciente->getElementsByTagName("senha");
            $senha = $senhas->item(0)->nodeValue;

            if($cpf == $GLOBALS['cpf'] && $senha == $GLOBALS['senha']) {
                $nomes = $paciente->getElementsByTagName("nome");
                $nome = $nomes->item(0)->nodeValue;
                
                $idades = $paciente->getElementsByTagName("idade");
                $idade = $idades->item(0)->nodeValue;
    
                $cpfs = $paciente->getElementsByTagName("cpf");
                $cpf = $cpfs->item(0)->nodeValue;
    
                $emails = $paciente->getElementsByTagName("email");
                $email = $emails->item(0)->nodeValue;
    
                $enderecos = $paciente->getElementsByTagName("endereco");
                $endereco = $enderecos->item(0)->nodeValue;
    
                $telefones = $paciente->getElementsByTagName("telefone");
                $telefone = $telefones->item(0)->nodeValue;
    
                $senhas = $paciente->getElementsByTagName("senha");
                $senha = $senhas->item(0)->nodeValue;

                $_SESSION['nome'] = $nome;
                $_SESSION['idade'] = $idade;
                $_SESSION['cpf'] = $cpf;
                $_SESSION['email'] = $email;
                $_SESSION['endereco'] = $endereco;
                $_SESSION['telefone'] = $telefone;
                $_SESSION['senha'] = $senha;

                return TRUE;
            }
        }
        return FALSE;
    }

    function medicoEhCadastrado() { 
        $dom_xml = new DOMDocument();
        
        $dom_xml->load("database/Medicos.xml");
        
        $medicos = $dom_xml->getElementsByTagName( "Medico" );
        foreach( $medicos as $medico ) {
            $cpfs = $medico->getElementsByTagName("cpf");
            $cpf = $cpfs->item(0)->nodeValue;

            $senhas = $medico->getElementsByTagName("senha");
            $senha = $senhas->item(0)->nodeValue;

            if($cpf == $GLOBALS['cpf'] && $senha == $GLOBALS['senha']) {
                $nomes = $medico->getElementsByTagName("nome");
                $nome = $nomes->item(0)->nodeValue;
                
                $idades = $medico->getElementsByTagName("idade");
                $idade = $idades->item(0)->nodeValue;
    
                $cpfs = $medico->getElementsByTagName("cpf");
                $cpf = $cpfs->item(0)->nodeValue;
    
                $emails = $medico->getElementsByTagName("email");
                $email = $emails->item(0)->nodeValue;
    
                $enderecos = $medico->getElementsByTagName("endereco");
                $endereco = $enderecos->item(0)->nodeValue;
    
                $telefones = $medico->getElementsByTagName("telefone");
                $telefone = $telefones->item(0)->nodeValue;
    
                $senhas = $medico->getElementsByTagName("senha");
                $senha = $senhas->item(0)->nodeValue;
    
                $crms = $medico->getElementsByTagName("crm");
                $crm = $crms->item(0)->nodeValue;

                $especialidades = $medico->getElementsByTagName("especialidade");
                $especialidade = $especialidades->item(0)->nodeValue;
    
                $horarios = $medico->getElementsByTagName("horarios");
                $horario = $horarios->item(0)->nodeValue;
    
                $segundas = $medico->getElementsByTagName("segunda");
                $segunda = $segundas->item(0)->nodeValue;
    
                $tercas = $medico->getElementsByTagName("terca");
                $terca = $tercas->item(0)->nodeValue;
    
                $quartas = $medico->getElementsByTagName("quarta");
                $quarta = $quartas->item(0)->nodeValue;
    
                $quintas = $medico->getElementsByTagName("quinta");
                $quinta = $quintas->item(0)->nodeValue;
    
                $sextas = $medico->getElementsByTagName("sexta");
                $sexta = $sextas->item(0)->nodeValue;
               
                $inicios_seg = $medico->getElementsByTagName("ini-expediente-seg");
                $inicio_expediente_seg = $inicios_seg->item(0)->nodeValue;
                
                $fins_seg = $medico->getElementsByTagName("fim-expediente-seg");
                $fim_expediente_seg = $fins_seg->item(0)->nodeValue;
    
                $inicios_ter = $medico->getElementsByTagName("ini-expediente-ter");
                $inicio_expediente_ter = $inicios_ter->item(0)->nodeValue;
                
                $fins_ter = $medico->getElementsByTagName("fim-expediente-ter");
                $fim_expediente_ter = $fins_ter->item(0)->nodeValue;
               
                $inicios_qua = $medico->getElementsByTagName("ini-expediente-qua");
                $inicio_expediente_qua = $inicios_qua->item(0)->nodeValue;
                
                $fins_qua = $medico->getElementsByTagName("fim-expediente-qua");
                $fim_expediente_qua = $fins_qua->item(0)->nodeValue;
    
                $inicios_qui = $medico->getElementsByTagName("ini-expediente-qui");
                $inicio_expediente_qui = $inicios_qui->item(0)->nodeValue;
       
                $fins_qui = $medico->getElementsByTagName("fim-expediente-qui");
                $fim_expediente_qui = $fins_qui->item(0)->nodeValue;
    
                $inicios_sex = $medico->getElementsByTagName("ini-expediente-sex");
                $inicio_expediente_sex = $inicios_sex->item(0)->nodeValue;
                
                $fins_sex = $medico->getElementsByTagName("fim-expediente-sex");
                $fim_expediente_sex = $fins_sex->item(0)->nodeValue;

                $_SESSION['nome'] = $nome;
                $_SESSION['idade'] = $idade;
                $_SESSION['cpf'] = $cpf;
                $_SESSION['email'] = $email;
                $_SESSION['endereco'] = $endereco;
                $_SESSION['telefone'] = $telefone;
                $_SESSION['senha'] = $senha;
                $_SESSION['crm'] = $crm;
                $_SESSION['especialidade'] = $especialidade;
                $_SESSION['ini-expediente-seg'] = $inicio_expediente_seg;
                $_SESSION['fim-expediente-seg'] = $fim_expediente_seg;
                $_SESSION['ini-expediente-ter'] = $inicio_expediente_ter;
                $_SESSION['fim-expediente-ter'] = $fim_expediente_ter;
                $_SESSION['ini-expediente-qua'] = $inicio_expediente_qua;
                $_SESSION['fim-expediente-qua'] = $fim_expediente_qua;
                $_SESSION['ini-expediente-qui'] = $inicio_expediente_qui;
                $_SESSION['fim-expediente-qui'] = $fim_expediente_qui;
                $_SESSION['ini-expediente-sex'] = $inicio_expediente_sex;
                $_SESSION['fim-expediente-sex'] = $fim_expediente_sex;

                if($inicio_expediente_seg == $inicio_expediente_ter && $inicio_expediente_ter == $inicio_expediente_qua && $inicio_expediente_qua == $inicio_expediente_qui && $inicio_expediente_qui == $inicio_expediente_sex) {
                    if($fim_expediente_seg == $fim_expediente_ter && $fim_expediente_ter == $fim_expediente_qua && $fim_expediente_qua == $fim_expediente_qui && $fim_expediente_qui == $fim_expediente_sex) {
                        $_SESSION['ini-all'] = $inicio_expediente_seg;
                        $_SESSION['fim-all'] = $fim_expediente_seg;
                    }
                } else {
                    $_SESSION['ini-all'] = "";
                    $_SESSION['fim-all'] = "";
                }


                return TRUE;
            }
        }
        return FALSE;
    }

    function atendenteEhCadastrado() { 
        if($GLOBALS['cpf'] == '000.000.000-00' && $GLOBALS['senha'] == 'admin')
            return TRUE;
        return FALSE;
    }
    
?>