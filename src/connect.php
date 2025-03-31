<?php

$servername = "localhost";  // Geralmente "localhost" para servidores locais
$username = "root";         // Nome do usuário do MySQL
$password = "";             // Senha do usuário (deixe vazio se não houver senha)
$dbname = "ordered_cliente";   // Nome do banco de dados

$mysqli = new mysqli($servername, $username, $password, $dbname);
if($mysqli->connect_errno) {
    die("Falha na conexão com o banco de dados");
}