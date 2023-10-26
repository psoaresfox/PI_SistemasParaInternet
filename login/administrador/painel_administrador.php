<?php 

    session_start();

    if(!isset($SESSION['admin_logado'])) {
        header("Location:login.php");
        exit();
    }

    echo "Bem vindo, administrador";
?>