<?php 
include('../src/connect.php');

if(!isset($_SESSION))
    session_start();

    if(!isset($_SESSION['usuario'])) {
        header("Location: /MyOrdered/index.php");
        die();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/pag_end.css">
</head>
<body>
<div class="container">
        <div class="message-box">
            <h1>Concluído!</h1>
            <p>Parabéns! O Registro Foi Feito Com Sucesso.</p>
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="50" height="50">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <button onclick="window.location.href='../app/home.php'">Voltar para o Início</button>
        </div>
    </div>

</body>
</html>