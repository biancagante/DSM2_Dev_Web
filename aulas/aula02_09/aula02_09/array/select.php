<?php
$usuarios = [
    0 => "Aluno",
    1 => "Professor"
];
$cursos = ["ADS", "DSM", "PQ", "COMEX", "GE"];
$periodos = array("Matutino", "Vespertino", "Noturno");
$fotos = [
    "https://media.licdn.com/dms/image/v2/D4D22AQElNq36PiW6CA/feedshare-shrink_800/B4DZds6bnaHkAk-/0/1749878947928?e=2147483647&v=beta&t=MopiwON4FrEgOrY5fNHG6N6rf2H-DWrC45jrSmBL1ts",
    "https://media.licdn.com/dms/image/v2/C4D22AQEZXp5E44EH5Q/feedshare-shrink_800/feedshare-shrink_800/0/1677825394615?e=2147483647&v=beta&t=a5W51Kib8RoiG3_EhjS4qC0SkndUC-jkHWTW4fcrBDA",
    "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQzp8dFu0lhkg84-YlIuE43ALPLsIi1HacNwA&s"
]
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select array</title>
</head>

<body style="background-color: #181818; color: white; font-size: 22px; font-family: system-ui, -apple-system; padding: 2vw;">
    <form action="#" method="post" style="display: flex; flex-direction: column; width: 500px;">
        <label for="usuario">Usuário
            <input type="text" name="usuario">
            <?php
            foreach ($usuarios as $user) {
                echo "<input type='radio' value='$user' name='usuario'>$user";
            }
            ?></label>
        <label for="sltcurso">Curso:</label>
        <select name="sltcurso" id="" style="padding: .25vw;">
            <?php
            foreach ($cursos as $c) {
                echo "<option value='$c'>" . $c . "</option>";
            }
            ?>
        </select>
        <label for="">Período:
            <?php
            foreach ($periodos as $p) {
                echo "<input type='checkbox' name='periodos[]' value='$p'>$p";
            }
            ?></label>
        <input type="submit" value="Enviar" style="padding: .25vw;">
        <hr>
        <h2>Galeria:</h2>
        <div style="display: flex;">

            <?php
        foreach ($fotos as $f) {
            echo "<img src='$f' width='50%'>";
        }
        ?>
        </div>
    </form>
</body>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $curso = $_POST['sltcurso'];
    $periodos = $_POST['periodos'];
    echo "$usuario matriculado em $curso";

    foreach ($periodos as $p) {
        echo "<li>Cursa no período: " . $p;
    }
}
?>

</html>