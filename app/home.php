<?php
include('../src/connect.php');

if(!isset($_SESSION))
    session_start();

    if(!isset($_SESSION['usuario'])) {
        header("Location: /MyOrdered/index.php");
        die();
    }


$sql = "SELECT * FROM pedidos";
$result = $mysqli->query($sql);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/card.css">
</head>
<body>

    <nav>
        <ul>
            <li><a href="#">Serviços</a></li>
            <li class="submenu">
                <a href="../interface/ordered_ex.php">Pedidos</a>
                
            
        </ul>
        <a href="../src/logout.php"><button class="sair">Sair</button></a>
        
    </nav>

<div class="container">
        
        <div class="card">
            <div class="card-icon produto-icon">+</div>
            <div class="card-title">Gerenciar Produtos</div>
            <a href="../app/add_product.php" class="btn btn-adicionar">Adicionar Produto</a>
        </div>
        
        
        <div class="card">
            <div class="card-icon pedido-icon">🛒</div>
            <div class="card-title">Gerenciar Pedidos</div>
            <a href="../app/register_order.php" class="btn btn-pedido">Fazer Pedido</a>
        </div>
    </div>
            
            </div>
        </div>
    </div>

</body>
</html>
</html>