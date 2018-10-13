<?php   
    session_start();
    require_once "Medico.php";
    require_once "Atendente.php";
    require_once "Consulta.php";
    require_once "Paciente.php";

    $atendente = new Atendente();
    
    // Pegar nome do medico //
    $nome_medico = $_SESSION['nome'];

    

    // #######################################################################################
    $lista_consultas = array();
    $lista_consultas = getListaConsultasMedico($nome_medico);
    $lista_consultas = ordenarDataConsulta($lista_consultas);

    if(count($lista_consultas) == 0) {
        echo "Não há consultas agendadas.<br>";
        exit(1);
    }

    echo '<form name="form_receitar" id="form_receitar" onsubmit="return false;">';

    echo '<table>
            <tr>
                <th style="text-align: center">DATA</th>
                <th style="text-align: center">HORÁRIO</th>
                <th style="text-align: center">PACIENTE</th>
                <th colspan="2" style="text-align: center">AÇÕES</th>
            </tr>';
    $count = 0;
    foreach($lista_consultas as $consulta) {
        $count++;
        echo "<script>
            $(document).ready(function(){
                $(\"#receitar$count\").click(function(){
                    $(\"#text_receita$count\").collapse(\"toggle\");
                });
            });

            $(document).ready(function(){
                $(\"#diagnosticar$count\").click(function(){
                    $(\"#text_diagnostico$count\").collapse(\"toggle\");
                });
            });

            $(document).ready(function(){
                $(\"#btn_salvar_receita$count\").click(function(){
                    $(\"#text_receita$count\").collapse(\"hide\");
                });

                $(\"#btn_salvar_diagnostico$count\").click(function(){
                    $(\"#text_diagnostico$count\").collapse(\"hide\");
                });
            });

        </script>";


        echo "<th><tr>";
        echo "<td>".$consulta->dia . "/" . $consulta->mes . "/" . $consulta->ano. "</td>";
        echo "<td>".$consulta->horario."</td>";
        echo "<td style=\"text-align: left\">".$consulta->nome_paciente."</td>";

        // Botao Receitar //
        echo "<td><button class=\"btn btn-default\" style=\"margin: 0px; border-radius: 1px;\" id=\"receitar$count\">Receitar</button></td>";

        // Botao Diagnosticar //
        echo "<td><button class=\"btn btn-default\" style=\"margin: 0px; border-radius: 1px;\" id=\"diagnosticar$count\">Diagnosticar</button></td></tr>";

        // Espaco para digitar a Receita //
        echo "<tr class=\"collapse\" id=\"text_receita$count\" style=\"background-color: #FFFFFF\">";
        echo "<td colspan=\"5\">";
        echo "<textarea name=\"receita$count\" cols=\"60\" rows=\"5\" placeholder=\"Digite aqui a receita ou uma observação.\"></textarea>";
        echo "<button type=\"submit\" class=\"btn btn-default\" id=\"btn_salvar_receita$count\" style=\"margin-bottom: 10px;\" onclick=\"ajaxPost('../server/receitarPaciente.php', '#resultado-receita')\">Salvar</button></td></tr>";
        
        // Espaco para digitar o diagnostico //
        echo "<tr class=\"collapse\" id=\"text_diagnostico$count\" style=\"background-color: #FFFFFF\">";
        echo "<td colspan=\"5\">";
        echo "<textarea name=\"diagnostico$count\" cols=\"60\" rows=\"5\" placeholder=\"Digite aqui o diagnóstico do paciente.\"></textarea>";
        echo "<button type=\"submit\" class=\"btn btn-default\" id=\"btn_salvar_diagnostico$count\" style=\"margin-bottom: 10px;\" onclick=\"ajaxPost('../server/diagnosticarPaciente.php', '#resultado-diagnostico')\">Salvar</button></td></tr>";
        
    }
    
    echo '</table>';
    echo '</form>';

    echo '<div id="resultado-receita"></div>';
    echo '<div id="resultado-diagnostico"></div>';
    exit(0);
    // #######################################################################################

    function getListaConsultasMedico($nome_medico_consulta) {
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