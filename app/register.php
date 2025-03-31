<?php
if(!isset($_SESSION))
session_start();







if(count($_POST) > 0) {

    include('../src/connect.php');
    
    $erro = false;
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha_descriptografada = $_POST['senha'];

    if(strlen($senha_descriptografada) < 6 && strlen($senha_descriptografada) > 16) {
        $erro = "A senha deve ter entre 6 e 16 caracteres.";
    }

    if(empty($nome)) {
        $erro = "Preencha o nome";
    }
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Preencha o e-mail";
    }

    if($erro) {
        echo "<p><b>ERRO: $erro</b></p>";
    } else {
        $senha = password_hash($senha_descriptografada, PASSWORD_DEFAULT);

            $sql_code = "INSERT INTO clientes (nome, email, senha, data) 
        VALUES ('$nome', '$email', '$senha', NOW())";

        $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
      }
        }
    



?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../css/register_ex.css">
</head>
<body>
    <div class="page">
        
       <form action="" method="POST" class="formRegister">
       <h1>Registro</h1>
       <p>Digite os seus dados de acesso no campo abaixo</p>
    
    <label>Nome: </label>
    <input value="<?php if(isset($_POST['nome'])) echo $_POST['nome'];?>" name="nome" type="text">   
   
    
   
    <label>E-mail</label>
    <input value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>"  name="email" type="text">  
   

    <label>Senha:</label>
    <input value="<?php if(isset($_POST['senha'])) echo $_POST['senha']; ?>" name="senha" type="password">
    
  
  
        <button type="submit" class="btn">Registrar</button>
        <a href="/MyOrdered/index.php" class="register">Voltar</a>
    </form> 
    </div>
    
   

</body>
</html>