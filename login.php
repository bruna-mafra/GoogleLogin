<?php require_once 'menu.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
</head>

<body>
    <div class="container p-3">
        <h2>Login</h2>
        <form class="p-3" method="post" action="processaLogin.php">
            <div class="mb-3">
                <label for="loginEmail" class="form-label">Email:</label>
                <input type="email" class="form-control" id="loginEmail" name="loginEmail" required>
            </div>

            <div class="mb-3">
                <label for="loginSenha" class="form-label">Senha:</label>
                <input type="password" class="form-control" id="loginSenha" name="loginSenha" required>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>

</html>