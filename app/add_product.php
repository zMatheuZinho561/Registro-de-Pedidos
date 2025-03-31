<?php

include('../src/connect.php');

if(!isset($_SESSION))
    session_start();

    if(!isset($_SESSION['usuario'])) {
        header("Location: /MyOrdered/index.php");
        die();
    }
    
    $id = $_SESSION['usuario'];

    $sql_clientes = "SELECT * FROM clientes WHERE id != '$id'";
    $query_clientes = $mysqli->query($sql_clientes) or die($mysqli->error);
    $num_clientes = $query_clientes->num_rows;
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/form.css">
    <title>Home</title>
    
</head>

<body>



  <form action="../src/register_product.php" method="POST">
    <label for="nome">Nome do Produto:</label>
    <input type="text" name="nome" required>

    <label for="descricao">Descrição:</label>
    <textarea name="descricao"></textarea>

    <label for="preco">Preço:</label>
    <input type="number" name="preco" step="0.01" required>

    <label for="estoque">Estoque:</label>
    <input type="number" name="estoque" required>

    <button type="submit" class="btn_add">Adicionar Produto</button>

    <div class="container">
        <a href="../app/home.php" class="voltar-btn">Voltar</a>
    </div>

</form>










</body>
</html>