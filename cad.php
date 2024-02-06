<?php
require_once "Classes/Jogo.php";
require_once "Classes/Connect.php";



$jogo = new Jogo($_GET["nomeJogador"]);



?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>GL QUIZ</title>
</head>
<body>
    <section class="section-cad">
        <form class="form-cad" method="post">
            <?php $jogo->iniciarJogo(); ?>
        </form>
        <input type="submit" value="Enviar">
        <p><a href="index.html"><button>Sair</button></a></p>
    </section>
</body>
</html>