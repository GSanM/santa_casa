<?php

require_once "connectDB.php";

$conn = connectToDB('root', 'Dijkstra');
$conn->set_charset("utf8");

$sql = "SELECT cpf, nome FROM paciente";
$result = $conn->query($sql);

echo '<datalist id="patients">';
while ($row = $result->fetch_assoc())
{
    $nome_paciente = $row['nome'];
    echo "<option value='$nome_paciente'></option>";
}
echo '</datalist>';

?>