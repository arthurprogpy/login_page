<?php

// Define as informações de login do banco de dados
$usuario = 'root';
$senha = '';
$database = 'login';
$host = 'localhost';

// Cria um novo objeto mysqli para conectar ao banco de dados
$mysqli = new mysqli($host, $usuario, $senha, $database);

// Verifica se houve algum erro na conexão com o banco de dados
if($mysqli->error) {
    // Em caso de erro, exibe uma mensagem de falha na conexão com o banco de dados
    // e a mensagem de erro do MySQL
    die("Falha ao conectar ao banco de dados: " . $mysqli->error);
}

// Se não houver erros na conexão, o código continuará a execução normalmente.