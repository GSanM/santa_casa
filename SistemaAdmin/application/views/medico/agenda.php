<?php require_once ('application/views/medico/header.php')?>

<?php
    if (session_status() != PHP_SESSION_NONE) {
        echo "<p style='text-align:center; margin-top:30px; font-size:30px'> DR. " . $this->session->userdata('nome_medico') . "</p>";



    }
?>

<?php
    $NOME_MESES = array(    1 => "Jan",
                            2 => "Fev",
                            3 => "Mar",
                            4 => "Abr",
                            5 => "Mai",
                            6 => "Jun",
                            7 => "Jul",
                            8 => "Ago",
                            9 => "Set",
                            10 => "Out",
                            11 => "Nov",
                            12 => "Dez");

    $datas = array();
    $consultas = array(array());

    foreach($query->result() as $row) {
        if(in_array($row->data, $datas) == false) {
            $datas[] = $row->data;
        }
        $consultas[$row->data][] = $row;
    }

?>

<?php foreach($datas as $data) {
    $data_sepadada = explode("-", $data);
    $dia = $data_sepadada[2];
    $mes = $NOME_MESES[intval($data_sepadada[1])];
    $ano = $data_sepadada[0];
    $consultasNoDia = count($consultas[$data]) + 1;
    //<td  rowspan='.$consultasNoDia.">".$dia. " de ". $mes ." de " .$ano.'</td>
    echo'
    <table>
        <tr class="coluna-titulo">
            <td rowspan='.$consultasNoDia.'> <span class="letra-mes">'. $mes .' '. $dia .'</span> <br>'. $ano .'</td>
        </tr>';

        foreach($consultas[$data] as $consulta) {
       
            echo '
            
            <tr>
                <td width=60%><b>'. $consulta->horario .'</b> - '. $consulta->nome_paciente .' - '.$consulta->nome_clinica .'</td>
            </tr>
            ';
        }

    echo'
    </table>
    ';
}
?>

<?php require_once ('application/views/footer.php')?>