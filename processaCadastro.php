<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT); // Recomendado: armazenar senhas com hash

    // Conectar ao banco de dados (substitua pelos seus dados)
    $conexao = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Verifica a conexão
    if (!$conexao) {
        die("Falha na conexão: " . mysqli_connect_error());
    }

    // Verificar se o email já está cadastrado
    $stmt_verificar = mysqli_prepare($conexao, "SELECT id FROM usuario WHERE email = ?");
    mysqli_stmt_bind_param($stmt_verificar, "s", $email);
    mysqli_stmt_execute($stmt_verificar);
    mysqli_stmt_store_result($stmt_verificar);

    if (mysqli_stmt_num_rows($stmt_verificar) > 0) {
        // Email já cadastrado
        echo "Este email ja esta cadastrado. Por favor, tente novamente.";
    } else {
        // Preparar e executar a inserção
        $stmt = mysqli_prepare($conexao, "INSERT INTO usuario (email, senha) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $email, $senha);
        $sucesso = mysqli_stmt_execute($stmt);

        // Verifica o sucesso da operação
        if ($sucesso) {
            // Realizar login automaticamente após o cadastro
            session_start();

            // Pode ser necessário ajustar essas variáveis de acordo com a sua estrutura de banco de dados
            $_SESSION['user_id'] = mysqli_insert_id($conexao);
            $_SESSION['email'] = $email;

            // Fechar a sessão
            session_write_close();

            echo "Cadastro realizado com sucesso e usuário logado!";
        } else {
            echo "Erro ao r: " . mysqli_error($conexao);
        }

        // Fechar a consulta de inserção
        mysqli_stmt_close($stmt);
    }

    // Fechar a consulta de verificação
    mysqli_stmt_close($stmt_verificar);
    // Fechar a conexão
    mysqli_close($conexao);
} else {
    // Responde com um erro se não for uma solicitação POST
    http_response_code(400);
    echo "Bad Request";
}
?>
