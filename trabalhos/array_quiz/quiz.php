<?php
$quiz = [
    "Inglês" => [
        [
            'pergunta' => 'Qual é a tradução correta da frase: "She is reading a book"?',
            'opcoes' => ['Ela lê um livro', 'Ela está lendo um livro', 'Ela leu um livro', 'Ela vai ler um livro'],
            'resposta_correta' => 'Ela está lendo um livro',
        ],
        [
            'pergunta' => 'Qual das opções representa o passado do verbo "go"?',
            'opcoes' => ['Goed', 'Went', 'Gone', 'Goes'],
            'resposta_correta' => 'Went',
        ],
        [
            'pergunta' => 'Qual é o comparativo de "good"?',
            'opcoes' => ['Gooder', 'More good', 'Better', 'Best'],
            'resposta_correta' => 'Better',
        ],
        [
            'pergunta' => 'Qual pronome pode substituir "John and I"?',
            'opcoes' => ['He', 'They', 'We', 'Us'],
            'resposta_correta' => 'We',
        ],
        [
            'pergunta' => 'Complete a frase: "I have lived here ___ 2010".',
            'opcoes' => ['for', 'since', 'at', 'by'],
            'resposta_correta' => 'since',
        ],
    ],

    "Espanhol" => [
        [
            'pergunta' => 'Qual é o significado da palavra "perro"?',
            'opcoes' => ['Gato', 'Cachorro', 'Pássaro', 'Cavalo'],
            'resposta_correta' => 'Cachorro',
        ],
        [
            'pergunta' => 'Como se diz "livro" em espanhol?',
            'opcoes' => ['Libro', 'Cuadro', 'Mesa', 'Página'],
            'resposta_correta' => 'Libro',
        ],
        [
            'pergunta' => 'Qual frase está correta no passado simples?',
            'opcoes' => ['Yo comí una manzana', 'Yo comer una manzana', 'Yo come una manzana', 'Yo comía una manzana'],
            'resposta_correta' => 'Yo comí una manzana',
        ],
        [
            'pergunta' => 'Qual é a forma correta de "nós" em espanhol?',
            'opcoes' => ['Vosotros', 'Ellos', 'Nosotros', 'Ustedes'],
            'resposta_correta' => 'Nosotros',
        ],
        [
            'pergunta' => 'Qual destas palavras é um verbo?',
            'opcoes' => ['Casa', 'Correr', 'Rápido', 'Rojo'],
            'resposta_correta' => 'Correr',
        ],
    ],

    "Biologia" => [
        [
            'pergunta' => 'Qual molécula é considerada a unidade básica da hereditariedade?',
            'opcoes' => ['RNA', 'Proteína', 'DNA', 'Lipídio'],
            'resposta_correta' => 'DNA',
        ],
        [
            'pergunta' => 'Qual é o nome do processo em que células se dividem para formar gametas?',
            'opcoes' => ['Mitose', 'Meiose', 'Clonagem', 'Fagocitose'],
            'resposta_correta' => 'Meiose',
        ],
        [
            'pergunta' => 'Os fungos são classificados como:',
            'opcoes' => ['Autótrofos', 'Procariontes', 'Heterótrofos', 'Fotossintetizantes'],
            'resposta_correta' => 'Heterótrofos',
        ],
        [
            'pergunta' => 'Qual estrutura da célula é responsável pela síntese de proteínas?',
            'opcoes' => ['Ribossomo', 'Mitocôndria', 'Cloroplasto', 'Lisossomo'],
            'resposta_correta' => 'Ribossomo',
        ],
        [
            'pergunta' => 'Qual grupo de seres vivos pertence ao Reino Monera?',
            'opcoes' => ['Bactérias', 'Protozoários', 'Algas pluricelulares', 'Fungos'],
            'resposta_correta' => 'Bactérias',
        ],
    ],
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Quiz</title>
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/8582/8582525.png" type="image/x-icon">
    <style>
        :root {
            --cor-bg: #2F1B6E;
            --cor-primaria: #6F27F5;
            --cor-secundaria: #D2BBFC;
            --cor-texto: #ffffff;
            --cor-erro: #ff4d4d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Roboto, sans-serif;
        }

        body {
            min-height: 100vh;
            width: 100%;
            background-color: var(---cor-bg);
            color: var(--cor-texto);
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        main {
            background-color: var(--cor-secundaria);
            width: 100%;
            min-height: 100vh;
            padding: 4vh 2vw;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2.5vw;
        }

        #frmTema {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.2vw;
            width: 70%;
            background-color: var(--cor-texto);
            padding: 2vw;
            border-radius: 1rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        #btnEnviar {
            align-self: flex-end;
            background-color: var(--cor-primaria);
            color: var(--cor-texto);
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s ease;
        }

        #btnEnviar:hover {
            background-color: #8756f7;
        }

        #frmQuiz {
            width: 70%;
            display: flex;
            flex-direction: column;
            padding: 2vw;
            border-radius: 1rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .div_pergunta {
            display: flex;
            flex-direction: column;
            margin-bottom: 0.5vw;
            padding: 1vw;
        }

        .div_pergunta label {
            margin-bottom: .5vw;
            ;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: .5vw;
            margin: .5vw;
        }

        .msgErro {
            color: var(--cor-erro);
            font-weight: bold;
        }

        .msgSucesso {
            color: var(--cor-bg);
            font-weight: bold;
        }

        .btn btn-warning {
            font-weight: 700;
        }

        .msgClassificacao {
            background-color: rgba(3, 3, 3, 0.5);
            padding: .5vw 2vw;
            border-radius: 12px;
        }

        .frmResposta {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2vw;
        }

        h6 {
            color: var(--cor-bg)
        }

        .correcao {
            background-color: rgba(255, 255, 255, 0.5);
            padding: 2vw;
            border-radius: 8px;
            color: black;
            width: 40%;
        }

        .correcao_layout {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            gap: 2vw;
            width: 100%;
            justify-content: center;
        }
        
        p {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <main>
        <form action="#" method="POST" class="form-control" id="frmTema" name="frmTema">
            <h4>Escolha um tema</h4>
            <select name="sltTema" class="form-select">
                <?php
                foreach ($quiz as $tema => $perguntas) {
                    echo "<option value='$tema'>$tema";
                }
                ?>
            </select>
            <input type="submit" value="Enviar" class="btn btn-primary" id="btnEnviar">
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['sltTema']) && !isset($_POST['btnConcluir'])) {
                $tema = $_POST['sltTema'];
                $q = $quiz[$tema];

                echo "<form action='' method='POST' class='form-control' id='frmQuiz'>";
                echo "<input type='hidden' name='sltTema' value='$tema'>";

                foreach ($q as $i => $pergunta) {
                    echo "<div class='div_pergunta'><strong>" . $pergunta['pergunta'] . "</strong>";

                    foreach ($pergunta['opcoes'] as $opcao) {
                        echo "<label class='form-label'><input type='radio' name='resp[$i]' value='$opcao'>$opcao</label>";
                    }
                    echo "</div>";
                }
                echo "<input type='submit' name='btnConcluir' class='btn btn-warning' value='Concluir quiz'></form>";
            }

            if (isset($_POST['btnConcluir'])) {
                if (isset($_POST['resp'])) {
                    $respostasUsuario = $_POST['resp'];
                    $tema = $_POST['sltTema'];
                    $q = $quiz[$tema];
                    $pontos = 0;

                    foreach ($q as $i => $pergunta) {
                        $respostaCorreta = $pergunta['resposta_correta'];
                        $respostaUsuario = $respostasUsuario[$i] ?? '';

                        if ($respostaUsuario === $respostaCorreta) {
                            $pontos++;
                        }
                    }
                    $percentual_pontos = ($pontos / count($q)) * 100;

                    echo "<form method='POST' class='frmResposta'>
                            <h5 class='msgSucesso'>Você acertou $pontos de " . count($q) . " perguntas do tema {$tema}! ({$percentual_pontos}% de acerto)</h5>
                    ";


                    if ($pontos < 3) {
                        echo "<span class='msgClassificacao'>Você pode melhorar tentando outra vez 😢</span>";
                    } else if ($pontos > 3 && $pontos < 5) {
                        echo "<span class='msgClassificacao'>Você foi bem 😀</span>";
                    } else {
                        echo "<span class='msgClassificacao' id='celebracao_especial'>Você acertou tudo!🎉</span>";
                    }

                    echo "<form method='POST'>
                            <input type='hidden' name='sltTema' value='$tema'>
                            <input type='submit' class='btn btn-danger' method='POST' value='Tentar novamente' name='tentarNovamente'></form>
                    ";

                    echo "<div class='correcao_layout'>";
                    foreach ($q as $i => $pergunta) {
                        $respostaCorreta = $pergunta['resposta_correta'];
                        $respostaUsuario = $respostasUsuario[$i] ?? '';

                        $classe = ($respostaUsuario === $respostaCorreta) ? 'correta' : 'errada';

                        if($classe == 'errada') {
                            echo "<div class='correcao'>
                                    <p><strong>Pergunta:</strong> {$pergunta['pergunta']}</p>
                                    <p><strong>Sua resposta:</strong> $respostaUsuario</p>
                                    <p><strong>Resposta correta:</strong> $respostaCorreta</p>
                                </div>";
                        }
                    }
                    echo "</div>";
                } else {
                    echo "<h5 class='msgErro'>Nenhuma alternativa escolhida.</h5>";
                    echo "<form method='POST'>
                        <input type='submit' class='btn btn-danger' method='POST' value='Tentar novamente' name='tentarNovamente'></form>
                    ";
                }
            }
        }
        ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
        const celebrateBtn = document.getElementById('celebracao_especial');
        
        if (celebrateBtn) {
            setTimeout(() => {
                confetti({
                    particleCount: 100,
                    spread: 70,
                    origin: { y: 0.6 }
                });
            }, 500);
        }

        // código inspo: https://codepen.io/yasirali9/pen/jOjqmMj
    })
</script>
</body>

</html>