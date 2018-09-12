<?php

// Conecta ao banco
function connectToDB($username, $password)
{
    $servername = 'localhost';
    $dbname = 'clinical_system';

    // Cria conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica conexão
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    echo "Connected successfully";

    return $conn;
}

// Envia query para o banco e retorna a saída
function submit($conn, $sql)
{
    if ($conn->query($sql) === TRUE) 
    {
        echo "Success";
        return 1;
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return 0;
    }
}

?>