<?php 

require "Pergunta.php";


class Jogo extends Pergunta {
    protected string $nomeJogador;
    protected int $numeroPerguntas;
    protected int $idJogo;


    public function __construct($nomeJogador)
    {
        $this->nomeJogador = $nomeJogador;
        $this->numeroPerguntas = 0;

        session_start();

        if (!isset($_SESSION["idJogo"])) {
            $_SESSION["idJogo"] = 1;
        }
        $this->idJogo = $_SESSION["idJogo"];

        

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
        $this->numeroPerguntas++;
        
        $conexaoInternet = $this->verificarConexaoInternet();
        
        if ($conexaoInternet) {
            
            $perguntas = $pergunta->gerarPerguntaAPI();
            $_SESSION["pergunta"] = $perguntas;
            
            if ($this->numeroPerguntas > 5) {
                $_SESSION["idJogo"]++; 
                $this->idJogo = $_SESSION["idJogo"];
                $this->numeroPerguntas = 0;
                session_destroy();
            }

        } else {

            $perguntas = $pergunta->gerarPerguntaBD();

        }

       
        var_dump($this->numeroPerguntas);
        return $perguntas;
    }

    public function novoJogo() {

        if ($this->numeroPerguntas > 5) {
            $_SESSION["idJogo"]++; 
            $this->idJogo = $_SESSION["idJogo"]; 
        }
    }

}





?>