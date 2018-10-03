<?php

require_once "connectDB.php";

$conn = connectToDB('root', 'Dijkstra');
$conn->set_charset("utf8");

$sql = "SELECT nome FROM medico";
$result = $conn->query($sql);

echo '<datalist id="doctors">';
while ($row = $result->fetch_assoc())
{
    echo "<option value='".$row['nome']."'></option>";
}
echo '</datalist>';

?>