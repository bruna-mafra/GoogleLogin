<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $email = $data["email"];
    $sub = $data["sub"];

    $conexao = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$conexao) {
        die("Falha na conexão: " . mysqli_connect_error());
    }

    $stmt = mysqli_prepare($conexao, "INSERT INTO usuario (email, sub) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $email, $sub);
    $sucesso = mysqli_stmt_execute($stmt);

    if ($sucesso) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['error' => 'Erro ao inserir no banco de dados']);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Bad Request']);
}
?>
