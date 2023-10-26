<?php

session_start();

 

if(!isset($_SESSION['admin_logado'])){
    header('Location:login.php');
    exit();
}

 
require_once('../conexao/conexao.php');

 
try{
    $stmt = $pdo->prepare("SELECT * FROM PRODUTOS");
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo "Erro: ". $e->getMessage();
}

?>

 

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

 <style>
    body{
        background: rgb(174,238,185);
        background: linear-gradient(324deg, rgba(174,238,185,1) 21%, rgba(234,173,229,1) 45%, rgba(114,110,242,1) 67%);
        padding: 20px 50px 0px 200px;
    }
    th, td{
        padding: 8px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }
    th{
        background-color: #f2f2f2;
    }
    tr:hover{
        background-color: #f5f5f5;
    }
 </style>

</head>

<body>
    <h2>Lista de produtos</h2>
    <table>
        <header>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Imagem</th>
                <th>Ações</th>
            </tr>
        </header>
        <tbody>
            <?php foreach($produtos as $produto): ?>
                <tr>
                <td><?php echo $produto['id'];?></td>
                    <td><?php echo $produto['nome'];?></td>
                    <td><?php echo $produto['descricao'];?></td>
                    <td><?php echo $produto['preco'];?></td>
                    <td><?php echo $produto['imagem'];?></td>
                    <td><img src="<?php echo $produto['url_imagem'];?>" alt="Imagem do Produto" width="50"></td>

                    <td>
                    <a href="editar_produto.php?id=<?php echo $produto['id']; ?>"><button>Editar</button></a> |
                    <a href="excluir_produto.php?id=<?php echo $produto['id']; ?>" onclick="return confirmarExclusao();"><button>Excluir</button></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>

    <a href="painel_admin.php"><button>Voltar ao Painel</button></a>
    <a href="../administrador/cadastrar_produto.php"><button>Cadastrar mais produtos</button></a>
    <a href="../administrador/login.php"><button>Log Out</button></a>
</body>

</html>