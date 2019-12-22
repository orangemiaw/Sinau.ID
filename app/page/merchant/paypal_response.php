<?php

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

if ($_SESSION['is_admin'] == true || empty($_SESSION['id'])) {
    $notice->addError("You don't have permission to access the feature !");
    header("location:".HTTP."?page=upgrade");
    return;
}

if (empty($_GET['paymentId']) || empty($_GET['PayerID'])) {
    $notice->addError("The response is missing the paymentId and PayerID !");
    header("location:".HTTP."?page=upgrade");
    return;
}

require PATH_MODEL . 'model_config.php';
$modelConfig = new model_config($db);
$loadPaypalConfig = $modelConfig->get_row();

$paypalConfig = [
    'enable_sandbox'    => ($loadPaypalConfig['paypal_live_payment'] == STATUS_ENABLE) ? true : false,
    'client_id'         => $loadPaypalConfig['paypal_client_id'],
    'client_secret'     => $loadPaypalConfig['paypal_client_secret'],
    'return_url'        => HTTP . '?merchant=paypal_response',
    'cancel_url'        => HTTP . '?page=upgrade',
];

$apiContext = getApiContext($paypalConfig['client_id'], $paypalConfig['client_secret'], $paypalConfig['enable_sandbox']);

$paymentId = $_GET['paymentId'];
$payment = Payment::get($paymentId, $apiContext);

$execution = new PaymentExecution();
$execution->setPayerId($_GET['PayerID']);

try {
    // Take the payment
    $payment->execute($execution, $apiContext);

    try {

        $payment = Payment::get($paymentId, $apiContext);
        
        $data = [
            'participant_id' => $_SESSION['id'],
            'transaction_id' => $payment->getId(),
            'payment_method' => PAYPAL_PAYMENT_METHOD,
            'payment_amount' => $payment->transactions[0]->amount->total,
            'payment_status' => $payment->getState(),
            'invoice_id'     => $payment->transactions[0]->invoice_number
        ];
      
        if(strtolower($data['payment_status']) == 'approved') {
            $explodeInvoice = explode("-", $data['invoice_id']);

            $update = $db->update("participants", array("participant_group_id" => $explodeInvoice[1]), array("participant_id" => $data['participant_id']));
            $insert = $db->insert("payments", $data);

            // Rewrite session group_id
            require PATH_MODEL . 'model_participant_group.php';
            $m_participant_group = new model_participant_group($db);
            $arr_participant_group = $m_participant_group->get_row(array("participant_group_id" => $explodeInvoice[1]));

            $_SESSION['group'] = $arr_participant_group['participant_group_name'];
            $_SESSION['group_id'] = $explodeInvoice[1];
            
            if(!$insert || !$update) {
                $notice->addError("Query failed !");
                header("location:".HTTP."?page=upgrade");
                return;
            }

            $notice->addSuccess("Payment successfully and your account has been upgraded !");
            header("location:".HTTP."?page=dashboard");
            return;
        } else {
            // Payment failed
            $notice->addError("Payment failed !");
            header("location:".HTTP."?page=upgrade");
            return;
        }
    } catch (Exception $e) {
        // Failed to retrieve payment from PayPal
        $notice->addError("Failed to retrieve payment from PayPal !");
        header("location:".HTTP."?page=upgrade");
        return;
    }

} catch (Exception $e) {
    // Failed to take payment
    $notice->addError("Failed to take payment !");
    header("location:".HTTP."?page=upgrade");
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
