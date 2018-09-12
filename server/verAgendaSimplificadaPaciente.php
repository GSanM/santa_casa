<?php
    require_once "Atendente.php";
    require_once "Consulta.php";
    require_once "Paciente.php";

    $atendente = new Atendente();

    $nome_paciente = $_POST['patient-name-ver-agenda'];

    $lista_consultas = array();
    $lista_pacientes = array();

    $lista_pacientes = getListaPacientes();

    if(pacienteExiste($nome_paciente, $lista_pacientes) == false) {
        echo "Paciente não cadastrado.";
        exit(1);
    }

    $lista_consultas = getListaConsultasPorPaciente($nome_paciente);
    $lista_consultas = ordenarConsultas($lista_consultas);

    if(count($lista_consultas) == 0) {
        echo "Não há consultas agendadas.";
        exit(1);
    }

    // Para ter chegado até aqui, o Paciente existe e possui agendamentos
    mostrarConsultasPaciente($lista_consultas);

    exit(0);

    ############################################### funções #########################################################

    function getListaPacientes(){
        /** Criando uma nova lista para guardar os pacientes
         *  Esta lista será retornada para inicializar a lista
         *  de pacientes.
        */

        $lista_pacientes = array();

        /* Esta funcado serve para carregar os dados di paciente.xml */
        $dom_xml = new DOMDocument();

        /* Para formatar o arquivo XML */
        $dom_xml->preserveWhiteSpace = false;
        $dom_xml->formatOutput = true;

        /* Carregando o arquivo .xml */
        $dom_xml->load("database/Pacientes.xml");
        /* Pega todos os elementos com a TAG "paciente" */

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


            $novo_paciente = new Paciente($cpf, $senha);

            $novo_paciente->nome = $nome;
            $novo_paciente->idade = $idade;
            $novo_paciente->endereco = $endereco;
            $novo_paciente->telefone = $telefone;
            $novo_paciente->email = $email;

            $lista_pacientes[] = $novo_paciente;

        }

        return $lista_pacientes;
    }

    function getListaConsultasPorPaciente($nome_paciente_pesquisar) {
        // Dado o nome do médico, a funcao retorna a lista de consultas dele //
        $lista_consultas = array();
        /* Esta funcado serve para carregar os dados di Paciente.xml */
        $dom_xml = new DOMDocument();

        /* Para formatar o arquivo XML */
        $dom_xml->preserveWhiteSpace = false;
        $dom_xml->formatOutput = true;

        /* Carregando o arquivo .xml */
        $dom_xml->load("database/Consultas.xml");

        /* Pega todos os elementos com a TAG "Paciente" */
        $consultas = $dom_xml->getElementsByTagName("Consulta");
        foreach( $consultas as $consulta ) {
            $nomes_pacientes = $consulta->getElementsByTagName("nome-paciente");
            $nome_paciente = $nomes_pacientes->item(0)->nodeValue;

            if($nome_paciente == $nome_paciente_pesquisar) {
                $nomes_medico = $consulta->getElementsByTagName("nome-medico");
                $nome_medico = $nomes_medico->item(0)->nodeValue;

                $dias_semanas = $consulta->getElementsByTagName("data");
                $data = $dias_semanas->item(0)->nodeValue;

                $horarios = $consulta->getElementsByTagName("horario");
                $horario = $horarios->item(0)->nodeValue;

                $receitas = $consulta->getElementsByTagName("receita");
                $receita = $receitas->item(0)->nodeValue;

                $diagnosticos = $consulta->getElementsByTagName("diagnostico");
                $diagnostico = $diagnosticos->item(0)->nodeValue;

                /* Criando uma instancia de um Novo consulta */
                $novo_consulta = new Consulta($nome_paciente, $nome_paciente, $data, $horario);

                /* Inserindo os dados do Novo consulta */
                $novo_consulta->nome_paciente = $nome_paciente;
                $novo_consulta->nome_medico = $nome_medico;
                $novo_consulta->data = $data;
                $novo_consulta->horario = $horario;
                $novo_consulta->receita = $receita;
                $novo_consulta->diagnostico = $diagnostico;

                $lista_consultas[] = $novo_consulta;
            }
        }
        return $lista_consultas;

    }

    function pacienteExiste($nome_paciente, $lista_pacientes) {
        foreach($lista_pacientes as $paciente) {
            if($paciente->nome == $nome_paciente)
                return true;
        }
        return false;
    }

    function mostrarConsultasPaciente ($lista_consultas) {
        echo '
        <!DOCTYPE html>
        <html>
        <head>
        <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
        </style>
        ';

        echo "<h3>Sr(a) ".$lista_consultas[0]->nome_paciente."<br></h3>";

        echo '<table>
            <tr>
              <th style="text-align: center">DATA</th>
              <th style="text-align: center">HORÁRIO</th>
              <th style="text-align: center">MEDICO</th>
            </tr>';

        foreach($lista_consultas as $consulta) {
            $data = $consulta->dia . "/" . $consulta->mes . "/" . $consulta->ano;
            echo "<tr>";
            echo "<td>".$data."</td>";
            echo "<td>".$consulta->horario."</td>";
            echo "<td style=\"text-align: left;\">".$consulta->nome_medico."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    function ordenarConsultas($lista_consultas) {
        usort( $lista_consultas,

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
            return $lista_consultas;
    }

?>
