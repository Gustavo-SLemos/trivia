<?php 

require "Pergunta.php";

class Jogo {
    protected string $nomeJogador;
    protected int $numeroPerguntas;


    public function __construct($nomeJogador)
    {
        $this->nomeJogador = $nomeJogador;
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

        } else {

            $perguntas = $pergunta->gerarPerguntaBD();

        }
        
        return $perguntas;
    }
}

?>