<?php require_once ('application/views/paciente/header.php')?>

<?php
    
    if (session_status() != PHP_SESSION_NONE) {
        echo "<p style='text-align:center; margin-top:30px; font-size:30px'> " . $this->session->userdata('nome') . "</p>";
    } else 
        header('Location: ' . base_url(""));
?>

<input class="form-control" id="myInput" type="text" placeholder="Filtrar..">
<br>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Nome do Médico</th>
        <th>Especialidade</th>
        <th>Nome da Clinica</th>
    </tr>
    </thead>
    <tbody id="myTable">
    <?php foreach($query->result() as $row):?>
                <tr class="dialog clickable linha-selecionada">
                    <td><?php echo $row->nome_medico;?></td>
                    <td><?php echo $row->especialidade;?></td>
                    <td><?php echo $row->nome_clinica;?></td>
                </tr>
    <?php endforeach;?>

    </tbody>
</table>

<?php require_once ('application/views/footer.php')?>
