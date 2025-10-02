<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumo</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/12639/12639601.png" type="image/x-icon">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="degrade"></div>
    <div class="resumo-container">
        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nome = $_POST['input_nome'];
                $servico_escolhido = $_POST['opcoes_servicos'];
                $especie = $_POST['especie'];

                $tabela_precos = [
                    "Banho simples (R$ 40)" => 40.00,
                    "Tosa higiênica (R$ 50)" => 50.00,
                    "Banho + Tosa completa (R$ 80)" => 80.00,
                    "Tosa estilizada (R$ 110)" => 110.00,

                    "Cão, gato ou coelho" => 0.00,
                    "Outra espécie (+R$ 10)" => 10.00,

                    "Antipulgas e carrapaticidas (R$ 80)" => 80.00,
                    "Shampoos e condicionadores específicos para pets (R$ 60)" => 60.00,
                    "Decoração com laços, gravatinhas ou penteados temáticos (R$ 15)" => 15.00,
                    "Petiscos para recompensa pós-banho (R$ 10)" => 10.00
                ];


                if (empty($nome)) {
                    echo "<p class='text-danger'>Por favor insira um nome.</p>";
                } 
                
                else {
                    echo '<h2 class="resumo-titulo">Resumo do Atendimento</h2>';

                    echo '<div class="resumo-servico">';
                    echo '<p><strong>Nome do cliente:</strong> ' . $nome . '</p>';
                    echo '<p><strong>Serviço escolhido:</strong> ' . $servico_escolhido . '</p>';
                    echo '<p><strong>Espécie do pet:</strong> ' . $especie . '</p>';
                    echo '</div>';

                    $preco_servico = $tabela_precos[$servico_escolhido];
                    $preco_especie = $tabela_precos[$especie];

                    $preco_final = $preco_servico + $preco_especie;

                    echo '<div class="mt-3"><strong>Produtos extras:</strong>';
                    
                    if (isset($_POST['ckextras'])) {
                        $extras_escolhidos = $_POST['ckextras'];
                        echo '<ul>';

                        foreach ($extras_escolhidos as $extras) {
                            echo '<li>' . $extras . '</li>';

                            $preco_produtos_extras = $tabela_precos[$extras];
                            $preco_final += $preco_produtos_extras;
                        }

                        echo '</ul>';
                    } 
                    
                    else {
                        echo '<p>Nenhum produto extra adicionado.</p>';
                    }

                    echo '<div class="preco-final">Preço final: R$ ' . number_format($preco_final, 2, ',', '.') . '</div>';
                }
            }
        ?>
    </div>

    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous">
    </script>
</body>
</html>