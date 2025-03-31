<?php
include('../src/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mesa_id = $_POST['mesa_id'];
    $produtos = $_POST['produtos'] ?? [];
    $quantidades = $_POST['quantidade'] ?? [];

    if (empty($produtos)) {
        die("Nenhum produto foi selecionado.");
    }

    
    $stmt = $mysqli->prepare("INSERT INTO pedidos (mesa_id) VALUES (?)");
    $stmt->bind_param("i", $mesa_id);
    $stmt->execute();
    $pedido_id = $stmt->insert_id;
    
    
    $stmt = $mysqli->prepare("INSERT INTO pedidos_itens (pedido_id, produto_id, quantidade) VALUES (?, ?, ?)");
    foreach ($produtos as $produto_id) {
        $quantidade = $quantidades[$produto_id];
        $stmt->bind_param("iii", $pedido_id, $produto_id, $quantidade);
        $stmt->execute();
    }

    echo "Pedido realizado com sucesso! <a href='../interface/ordered_ex.php'>Ver pedidos</a>";
}
?>