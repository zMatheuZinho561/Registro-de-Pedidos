<?php 
include('../src/connect.php');

 if (isset($_POST['remover_id'])) {
    $pedidoId = $_POST['remover_id'];

    $mysqli->begin_transaction();

    try {
        
        $sql_itens = "DELETE FROM pedidos_itens WHERE pedido_id = ?";
        $stmt_itens = $mysqli->prepare($sql_itens);
        $stmt_itens->bind_param("i", $pedidoId);
        $stmt_itens->execute();
        
        $sql_pedido = "DELETE FROM pedidos WHERE id = ?";
        $stmt_pedido = $mysqli->prepare($sql_pedido);
        $stmt_pedido->bind_param("i", $pedidoId);
        $stmt_pedido->execute();
        $mysqli->commit();
        
        header("Location: ../interface/ordered_ex.php");
        exit();
    } catch (Exception $e) {
        
        $mysqli->rollback();
        echo "Erro ao remover o pedido: " . $e->getMessage();
    }
}


$mysqli->close();
?>





?>