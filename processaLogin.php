<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST["loginEmail"], FILTER_SANITIZE_EMAIL);
    $senha = $_POST["loginSenha"];

    $conexao = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$conexao) {
        die("Falha na conexão: " . mysqli_connect_error());
    }

    $stmt = mysqli_prepare($conexao, "SELECT id, email, senha FROM usuario WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_bind_result($stmt, $id, $email_db, $senha_db);
        mysqli_stmt_fetch($stmt);

        if (password_verify($senha, $senha_db)) {
            // Login bem-sucedido
            echo json_encode(['status' => 'success', 'message' => 'Usuario logado']);
            // Aqui você pode redirecionar o usuário ou realizar outras ações necessárias após o login
        } else {
            echo json_encode(['error' => 'Senha incorreta']);
        }
    } else {
        echo json_encode(['error' => 'Email nao cadastrado']);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Bad Request']);
}
