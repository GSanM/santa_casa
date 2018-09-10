<?php
    require_once "Consulta.php";

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();

    $nome_medico = $_SESSION['nome'];

    $lista_consultas = array();
    $lista_consultas = getListaConsultasMedico($nome_medico);
    $lista_consultas = ordenarDataConsulta($lista_consultas);

    $cont = 1;
    foreach($lista_consultas as $consulta) {
        $diagnostico = $_POST["diagnostico$cont"];
        
        if($diagnostico != "")
            inserirDiagnostico($diagnostico, $consulta);
        
        $cont = $cont + 1;
    }

    function inserirDiagnostico($diagnostico_novo, $consulta_para_buscar) {
        $root = simplexml_load_file('database/Consultas.xml');

        foreach($root->children() as $consulta) {
            if(verificarIgualdadeConsultas($consulta, $consulta_para_buscar)){
                $consulta->diagnostico = $diagnostico_novo;
                echo "Diagnóstico salvo com sucesso.<br>";
            }

        }
        
        $root->asXML('database/Consultas.xml');
    }
 
    function getListaConsultasMedico($nome_medico_consulta) {
        $lista_consultas = array();
         // Esta funcado serve para carregar os dados do Medico.xml //
         $dom_xml = new DOMDocument();

         // Para formatar o arquivo XML //
         $dom_xml->preserveWhiteSpace = false;
         $dom_xml->formatOutput = true;
         
         // Carregando o arquivo .xml //
         $dom_xml->load("database/Consultas.xml");

         // Pega todos os elementos com a TAG "Medico" //
         $consultas = $dom_xml->getElementsByTagName("Consulta");
         foreach( $consultas as $consulta ) {
             
             $nomes_medicos = $consulta->getElementsByTagName("nome-medico");
             $nome_medico = $nomes_medicos->item(0)->nodeValue;

             if($nome_medico_consulta == $nome_medico) {
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

                 // Criando uma instancia de um Novo consulta //
                 $novo_consulta = new Consulta($nome_paciente, $nome_medico, $data, $horario);

                 // Inserindo os dados do Novo consulta //
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

    function ordenarDataConsulta($array) {
        usort( $array,
                
        function( $a, $b ) {
            if($a->data == $b->data) {
                if($a->horario == $b->horario)
                    return 0;
                if($a->horario < $b->horario)
                    return -1;
                return 1;
            }

            if ($a->data < $b->data)
                return -1;

            return 1 ;
        });
        return $array;
    }
   
    function verificarIgualdadeConsultas($consulta, $consulta_para_buscar) {
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

?>