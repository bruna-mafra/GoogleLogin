<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        /* Estilos personalizados para o menu de navegação */

        *,
        *::before,
        *::after {
            --azul-escuro: #154580;
            --azul-medio: #3970BE;
            --azul-claro: #E5F1FF;
            --cinza-texto: #444444;
            --cinza-claro: #ECECEC;
            box-sizing: border-box;
        }

        body {
            font-family: Roboto, Arial, Helvetica, sans-serif;
        }

        .navbar-custom {
            background-color: #3498db;
            /* background-color: var(--azul-escuro); */
            /* Cor de fundo */
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .navbar-nav .nav-link {
            color: whitesmoke !important;
            /* Cor do texto */
        }

        .navbar-custom .navbar-nav .nav-link:hover {
            color: #2c3e50 !important;
            /* Cor do texto ao passar o mouse */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">Login Social</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="cadastro.php">Cadastro sem Google</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login sem Google</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/teste2/">Continuar com Google</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.9/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</body>

</html>