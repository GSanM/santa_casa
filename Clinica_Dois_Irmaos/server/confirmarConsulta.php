<?php
    require_once "Consulta.php";
    require_once "Atendente.php";

    $nome_paciente = $_POST['nome_paciente'];
    $nome_medico = $_POST['nome_medico'];
    $data = $_POST['data'];
    $horario = $_POST['horario'];

    $consulta_pendente = new Consulta($nome_paciente, $nome_medico, $data, $horario);

    if(!removerConsulta($consulta_pendente))
        exit(0);

    $atendente = new Atendente();

    if ($atendente->agendarConsulta($consulta_pendente))
        echo "Consulta agendada com sucesso.";
    else
    {
        echo "Não foi possível agendar a consulta.";
        return new HttpStatusCodeResult(400, "Error message");
    }

    function removerConsulta($consulta_pendente) {
        $xml = simplexml_load_file('database/ConsultasPendentes.xml');
        
        $count = 0;

        foreach($xml->children() as $consulta) {

            if(verificarIgualdadeConsultas($consulta, $consulta_pendente)) {
                unset($xml->Consulta[$count]);
                $xml->asXML('database/ConsultasPendentes.xml');
                return 1;
            }
            $count += 1;
        }
        return 0;
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