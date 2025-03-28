<?php

//pegando os dados vindos do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$cep = $_POST['cep'];
$celular = $_POST['celular'];
$data_atual = date('d/m/Y'); //25/11/2025
$hora_atual = date('H:i:s');

//CONFIGURAÇÕES DE CREDENCIAIS
$server ='localhost';
$usuario = 'root';
$senha = '';
$banco = 'formulario_infinito';

//CONEXÕES COM NOSSO BANCO DE DADOS
$conn = new mysqli($server, $usuario, $senha, $banco);

//VERIFICAR CONEXÃO
if($conn->connect_error) {
    die("Falha ao se comunicar com o banco de dados: " .$conn->connect_error);
}

$smtp = $conn->prepare("INSERT INTO inscrições (nome, email, cpf, cep, celular, data, hora) VALUES (?, ?, ? ,?, ?, ?, ?)");
$smtp->bind_param("sssssss", $nome, $email, $cpf, $cep, $celular, $data_atual, $hora_atual);

if($smtp->execute()) {
    echo '<div class="alert alert-success">Mensagem enviada com sucesso!</div>';
    echo '<p>Você será redirecionando em 3 segundos...</p>';
    echo '<script>setTimeout(function() { window.location.href = "sorteio.html"; }, 3000);</script>';
} else {
    echo '<div class="alert alert-error">Erro no envio da mensagem: ' . $smtp->error . '</div>';
}
$smtp->close();
$conn->close();

?>