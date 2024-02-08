<?php 



class RequisicaoAPI {
    
    public function dadosAPI($data, $connect) {
        
        foreach ($data['results'] as $pergunta) {
            $type_ = $pergunta['type'];
            $difficulty = $pergunta['difficulty'];
            $category = $pergunta['category'];
            $question = $pergunta['question'];
            $correct_answer = $pergunta['correct_answer'];
            $incorrect_answer =  json_encode($pergunta['incorrect_answers']);
        
            
            $stmt = $connect->prepare("INSERT INTO pergunta (type_, difficulty, category, question, correct_answer, incorrect_answers) VALUES (:type_, :difficulty, :category, :question, :correct_answer, :incorrect_answers)");

            $stmt->bindParam("type_", $type_);
            $stmt->bindParam("difficulty", $difficulty);
            $stmt->bindParam("category", $category);
            $stmt->bindParam("question", $question);
            $stmt->bindParam("correct_answer", $correct_answer);
            $stmt->bindParam("incorrect_answers", $incorrect_answer);
            $stmt->execute();
        }
    }
    
}



?>