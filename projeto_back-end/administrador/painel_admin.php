<?php


session_start();

//Este trecho de código verifica se o usuário está logado como administrador (usando a superglobal $_SESSION que foi criada no arquivo processa_login.php). Se não estiver, ele o redireciona para a página de login. Se estiver, ele tem acesso a partes do site restritas a administradores.
if(!isset($_SESSION['admin_logado'])){
    header("Location:login.php");
    exit();
}
//Usar exit(); após um redirecionamento é considerado uma prática de programação segura. Previne a Execução de Código Subsequente. 
?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Administrador</title>
    <style>
        body{
            background: rgb(253,240,45);
            background: linear-gradient(222deg, rgba(253,240,45,1) 1%, rgba(34,193,195,1) 56%, rgba(45,136,253,1) 83%);
            background-repeat: no-repeat;
            height: 734px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            
        }
        button{
            margin: 20px;
        }
        .container{
            background: rgb(253,240,45);
            background: linear-gradient(346deg, rgba(253,240,45,1) 0%, rgba(34,193,195,1) 40%, rgba(45,136,253,1) 77%);
            width: 25%;
            height: 12rem;
            border-radius: 20px;
        }
    </style>
</head>
<body>
    <section class="container">
        <h2>Bem-vindo Administrador</h2>
        <a href="cadastrar_produto.php">
        <button>Cadastrar Produto</button></a>
        <a href="listar_produtos.php"><button>Voltar à Lista de Produtos</button></a>
        <a href="../administrador/login.php"><button>Log Out</button></a>
    </section>
</body>
</html>