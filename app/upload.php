<?php

require "conexao.php";

$pdo->exec("CREATE TABLE IF NOT EXISTS arquivos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    tamanho INT,
    enviado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

if (!isset($_FILES["arquivo"])) {
    die("Nenhum arquivo enviado.");
}

$arquivo = $_FILES["arquivo"];

if ($arquivo["error"] !== UPLOAD_ERR_OK) {
    die("Erro no upload.");
}

$nome = basename($arquivo["name"]);
$tamanho = $arquivo["size"];
$destino = "uploads/" . $nome;

if (move_uploaded_file($arquivo["tmp_name"], $destino)) {
    $stmt = $pdo->prepare("INSERT INTO arquivos (nome, tamanho) VALUES (?, ?)");
    $stmt->execute([$nome, $tamanho]);
    header("Location: index.php");
    exit;
}

echo "Erro ao salvar o arquivo.";