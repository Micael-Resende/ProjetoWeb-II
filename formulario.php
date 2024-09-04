<?php
include_once 'bd/conexao.php';

if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    // $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

    try {
        $conexao = Conexao::Conectar();
        $stmt = $conexao->prepare("INSERT INTO usuarios (nome, email, telefone, senha) VALUES (:nome, :email, :telefone, :senha)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':senha', $senha);

        if ($stmt->execute()) {
            echo "Dados inseridos com sucesso!";
            header('Location: index.php');
        } else {
            echo "Erro na inserção.";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Web</title>
    <link rel="stylesheet" href="css/formulario.css">
</head>
<body>
    <a href="home.php"><img src="img/seta-esquerda.png" alt="seta" height="20px"></a>
    <div class="box">
        <form action="formulario.php" method="POST">
            <fieldset>
                <legend><b>Fórmulario</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelInput">Nome completo</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" required>
                    <label for="senha" class="labelInput">Senha</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" required>
                    <label for="email" class="labelInput">Email</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                    <label for="telefone" class="labelInput">Telefone</label>
                </div>
                <br>
                <button type="submit" name="submit" id="submit">Enviar</button>
            </fieldset>
        </form>
    </div>
</body>
</html>
