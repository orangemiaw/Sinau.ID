<?php

defined('SINAUID') OR exit('No direct script access allowed');

class model_face_recognition extends curl {
    public function proccess($image1, $image2) {
		// $image_url1 = str_replace('./', base_url(), $image1);
		// $image_url2 = str_replace('./', base_url(), $image2);

        // Testing
		// $image_test1 = 'https://cdn2.tstatic.net/surabaya/foto/bank/images/ktp-meritha-vridawati_20180109_015246.jpg';
		// $image_test2 = 'http://cdn2.tstatic.net/tribunnews/foto/bank/images/tewas_20180108_131714.jpg';

		// $post = array(
        //     'api_key'       => FACE_API_KEY, 
        //     'api_secret'    => FACE_API_SECRET, 
        //     'image_url1'    => $image_test1, 
        //     'image_url2'    => $image_test2
        // );

        // Real production
		$post = array(
            'api_key'           => FACE_API_KEY, 
            'api_secret'        => FACE_API_SECRET, 
            'image_base64_1'    => $image1, 
            'image_base64_2'    => $image2
        );

		$req = $this->post('https://api-us.faceplusplus.com/facepp/v3/compare', $post);
		return $req;
    }
}