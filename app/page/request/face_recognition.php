<?php

// Call model
require_once PATH_MODEL . 'model_face_recognition.php';
$m_face_recognition = new model_face_recognition();

$pathktp = PATH_KTP.$_SESSION['username'].'/';
$pathcapture = PATH_CAPTURE.$_SESSION['username'].'/';

if(!empty($_FILES["capture"]["name"])) {
    $filename   = $_SESSION['username'] . '_' . time();
    $upload     = $upload->go($filename, $pathcapture);
    if($upload['status'] == false) {
        show_api_error(500, array($upload['error']));
        return;
    }
    
    $namecapture = $upload['filename'];
} else {
    show_api_error(400, array('Capture image needed.'));
    return;
}

$face_recognition = json_decode($m_face_recognition->proccess($pathktp.$arr_participant->namektp, $pathcapture.$namecapture));

if(!empty($face_recognition->confidence)) {
    if($face_recognition->confidence > 80) {
        $risk_status = "low";
    } elseif($face_recognition->confidence > 60 && $face_recognition->confidence < 80) {
        $risk_status = "medium";
    } else {
        $risk_status = "hight";
    }
    $face_detected = true;
} else {
    $risk_status = "vary hight";
    $face_detected = false;
}

show_api_data(200, array('risk_status' => $risk_status, 'face_detected' => $face_detected, 'captured_image' => $namecapture, 'captured_data' => $face_recognition), array('OK'));
return;