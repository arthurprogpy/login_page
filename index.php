<?php

// Inclui o arquivo de conexão ao banco de dados
include('conexao.php');

// Verifica se o formulário de login foi submetido
if(isset($_POST['email']) || isset($_POST['senha'])) {

    // Verifica se o campo de e-mail foi preenchido
    if(strlen($_POST['email']) == 0) {
        echo "Preencha seu e-mail";
    } else if(strlen($_POST['senha']) == 0) {
        // Verifica se o campo de senha foi preenchido
        echo "Preencha sua senha";
    } else {

        // Limpa e escapa os valores de e-mail e senha
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        // Monta o código SQL para selecionar o usuário com o e-mail e senha informados
        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";

        // Executa o código SQL e verifica se houve erros
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        // Verifica a quantidade de resultados encontrados
        $quantidade = $sql_query->num_rows;

        // Se houver apenas um usuário com o e-mail e senha informados
        if($quantidade == 1) {
            
            // Obtém os dados do usuário encontrado
            $usuario = $sql_query->fetch_assoc();

            // Inicia a sessão, caso não esteja iniciada
            if(!isset($_SESSION)) {
                session_start();
            }

            // Define as variáveis de sessão com o ID e nome do usuário
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            // Redireciona o usuário para o painel
            header("Location: painel.php");

        } else {
            // Se não houver nenhum ou mais de um usuário com o e-mail e senha informados, exibe uma mensagem de erro
            echo "Falha ao logar! E-mail ou senha incorretos";
        }

    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Acesse sua conta</h1>
    <form action="" method="POST">
        <p>
            <label>E-mail</label>
            <input type="text" name="email">
        </p>
        <p>
            <label>Senha</label>
            <input type="password" name="senha">
        </p>
        <p>
            <button type="submit">Entrar</button>
        </p>
    </form>
</body>
</html>
