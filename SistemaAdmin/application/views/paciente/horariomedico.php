<?php require_once ('application/views/paciente/header.php')?>

<?php
    
    if (session_status() != PHP_SESSION_NONE) {
        echo "<p style='text-align:center; margin-top:30px; font-size:30px'> Dr(a) " . $_SESSION['nome_medico'] . "</p>";
    } else 
        header('Location: ' . base_url(""));
?>
<a href="<?php echo base_url("paciente/agendar")?>" style="margin-left: 20px"> <- Voltar </a>

<?php $query = $query->result_array()[0]; ?>

<h2>Horário do médico</h2>

<table border="2px solid black" class="table-fill" id="tbl" >
    <thead>
        <tr>
        <th class="date-column"></th>
        <th style="text-align: center;">08h</th>
        <th style="text-align: center;">09h</th>
        <th style="text-align: center;">10h</th>
        <th style="text-align: center;">11h</th>
        <th style="text-align: center;">12h</th>
        <th style="text-align: center;">13h</th>
        <th style="text-align: center;">14h</th>
        <th style="text-align: center;">15h</th>
        <th style="text-align: center;">16h</th>
        <th style="text-align: center;">17h</th>
        <th style="text-align: center;">18h</th>
        </tr>
    </thead>

    <tbody class="table-hover" >
        <tr>
            <td>Segunda-Feira</td>
            <?php for($i = 8; $i <= 18; $i++):?>
                <th style="background-color: <?php echo ($query["seg$i"] == 1) ? "white": "green"?>"></th>
            <?php endfor;?>
        </tr>

        <tr>
            <td>Terça-Feira</td>
            <?php for($i = 8; $i <= 18; $i++):?>
                <th style="background-color: <?php echo ($query["ter$i"]) ? "red": "green"?>"></th>
            <?php endfor;?>
        </tr>

        <tr>
            <td>Quarta-Feira</td>
            <?php for($i = 8; $i <= 18; $i++):?>
                <th style="background-color: <?php echo ($query["qua$i"]) ? "red": "green"?>"></th>
            <?php endfor;?>
        </tr>

        <tr>
            <td>Quinta-Feira</td>
            <?php for($i = 8; $i <= 18; $i++):?>
                <th style="background-color: <?php echo ($query["qui$i"]) ? "red": "green"?>"></th>
            <?php endfor;?>
        </tr>

        <tr>
            <td>Sexta-Feira</td>
            <?php for($i = 8; $i <= 18; $i++):?>
                <th style="background-color: <?php echo ($query["sex$i"]) ? "red": "green"?>"></th>
            <?php endfor;?>
        </tr>
    </tbody>
</table>

<?php require_once ('application/views/footer.php')?>
