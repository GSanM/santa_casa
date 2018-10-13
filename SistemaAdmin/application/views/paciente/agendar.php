<?php require_once ('application/views/paciente/header.php')?>

<?php
    if (session_status() != PHP_SESSION_NONE) {
        echo "<p style='text-align:center; margin-top:30px; font-size:30px'> " . $this->session->userdata('nome') . "</p>";
    } else 
        header('Location: ' . base_url(""));
?>

<?php
    if(isset($query)) {
        $nomeMedicos = array();
        foreach($query as $row) {
            if(isset($row['nome_clinica_por_medico']))
                $queryClinicasPorMedico[] = $row;
            elseif(isset($row['seg8']) || isset($row['ter8']) || isset($row['qua8']) || isset($row['qui8']) || isset($row['sex8']))
                $queryHorarios[] = $row;
            else {
                $queryMedicos[] = $row;

                if(!in_array($row['nome_medico'], $nomeMedicos))
                    $nomeMedicos[] = $row['nome_medico'];
            }
        }
    }
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
    <?php foreach($queryMedicos as $row):?>
                <tr class="dialog clickable linha-selecionada" id="modal-click">                    
                    <td><?php echo $row['nome_medico']?></a></td>
                    <td><?php echo $row['especialidade']?></td>
                    <td><?php echo $row['nome_clinica']?></td>
                </tr>
    <?php endforeach;?>

    </tbody>
</table>

<form id="formAgendar" action="<?php echo base_url('paciente/agendar/envio')?>" method="POST">
    <div style="margin: 0 auto; width:70%"> 
    <label>Médico</label>
    <input id="iMedico" name="iMedico" list="lista_medicos" type="text" placeholder="Digite o nome do Médico" onblur="getClinicasMedico()">
    <datalist id="lista_medicos">
        <?php foreach($nomeMedicos as $row):?>
        <option value="<?php echo $row?>">
        <?php endforeach?>
    </datalist>
    <br><br><br>

    <label>Clínica</label>
    <input id="iClinica" name="iClinica" list="lista_clinicas" type="text" placeholder="Digite o nome da Clinica">
    <datalist id="lista_clinicas">
        <?php foreach($queryClinicasPorMedico as $row):?>
        <option value="<?php echo $row['nome_clinica_por_medico']?>">
        <?php endforeach?>
    </datalist>
    <br><br><br>

    <label>Data</label>
    <input id="iData" name="iData" type="date" placeholder="Digite a data" onblur="getHorariosMedico()">
    <br><br><br>


    <label>Horário</label>
    <input id="iHorario" name="iHorario" list="lista_horarios" type="text" placeholder="Digite o horário">
    <datalist id="lista_horarios">
        <?php foreach($queryHorarios[0] as $key=>$value):?>
        <option value="<?php echo ($value)? get_formatted_time($key):"" ?>">
        <?php endforeach?>
        <?php function get_formatted_time($value){
            if(strlen($value) == 4)
                return $value[3] + ":00";
            if(strlen($value) == 5)
                return $value[3].$value[4].":00";
        }?>
    </datalist>
    <br><br><br>

    <button class="btn" >Agendar</button>
    <div class="btn" onclick="clearForm()">Limpar</div>
    </div>
</form>

<?php require_once ('application/views/footer.php')?>
