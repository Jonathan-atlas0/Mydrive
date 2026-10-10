<?php

if (!isset($_GET["arquivo"])) {
    die("Arquivo não informado.");
}

$nome = basename($_GET["arquivo"]);

$caminho = "uploads/" . $nome;

if (!file_exists($caminho)) {
    die("Arquivo não encontrado.");
}

header("Content-Disposition: attachment; filename=\"" . $nome . "\"");
header("Content-Length: " . filesize($caminho));
header("Content-Type: application/octet-stream");

readfile($caminho);
exit;