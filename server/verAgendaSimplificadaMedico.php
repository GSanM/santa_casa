<?php   

    require_once "Medico.php";
    require_once "Atendente.php";
    require_once "Consulta.php";
    require_once "Paciente.php";

    $atendente = new Atendente();
       
    $nome_medico = $_POST['doctor-name-ver'];

    $lista_consultas = array();
    $lista_medicos = array();

    $lista_medicos = getListaMedicos();

    if(medicoExiste($nome_medico, $lista_medicos) == false) {
        echo "Médico não cadastrado.";
        exit(1);
    }
  
    $lista_consultas = getListaConsultasPorMedico($nome_medico);
    $lista_consultas = ordenarConsultas($lista_consultas);

    if(count($lista_consultas) == 0) {
        echo "Não há consultas agendadas.";
        exit(1);
    }

    // Para ter chegado até aqui, o medico existe e possui agendamentos
    mostrarConsultasMedico($lista_consultas);


    exit(0);
    
    ############################################### funções #########################################################

    function getListaMedicos(){
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

    function getListaConsultasPorMedico($nome_medico_pesquisar) {
        // Dado o nome do médico, a funcao retorna a lista de consultas dele // 
        $lista_consultas = array();
        /* Esta funcado serve para carregar os dados di Medico.xml */
        $dom_xml = new DOMDocument();

        /* Para formatar o arquivo XML */
        $dom_xml->preserveWhiteSpace = false;
        $dom_xml->formatOutput = true;
        
        /* Carregando o arquivo .xml */
        $dom_xml->load("database/Consultas.xml");

        /* Pega todos os elementos com a TAG "Medico" */
        $consultas = $dom_xml->getElementsByTagName("Consulta");
        foreach( $consultas as $consulta ) {
            $nomes_medicos = $consulta->getElementsByTagName("nome-medico");
            $nome_medico = $nomes_medicos->item(0)->nodeValue;

            if($nome_medico == $nome_medico_pesquisar) {
                $nomes_paciente = $consulta->getElementsByTagName("nome-paciente");
                $nome_paciente = $nomes_paciente->item(0)->nodeValue;
                
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
        }
        return $lista_consultas;

    }

    function medicoExiste($nome_medico, $lista_medicos) {
        foreach($lista_medicos as $medico) {
            if($medico->nome == $nome_medico)
                return true;
        }
        return false;
    }

    function mostrarConsultasMedico ($lista_consultas) {
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

        echo "<h3>Dr(a) ".$lista_consultas[0]->nome_medico."<br></h3>";

        echo '<table>
            <tr>
              <th style="text-align: center">DATA</th>
              <th style="text-align: center">HORÁRIO</th>
              <th style="text-align: center">PACIENTE</th>
            </tr>';

        foreach($lista_consultas as $consulta) {
            $data = $consulta->dia . "/" . $consulta->mes . "/" . $consulta->ano;
            echo "<tr>";
            echo "<td>".$data."</td>";
            echo "<td>".$consulta->horario."</td>";
            echo "<td style=\"text-align: left;\">".$consulta->nome_paciente."</td>";
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