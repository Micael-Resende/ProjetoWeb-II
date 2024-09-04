<?php
include_once 'conexao.php';
$objeto = new Conexao();
$conexao = $objeto->Conectar();

// Recepção dos dados enviados mediante POST
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';
$opcao = isset($_POST['opcao']) ? $_POST['opcao'] : '';
$id = isset($_POST['id']) ? $_POST['id'] : '';

$hashedSenha = password_hash($senha, PASSWORD_DEFAULT);
$data = [];  // Inicializa a variável $data como um array vazio

switch($opcao){
    case 1: // Inserção
        $consulta = "INSERT INTO usuarios (nome, email, telefone, senha) VALUES(:nome, :email, :telefone, :senha)";
        $resultado = $conexao->prepare($consulta);
        $resultado->bindParam(':nome', $nome);
        $resultado->bindParam(':email', $email);
        $resultado->bindParam(':telefone', $telefone);
        $resultado->bindParam(':senha', $senha);
        $resultado->execute();

        $consulta = "SELECT id, nome, email, telefone, senha FROM usuarios ORDER BY id DESC LIMIT 1";
        $resultado = $conexao->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 2: // Modificação
        $consulta = "UPDATE usuarios SET nome=:nome, email=:email, telefone=:telefone, senha=:senha WHERE id=:id";
        $resultado = $conexao->prepare($consulta);
        $resultado->bindParam(':nome', $nome);
        $resultado->bindParam(':email', $email);
        $resultado->bindParam(':telefone', $telefone);
        $resultado->bindParam(':senha', $senha);
        $resultado->bindParam(':id', $id);
        $resultado->execute();

        $consulta = "SELECT id, nome, email, telefone, senha FROM usuarios WHERE id=:id";
        $resultado = $conexao->prepare($consulta);
        $resultado->bindParam(':id', $id);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 3: // Exclusão
        $consulta = "DELETE FROM usuarios WHERE id=:id";
        $resultado = $conexao->prepare($consulta);
        $resultado->bindParam(':id', $id);
        $resultado->execute();
       
        $data = ['success' => true]; 
        break;
}

// Verifica se $data não está vazio antes de retornar
if (!empty($data)) {
    print json_encode($data, JSON_UNESCAPED_UNICODE);
}

$conexao = null;  // Fecha a conexão


