<?php
session_start();

// Configurações do banco
$server = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'formulario_infinito';

// Conexão com o banco
$conn = new mysqli($server, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Falha ao se comunicar com o banco de dados: " . $conn->connect_error);
}

// Gerar código de 6 dígitos
$codigo = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

// Salvar dados na sessão para verificação posterior
$_SESSION['dados_cadastro'] = [
    'nome' => $_POST['nome'],
    'email' => $_POST['email'],
    'cpf' => $_POST['cpf'],
    'cep' => $_POST['cep'],
    'celular' => $_POST['celular'],
    'codigo' => $codigo
];

// Aqui você implementaria o envio real do WhatsApp
// Esta é uma simulação do envio
$mensagem_whatsapp = "Seu código de verificação é: $codigo";
// Simulação: mostra o código na tela para testes
echo "<script>alert('Código enviado para WhatsApp (simulado): $codigo');</script>";

// Redirecionar para página de verificação
header("Location: verificar-codigo.php");
exit();
?>