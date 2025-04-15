<?php

$hostname = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($hostname, $username, $password);
if($conn->connect_errno){
    die ("Falha ao conectar: (" . $conn->connect_errno . ") " . $conn ->connect_error);
}else{
    // Echo"Sucesso";
}

// Criar o banco de dados se nao existir e a tabela

$dbname = "bdsinfonia";
$sql =  "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE){
    // echo "Banco de dados verificado/criado com sucesso!<br>";
} else{
    die("Erro ao criar o banco: " . $conn->error);

}

$conn -> select_db($dbname);
?>