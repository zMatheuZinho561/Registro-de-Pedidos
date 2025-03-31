<?php
include('../src/connect.php');

if(!isset($_SESSION))
    session_start();

    if(!isset($_SESSION['usuario'])) {
        header("Location: /MyOrdered/index.php");
        die();
    }

    $sql = "
   SELECT pedidos.id, pedidos.data_hora, mesas.numero AS numero_mesa
   FROM pedidos
   JOIN mesas ON pedidos.mesa_id = mesas.id;
";
$result = $mysqli->query($sql);



$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/ordered_app.css">
</head>
<body>
<div class="container">
        <h1>Pedidos Registrados</h1>

        <div class="pedidos-lista">
            <?php while ($pedido = $result->fetch_assoc()) { ?>
                <div class="pedido-card">
                    <div class="pedido-info">
                        <h2>Pedido #<?php echo $pedido['id']; ?></h2>
                        <p><strong>Mesa:</strong> <?php echo $pedido['numero_mesa']; ?></p> 
                        <p><strong>Data:</strong> <?php echo date('d/m/Y H:i', strtotime($pedido['data_hora'])); ?></p>
                        
                    </div>
                    <div class="pedido-actions">
                    <a href="display.php?id=<?php echo $pedido['id']; ?>" class="btn">Ver Detalhes</a>
               
                    <form method="POST" action="../src/remove_order.php">
                            <input type="hidden" name="remover_id" value="<?php echo $pedido['id']; ?>">
                            <button type="submit">Finalizar</button>
                        </form>

                </form>
                
                    </div>
                    
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>