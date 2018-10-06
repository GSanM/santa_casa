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
                <tr class="dialog clickable linha-selecionada" id="modal-click">
                    
                    <td><a href="<?php echo base_url("paciente/horariomedico")?>"> <?php echo $row->nome_medico;?></a></td>
                    <td><?php echo $row->especialidade;?></td>
                    <td><?php echo $row->nome_clinica;?></td>
                </tr>
    <?php endforeach;?>

    </tbody>
</table>

<form id="formAgendar" action="<?php echo base_url('paciente/agendar/envio')?>" method="POST">
    <label>Médico</label>
    <input id="iMedico" name="iMedico" list="lista_medicos" type="text" placeholder="Digite o nome do Médico" onblur="getHorarioMedico(this)">
    <datalist id="lista_medicos">
        <?php foreach($query->result() as $row):?>
        <option value="<?php echo $row->nome_medico?>">
        <?php endforeach?>
    </datalist>
    <br><br><br>

    <label>Clínica</label>
    <input type="text" placeholder="Digite o nome do Médico">
    <datalist id="lista_horarios">
        <?php foreach($query->result() as $row):?>
        <option value="<?php echo $row->nome_clinica?>">
        <?php endforeach?>
    </datalist>
    <br><br><br>

    <label>Horário</label>
    <input id="" list="lista_horarios" type="text" placeholder="Digite o horário">
    <datalist id="lista_horarios">
        <?php foreach($query->result() as $row):?>
        <option value="<?php echo $row->nome_medico?>">
        <?php endforeach?>
    </datalist>
    <br><br><br>





    <button>Agendar</button>
</form>

<?php require_once ('application/views/footer.php')?>
