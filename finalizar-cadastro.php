<?php
session_start();

if (!isset($_SESSION['dados_cadastro'])) {
    header("Location: index.html");
    exit();
}

// Verificar código
if ($_POST['codigo'] !== $_SESSION['dados_cadastro']['codigo']) {
    die("Código inválido. Por favor, tente novamente.");
}

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

// Inserir no banco de dados
$dados = $_SESSION['dados_cadastro'];
$data_atual = date('d/m/Y');
$hora_atual = date('H:i:s');

$stmt = $conn->prepare("INSERT INTO inscrições (nome, email, cpf, cep, celular, data, hora) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $dados['nome'], $dados['email'], $dados['cpf'], $dados['cep'], $dados['celular'], $data_atual, $hora_atual);

if ($stmt->execute()) {
    // Cadastro concluído com sucesso
    $_SESSION['usuario_logado'] = $dados['celular'];
    header("Location: painel-usuario.php");
} else {
    echo "Erro no cadastro: " . $stmt->error;
}

$stmt->close();
$conn->close();
unset($_SESSION['dados_cadastro']);
?>