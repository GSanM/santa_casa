<?php require_once ('application/views/paciente/header.php')?>

<?php
    
    if (session_status() != PHP_SESSION_NONE) {
        echo "<p style='text-align:center; margin-top:30px; font-size:30px'> " . $this->session->userdata('nome') . "</p>";
    } else 
        header('Location: ' . base_url(""));
?>

<?php
    function normalizarData($date) {
        $splittedDate = explode("-", $date);
        $day   = $splittedDate[2];
        $month = $splittedDate[1];
        $year  = $splittedDate[0];

        return $day . "/" . $month . "/" . $year;
    }
?>

<h4>Histórico do paciente</h4><br>
<input class="form-control" id="myInput" type="text" placeholder="Filtrar..">
<br>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Data</th>
        <th>Diagnostico</th>
        <th>Receita</th>
        <th>Nome do Médico</th>
    </tr>
    </thead>
    <tbody id="myTable">
    <?php foreach($query->result() as $row):?>
                <tr class="dialog clickable linha-selecionada">
                    <td><?php echo normalizarData($row->data);?></td>
                    <td><?php echo $row->diagnostico == "" ? "ainda não há diagnóstico" : $row->diagnostico;?></td>
                    <td><?php echo $row->receita == "" ? "ainda não há receita" : $row->receita;?></td>
                    <td><?php echo $row->nome_medico;?></td>
                </tr>
    <?php endforeach;?>

    </tbody>
</table>

<?php require_once ('application/views/footer.php')?>
