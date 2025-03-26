<?php
session_start();

if (!isset($_SESSION['usuario_logado'])) {
    header("Location: index.html");
    exit();
}

// Gerar número da sorte
$numero_sorte = rand(1, 100);

// Salvar na sessão para mostrar ao usuário
$_SESSION['numero_sorte'] = $numero_sorte;

// Simular envio por WhatsApp
$celular = $_SESSION['usuario_logado'];
$mensagem = "Seu número da sorte é: $numero_sorte";
// Aqui você implementaria o envio real
// Por enquanto, apenas simulamos
echo "<script>alert('Número enviado para WhatsApp (simulado): $numero_sorte');</script>";

// Redirecionar de volta ao painel
header("Location: painel-usuario.php");
exit();
?>