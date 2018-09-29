<?php require_once ('application/views/paciente/header.php')?>

<input class="form-control" id="myInput" type="text" placeholder="Filtrar..">
<br>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Nome do Médico</th>
        <th>Especialidade</th>
        <th>Nome da Clinica</th>
    </tr>
    </thead>
    <tbody id="myTable">
    <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr class="dialog" class="clickable">
                    <td><?php echo $row['nome_medico'];?></td>
                    <td><?php echo $row['especialidade'];?></td>
                    <td><?php echo $row['nome_clinica'];?></td>
                </tr>
    <?php endwhile;?>

    </tbody>
</table>

<?php require_once ('application/views/footer.php')?>
