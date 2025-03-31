<?php 
if(isset($_POST['email']) && isset($_POST['senha'])) {

    include('./src/connect.php');

    $email = $mysqli->escape_string($_POST['email']);
    $senha = $_POST['senha'];

    $sql_code = "SELECT * FROM clientes WHERE email = '$email'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

    if($sql_query->num_rows == 0) {
        echo "O e-mail informado é incorreto";
    } else {
        $usuario = $sql_query->fetch_assoc();
        if(!password_verify($senha, $usuario['senha'])) {
            echo "A senha informada está incorreta";
            
        } else {
            if(!isset($_SESSION))
                session_start();
            $_SESSION['usuario'] = $usuario['id'];
            header("Location: /MYORDERED/app/home.php");
            exit();
        }
    }

}


?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../MyOrdered/css/login.css">
</head>
<body>
    <div class="page">
        <form action="" method="POST" class="formLogin">
            <h1>Login</h1>
            <p>Digite os seus dados de acesso no campo abaixo</p>
            <label for="email">E-mail</label>
            <input type="text" name="email" placeholder="Digite seu e-mail" autofocus="true">
            <label for="password">Senha</label>
            <input type="password" placeholder="Digite sua senha" name="senha">
            <button type="submit" class="btn">Entrar</button>
            <a href="../MyOrdered/app/register.php" class="register">Criar conta</a>
        </form>
    </div>
</body>
</body>
</html>