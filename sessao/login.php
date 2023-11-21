<?php
include_once 'funcoes.php';


$logado = verificaLogado();

if ((isset($_GET['action']) and ($_GET['action'] == 'logar'))) {
    logar('brunamafra@gmail');
}

if ($logado === true) {
    echo "Logado. Redicionar para logado";
    echo session_id();
    var_dump($_SESSION);
} else {
    // echo "Exibir formulário de login";
    echo "<a href='?action=logar'> Logar</a>";
}
