<?php 


class Tentativa {


    public function armazenaPergunta($idJogo, $numeroPerguntas, $nomeJogador, $id_resposta, $pergunta, $connect) {
        
        try {
            
            $stmt = $connect->prepare("INSERT INTO tentativa (id_jogo, nome_jogador, pergunta, id_resposta, numero_perguntas) VALUES (:id_jogo, :nome_jogador, :pergunta, :id_resposta, :numero_perguntas)");

            $stmt->bindParam(':id_jogo', $idJogo);
            $stmt->bindParam(':nome_jogador', $nomeJogador);
            $stmt->bindParam(':pergunta', $pergunta);
            $stmt->bindParam(':id_resposta', $id_resposta);
            $stmt->bindParam(':numero_perguntas', $numeroPerguntas);

            $stmt->execute();

        } catch (PDOException $e) {
            echo "ERRO...";
        }
    }
}



?>