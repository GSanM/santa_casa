<?php

function connect($servername, $username, $password, $dbname)
{
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    echo "Connected successfully";

    return $conn;
}

function populate_clinica($conn)
{
    for($i=1; $i <= 3; $i++)
    {
        $nome = "'Clinica $i'";
        $end = "'Av. Bandeirantes, $i'";
        $tel = "'(51)3033-192$i'";
        $query = "INSERT INTO santa_casa.clinica (nome, endereco, telefone) VALUES ($nome, $end, $tel)";
        
        $conn->query($query);
    }
}

function populate_client($conn)
{
    $cpf = "'12345678910'";
    $nome = "'Julieta'";
    $email = "'julieta@gmail.com'";
    $end = "'Rua do Botucatu, 234'";
    $tel = "'(21)2231-4929'";
    $clinica = 1;
    $query = "INSERT INTO cliente (cpf, nome, email, endereco, telefone, id_clinica) VALUES ($cpf, $nome, $email, $end, $tel, $clinica)";
}

function populate_medico()
{

}

function populate_atendente()
{

}

$conn = connect("localhost", "root", "Dijkstra", "santa_casa");

//populate_clinica($conn);
populate_client($conn);

$conn->close();

?>