<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array</title>
</head>

<body style="background-color: #181818; color: white; font-size: 22px; font-family: system-ui, -apple-system; padding: 2vw;">
</body>
    <h1 style="color: #FFB8C9;">Array</h1>
</html>

<?php
// criação de array, ele não impede tipos diferentes
$nomes = ["Maria", "Fábio", "Caio"];
echo "Segundo nome: " . $nomes[1] . "<hr>";

$nomes[] = "Marcos";
$nomes[2] = "Bianca";
sort($nomes);

$idades = array(25, 36, 15);
echo "Idade na última posição: " . $idades[2];
sort($idades); // sorting
rsort($idades); // reverse sorting
foreach ($idades as $i) {
    echo "<br>$i";
}

echo "<br>Quantidade de elementos em idades: " . count($idades) . "<hr>";

for ($c = 0; $c < count($nomes); $c++) {
    echo "Nomes $c: $nomes[$c]<br>";
}

// array associativo
$aluno = [
    "Matricula" => 123,
    "Nome" => "Júlio",
    "Curso:" => "DSM"
];

echo "<hr>Nome: " . $aluno["Nome"];
$aluno['Periodo'] = "Vespertino";

sort($aluno);
unset($aluno['Matricula']); // excluir o item na chave matricula

foreach ($aluno as $a) {
    echo "<br>$a";
}

echo "<hr>";

$unidades = [
    0 => "PG",
    1 => "SV",
    2 => "CBT",
    3 => "PDMNGB"
];

rsort($unidades);

foreach($unidades as $chave => $valor) {
    echo "$chave:$valor<br>";
} 
?>

