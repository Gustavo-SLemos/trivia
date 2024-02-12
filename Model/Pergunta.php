<?php

require "ArmazenarDados.php";
require "APIcurl.php";


class Pergunta {


    public function gerarPerguntaAPI($connect) {

        $data = (new APIcurl)->requisicaoCurl();

        foreach ($data["results"] as $questao) {

            echo "<h2 class='pergunta'>" . $questao["question"] . "</h2>" . "<br>";

            $opcoes = array_merge([$questao['correct_answer']], $questao['incorrect_answers']);
        
            shuffle($opcoes);
        
            foreach ($opcoes as $opcao) {
                echo "<input class='opcao' type='radio' name='id_resposta' value=$opcao required>$opcao<br>";
            }
        }

        (new ArmazenarDados)->dadosAPI($data, $connect);

        return $questao["question"];
    }

    public function gerarPerguntaBD($connect){
    
        try {

            $stmt = $connect->prepare("SELECT question, correct_answer, incorrect_answers FROM pergunta ORDER BY RANDOM()");
            $stmt->execute();
            $questao = $stmt->fetch(PDO::FETCH_ASSOC);

            echo "<h2 class='pergunta'>" . $questao["question"] . "</h2>" . "<br>";
            
            $opcoes = array_merge([$questao['correct_answer']], json_decode($questao['incorrect_answers']));
            shuffle($opcoes);
            
            foreach ($opcoes as $opcao) {
                echo "<input class='opcao' type='radio' name='id_resposta' value='$opcao' required>$opcao<br>";
            }

        } catch (PDOException $e) {
            echo "ERRO...";
        }
        

        return $questao["question"];
    }
}


?>