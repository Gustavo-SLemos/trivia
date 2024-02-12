<?php require_once __DIR__ .  "/../Controller/cad.php";?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="..\images\GL-logo.ico" type="image/x-icon">
    <title>GL QUIZ</title>
</head>
<body>
    <section class="section-cad">
        <form class="form-cad" method="post">
            <?php $jogo->iniciarJogo($connect); ?>
            <input type="submit" name="resposta" value="Enviar">               
        </form>
        <form method="post">         
            <button type="submit" name="sair">Sair</button>
        </form>
    </section>  
</body>
</html>