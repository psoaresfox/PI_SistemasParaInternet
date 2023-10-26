<?php 
    session_start();

    require_once('../login/conexao/conexao.php');

    $email = $GET['back-email'];
    $senha = $_GET['back-password'];

    $sql = "SELECT * FROM Administrador WHERE ADM_EMAIL = :email AND ADM_SENHA = :senha AND ADM_ATIVO = 1";

    $query = $pdo->prepare($sql);
    $query->bindParam(':email',$nome, PDO::PARAM_STR);
    $query->bindParam(':senha', $senha, PDO::PARAM_STR);

    $query->execute();

    if ($query->rowCount() > 0) {
        $_SESSION['admin_logado'] = true;
        header ('Location: administrador/painel_administrador.php');
    } else {
        $_SESSION['admin_logado'] = false;
        header('Location: login.php');
    }
?>