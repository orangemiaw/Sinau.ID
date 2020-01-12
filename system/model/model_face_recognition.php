<?php

defined('SINAUID') OR exit('No direct script access allowed');

class model_face_recognition extends curl {
    private function auth($base_url, $login, $password) {
        $post = array(
            "login"     => rtrim($login),
            "password"  => rtrim($password)
        );

        $req = $this->post($base_url . '/authenticate', $post);
        $json = json_decode($req);
        
        if($json->meta->code == 200) {
            return $json->data->access_token;
        }

        return false;
    }

    public function proccess($base_url, $login, $password, $image1, $image2) {
        // Get AuthToken
        $token = $this->auth($base_url, $login, $password);
        if(!$token) {
            return false;
        }

        // Compare image
		$post = array(
            'image_base64_1'    => $image1, 
            'image_base64_2'    => $image2
        );

        $this->setHeader('Authorization', 'Bearer ' . $token);
        $req = $this->post($base_url . '/face_comparing', $post);
		return $req;
    }
}