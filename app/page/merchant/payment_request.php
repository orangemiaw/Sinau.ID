<?php

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

if ($_SESSION['is_admin'] == true || empty($_SESSION['id'])) {
    $notice->addError("You don't have permission to access the feature !");
    header("location:".HTTP."?page=upgrade");
    return;
}

if (empty($_POST['cbParticipantGroup']) || empty($_POST['rdPaymentMethod'])) {
    $notice->addError("Please, Insert correctly !");
	header("location:".HTTP."?page=upgrade");
	return;
}

$upgradeTo = $_POST['cbParticipantGroup'];
$paymentMethod = $_POST['rdPaymentMethod'];

require PATH_MODEL . 'model_config.php';
require PATH_MODEL . 'model_participant_group.php';
$modelConfig = new model_config($db);
$modelParticipantGroup = new model_participant_group($db);
$loadPaypalConfig = $modelConfig->get_row();
$loadParticipantGroup = $modelParticipantGroup->get_row(array('participant_group_id' => $upgradeTo));

$paypalConfig = [
    'enable_sandbox'    => ($loadPaypalConfig['paypal_live_payment'] == STATUS_ENABLE) ? true : false,
    'client_id'         => $loadPaypalConfig['paypal_client_id'],
    'client_secret'     => $loadPaypalConfig['paypal_client_secret'],
    'return_url'        => HTTP . '?merchant=paypal_response',
    'cancel_url'        => HTTP . '?page=upgrade',
];

$apiContext = getApiContext($paypalConfig['client_id'], $paypalConfig['client_secret'], $paypalConfig['enable_sandbox']);

// var_dump($paypalConfig);
// die();

if($paymentMethod == 'paypal') {
    $payer = new Payer();
    $payer->setPaymentMethod('paypal');

    // Data for the payment.
    $currency = 'USD';
    $amountPayable = $loadParticipantGroup['participant_group_price'];
    $invoiceNumber = strtoupper(uniqid()) . '-' . $upgradeTo;

    $amount = new Amount();
    $amount->setCurrency($currency)
        ->setTotal($amountPayable);

    $transaction = new Transaction();
    $transaction->setAmount($amount)
        ->setDescription('Sinau.id Account Upgrade')
        ->setInvoiceNumber($invoiceNumber);

    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl($paypalConfig['return_url'])
        ->setCancelUrl($paypalConfig['cancel_url']);

    $payment = new Payment();
    $payment->setIntent('sale')
        ->setPayer($payer)
        ->setTransactions([$transaction])
        ->setRedirectUrls($redirectUrls);

    try {
        $payment->create($apiContext);
    } catch (Exception $e) {
        $notice->addError("Unable to create link for payment !");
        header("location:".HTTP."?page=upgrade");
        return;
    }

    header('Location:' . $payment->getApprovalLink());
    return;
}

function getApiContext($clientId, $clientSecret, $enableSandbox = false) {
    $apiContext = new ApiContext(
        new OAuthTokenCredential($clientId, $clientSecret)
    );

    $apiContext->setConfig([
        'mode' => $enableSandbox ? 'sandbox' : 'live'
    ]);

    return $apiContext;
}