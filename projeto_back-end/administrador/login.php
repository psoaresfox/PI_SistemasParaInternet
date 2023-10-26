<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login do Administrador</title>
    <style>
        body{
            background: rgb(238,174,202);
            background: linear-gradient(90deg, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);   
            
        }
        body form{
            display: flex;
            border-radius: 5vh;
            width: 50vw;
            height: 60vh;
            justify-content: center;
            align-items: center;
            text-align: center;
            background: rgb(238,174,202);
            background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);
            box-shadow: 4vh 4vh 4vh rgba(0, 0, 0, 0.459);
            color: white;
        }
        body form h2{
            position: relative;
            bottom: 15vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: 700;
            font-size: 2rem;
        }
       body form input{
            padding: 0.5vh;
            border-radius: 1vh;
        }
    </style>
</head>
<body>
    <h2>Login do Administrador</h2>
    <form action="processa_login.php" method="post"> <!-- Post não mostra as informações do usuário, ao contrário do Get que mostra tudo.-->
    <label for="nome">Nome: </label>
    <input type="text" name="nome" id="nome" required> <!--Required serve para ter que preencher obrigatóriamente o campo-->
    <p><br></p> <!--<br> quebra de linha-->
    <label for="senha">Senha: </label>
    <input type="text" name="senha" id="senha" required>
        <p><br></p>
    <input type="submit" value="Entrar">

        <?php
        /*Mensagem de erro para caso os dados do usuário sejam incorretos. */
            if(isset($_GET['error'])){ //A mensagem de erro funciona como super global GET e não POST.
                echo '<p style= "color: red; ">Nome do usuário ou senha incorretos!</p>';
            }
        ?>
    </form>
</body>
</html>