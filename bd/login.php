<?php
session_start();

include_once 'conexao.php';
$objeto = new Conexao();
$conexao = $objeto->Conectar();

// Recepção dos dados enviados via POST
$nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
$senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';

// Consultar usuário no banco de dados
$consulta = "SELECT * FROM usuarios WHERE nome=:nome";
$resultado = $conexao->prepare($consulta);
$resultado->bindParam(':nome', $nome);
$resultado->execute();

$data = null; // Inicializa a variável $data como null

if ($resultado->rowCount() > 0) {
    $usuario = $resultado->fetch(PDO::FETCH_ASSOC);

    // Debugging: Verifique o conteúdo da senha
    error_log('Senha armazenada: ' . $usuario['senha']);
    error_log('Senha fornecida: ' . $senha);

    // Verificar a senha
    if ($senha === $usuario['senha']) {
        $_SESSION["nome"] = $nome;
        $data = $usuario;
    } else {
        $_SESSION["nome"] = null;
    }
} else {
    $_SESSION["nome"] = null;
}

// Retornar a resposta em formato JSON
print json_encode($data);
$conexao = null;

