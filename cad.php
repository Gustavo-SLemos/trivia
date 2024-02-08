<?php
require "Classes/Jogo.php";
require "Classes/Tentativa.php";

$jogo = new Jogo($_GET["nomeJogador"]);

if(isset($_POST["sair"])) {
    unset($_SESSION["numeroPerguntas"]);
    header("Location: index.html");
}

if(isset($_POST["resposta"])) {
    $_SESSION["id_resposta"] =$_POST["id_resposta"];
    $salvar = (new Tentativa)->armazenaPergunta($_SESSION['idJogo'], $_SESSION['numeroPerguntas'], $_SESSION['nomeJogador'], $_SESSION['id_resposta'], $_SESSION['pergunta']);
}

var_dump($_SESSION);

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
            <input type="submit" name="resposta" value="Enviar">           
            <p><button type="submit" name="sair">Sair</button></p>
        </form>
    </section>
</body>
</html>