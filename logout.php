<?php
session_start();

// Limpar todas as variáveis de sessão
$_SESSION = array();

// Destruir a sessão
session_destroy();

// Redirecionar para página inicial
header("Location: index.html");
exit();
?>