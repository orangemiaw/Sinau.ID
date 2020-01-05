<?php
use Stelin\OVOID;
use Stelin\Response\CustomerTransferResponse;
$ovoid = new OVOID();

$action         = isset($_GET['act']) ? $_GET['act'] : '';
$phoneNumber    = isset($_POST['txtOVOPhoneNumber']) ? $_POST['txtOVOPhoneNumber'] : '';
$refId          = isset($_POST['txtOVORefId']) ? $_POST['txtOVORefId'] : '';
$otpCode        = isset($_POST['txtOTPCode']) ? $_POST['txtOTPCode'] : '';
$pinCode        = isset($_POST['txtOTPPin']) ? $_POST['txtOTPPin'] : '';
$tokenCode      = isset($_POST['txtOVOToken']) ? $_POST['txtOVOToken'] : '';

switch($action) {
    case 'step1':
        validatePhoneNumber($phoneNumber);

        try {
            $refId = $ovoid->login2FA($phoneNumber)->getRefId();
            if(!empty($refId)) {
                header("Location:".HTTP."?merchant=ovo_step2&phoneNumber=" . $phoneNumber . "&refId=" . $refId);
                return;
            } else {
                $notice->addError("Failed to connect OVO server !");
                header("Location:".HTTP."?merchant=ovo_step1");
                return;
            }
        } catch (Exception $e) {
            $notice->addError("Mobile number is not registered at OVO !");
            header("Location:".HTTP."?merchant=ovo_step1");
            return;
        }
        break;
    case 'step2':
        validatePhoneNumber($phoneNumber);

        try {
            $token = $ovoid->login2FAVerify($refId, $otpCode, $phoneNumber)->getUpdateAccessToken();
            if(!empty($token)) {
                header("Location:".HTTP."?merchant=ovo_step3&token=" . $token . "&refId=" . $refId);
                return;
            } else {
                $notice->addError("Failed to connect OVO server !");
                header("Location:".HTTP."?merchant=ovo_step2&phoneNumber=" . $phoneNumber . "&refId=" . $refId);
                return;
            }
        } catch (Exception $e) {
            $notice->addError("Invalid OTP code or parameters !");
            header("Location:".HTTP."?merchant=ovo_step2&phoneNumber=" . $phoneNumber . "&refId=" . $refId);
            return;
        }
        break;
    case 'step3':
        $authorization = $ovoid->loginSecurityCode($pinCode, $tokenCode)->getAuthorizationToken();

        if(!empty($authorization)) {
            require PATH_MODEL . 'model_config.php';
            require PATH_MODEL . 'model_participant_group.php';
            $modelConfig = new model_config($db);
            $modelParticipantGroup = new model_participant_group($db);
            $loadOVOConfig = $modelConfig->get_row();
            $loadParticipantGroup = $modelParticipantGroup->get_row(array('participant_group_id' => $_SESSION['tmp_upgrade']));
            $upgradePrice = $loadParticipantGroup['participant_group_price'] * RATE_USD_TO_IDR;

            $ovoid = new OVOID($authorization);
            $response = new CustomerTransferResponse(array('refId' => $refId));
            $payment = $ovoid->transferOvo($loadOVOConfig['ovo_number'], $upgradePrice, "Sinau.id Upgrade Account");

            var_dump($response->getMessage());
            die();

            // try {
            //     $payment = $ovoid->transferOvo($loadOVOConfig['ovo_number'], $upgradePrice, "Sinau.id Upgrade Account");
                
            //     var_dump(json_encode($payment, false));
            //     die();
            // } catch (OvoidException $e) {
            //     $notice->addError("Error ! " . $e);
            //     header("location:".HTTP."?page=upgrade");
            //     return;
            // }

            // if(!$payment) {
            //     $notice->addError("Failed to make payment using OVO because low balance or token expired !");
            //     header("Location:".HTTP."?page=upgrade");
            //     return;
            // }

            $data = [
                'participant_id' => $_SESSION['id'],
                'transaction_id' => 'OVOID-' . time(),
                'payment_method' => OVO_PAYMENT_METHOD,
                'payment_amount' => $loadParticipantGroup['participant_group_price'],
                'payment_status' => 'approved',
                'invoice_id'     => strtoupper(uniqid() . '-' . $_SESSION['tmp_upgrade'])
            ];

            $update = $db->update("participants", array("participant_group_id" => $explodeInvoice[1]), array("participant_id" => $data['participant_id']));
            $insert = $db->insert("payments", $data);

            if(!$insert || !$update) {
                $notice->addError("Query failed !");
                header("location:".HTTP."?page=upgrade");
                return;
            }

            $arr_participant_group  = $m_participant_group->get_row(array("participant_group_id" => $_SESSION['tmp_upgrade']));
            $_SESSION['group']      = $arr_participant_group['participant_group_name'];
            $_SESSION['group_id']   = $arr_participant_group['participant_group_id'];

            unset($_SESSION['tmp_upgrade']);
        } else {
            $notice->addError("Failed to connect OVO server !");
            header("Location:".HTTP."?merchant=ovo_step3&token=" . $tokenCode);
            return;
        }
        break;
}

function validatePhoneNumber($phoneNumber) {
    if(!is_numeric($phoneNumber) || strlen($phoneNumber) < 10 || strlen($phoneNumber) > 12) {
        $notice->addError("Invalid phone number !");
        header("Location:".HTTP."?merchant=ovo_step1");
        return;
    }
}