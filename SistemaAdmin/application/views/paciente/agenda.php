<?php require_once ('application/views/paciente/header.php')?>

<?php
    
    if (session_status() != PHP_SESSION_NONE) {
        echo "<p style='text-align:center; margin-top:30px; font-size:30px'> " . $this->session->userdata('nome') . "</p>";
    } else 
        header('Location: ' . base_url(""));
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


<?php foreach($datas as $data):
    $data_sepadada = explode("-", $data);
    $dia = $data_sepadada[2];
    $mes = $NOME_MESES[intval($data_sepadada[1])];
    $ano = $data_sepadada[0];
    $consultasNoDia = count($consultas[$data]) + 1;
?>

    <table class="linha-selecionada">
        <tr class="coluna-titulo">
            <td rowspan=<?php echo $consultasNoDia?>> <span class="letra-mes"><?php echo "$mes $dia "?></span> <br><?php echo $ano?></td>
        </tr>

        <?php foreach($consultas[$data] as $consulta): ?>
            <tr>
                <td width=60% class="left-column"><b><?php echo $consulta->horario?></b><?php  echo " - Dr(a) $consulta->nome_medico $consulta->nome_clinica"?></td>
            </tr>
        <?php endforeach?>    
    </table>
    

<?php endforeach?>

<?php require_once ('application/views/footer.php')?>