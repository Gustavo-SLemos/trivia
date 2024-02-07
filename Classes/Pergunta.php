<?php

require "RequisicaoAPI.php";

class Pergunta {


    public function gerarPerguntaAPI() {
        
        $data = json_decode(file_get_contents("https://opentdb.com/api.php?amount=1"), true);
        
        foreach ($data["results"] as $questao) {

            echo "<h2 class='pergunta'>" . $questao["question"] . "</h2>" . "<br>";

            $opcoes = array_merge([$questao['correct_answer']], $questao['incorrect_answers']);
        
            shuffle($opcoes);
        
            foreach ($opcoes as $opcao) {
                echo "<input class='opcao' type='radio' name='id_resposta' value=$opcao>$opcao<br>";
            }
        }

        $banco = (new RequisicaoAPI)->dadosAPI($data);
        return $questao["question"];
    }

    public function gerarPerguntaBD(){
        $connect = new Connect();
        $connect = $connect->getConnection();

        $stmt = $connect->prepare("SELECT question, correct_answer, incorrect_answers FROM pergunta ORDER BY RANDOM() LIMIT 1");
        $stmt->execute();
        $questao = $stmt->fetch(PDO::FETCH_ASSOC);

        echo "<h2 class='pergunta'>" . $questao["question"] . "</h2>" . "<br>";
        
        $opcoes = array_merge([$questao['correct_answer']], json_decode($questao['incorrect_answers']));//decode para o json de incorretas
        shuffle($opcoes);
        
        foreach ($opcoes as $opcao) {
            echo "<input class='opcao' type='radio' name='id_resposta' value='$opcao'>$opcao<br>";
        }

        return $questao["question"];
    }
}


?>