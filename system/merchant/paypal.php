<?php

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

$enableSandbox = true;
$paypalConfig = [
    'client_id'     => 'ASZablu8aoAO0-_1asXPYSjM9-BQ9qdkwE3eUDiITp_Snxouz4vWvSGGPf1lYFz3_ekUwHB8Xss5OhCX',
    'client_secret' => 'EFTBuQQD5RmjvRRZ8x5rd2967DrU7-k6u3eGgZ_nudXHoEnhTaMCuZAes8xfCrmXhrvLlzJAliAjeg3E',
    'return_url'    => HTTP . '?merchant=paypal_response',
    'cancel_url'    => HTTP . '?page=upgrade',
];

$apiContext = getApiContext($paypalConfig['client_id'], $paypalConfig['client_secret'], $enableSandbox);

function getApiContext($clientId, $clientSecret, $enableSandbox = false) {
    $apiContext = new ApiContext(
        new OAuthTokenCredential($clientId, $clientSecret)
    );

    $apiContext->setConfig([
        'mode' => $enableSandbox ? 'sandbox' : 'live'
    ]);

    return $apiContext;
}