<?php

require_once "connectDB.php";

$conn = connectToDB('root', 'Dijkstra');
$conn->set_charset("utf8");

$sql = "SELECT nome FROM clinica";
$result = $conn->query($sql);

echo '<datalist id="clinicas">';
while ($row = $result->fetch_assoc())
{
    echo "<option value='".$row['nome']."'></option>";
}
echo '</datalist>';

?>