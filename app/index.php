<?php

require "conexao.php";

$arquivos = $pdo->query("SELECT * FROM arquivos ORDER BY enviado_em DESC")->fetchAll();

$extensoes_imagem = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Drive</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">☁ Meu Drive</div>
</header>

<main class="container">

    <div class="topo">
        <h1>Meus arquivos</h1>
    </div>

    <div class="upload-area">
        <p>Envie seus arquivos para o seu Drive</p>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="arquivo" required>
            <br>
            <button type="submit">↑ Enviar arquivo</button>
        </form>
    </div>

    <div class="arquivos">
        <?php foreach ($arquivos as $arquivo): ?>
            <?php
                $ext = strtolower(pathinfo($arquivo['nome'], PATHINFO_EXTENSION));
                $eh_imagem = in_array($ext, $extensoes_imagem);
            ?>
            <div class="arquivo">
                <div class="icone">
                    <?php if ($eh_imagem): ?>
                        <img src="uploads/<?= urlencode($arquivo['nome']) ?>" alt="preview" style="max-width:100px;max-height:100px;border-radius:6px;">
                    <?php else: ?>
                        📄
                    <?php endif; ?>
                </div>
                <div class="nome">
                    <?= htmlspecialchars($arquivo['nome']) ?>
                </div>
                <div class="acoes">
                    <a class="download" href="download.php?arquivo=<?= urlencode($arquivo['nome']) ?>">Baixar</a>
                    <a class="excluir" href="delete.php?arquivo=<?= urlencode($arquivo['nome']) ?>">Excluir</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</main>

</body>
</html>