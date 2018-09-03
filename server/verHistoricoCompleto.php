<?php

    session_start();

    ini_set('display_error',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);

    $nome_paciente = $_POST['patient-name'];

    $dom_xml_consultas = new DOMDocument();

    $dom_xml_consultas->load("database/Consultas.xml");
    
    $consultas = $dom_xml_consultas->getElementsByTagName("Consulta");
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
    
    echo '<table>
            <tr>
              <th style="text-align: center">DATA</th>
              <th style="text-align: center">HORÁRIO</th>
              <th style="text-align: center">PACIENTE</th>
              <th style="text-align: center">MÉDICO</th>
              <th style="text-align: center">DIAGNÓSTICO</th>
              <th style="text-align: center">RECEITA</th>
            </tr>';
    $found = 0;
    foreach($consultas as $consulta)
    {
        $datas = $consulta->getElementsByTagName("data");
        if(is_object($datas->item(0)))
        {
            $data = $datas->item(0)->nodeValue;
        }

        $horarios = $consulta->getElementsByTagName("horario");
        if(is_object($horarios->item(0)))
        {
            $horario = $horarios->item(0)->nodeValue;
        }

        $pacientes = $consulta->getElementsByTagName("nome-paciente");
        if(is_object($pacientes->item(0)))
        {
            $paciente = $pacientes->item(0)->nodeValue;
        }

        $medicos = $consulta->getElementsByTagName("nome-medico");
        if(is_object($medicos->item(0)))
        {
            $medico = $medicos->item(0)->nodeValue;
        }

        $receitas = $consulta->getElementsByTagName("receita");
        if(is_object($receitas->item(0)))
        {
            $receita = $receitas->item(0)->nodeValue;
        }
        
        $diagnosticos = $consulta->getElementsByTagName("diagnostico");
        if(is_object($diagnosticos->item(0)))
        {
            $diagnostico = $diagnosticos->item(0)->nodeValue;
        }
        
        if(($nome_paciente == $paciente) && !empty($nome_paciente))
        {
            $splits = explode("-", $data);
            $ano = $splits[0];
            $mes = $splits[1];
            $dia = $splits[2];

            echo "<tr>";
            echo "<td>$dia/$mes/$ano</td>";
            echo "<td>".$horario."</td>";
            echo "<td>".$paciente."</td>";
            echo "<td>".$medico."</td>";
            echo "<td>".$diagnostico."</td>";
            echo "<td>".$receita."</td>";
            echo "</tr>";
            $found = 1;
        }
    }
    echo "</table>";
    if(!empty($nome_paciente) && ($found == 0))
    {
        echo "<script>alert(\"Paciente não encontrado!\");</script>";
    }

?>