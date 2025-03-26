<?php
session_start();

if (!isset($_SESSION['usuario_logado'])) {
    header("Location: index.html");
    exit();
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

// Buscar dados do usuário
$celular = $_SESSION['usuario_logado'];
$sql = "SELECT * FROM inscrições WHERE celular = ? ORDER BY id DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $celular);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Usuário</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="painel">
        <h2>Bem-vindo, <?php echo htmlspecialchars($usuario['nome']); ?>!</h2>
        
        <div class="info-usuario">
            <p><strong>Celular:</strong> <?php echo htmlspecialchars($usuario['celular']); ?></p>
            <p><strong>E-mail:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
            <p><strong>CPF:</strong> <?php echo htmlspecialchars($usuario['cpf']); ?></p>
            <p><strong>CEP:</strong> <?php echo htmlspecialchars($usuario['cep']); ?></p>
        </div>
        
        <div class="jogo-sorte">
            <h3>Jogo do Número da Sorte</h3>
            <form action="gerar-numero-sorte.php" method="post">
                <button type="submit">Gerar Número da Sorte</button>
            </form>
            
            <?php if (isset($_SESSION['numero_sorte'])): ?>
                <div class="numero-sorte">
                    <p>Seu número da sorte é: <?php echo $_SESSION['numero_sorte']; ?></p>
                    <p>(Enviado para seu WhatsApp)</p>
                </div>
                <?php unset($_SESSION['numero_sorte']); ?>
            <?php endif; ?>
        </div>
        
        <a href="logout.php" class="logout">Sair</a>
    </div>
</body>
</html>