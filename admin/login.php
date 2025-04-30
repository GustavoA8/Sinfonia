<?php
session_start();

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

// Aqui você define o login válido
$usuario_correto = 'biaefifo02';
$senha_correta = '123';

if ($usuario === $usuario_correto && $senha === $senha_correta) {
    $_SESSION['logado'] = true;
    header("Location: estoque.php");
    exit;
} else {
    echo "<script>alert('Usuário ou senha inválidos!'); window.location.href='admin.html';</script>";
}
?>
