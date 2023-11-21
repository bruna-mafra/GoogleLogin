<?php
require_once 'config.php';
class Util
{

    static function VerificaTokenCSRF(): bool
    {
        // Obtem o token CSRF do cookie
        $csrfTokenCookie = $_COOKIE['g_csrf_token'] ?? null;
        if (!$csrfTokenCookie) {
            http_response_code(400);
            die('No CSRF token in Cookie.');
        }

        // Obtem o token CSRF do corpo da requisição POST
        $csrfTokenBody = $_POST['g_csrf_token'] ?? null;
        if (!$csrfTokenBody) {
            http_response_code(400);
            die('No CSRF token in post body.');
        }

        // Verifica se os tokens CSRF do cookie e do corpo da requisição são iguais
        if ($csrfTokenCookie !== $csrfTokenBody) {
            // http_response_code(400);
            // die('Failed to verify double submit cookie.');
            return false;
        } else {
            return true;
        }
    }

    static function cadastraUsuario($emaildb, $subdb): void
    {
        $conexao = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        // Prepara e executa a inserção
        $stmt = mysqli_prepare($conexao, "INSERT INTO usuario (email, sub) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $emaildb, $subdb);
        $sucesso = mysqli_stmt_execute($stmt);

        // Verifica o sucesso da operação
        if ($sucesso) {
            // Realiza login automaticamente após o cadastro
            // session_start();
            // Pode ser necessário ajustar essas variáveis de acordo com a sua estrutura de banco de dados
            // $_SESSION['user_id'] = mysqli_insert_id($conexao);
            // $_SESSION['email'] = $emaildb;
            // Fechar a sessão
            // session_write_close();
            echo "Cadastro realizado com sucesso!";
        } else {
            echo "Erro ao r: " . mysqli_error($conexao);
        }

        // Fechar a consulta de inserção
        mysqli_stmt_close($stmt);
        mysqli_close($conexao);
    }

    static function ExisteCadastro($emaildb): bool
    {
        $conexao = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if (!$conexao) {
            die("Falha na conexão: " . mysqli_connect_error());
        }
        // Verificar se o email já está cadastrado
        $stmt_verificar = mysqli_prepare($conexao, "SELECT id FROM usuario WHERE email = ?");
        mysqli_stmt_bind_param($stmt_verificar, "s", $emaildb);
        mysqli_stmt_execute($stmt_verificar);
        mysqli_stmt_store_result($stmt_verificar);
        if (mysqli_stmt_num_rows($stmt_verificar) > 0) {
            $existe = true;
        } else {
            $existe = false;
        }
        mysqli_stmt_close($stmt_verificar);
        mysqli_close($conexao);
        return $existe;
    }

}
