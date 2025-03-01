<?php
// Definição das variáveis de conexão
$dbhost = 'localhost';
$dbusername = 'root';
$dbpassword = '';  // Senha do banco de dados
$dbname = 'event_manager';

// Criação da conexão com o banco de dados
$conexao = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

// Verificação da conexão
if ($conexao->connect_errno) {
    die("Erro na conexão: " . $conexao->connect_error);
}

// Definir a codificação de caracteres
$conexao->set_charset('utf8');

// Função para retornar a conexão
function getConnection() {
    global $conexao;
    return $conexao;
}
?>

