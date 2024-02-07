<?php 

require_once "Connect.php";

class Tentativa {


    public function armazenaPergunta() {
        $connect = new Connect();
        $connect = $connect->getConnection();

        $stmt = $connect->prepare("INSERT INTO tentativa (idJogo, nomeJogador, pergunta, id_resposta, numeroPerguntas) VALUES (:idJogo, :nomeJogador, :pergunta, :id_reposta, :numeroPerguntas)");

        foreach ($_SESSION as $key => $value) {
            if (isset($value['idJogo'], $value['nomeJogador'], $value['pergunta'])) {
                $stmt->bindParam(':idJogo', $value['idJogo']);
                $stmt->bindParam(':nomeJogador', $value['nomeJogador']);
                $stmt->bindParam(':pergunta', $value['pergunta']);
                $stmt->bindParam(':id_resposta', $value['id_resposta']);
                $stmt->bindParam(':numeroPerguntas', $value['numeroPerguntas']);
                $stmt->execute();
            }
        }
    }
}



?>