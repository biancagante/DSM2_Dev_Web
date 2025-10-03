<?php
    session_start();
    // apaga apenas as variáveis dentro da sessão 
    session_unset();
    // destroi completamente a sessão
    session_destroy();

    header('Location: index.php');
?>