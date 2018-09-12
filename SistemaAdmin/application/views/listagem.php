<?php require_once 'header.php'?>
    <div class="base-home">
        <h1 class="titulo">>> CLINICAS CADASTRADAS</h1>
            
        <?php 
            echo "<table><thead><tr>";
            echo "<th>Nome da Clinica</th>";
            echo "<th>Nome do Gerente</th>";
            echo "<th>CPF do Gerente</th>";
            echo "</tr></thead>";

            echo "<tbody>";
            foreach($resultado as $result) { 
                echo "<tr>";
                echo "<td>$result->nome_clinica</td>";
                echo "<td>$result->nome_gerente</td>";
                echo "<td>$result->cpf_gerente</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";

        ?>
    </div>

<?php require_once 'footer.php'?>