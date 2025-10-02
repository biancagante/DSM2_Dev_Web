<?php
// ----- DADOS DO QUIZ -----
$quiz = [
    "Geografia" => [
        [
            'pergunta' => 'Qual o nome do nosso país?',
            'opcoes' => ['Brasil', 'Argentina', 'México'],
            'resposta_correta' => 'Brasil',
        ],
        [
            'pergunta' => 'Qual é a capital do Brasil?',
            'opcoes' => ['São Paulo', 'Brasília', 'Rio de Janeiro'],
            'resposta_correta' => 'Brasília',
        ],
    ],
    "História" => [
        [
            'pergunta' => 'Quem foi o primeiro presidente do Brasil?',
            'opcoes' => ['Deodoro da Fonseca', 'Getúlio Vargas', 'Juscelino Kubitschek'],
            'resposta_correta' => 'Deodoro da Fonseca',
        ],
        [
            'pergunta' => 'Em que ano o Brasil proclamou a República?',
            'opcoes' => ['1889', '1822', '1930'],
            'resposta_correta' => '1889',
        ],
    ],
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Quiz PHP Estilizado</title>
    <style>
        /* RESET BÁSICO */
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f2f6fc;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
            min-height: 100vh;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        /* FORMULÁRIOS */
        form {
            background: #fff;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 600px;
            margin-bottom: 30px;
        }

        select, input[type="submit"] {
            width: 100%;
            padding: 12px 15px;
            margin-top: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* PERGUNTAS */
        .pergunta {
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 18px;
            color: #333;
        }

        label {
            display: block;
            padding: 8px 12px;
            margin-bottom: 6px;
            background: #f9f9f9;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        label:hover {
            background: #e1e7f0;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        /* RESULTADOS */
        .correta {
            background-color: #d4edda;
            border-left: 6px solid #28a745;
            padding: 12px;
            margin-bottom: 12px;
            border-radius: 8px;
        }

        .errada {
            background-color: #f8d7da;
            border-left: 6px solid #dc3545;
            padding: 12px;
            margin-bottom: 12px;
            border-radius: 8px;
        }

        h3 {
            text-align: center;
            color: #333;
        }

        /* RESPONSIVO */
        @media (max-width: 640px) {
            form { padding: 20px; }
            .pergunta { font-size: 16px; }
            input[type="submit"], select { font-size: 14px; padding: 10px; }
        }
    </style>
</head>
<body>

<h2>Escolha um tema</h2>
<form action="" method="POST">
    <select name="sltTema" required>
        <option value="" disabled selected>Selecione o tema</option>
        <?php foreach ($quiz as $tema => $perguntas): ?>
            <option value="<?= $tema ?>"><?= $tema ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" name="btnEscolherTema" value="Começar Quiz">
</form>

<?php
// ----- MOSTRA O QUIZ -----
if (isset($_POST['btnEscolherTema'])) {
    $tema = $_POST['sltTema'];
    $q = $quiz[$tema];

    echo "<h2>Quiz de $tema</h2>";
    echo "<form action='' method='POST'>";

    echo "<input type='hidden' name='sltTema' value='$tema'>";

    foreach ($q as $i => $pergunta) {
        echo "<div class='pergunta'>{$pergunta['pergunta']}</div>";
        foreach ($pergunta['opcoes'] as $opcao) {
            echo "<label><input type='radio' name='resp[$i]' value='$opcao' required> $opcao</label>";
        }
    }

    echo "<input type='submit' name='btnConcluir' value='Concluir quiz'>";
    echo "</form>";
}

// ----- CALCULA RESULTADO -----
if (isset($_POST['btnConcluir'])) {
    $respostasUsuario = $_POST['resp'] ?? [];
    $tema = $_POST['sltTema'];
    $q = $quiz[$tema];

    $pontos = 0;
    echo "<h2>Resultado do Quiz de $tema</h2>";

    foreach ($q as $i => $pergunta) {
        $respostaCorreta = $pergunta['resposta_correta'];
        $respostaUsuario = $respostasUsuario[$i] ?? '';

        $classe = ($respostaUsuario === $respostaCorreta) ? 'correta' : 'errada';
        if ($respostaUsuario === $respostaCorreta) $pontos++;

        echo "<div class='$classe'>";
        echo "<p><strong>Pergunta:</strong> {$pergunta['pergunta']}</p>";
        echo "<p><strong>Sua resposta:</strong> $respostaUsuario</p>";
        echo "<p><strong>Resposta correta:</strong> $respostaCorreta</p>";
        echo "</div>";
    }

    echo "<h3>Você acertou $pontos de " . count($q) . " perguntas!</h3>";
}
?>

</body>
</html>
