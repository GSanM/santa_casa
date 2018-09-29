<?php require_once ("application/views/medico/header.php")?>

<?php
    if (session_status() != PHP_SESSION_NONE) {
        echo "<p style='text-align:center; margin-top:30px; font-size:30px'> DR. " . $this->session->userdata('nome') . "</p>";

    }
?>

<?php
    $listaClinicas  = array();
    $listaEndereco  = array();
    $listaTelefone  = array();
    $listaGerente   = array();
    foreach($query->result() as $row) {
        if(in_array($row->nome_clinica, $listaClinicas) == false){
            $listaClinicas[]  = $row->nome_clinica;
            $listaEndereco[]  = $row->endereco_clinica;
            $listaTelefone[]  = $row->telefone_clinica;
            $listaGerente[]   = $row->nome_gerente;
        }
    }   
?>

<div class="base-home">
    <h1 class="titulo">>> CLINICAS</h1>
    <table>
        <thead>
            <tr>
                <th>Nome da Clinica</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>Gerente</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $numberOfClinics = count($listaClinicas);
            $counter = 0;
        ?>
        <?php while($counter < $numberOfClinics):?>
            <tr class="dialog" class="clickable">
                <td><?php echo $listaClinicas[$counter];?></td>
                <td><?php echo $listaEndereco[$counter];?></td>
                <td><?php echo $listaTelefone[$counter];?></td>
                <td><?php echo $listaGerente[$counter];?></td>
            </tr>
        <?php $counter += 1;?>
        <?php endwhile;?>
        </tbody>
    </table>
</div>

<?php require_once ("application/views/footer.php")?>