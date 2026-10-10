<?php
$host = "172.17.0.1";
$banco = "mini_drive";
$usuario = "drive";
$senha = "drive123";
try {

    $pdo = new PDO(
        "mysql:host=$host;port=3307;dbname=$banco;charset=utf8mb4",
        $usuario,
        $senha
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch (PDOException $e) {

    die("Erro na conexão: " . $e->getMessage());

}