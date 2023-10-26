<?php
session_start();
require_once('../administrador/conexao.php');
if(!isset($_SESSION['admin_logado'])){
    header("Location:login.php");
    exit();
}//verifica se o usuário está logado e o metodo se post.

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $imagem = $_FILES['imagem']['name'];//******corrigir $_POST['imagem'];
    $url_imagem = $_POST['url_imagem'];//Receber a URL da imagem do formulário

    //Diretório onde a imagem será salva
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($imagem);

    //Gerar a URL da imagem
    $base_url = "http://localhost/Projeto/";
    $url_imagem = $base_url . "uploads/" . basename($imagem); 

    
    //Mover o arquivo de imagem carregado para o diretório de destino
    if(move_uploaded_file($_FILES['imagem']['tmp_name'], $target_file)){
        echo "Imagem " . basename($imagem) . " foi carregada";
    }else {
        echo "Falha ao carregar a imagem";
    }

    try{/*Try Catch são blocos de comandos que tem como principal objetivo tratar exceções que o programador não tem como prever que irão acontecer ou controlar. Como, por exemplo, erros de execução, ou ainda erros como o usuário perder a conexão com a internet, entre outros. */
    $sql = "INSERT INTO PRODUTOS (nome, descricao, preco, imagem, url_imagem) VALUES (:nome, :descricao, :preco, :imagem, :url_imagem)";
    $stmt = $pdo->prepare($sql);//Preparação para evitar a injeção de sql. 
    /*Tratamento de segurança */
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
    $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
    $stmt->bindParam(':imagem', $target_file, PDO::PARAM_STR);
    $stmt->bindParam(':url_imagem', $url_imagem, PDO::PARAM_STR);
    $stmt->execute();

    echo "<p style='color:green; '>Produto cadastrado com sucesso!</p>";
    } catch(PDOException $e) {
        echo "<p style='color:red;'>Erro ao cadastrar o produto: " . $e->getMessage()."</p>"; 
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
    <style>
        body{
            background: rgb(174,238,185);
            background: linear-gradient(222deg, rgba(174,238,185,1) 26%, rgba(174,173,234,1) 45%, rgba(114,110,242,1) 67%);
            margin: 50px;
            padding: 92px 50px 0px 324px;
        }
    </style>
</head>
<body>
    <section class="container">
        <h2>Cadastrar Produto</h2>
        <form action="" method="post" enctype="multipart/form-data">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
        <p></p>
        <label for="descricao">Descrição</label>
        <textarea name="descricao" id="descricao" required></textarea>
        <p></p>
        <label for="preco">Preço</label>
        <input type="number" name="preco" id="preco" step="0.01" required>
        <p></p>
        <label for="imagem">Imagem</label>
        <input type="file" name="imagem" id="imagem">
        <p></p>
        <label for="url_imagem">URL da Imagem</label>
        <input type="text" name="url_imagem" id="url_imagem">
        <p></p>
        <input type="submit" value="Cadastrar">
        </form>
    </section>
    <a href="../administrador/painel_admin.php"><button>Voltar ao Painel do Adimn</button></a>
    <a href="../administrador/listar_produtos.php"><button>Lista de produtos</button></a>
    <a href="../administrador/login.php"><button>Log Out</button></a>
</body>
</html>
