<?php
session_start();

if (!isset($_SESSION['dados_cadastro'])) {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Código</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <form action="finalizar-cadastro.php" method="post">
        <h2>Verificação por WhatsApp</h2>
        <p>Enviamos um código de 6 dígitos para o número <?php echo $_SESSION['dados_cadastro']['celular']; ?></p>
        
        <label for="codigo">Código de Verificação:</label>
        <input type="text" name="codigo" placeholder="Digite o código recebido" required maxlength="6">
        
        <button type="submit">Verificar</button>
    </form>
</body>
</html>