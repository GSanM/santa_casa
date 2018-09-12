<!DOCTYPE html>
<html>
<head>
    <title> Classe Atendente </title>
</head>
<body>
    <?php

        require_once "Paciente.php";
        require_once "Medico.php";
        require_once "Consulta.php";

        class Atendente {
            private $lista_consultas = array();
            private $lista_consultas_pendentes = array();
            private $lista_medicos = array();
            private $lista_pacientes = array();

            function __construct() {

                /* Ler os arquivos XML caso ele exista */
                /* Preencher as listas */

                if( file_exists('database/Medicos.xml') ) {
                    /* Se o arquivo Medicos.xml já existe, então carregue a lista de Medicos */
                    $this->lista_medicos = $this->getXMLMedicos();

                } else {
                    /* Se o arquivo não existe, então crie */
                    $dom_xml_medicos = new DOMDocument();
                    $root = $dom_xml_medicos->createElement("Medicos");
                    $root = $dom_xml_medicos->appendChild($root);

                    $file_medicos_xml = fopen("database/Medicos.xml", "w");
                    fwrite($file_medicos_xml, (string)$dom_xml_medicos->saveXML());
                    fclose($file_medicos_xml);
                }


                if( file_exists('database/Pacientes.xml') ) {
                    /* Se o arquivo Pacientes.xml já existe, então carregue a lista de Pacientes */
                    $this->lista_pacientes = $this->getXMLPacientes();

                } else {
                    /* Se o arquivo não existe, então crie */
                    $dom_xml_pacientes = new DOMDocument();

                    $root_xml_pacientes = $dom_xml_pacientes->createElement("Pacientes");
                    $root_xml_pacientes = $dom_xml_pacientes->appendChild($root_xml_pacientes);

                    $file_pacientes_xml = fopen("database/Pacientes.xml", "w");
                    fwrite($file_pacientes_xml, (string)$dom_xml_pacientes->saveXML());
                    fclose($file_pacientes_xml);
                }


                if( file_exists('database/Consultas.xml') ) {
                    /* Se o arquivo Consultas.xml já existe, então carregue a lista de Consultas */
                    $this->lista_consultas = $this->getXMLConsultas("database/Consultas.xml");

                } else {
                    /* Se o arquivo não existe, então crie */
                    $dom_xml_consultas = new DOMDocument();

                    $root_xml_consultas = $dom_xml_consultas->createElement("Consultas");
                    $root_xml_consultas = $dom_xml_consultas->appendChild($root_xml_consultas);

                    $file_consultas_xml = fopen("database/Consultas.xml", "w");
                    fwrite($file_consultas_xml, (string)$dom_xml_consultas->saveXML());
                    fclose($file_consultas_xml);
                }

                if( file_exists('database/ConsultasPendentes.xml') ) {
                    /* Se o arquivo Consultas.xml já existe, então carregue a lista de Consultas */
                    $this->lista_consultas = $this->getXMLConsultas("database/ConsultasPendentes.xml");
                } else {
                    /* Se o arquivo não existe, então crie */
                    $dom_xml_consultas_pendentes = new DOMDocument();

                    $root_xml_consultas_pendentes = $dom_xml_consultas_pendentes->createElement("Consultas");
                    $root_xml_consultas_pendentes = $dom_xml_consultas_pendentes->appendChild($root_xml_consultas_pendentes);

                    $file_consultas_pendentes_xml = fopen("database/ConsultasPendentes.xml", "w");
                    fwrite($file_consultas_pendentes_xml, (string)$dom_xml_consultas_pendentes->saveXML());
                    fclose($file_consultas_pendentes_xml);
                }
            }

            public function cadastrarPaciente ($novo_paciente) {
                foreach($this->lista_pacientes as $paciente) {
                    if($novo_paciente->getCPF() == $paciente->getCPF())
                        return 0;
                }

                /* Para ter chegado aqui, o paciente não existe */
                /* Portando, insira o novo paciente na lista de pacientes */
                $this->lista_pacientes[] = $novo_paciente;

                /* Criando um novo objeto DOM */
                $dom_xml = new DOMDocument();

                /* Para formatar o arquivo XML */
                $dom_xml->preserveWhiteSpace = false;
                $dom_xml->formatOutput = true;

                /* Carregando o arquivo .xml */
                /* No construtor já é verificado se o arquivo já existe */
                $dom_xml->load("database/Pacientes.xml");

                /* Para pegar o elemento root do XML */
                $root = $dom_xml->getElementsByTagName("Pacientes")[0];

                /* Criando um novo elemento <paciente> */
                $xml_novo_paciente = $dom_xml->createElement("Paciente");

                /* Criando atributos do paciente */
                $xml_nome = $dom_xml->createElement( "nome", $novo_paciente->nome );
                $xml_idade = $dom_xml->createElement( "idade", $novo_paciente->idade );
                $xml_cpf = $dom_xml->createElement( "cpf", $novo_paciente->getCPF() );
                $xml_email = $dom_xml->createElement( "email", $novo_paciente->email );
                $xml_endereco = $dom_xml->createElement( "endereco", $novo_paciente->endereco );
                $xml_telefone = $dom_xml->createElement( "telefone", $novo_paciente->telefone );
                $xml_senha = $dom_xml->createElement( "senha", $novo_paciente->getSenha() );

                /* Inserindo os atributos no paciente */
                $xml_novo_paciente->appendChild( $xml_nome );
                $xml_novo_paciente->appendChild( $xml_idade );
                $xml_novo_paciente->appendChild( $xml_cpf );
                $xml_novo_paciente->appendChild( $xml_email );
                $xml_novo_paciente->appendChild( $xml_endereco );
                $xml_novo_paciente->appendChild( $xml_telefone );
                $xml_novo_paciente->appendChild( $xml_senha );

                /* Inserindo novo medico na lista de medicos */
                $root->appendChild( $xml_novo_paciente );

                /* Gravando resultado no disco */
                $dom_xml->save('database/Pacientes.xml');

                return 1;
            }

            public function cadastrarMedico ($novo_medico) {

                // Verificando se o médico já existe //
                foreach($this->lista_medicos as $medico) {
                    if($novo_medico->getCPF() == $medico->getCPF())
                        return 0;
                }

                // Para ter chegado aqui, o médico não existe //
                // Portando, insira o novo médico na lista de médicos //
                $this->lista_medicos[] = $novo_medico;

                // Criando um novo objeto DOM //
                $dom_xml = new DOMDocument();

                // Para formatar o arquivo XML //
                $dom_xml->preserveWhiteSpace = false;
                $dom_xml->formatOutput = true;

                // Carregando o arquivo .xml //
                // No construtor já é verificado se o arquivo já existe //
                $dom_xml->load("database/Medicos.xml");

                // Para pegar o elemento root do XML //
                $root = $dom_xml->getElementsByTagName("Medicos")[0];

                // Criando um novo elemento <medico> //
                $xml_novo_medico = $dom_xml->createElement("Medico");

                // Criando atributos do médico //
                $xml_nome = $dom_xml->createElement( "nome", $novo_medico->nome );
                $xml_idade = $dom_xml->createElement( "idade", $novo_medico->idade );
                $xml_cpf = $dom_xml->createElement( "cpf", $novo_medico->getCPF() );
                $xml_email = $dom_xml->createElement( "email", $novo_medico->email );
                $xml_endereco = $dom_xml->createElement( "endereco", $novo_medico->endereco );
                $xml_telefone = $dom_xml->createElement( "telefone", $novo_medico->telefone );
                $xml_senha = $dom_xml->createElement( "senha", $novo_medico->getSenha() );
                $xml_crm = $dom_xml->createElement( "crm", $novo_medico->crm );
                $xml_especialidade = $dom_xml->createElement( "especialidade", $novo_medico->especialidade );

                $xml_horarios = $dom_xml->createElement( "horarios" );
                $xml_segunda = $dom_xml->createElement( "segunda" );
                $xml_terca = $dom_xml->createElement( "terca" );
                $xml_quarta = $dom_xml->createElement( "quarta" );
                $xml_quinta = $dom_xml->createElement( "quinta" );
                $xml_sexta = $dom_xml->createElement( "sexta" );

                // Inserindo as horas //
                $xml_hora_inicio_seg = $dom_xml->createElement( "ini-expediente-seg", $novo_medico->inicio_expediente_seg );
                $xml_hora_fim_seg = $dom_xml->createElement( "fim-expediente-seg", $novo_medico->fim_expediente_seg );
                $xml_hora_inicio_ter = $dom_xml->createElement( "ini-expediente-ter", $novo_medico->inicio_expediente_ter );
                $xml_hora_fim_ter = $dom_xml->createElement( "fim-expediente-ter", $novo_medico->fim_expediente_ter );
                $xml_hora_inicio_qua = $dom_xml->createElement( "ini-expediente-qua", $novo_medico->inicio_expediente_qua );
                $xml_hora_fim_qua = $dom_xml->createElement( "fim-expediente-qua", $novo_medico->fim_expediente_qua );
                $xml_hora_inicio_qui = $dom_xml->createElement( "ini-expediente-qui", $novo_medico->inicio_expediente_qui );
                $xml_hora_fim_qui = $dom_xml->createElement( "fim-expediente-qui", $novo_medico->fim_expediente_qui );
                $xml_hora_inicio_sex = $dom_xml->createElement( "ini-expediente-sex", $novo_medico->inicio_expediente_sex );
                $xml_hora_fim_sex = $dom_xml->createElement( "fim-expediente-sex", $novo_medico->fim_expediente_sex );

                $xml_segunda->appendChild($xml_hora_inicio_seg);
                $xml_segunda->appendChild($xml_hora_fim_seg);
                $xml_terca->appendChild($xml_hora_inicio_ter);
                $xml_terca->appendChild($xml_hora_fim_ter);
                $xml_quarta->appendChild($xml_hora_inicio_qua);
                $xml_quarta->appendChild($xml_hora_fim_qua);
                $xml_quinta->appendChild($xml_hora_inicio_qui);
                $xml_quinta->appendChild($xml_hora_fim_qui);
                $xml_sexta->appendChild($xml_hora_inicio_sex);
                $xml_sexta->appendChild($xml_hora_fim_sex);

                $xml_horarios->appendChild($xml_segunda);
                $xml_horarios->appendChild($xml_terca);
                $xml_horarios->appendChild($xml_quarta);
                $xml_horarios->appendChild($xml_quinta);
                $xml_horarios->appendChild($xml_sexta);

                // Inserindo os atributos no medico //
                $xml_novo_medico->appendChild( $xml_nome );
                $xml_novo_medico->appendChild( $xml_idade );
                $xml_novo_medico->appendChild( $xml_cpf );
                $xml_novo_medico->appendChild( $xml_email );
                $xml_novo_medico->appendChild( $xml_endereco );
                $xml_novo_medico->appendChild( $xml_telefone );
                $xml_novo_medico->appendChild( $xml_senha );
                $xml_novo_medico->appendChild( $xml_crm );
                $xml_novo_medico->appendChild( $xml_especialidade );
                $xml_novo_medico->appendChild( $xml_horarios );

                // Inserindo novo medico na lista de medicos //
                $root->appendChild( $xml_novo_medico );

                // Gravando resultado no disco
                $dom_xml->save('database/Medicos.xml');

                return 1;

            }

            public function agendarConsulta ($nova_consulta) {
                /* Verificando se a consulta já existe */
                if(in_array($nova_consulta, $this->lista_consultas))
                    return 0;

                /* Para ter chegado aqui, a consulta não existe */
                /* Portando, insira consulta na lista de médicos */
                $this->lista_consultas[] = $nova_consulta;

                /* Criando um novo objeto DOM */
                $dom_xml = new DOMDocument();

                /* Para formatar o arquivo XML */
                $dom_xml->preserveWhiteSpace = false;
                $dom_xml->formatOutput = true;

                /* Carregando o arquivo .xml */
                /* No construtor já é verificado se o arquivo já existe */
                $dom_xml->load("database/Consultas.xml");

                /* Para pegar o elemento root do XML */
                $root = $dom_xml->getElementsByTagName("Consultas")[0];

                /* Criando um novo elemento <consulta> */
                $xml_nova_consulta = $dom_xml->createElement("Consulta");

                /* Criando atributos do consulta */
                $xml_nome_paciente = $dom_xml->createElement( "nome-paciente", $nova_consulta->nome_paciente );
                $xml_nome_medico = $dom_xml->createElement( "nome-medico", $nova_consulta->nome_medico );
                $xml_data = $dom_xml->createElement( "data", $nova_consulta->data );
                $xml_horario = $dom_xml->createElement( "horario", $nova_consulta->horario );
                $xml_receita = $dom_xml->createElement( "receita", $nova_consulta->receita );
                $xml_diagnostico = $dom_xml->createElement( "diagnostico", $nova_consulta->diagnostico );

                /* Inserindo os atributos no consulta */
                $xml_nova_consulta->appendChild( $xml_nome_paciente );
                $xml_nova_consulta->appendChild( $xml_nome_medico );
                $xml_nova_consulta->appendChild( $xml_data );
                $xml_nova_consulta->appendChild( $xml_horario );
                $xml_nova_consulta->appendChild( $xml_receita );
                $xml_nova_consulta->appendChild( $xml_diagnostico );

                /* Inserindo novo consulta na lista de consulta */
                $root->appendChild( $xml_nova_consulta );

                /* Gravando resultado no disco */
                $dom_xml->save('database/Consultas.xml');

                return 1;
            }

            public function agendarConsultaPendente ($nova_consulta) {
                /* Verificando se a consulta já existe */
                if(in_array($nova_consulta, $this->lista_consultas_pendentes))
                    return 0;

                /* Para ter chegado aqui, a consulta não existe */
                /* Portando, insira consulta na lista de médicos */
                $this->lista_consultas_pendentes[] = $nova_consulta;

                /* Criando um novo objeto DOM */
                $dom_xml = new DOMDocument();

                /* Para formatar o arquivo XML */
                $dom_xml->preserveWhiteSpace = false;
                $dom_xml->formatOutput = true;

                /* Carregando o arquivo .xml */
                /* No construtor já é verificado se o arquivo já existe */
                $dom_xml->load("database/ConsultasPendentes.xml");

                /* Para pegar o elemento root do XML */
                $root = $dom_xml->getElementsByTagName("Consultas")[0];

                /* Criando um novo elemento <consulta> */
                $xml_nova_consulta = $dom_xml->createElement("Consulta");

                /* Criando atributos do consulta */
                $xml_nome_paciente = $dom_xml->createElement( "nome-paciente", $nova_consulta->nome_paciente );
                $xml_nome_medico = $dom_xml->createElement( "nome-medico", $nova_consulta->nome_medico );
                $xml_data = $dom_xml->createElement( "data", $nova_consulta->data );
                $xml_horario = $dom_xml->createElement( "horario", $nova_consulta->horario );
                $xml_receita = $dom_xml->createElement( "receita", $nova_consulta->receita );
                $xml_diagnostico = $dom_xml->createElement( "diagnostico", $nova_consulta->diagnostico );

                /* Inserindo os atributos no consulta */
                $xml_nova_consulta->appendChild( $xml_nome_paciente );
                $xml_nova_consulta->appendChild( $xml_nome_medico );
                $xml_nova_consulta->appendChild( $xml_data );
                $xml_nova_consulta->appendChild( $xml_horario );
                $xml_nova_consulta->appendChild( $xml_receita );
                $xml_nova_consulta->appendChild( $xml_diagnostico );

                /* Inserindo novo consulta na lista de consulta */
                $root->appendChild( $xml_nova_consulta );

                /* Gravando resultado no disco */
                $dom_xml->save('database/ConsultasPendentes.xml');

                return 1;
            }

            public function alterarConsulta($nome_paciente, $nome_medico, $data_antiga, $horario_antigo, $data_nova, $horario_novo, $nome_medico_novo) {
                $consulta_antiga = new Consulta($nome_paciente, $nome_medico, $data_antiga, $horario_antigo);
                /*
                echo "<br><br>";
                echo "Paciente: $consulta_antiga->nome_paciente<br>";
                echo "Medico: $consulta_antiga->nome_medico<br>";
                echo "Horario: $consulta_antiga->horario<br>";
                echo "Data: $consulta_antiga->data<br><br>";

                echo "<br><br>Array:<br>";
                foreach($this->lista_consultas as $consulta) {
                    echo "Paciente: $consulta->nome_paciente<br>";
                    echo "Medico: $consulta->nome_medico<br>";
                    echo "Horario: $consulta->horario<br>";
                    echo "Data: $consulta->data<br><br>";
                }


                if(!in_array($consulta_antiga, $this->lista_consultas))
                    return 0;
                */

                $root = simplexml_load_file('database/Consultas.xml');

                foreach($root->children() as $consulta) {
                    if($this->verificarIgualdadeConsultas($consulta, $consulta_antiga)) {
                        $consulta->horario = $horario_novo;
                        $consulta->data = $data_nova;
                        $consulta->{'nome-medico'} = $nome_medico_novo;

                        $root->asXML('database/Consultas.xml');

                        // Atualizando a lista de consultas //
                        $consulta_nova = new Consulta($nome_paciente, $nome_medico_novo, $data_nova, $horario_novo);
                        $key = array_search($consulta_antiga, $this->lista_consultas); // returns the first key whose value is 'green'
                        $this->lista_consultas[$key] = $consulta_nova;

                        return 1;
                    }

                }



                /*
                foreach($this->lista_consultas as $consulta) {
                    echo "Paciente: $consulta->nome_paciente<br>";
                    echo "Medico: $consulta->nome_medico<br>";
                    echo "Horario: $consulta->horario<br>";
                    echo "Data: $consulta->data<br><br>";
                }
                */

                return 0;
            }

            private function verificarIgualdadeConsultas($consulta, $consulta_para_buscar) {
                if($consulta->{'nome-medico'} != $consulta_para_buscar->nome_medico)
                    return 0;

                if($consulta->{'nome-paciente'} != $consulta_para_buscar->nome_paciente)
                    return 0;

                if($consulta->data != $consulta_para_buscar->data)
                    return 0;

                if($consulta->horario != $consulta_para_buscar->horario)
                    return 0;

                return 1;
            }

            public function buscarConsulta($nome_paciente, $nome_medico) {
                $this->ordenarDataConsulta();

                $consultas = array();
                foreach($this->lista_consultas as $consulta) {
                    if(($nome_medico == $consulta->nome_medico) && ($nome_paciente == $consulta->nome_paciente))
                        $consultas[] = $consulta;
                }

                if(count($consultas) == 0) {
                    echo "<p>Erro. Não há consultas para alterar.</p>";
                    return 0;
                }

                echo "<h3>Dr. $nome_medico<br></h3>";

                if(count($consultas) == 0) {
                    echo "Não há consultas agendadas.<br>";
                    return 0;
                }

                foreach($consultas as $consulta) {
                    echo "<br>-------------------------------------------------<br>";
                    echo "<b>DATA</b>    : " . $consulta->dia . "/" . $consulta->mes . "/" . $consulta->ano . "<br>";
                    echo "<b>HORARIO</b>  : " . $consulta->horario . "<br>";
                    echo "<b>PACIENTE</b> : " . $consulta->nome_paciente . "<br>";
                    echo "-------------------------------------------------<br>";

                }
                return 1;
            }

            public function atualizarCadastroMedico($novo_medico) {
                session_start();
                $root = simplexml_load_file('database/Medicos.xml');

                foreach($root->children() as $medico) {

                    if($medico->cpf == $novo_medico->getCPF()) {

                        $medico->nome = $novo_medico->nome;
                        $medico->idade = $novo_medico->idade;
                        $medico->email = $novo_medico->email;
                        $medico->endereco = $novo_medico->endereco;
                        $medico->telefone = $novo_medico->telefone;
                        $medico->senha = $novo_medico->getSenha();
                        $medico->crm = $novo_medico->crm;
                        $medico->especialidade = $novo_medico->especialidade;
                        $medico->horarios->segunda->{'ini-expediente-seg'} = $novo_medico->inicio_expediente_seg;
                        $medico->horarios->segunda->{'fim-expediente-seg'} = $novo_medico->fim_expediente_seg;
                        $medico->horarios->terca->{'ini-expediente-ter'} = $novo_medico->inicio_expediente_ter;
                        $medico->horarios->terca->{'fim-expediente-ter'} = $novo_medico->fim_expediente_ter;
                        $medico->horarios->quarta->{'ini-expediente-qua'} = $novo_medico->inicio_expediente_qua;
                        $medico->horarios->quarta->{'fim-expediente-qua'} = $novo_medico->fim_expediente_qua;
                        $medico->horarios->quinta->{'ini-expediente-qui'} = $novo_medico->inicio_expediente_qui;
                        $medico->horarios->quinta->{'fim-expediente-qui'} = $novo_medico->fim_expediente_qui;
                        $medico->horarios->sexta->{'ini-expediente-sex'} = $novo_medico->inicio_expediente_sex;
                        $medico->horarios->sexta->{'fim-expediente-sex'} = $novo_medico->fim_expediente_sex;

                        $_SESSION['nome'] = $novo_medico->nome;
                        $_SESSION['idade'] = $novo_medico->idade;
                        $_SESSION['email'] = $novo_medico->email;
                        $_SESSION['endereco'] = $novo_medico->endereco;
                        $_SESSION['telefone'] = $novo_medico->telefone;
                        $_SESSION['senha'] = $novo_medico->getSenha();
                        $_SESSION['crm'] = $novo_medico->crm;
                        $_SESSION['especialidade'] = $novo_medico->especialidade;
                        $_SESSION['ini-expediente-seg'] = $novo_medico->inicio_expediente_seg;
                        $_SESSION['fim-expediente-seg'] = $novo_medico->fim_expediente_seg;
                        $_SESSION['ini-expediente-ter'] = $novo_medico->inicio_expediente_ter;
                        $_SESSION['fim-expediente-ter'] = $novo_medico->fim_expediente_ter;
                        $_SESSION['ini-expediente-qua'] = $novo_medico->inicio_expediente_qua;
                        $_SESSION['fim-expediente-qua'] = $novo_medico->fim_expediente_qua;
                        $_SESSION['ini-expediente-qui'] = $novo_medico->inicio_expediente_qui;
                        $_SESSION['fim-expediente-qui'] = $novo_medico->fim_expediente_qui;
                        $_SESSION['ini-expediente-sex'] = $novo_medico->inicio_expediente_sex;
                        $_SESSION['fim-expediente-sex'] = $novo_medico->fim_expediente_sex;
                    }
                }

                $root->asXML('database/Medicos.xml');
                return 1;
            }

            public function atualizarCadastroPaciente($novo_paciente) {
                session_start();
                $root = simplexml_load_file('database/Pacientes.xml');

                foreach($root->children() as $paciente) {

                    if($paciente->cpf == $novo_paciente->getCPF()) {

                        $paciente->nome = $novo_paciente->nome;
                        $paciente->idade = $novo_paciente->idade;
                        $paciente->email = $novo_paciente->email;
                        $paciente->endereco = $novo_paciente->endereco;
                        $paciente->telefone = $novo_paciente->telefone;
                        $paciente->senha = $novo_paciente->getSenha();

                        $_SESSION['nome'] = $novo_paciente->nome;
                        $_SESSION['idade'] = $novo_paciente->idade;
                        $_SESSION['email'] = $novo_paciente->email;
                        $_SESSION['endereco'] = $novo_paciente->endereco;
                        $_SESSION['telefone'] = $novo_paciente->telefone;
                        $_SESSION['senha'] = $novo_paciente->getSenha();
                    }
                }

                $root->asXML('database/Pacientes.xml');
                return 1;
            }

            private function getXMLMedicos() {
                /** Criando uma nova lista para guardar os medicos
                 *  Esta lista será retornada para inicializar a lista
                 *  de medicos.
                */

                $lista_medicos = array();

                /* Esta funcado serve para carregar os dados di Medico.xml */
                $dom_xml = new DOMDocument();

                /* Para formatar o arquivo XML */
                $dom_xml->preserveWhiteSpace = false;
                $dom_xml->formatOutput = true;

                /* Carregando o arquivo .xml */
                $dom_xml->load("database/Medicos.xml");
                /* Pega todos os elementos com a TAG "Medico" */

                $medicos = $dom_xml->getElementsByTagName("Medico");

                foreach( $medicos as $medico ) {
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


                    $novo_medico = new Medico($cpf, $senha);

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

                    $lista_medicos[] = $novo_medico;

                }

                return $lista_medicos;
            }

            private function getXMLPacientes() {

                $lista_pacientes = array();
                /* Esta funcado serve para carregar os dados di Medico.xml */
                $dom_xml = new DOMDocument();

                /* Para formatar o arquivo XML */
                $dom_xml->preserveWhiteSpace = false;
                $dom_xml->formatOutput = true;

                /* Carregando o arquivo .xml */
                $dom_xml->load("database/Pacientes.xml");

                /* Pega todos os elementos com a TAG "Medico" */
                $pacientes = $dom_xml->getElementsByTagName("Paciente");
                foreach( $pacientes as $paciente ) {

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

                    /* Criando uma instancia de um Novo Paciente */
                    $novo_paciente = new Paciente($cpf, $senha);

                    /* Inserindo os dados do Novo Paciente */
                    $novo_paciente->nome = $nome;
                    $novo_paciente->idade = $idade;
                    $novo_paciente->endereco = $endereco;
                    $novo_paciente->telefone = $telefone;
                    $novo_paciente->email = $email;

                    $lista_pacientes[] = $novo_paciente;
                }
                return $lista_pacientes;
            }

            private function getXMLConsultas($arq) {
                $lista_consultas = array();
                /* Esta funcado serve para carregar os dados di Medico.xml */
                $dom_xml = new DOMDocument();

                /* Para formatar o arquivo XML */
                $dom_xml->preserveWhiteSpace = false;
                $dom_xml->formatOutput = true;

                /* Carregando o arquivo .xml */
                $dom_xml->load($arq);

                /* Pega todos os elementos com a TAG "Medico" */
                $consultas = $dom_xml->getElementsByTagName("Consulta");
                foreach( $consultas as $consulta ) {

                    $nomes_paciente = $consulta->getElementsByTagName("nome-paciente");
                    $nome_paciente = $nomes_paciente->item(0)->nodeValue;

                    $nomes_medicos = $consulta->getElementsByTagName("nome-medico");
                    $nome_medico = $nomes_medicos->item(0)->nodeValue;

                    $dias_semanas = $consulta->getElementsByTagName("data");
                    $data = $dias_semanas->item(0)->nodeValue;

                    $horarios = $consulta->getElementsByTagName("horario");
                    $horario = $horarios->item(0)->nodeValue;

                    $receitas = $consulta->getElementsByTagName("receita");
                    $receita = $receitas->item(0)->nodeValue;

                    $diagnosticos = $consulta->getElementsByTagName("diagnostico");
                    $diagnostico = $diagnosticos->item(0)->nodeValue;

                    /* Criando uma instancia de um Novo consulta */
                    $novo_consulta = new Consulta($nome_paciente, $nome_medico, $data, $horario);

                    /* Inserindo os dados do Novo consulta */
                    $novo_consulta->nome_paciente = $nome_paciente;
                    $novo_consulta->nome_medico = $nome_medico;
                    $novo_consulta->data = $data;
                    $novo_consulta->horario = $horario;
                    $novo_consulta->receita = $receita;
                    $novo_consulta->diagnostico = $diagnostico;

                    $lista_consultas[] = $novo_consulta;
                }
                return $lista_consultas;
            }

            private function ordenarDataConsulta() {
                usort( $this->lista_consultas,

                    function( $a, $b ) {
                        if($a->data == $b->data) {
                            if($a->horario == $b->horario)
                                return 0;

                            if($a->horario < $b->horario)
                                return -1;

                            return 1;

                        }


                        if ($a ->data < $b->data)
                            return -1;

                        return 1 ;
                    });
            }


        }

    ?>
</body>
</html>
