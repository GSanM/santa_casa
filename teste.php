<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function get_medico() {
    $conn = new mysqli("localhost", "root", "Dijkstra", "clinical_system");

    $sql = "SELECT * FROM medico";

    $resultado = $conn->query($sql);

    print_r($resultado->fetch_array()['crm']);
}

get_medico();


?>