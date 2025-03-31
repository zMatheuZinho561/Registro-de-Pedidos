<?php
include('../src/connect.php');


if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: /MyOrdered/index.php");
    die();
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Pedido</title>
    <link rel="stylesheet" href="../css/form.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h2 class="text-center">Fazer Pedido</h2>
    
    <form action="../src/ordered_app.php" method="POST">
        
        <div class="mb-3">
            <label for="mesa" class="form-label">Número da Mesa:</label>
            <select name="mesa_id" class="form-select" required>
                <?php
                include 'conexao.php';
                $mesas = $mysqli->query("SELECT * FROM mesas");
                while ($mesa = $mesas->fetch_assoc()) {
                    echo "<option value='{$mesa['id']}'>Mesa {$mesa['numero']}</option>";
                }
                ?>
            </select>
        </div>

        <h3 class="mt-4">Selecione os Produtos:</h3>
        
        <div class="row">
            <?php
            $produtos = $mysqli->query("SELECT * FROM produtos");
            while ($produto = $produtos->fetch_assoc()) {
                ?>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= $produto['nome'] ?></h5>
                            <p class="card-text">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
                            <input type="checkbox" class="btn-check" name="produtos[<?= $produto['id'] ?>]" id="produto<?= $produto['id'] ?>" value="<?= $produto['id'] ?>">
                            <label class="btn btn-outline-primary" for="produto<?= $produto['id'] ?>">Selecionar</label>
                            <br>
                            <label class="form-label mt-2">Quantidade:</label>
                            <input type="number" class="form-control text-center" name="quantidade[<?= $produto['id'] ?>]" value="1" min="1" style="width: 80px; margin: auto;">
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success">Fazer Pedido</button>
        </div>
        <div class="container">
        <a href="../app/home.php" class="voltar-btn">Voltar</a>
    </div>

    </form>
</div>
</body>
</html>
