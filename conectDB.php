<?php
//Variaveis de config do banco de dados
$server = "localhost";
$database = "livraria_db";
$user = "root";
$pass = "";

$conn = new mysqli($server, $user, $pass, $database);

if ($conn->connect_error) {
    die("Falha na Conexão: " . $conn->connect_error);
  }
  //echo "Conexão Realizada com Sucesso!";

?>