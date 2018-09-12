<?php   
    session_start();
    require_once "Medico.php";
    require_once "Atendente.php";
    require_once "Consulta.php";
    require_once "Paciente.php";

    $atendente = new Atendente();

    // #######################################################################################
    $lista_consultas = array();
    $lista_consultas = getListaConsultas();
    $lista_consultas = ordenarDataConsulta($lista_consultas);

    if(count($lista_consultas) == 0) {
        echo "Não há consultas agendadas.<br>";
        exit(1);
    }

    echo '
    <!DOCTYPE html>
    <html>
    <head>
    <style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin-top: 10px;
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
    ';

    echo '<form name="form_confirmar" id="form_confirmar" onsubmit="return false;">';

    echo '<table id="table-confirmar">
            <tr>
              <th style="text-align: center">DATA</th>
              <th style="text-align: center">HORÁRIO</th>
              <th style="text-align: center">PACIENTE</th>
              <th style="text-align: center">MEDICO</th>
              <th colspan="2" style="text-align: center">AÇÕES</th>
            </tr>';
    $count = 0;
    foreach($lista_consultas as $consulta) { 
        $count++;

        echo "<script>";
        echo "$(document).ready(function(){
            $(\"#btn_confirmar_consulta$count\").click(function(){
                $.ajax({type: \"POST\",
                        url: \"../server/confirmarConsulta.php\",
                        dataType: \"script\",
                        data: { nome_paciente: '$consulta->nome_paciente', nome_medico: '$consulta->nome_medico', data: '$consulta->data', horario: '$consulta->horario' },
                        success: function(retorno){
                            alert(\"Confirmada com sucesso!\");
                            $(\"#resultado-consulta-pendente\").collapse('toggle');
                        },
                        error: function (a, b, c) {
                            alert(\"Não foi possível agendar a consulta.\");
                            $(\"#resultado-consulta-pendente\").collapse('toggle');
                        },
                });
            });
        });";
        echo "</script>";

        echo "<tr>";
        echo "<td>".$consulta->dia . "/" . $consulta->mes . "/" . $consulta->ano. "</td>";
        echo "<td>".$consulta->horario."</td>";
        echo "<td style=\"text-align: left\">".$consulta->nome_paciente."</td>";
        echo "<td style=\"text-align: left\">".$consulta->nome_medico."</td>";
                
        // Botao Confirmar //
        #echo "<td><button type=\"submit\" class=\"btn btn-default\" id=\"btn_confirmar_consulta$count\" style=\"margin-bottom: 10px;\" onclick=\"ajaxPost('../server/confirmarConsulta.php', '#resultado-confirmar')\">Confirmar</button></td>";
        echo "<td><button type=\"submit\" class=\"btn btn-default\" id=\"btn_confirmar_consulta$count\" style=\"margin-bottom: 10px;\">Confirmar</button></td>";


        // Botao Cancelar //
        echo "<td><button type=\"submit\" class=\"btn btn-default\" id=\"btn_cancelar_consulta$count\" style=\"margin-bottom: 10px;\" onclick=\"ajaxPost('../server/cancelarConsulta.php', '#resultado-cancelar')\">Cancelar</button></td></tr>";

    }
         
    echo '</table>';
    echo '</form>';

    echo '<div id="resultado-confirmar"></div>';
    echo '<div id="resultado-cancelar"></div>';
    exit(0);
    // #######################################################################################

    function getListaConsultas() {
               $lista_consultas = array();
                /* Esta funcado serve para carregar os dados do Medico.xml */
                $dom_xml = new DOMDocument();

                /* Para formatar o arquivo XML */
                $dom_xml->preserveWhiteSpace = false;
                $dom_xml->formatOutput = true;
                
                /* Carregando o arquivo .xml */
                $dom_xml->load("database/ConsultasPendentes.xml");

                /* Pega todos os elementos com a TAG "Medico" */
                $consultas = $dom_xml->getElementsByTagName("Consulta");
                foreach( $consultas as $consulta ) {
                    $nomes_medicos = $consulta->getElementsByTagName("nome-medico");
                    $nome_medico = $nomes_medicos->item(0)->nodeValue;

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

?>