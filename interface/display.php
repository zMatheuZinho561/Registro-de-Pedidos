<?php
include('../src/connect.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: /MyOrdered/index.php");
    die();
}


if (isset($_GET['id'])) {
    $pedido_id = (int)$_GET['id']; 

    $pedido_sql = "SELECT * FROM pedidos WHERE id = ?";
    $stmt_pedido = $mysqli->prepare($pedido_sql);
    $stmt_pedido->bind_param("i", $pedido_id);
    $stmt_pedido->execute();
    $pedido_result = $stmt_pedido->get_result();

    if ($pedido_result->num_rows > 0) {
        $pedido = $pedido_result->fetch_assoc();

        $itens_sql = "SELECT i.quantidade, p.nome, p.preco, m.numero AS numero_mesas
        FROM pedidos_itens i
        JOIN produtos p ON i.produto_id = p.id
        JOIN pedidos pe ON i.pedido_id = pe.id
        JOIN mesas m ON pe.mesa_id = m.id
        WHERE i.pedido_id = ?";

        $stmt_itens = $mysqli->prepare($itens_sql);
        $stmt_itens->bind_param("i", $pedido_id);
        $stmt_itens->execute();
        $itens_result = $stmt_itens->get_result();

        
    } else {
        echo "Pedido não encontrado! ID: " . $pedido_id;
        exit();
    }
} else {
    echo "ID do pedido não informado!";
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Pedido</title>
    <link rel="stylesheet" href="../css/display_ex.css">
</head>
<body>
    <div class="container">
        <h1>Detalhes do Pedido #<?php echo $pedido['id']; ?></h1>
        <p><strong>Id Do Pedido:</strong> <?php echo $pedido['mesa_id']; ?></p>
        <p><strong>Data:</strong> <?php echo date('d/m/Y H:i', strtotime($pedido['data_hora'])); ?></p>

        <h2>Itens do Pedido</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($itens_result->num_rows > 0) {
                    while ($item = $itens_result->fetch_assoc()) {
                        
                        $total_item = $item['quantidade'] * $item['preco'];
                        echo "<tr>";
                        echo "<td>" . $item['nome'] . "</td>";
                        echo "<td>" . $item['quantidade'] . "</td>";
                        echo "<td>R$ " . number_format($item['preco'], 2, ',', '.') . "</td>";
                        echo "<td>R$ " . number_format($total_item, 2, ',', '.') . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum item encontrado para este pedido.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>


