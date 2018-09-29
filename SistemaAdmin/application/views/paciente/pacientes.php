<?php require_once ("application/views/medico/header.php")?>

<?php
    if (session_status() != PHP_SESSION_NONE) {
        echo "<p style='text-align:center; margin-top:30px; font-size:30px'> DR. " . $this->session->userdata('nome') . "</p>";

    }
?>

<?php
    $listaPacientes = array();
    $listaClinicas  = array();
    foreach($query->result() as $row) {
        if(in_array($row->nome_paciente, $listaPacientes) == false){
            $listaPacientes[] = $row->nome_paciente;
            $listaClinicas[]  = $row->nome_clinica;
        }
    }   
?>

<div class="base-home">
    <h1 class="titulo">>> PACIENTES</h1>
        
    <?php 
        echo "<table><thead><tr>";
        echo "<th>Nome do Paciente</th>";
        echo "<th>Clinica</th>";
        echo "</tr></thead>";

        echo "<tbody>";
        $count = 0;
        $numeroDeRegistros = count($listaPacientes);
        while($count < $numeroDeRegistros) { 
            echo "<tr>";
            echo "<td>$listaPacientes[$count]</td>";
            echo "<td style='text-align:center;'>$listaClinicas[$count]</td>";
            echo "</tr>";

            $count += 1;
        }
        echo "</tbody>";
        echo "</table>";

    ?>
</div>

<?php require_once ("application/views/footer.php")?>