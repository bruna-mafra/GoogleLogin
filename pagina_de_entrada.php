<?php
require_once 'config.php';
require_once 'vendor/autoload.php';

use \Firebase\JWT\JWT;
use \Firebase\JWT\JWK;
use Firebase\JWT\Key;

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // Obtenha o token CSRF do cookie
    $csrfTokenCookie = $_COOKIE['g_csrf_token'] ?? null;

    if (!$csrfTokenCookie) {
        http_response_code(400);
        die('No CSRF token in Cookie.');
    }

    // Obtenha o token CSRF do corpo da requisição POST
    $csrfTokenBody = $_POST['g_csrf_token'] ?? null;

    if (!$csrfTokenBody) {
        http_response_code(400);
        die('No CSRF token in post body.');
    }

    // Verifique se os tokens CSRF do cookie e do corpo da requisição são iguais
    if ($csrfTokenCookie !== $csrfTokenBody) {
        http_response_code(400);
        die('Failed to verify double submit cookie.');
    }

    // Se chegou até aqui, a verificação do token CSRF foi bem-sucedida
    echo 'CSRF token verification successful.';

    // JWT recebido do Google Auth
    $jwtToken = $_POST['credential'];

    $publicKeys = [
        '5b3706960e3e60024a2655e78cfa63f87c97d309' => JWK::parseKey([
            'alg' => 'RS256',
            'use' => 'sig',
            'kid' => '5b3706960e3e60024a2655e78cfa63f87c97d309',
            'kty' => 'RSA',
            'n' => '4VCFlBofjCVMvApNQ97Y-473vGov--idNmGQioUg0PXJv0oRaAClXWINwNaMuLIegChkWNNpbvsrdJpapSNHra_cdAoSrhd_tLNWDtBGm6tsVZM8vciggnJHuJwMtGwZUiUjHeYWebaJrZmWh1WemYluQgyxgDAY_Rf7OdIthAlwsAzvmObuByoykU-74MyMJVal7QzATaEh0je7BqoDEafG750UrMwzSnACjlZvnmrCHR4KseT4Tv4Fa0rCc_wpRP-Uuplri_EbMSr15OXoGTDub6UM8_0LIjNL0yRqh5JpesbOtxW_OU1bMeSUOJeAZzAA4-vq_l-jrDlelHxZxw',
            'e' => 'AQAB',
        ]),
        '0e72da1df501ca6f756bf103fd7c720294772506' => JWK::parseKey([
            'use' => 'sig',
            'kty' => 'RSA',
            'alg' => 'RS256',
            'kid' => '0e72da1df501ca6f756bf103fd7c720294772506',
            'n' => 'vZgPf9nruMYY71q5pgThDwmk6Z3DD7cwN-Z52__b4xHeY95wOeKpjSliaI8K1PpeBbm4NykHm6UmfB_pCw5P2owpHZ8JEF2FCeDFKcOtZOzolYVgKZY8Sunqxcr3Sm0n73jbGcPgqu5PpjnOR4WkZCnpmDEZ34KNQat_MYYNUZZE2RlbpppNHiLatdiLW-rWi9YCmpsE4EIdd-XKIyZpQZRKaAl-w72BboTD_Koq2CkAOZOab73Q_G5FVT0NrxEWqP6artVfg5Dc_VVPnvtsC9yMe8lNgU3c3a-mE-vzE9oxAjr0s8Ek0Ih_sv-CbWL8xHiI7MOygIPG_aQqvMhPaQ',
            'e' => 'AQAB',
        ]),
    ];

    // JWT para teste
    $jwtSecretKey = CLIENT_SECRET;  // Substitua pela chave secreta real fornecida pelo Google

    try {
    $headers = new stdClass();

    // Decodificar o JWT
    $decoded = JWT::decode($jwtToken, $publicKeys, $headers, ['RS256']);

        // Token é válido, faça o que precisar aqui
        echo 'Token válido.';
        var_dump($decoded);
        $emaildb = $decoded->email;
        $subdb = $decoded->sub;
        echo "<br> Email: " . $emaildb;
        echo "<br> Sub: " . $subdb;
    } catch (\Exception $e) {
        // Lidar com erros de decodificação ou validação
        echo 'Erro: ' . $e->getMessage();
    }
}
