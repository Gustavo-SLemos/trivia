<?php 

require "Pergunta.php";


class Jogo extends Pergunta {
    protected string $nomeJogador;
    protected int $numeroPerguntas;
    protected int $idJogo;


    public function __construct($nomeJogador)
    {
        $this->nomeJogador = $nomeJogador;

        if (!isset($_SESSION["idJogo"])) {
            $_SESSION["idJogo"] = 0;
        }
        $this->idJogo = $_SESSION["idJogo"];

        if (!isset($_SESSION["numeroPerguntas"])) {
            $_SESSION["numeroPerguntas"] = 0;
        }
        $this->numeroPerguntas = $_SESSION["numeroPerguntas"];

        $_SESSION["nomeJogador"] = $this->nomeJogador;
    }

    public function verificarConexaoInternet() {
        $url = 'https://www.google.com';
    
        $headers = @get_headers($url);
        if ($headers && strpos($headers[0], '200')) {
            return true;
        } else {
            return false;
        }
    }

    public function iniciarJogo($connect) {
        
        $pergunta = new Pergunta();

        $conexaoInternet = $this->verificarConexaoInternet();

        $this->numeroPerguntas = $_SESSION["numeroPerguntas"];
        
        if ($conexaoInternet) {
            
            $perguntas = $pergunta->gerarPerguntaAPI($connect);
            $_SESSION["pergunta"] = $perguntas;
            
            $this->novoJogo();

        } else {

            $perguntas = $pergunta->gerarPerguntaBD($connect);
            $_SESSION["pergunta"] = $perguntas;
        
            $this->novoJogo();

        }

        $_SESSION["numeroPerguntas"]++;

        return $perguntas;
    }

    public function novoJogo() {

        if ($this->numeroPerguntas % 5 == 0) {
            $_SESSION["idJogo"]++;
            $this->idJogo = $_SESSION["idJogo"];
        }

    }

}





?>