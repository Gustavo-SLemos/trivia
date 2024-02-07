<?php 

require "Pergunta.php";


class Jogo extends Pergunta {
    protected string $nomeJogador;
    protected int $numeroPerguntas;
    protected int $idJogo;


    public function __construct($nomeJogador)
    {
        $this->nomeJogador = $nomeJogador;

        session_start();

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

    public function iniciarJogo() {
        
        $pergunta = new Pergunta();

        $conexaoInternet = $this->verificarConexaoInternet();
        
        if ($conexaoInternet) {
            
            $perguntas = $pergunta->gerarPerguntaAPI();
            $_SESSION["pergunta"] = $perguntas;

            $this->numeroPerguntas = $_SESSION["numeroPerguntas"];
            
            if ($this->numeroPerguntas % 5 == 0) {
                $_SESSION["idJogo"]++;
                $this->idJogo = $_SESSION["idJogo"];
                $perguntas = $pergunta->gerarPerguntaAPI();
            }

        } else {

            $perguntas = $pergunta->gerarPerguntaBD();
            $_SESSION["pergunta"] = $perguntas;
            
            $this->numeroPerguntas = $_SESSION["numeroPerguntas"];

            if ($this->numeroPerguntas % 5 == 0) {
                $_SESSION["idJogo"]++; 
                $this->idJogo = $_SESSION["idJogo"];   
            }

        }

        $_SESSION["numeroPerguntas"]++;

        var_dump($this->idJogo);
        var_dump($this->numeroPerguntas);
        return $perguntas;
    }

}





?>