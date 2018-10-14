<?php require_once ('application/views/medico/header.php')?>

<a style="margin: 20px 30px" href="<?php echo base_url('medico/agenda') ?>"> << Voltar </a>

<div style="width: 50%; margin: 30px auto">
    <span style="font-size: 20px">Paciente:</span> <?php echo "<b>$nome_paciente</b>"?>

    <br><br><br>
    <form action="<?php echo base_url('medico/receitar/salvar_receita')?>" method="POST">
        Digite o Diagnóstico:
        <textarea name="iDiagnostico" rows="3" cols="40"><?php echo $diagnostico?></textarea>

        <br><br>

        Digite a receita:
        <textarea name="iReceita" rows="10" cols="40"><?php echo $receita?></textarea>
        <input name="nome_paciente" type="hidden" value="<?php echo $nome_paciente?>">
        <input name="nome_medico"   type="hidden" value="<?php echo $nome_medico?>">
        <input name="nome_clinica"  type="hidden" value="<?php echo $nome_clinica?>">
        <input name="horario"       type="hidden" value="<?php echo $horario?>">
        <input name="data"          type="hidden" value="<?php echo $data?>">

        <button type="submit" class="btn">Salvar</button>
    </form>

</div>
<?php require_once ('application/views/footer.php')?>