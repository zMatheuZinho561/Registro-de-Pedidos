<?php 
 include('../src/connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];



    $preco = filter_var($preco, FILTER_VALIDATE_FLOAT);

 $sql = "INSERT INTO produtos (nome, descricao, preco, estoque)
 VALUES ('$nome', '$descricao','$preco','$estoque')";
 

 if ($mysqli->query($sql) === TRUE){
   header("Location: ../interface/end.php");
    
 }else{
    echo "ERRO:" .$sql . "<br>" . $mysqli->error;
 }




}



?>