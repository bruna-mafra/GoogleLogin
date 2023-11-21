<?php

function verificaLogado()
{
    session_start();
    if (isset($_SESSION['email'])) {
        return true;
    } else {
        session_destroy();
        return false;
    }
}

function logar($email){
    session_start();
    $_SESSION['email'] = $email;
}
