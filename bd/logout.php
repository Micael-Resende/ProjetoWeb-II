<?php
session_start();
unset($_SESSION["nome"]); // Remove a variável específica
session_unset(); // Remove todas as variáveis de sessão
#session_destroy(); // Destrói a sessão
header("Location: ../index.php");
#exit(); // Adiciona um exit após o redirecionamento para garantir que o script pare de executar
?>
