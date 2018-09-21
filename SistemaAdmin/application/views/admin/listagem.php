<?php require_once 'application/views/header.php'?>
    <div class="base-home">
        <h1 class="titulo">>> CLINICAS CADASTRADAS</h1>
            
        <?php 
            echo "<table><thead><tr>";
            echo "<th>Clinica</th>";
            echo "<th>Gerente</th>";
            echo "<th>CNPJ</th>";
            echo "<th>Endereco</th>";
            echo "<th>Telefone</th>";
            echo "</tr></thead>";

            echo "<tbody>";
            foreach($resultado as $result) { 
                echo "<tr>";
                echo "<td>$result->nome_clinica</td>";
                echo "<td>$result->nome_gerente</td>";
                echo "<td>$result->cnpj</td>";
                echo "<td>$result->endereco</td>";
                echo "<td>$result->telefone</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";

        ?>
    </div>

<?php require_once 'application/views/footer.php'?>