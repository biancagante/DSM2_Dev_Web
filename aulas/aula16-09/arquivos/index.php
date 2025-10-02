<?php
// cria ou abre o arquivo, "w" representa o estado do arquivo, se é para escrita, leitura, ou vizualização, "a" - acrecenta o conteudo novo
$arquivo = fopen("dados.txt", "a");
//escreve no arquivo
// fwrite($arquivo, "\nOie mundo.");
//fecha o arquivo
fclose($arquivo);

//abre o arquivo para leitura
$arquivo = fopen("dados.txt", "r");
//le o arquivo
// $conteudo = fread($arquivo, filesize("dados.txt"));
//exibe linha a linha do documento
// echo nl2br($conteudo);

while(($linha = fgets($arquivo)) != false){
    echo "<br>" . $linha;
    $array = explode(',', $linha);
    print_r($array);
}

fclose($arquivo);


?>