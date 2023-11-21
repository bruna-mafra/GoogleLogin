<?php

// Token JWT a ser verificado

// Chaves públicas fornecidas pelo Google (em formato JWK)
$publicKeys = [
    [
        'alg' => 'RS256',
        'use' => 'sig',
        'kid' => '5b3706960e3e60024a2655e78cfa63f87c97d309',
        'kty' => 'RSA',
        'n' => '4VCFlBofjCVMvApNQ97Y-473vGov--idNmGQioUg0PXJv0oRaAClXWINwNaMuLIegChkWNNpbvsrdJpapSNHra_cdAoSrhd_tLNWDtBGm6tsVZM8vciggnJHuJwMtGwZUiUjHeYWebaJrZmWh1WemYluQgyxgDAY_Rf7OdIthAlwsAzvmObuByoykU-74MyMJVal7QzATaEh0je7BqoDEafG750UrMwzSnACjlZvnmrCHR4KseT4Tv4Fa0rCc_wpRP-Uuplri_EbMSr15OXoGTDub6UM8_0LIjNL0yRqh5JpesbOtxW_OU1bMeSUOJeAZzAA4-vq_l-jrDlelHxZxw',
        'e' => 'AQAB',
    ],
    [
        'use' => 'sig',
        'kty' => 'RSA',
        'alg' => 'RS256',
        'kid' => '0e72da1df501ca6f756bf103fd7c720294772506',
        'n' => 'vZgPf9nruMYY71q5pgThDwmk6Z3DD7cwN-Z52__b4xHeY95wOeKpjSliaI8K1PpeBbm4NykHm6UmfB_pCw5P2owpHZ8JEF2FCeDFKcOtZOzolYVgKZY8Sunqxcr3Sm0n73jbGcPgqu5PpjnOR4WkZCnpmDEZ34KNQat_MYYNUZZE2RlbpppNHiLatdiLW-rWi9YCmpsE4EIdd-XKIyZpQZRKaAl-w72BboTD_Koq2CkAOZOab73Q_G5FVT0NrxEWqP6artVfg5Dc_VVPnvtsC9yMe8lNgU3c3a-mE-vzE9oxAjr0s8Ek0Ih_sv-CbWL8xHiI7MOygIPG_aQqvMhPaQ',
        'e' => 'AQAB',
    ],
];

// Substitua pelo seu ID do cliente do Google
$clientID = '823004310549-5kntcr67239n6iuqtn2mans9lag01vv9.apps.googleusercontent.com';

// Extração do token JWT do campo "credential"
$decodedToken = base64_decode(str_replace(['_', '-'], ['/', '+'], explode('.', $jwtToken)[1]));
$payload = json_decode($decodedToken, true);

// Verifica se o token é emitido pelo Google e se o ID do cliente está correto
if ($payload['iss'] === 'https://accounts.google.com' || $payload['iss'] === 'accounts.google.com') {
    if ($payload['aud'] === $clientID) {
        // Token válido, faça o que precisar aqui
        var_dump($payload);
    } else {
        echo 'Erro: ID do cliente inválido.';
    }
} else {
    echo 'Erro: Issuer inválido.';
}
