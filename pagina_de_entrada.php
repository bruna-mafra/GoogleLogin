<?php
require_once 'vendor/autoload.php';
require_once 'Util.php';

use \Firebase\JWT\JWT;
use \Firebase\JWT\JWK;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (Util::VerificaTokenCSRF()) {
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

        // $jwtSecretKey = CLIENT_SECRET;

        try {
            $headers = new stdClass();
            // Decodifica o JWT
            $decoded = JWT::decode($jwtToken, $publicKeys, $headers, ['RS256']);
            // Token é válido
            // echo 'Token válido.';
            // var_dump($decoded);
            $emaildb = $decoded->email;
            $subdb = $decoded->sub;

            if (Util::ExisteCadastro($emaildb)) {
                // Email ja cadastrado
                // session_start();

                // Pode ser necessário ajustar essas variáveis de acordo com a sua estrutura de banco de dados
                // $_SsESSION['user_id'] = mysqli_insert_id($conexao);
                // $_SESSION['email'] = $emaildb;

                // Fechar a sessão
                // session_write_close();
                echo "Email já cadastrado";
            } else {
                //Email ainda nao cadastrado
                Util::cadastraUsuario($emaildb, $subdb);
            }
        } catch (\Exception $e) {
            // Lidar com erros de decodificação ou validação do try
            echo 'Erro: ' . $e->getMessage();
        }
    }
}
