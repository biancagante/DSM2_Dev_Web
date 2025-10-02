<?php

//Se eu dependo do arquivo que eu estou importando, eu uso o require.
require('funcoes.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){  

    if(!empty($_POST['txtnome']) && !empty($_POST['txtn1']) && !empty($_POST['txtn2'])){
        $nm = $_POST['txtnome'];
        $n1 = $_POST['txtn1'];
        $n2 = $_POST['txtn2'];

        saudacao($nm);

        $m = media($n1, $n2);

        echo "<br>lSua média é " . media($n1, $n2);
    }else{
        erro();
    }
}

?>