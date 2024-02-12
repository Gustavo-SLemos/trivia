<?php
require __DIR__ . "/../Model/Jogo.php";
require __DIR__ . "/../Model/Tentativa.php";
require __DIR__ . "/../Model/Connect.php";

session_start();

$connect = new Connect();
$connect = $connect->getConnection();

$jogo = new Jogo($_GET["nomeJogador"]);

if(isset($_POST["sair"])) {
    unset($_SESSION["numeroPerguntas"]);
    header("Location: index.html");
}

if(isset($_POST["resposta"])) {
    $_SESSION["id_resposta"] =$_POST["id_resposta"];
    $salvar = (new Tentativa)->armazenaPergunta($_SESSION['idJogo'], $_SESSION['numeroPerguntas'], $_SESSION['nomeJogador'], $_SESSION['id_resposta'], $_SESSION['pergunta'], $connect);
}


?>
