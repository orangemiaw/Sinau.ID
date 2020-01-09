<?php

defined('SINAUID') OR exit('No direct script access allowed');

function encrypt_password($password) {
	$output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = "KX956YkEOG06fIKC2MVPM4Z6ftfOXtPE";
    $secret_iv = "Y3ov8YHjG3HTGvzdg2ZaYYFQASkMmvEA";
        
    // hash
    $key = hash('sha256', $secret_key);
        
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    // start encrypt password
    $output = openssl_encrypt($password, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);

    return strrev(sha1($output));
}

function answer_security($action, $string) {
	$output = false;
	$encrypt_method = "AES-256-CBC";
	$secret_key = '2692E94E7F344A28EDD46845BFE2E';
	$secret_iv = 'D828E7539CCFEABFF842B95E91C5C';
	// hash
	$key = hash('sha256', $secret_key);
	
	// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	$iv = substr(hash('sha256', $secret_iv), 0, 16);
	if ( $action == 'encrypt' ) {
		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);
	} else if( $action == 'decrypt' ) {
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}

	return $output;
}

function timestamp_to_date($timestamp, $format = 'D, j M Y - g:i A', $timezone = 'Asia/Jakarta') {
	$date = new DateTime();
	$date->setTimezone(new DateTimeZone($timezone));
	$date->setTimestamp($timestamp);
	return $date->format($format);
}

function timestamp_to_dmy($timestamp = NULL, $timezone = 'Asia/Jakarta', $format = 'm/d/Y') {
	if($timestamp != NULL) {
		$date = new DateTime();
		$date->setTimezone(new DateTimeZone($timezone));
		$date->setTimestamp($timestamp);
		return $date->format($format);
	} else {
		return "";
	}
}

function date_to_timestamp($inputDate = NULL) {
	if($inputDate == NULL) {
		$date = new DateTime('NOW');
		$date->setTimezone(new DateTimeZone('Asia/Jakarta'));
		return $date->getTimestamp();
	} else {
		$date = new DateTime($inputDate); // format: MM/DD/YYYY
		$date->setTimezone(new DateTimeZone('Asia/Jakarta'));
		return $date->format('U');
	}
}

function time_to_timestamp($inputDate = NULL, $timezone = 'Asia/Jakarta', $format = 'm/d/Y H:i:s') {
	if($inputDate != NULL) {
		$date = new DateTime($inputDate); 
		$date->setTimezone(new DateTimeZone($timezone));
		return $date->format($format);
	}
}

function ip_address() {
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if(getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if(getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if(getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if(getenv('HTTP_FORWARDED'))
		$ipaddress = getenv('HTTP_FORWARDED');
	else if(getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = '0.0.0.0';
	return $ipaddress;
}

function user_agent() {
	if(getenv('HTTP_USER_AGENT'))
		return getenv('HTTP_USER_AGENT');
	return 'none';
}

function set_select($value, $condition) {
	if($value == $condition)
		return "selected";
	return "";
}

function set_select_disable($value, $condition) {
	if($value == $condition)
		return "selected";
	return "disabled";
}

function set_checkbox($value) {
	if($value == 1)
		return "checked";
	return "";
}

function ajax_output($data = array(), $status, $callback = array()) {
	header('Content-Type: application/json');
	print json_encode(
		array(
			'data' => $data,
			'meta' => array(
				'status'     => $status,
				'callback'   => $callback
			)
		)
	);
	exit;
}

function show_api_error($status_code = 500, $message = '') {
	http_response_code($status_code);
	header('X-Powered-By: Sinau.id API');
	header('Cache-Control: no-cache, must-revalidate');
	header('Content-type: application/json');
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: POST, GET');

	print json_encode(
		array(
			'meta' => array(
				'code' => $status_code,
				'message' => $message
			)
		)
	);
}

function show_api_data($status_code = 200, $data = array (), $message = array (), $pagination = array ()) {
	http_response_code($status_code);
	header('X-Powered-By: Sinau.id API');
	header('Cache-Control: no-cache, must-revalidate');
	header('Content-type: application/json');
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: POST, GET');

	if (!empty($pagination)) {
		print json_encode(
			array(
				'data' => $data,
				'meta' => array(
					'code' => $status_code,
					'message' => $message,
					'pagination' => $pagination
				)
			)
		);
	} else {
		print json_encode(
			array(
				'data' => $data,
				'meta' => array(
					'code' => $status_code,
					'message' => $message
				)
			)
		);
	}
}

function convert_to_rupiah($angka) {
	return 'Rp. '.strrev(implode('.',str_split(strrev(strval($angka)),3)));
}

function image_base64($img_file) {
	// Read image path, convert to base64 encoding
	$imgData = base64_encode(file_get_contents($img_file));

	// Format the image SRC:  data:{mime};base64,{data};
	$src = 'data:'.mime_content_type($img_file).';base64,'.$imgData;

	return $src;
}

function generate_token() {
	return sha1(md5(time() . "-sinauid"));
}

?>