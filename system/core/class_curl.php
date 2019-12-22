<?php

defined('SINAUID') OR exit('No direct script access allowed');

class curl {
	public $curl;
	public $debug = false;
	public $result;
	public $error = array();
	public $requestheader;
	public $responseheader;
	public $cookiepath;
	public $responsecookie;
	public $requestcookie;
	public $headers = array();
	public $referer;
	public $option = array();
	public $httpcode;
	public $lasturl;
	public $debugvar = array();
	public $timeout = 30;
	
	
	function __construct(){
		
		$this->curl = curl_init();
		$this->setCookiePath(md5(time()));
		$this->setUserAgent("Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/34.0.1847.116 Chrome/34.0.1847.116 Safari/537.36");
		$this->setOption(CURLOPT_HEADER, true);
		$this->setOption(CURLINFO_HEADER_OUT, true);
		$this->setOption(CURLOPT_RETURNTRANSFER, true);
		$this->setOption(CURLOPT_FOLLOWLOCATION, true);
		$this->setOption(CURLOPT_TIMEOUT, $this->timeout);
		$this->setOption(CURLOPT_SSL_VERIFYPEER, false);
		$this->setOption(CURLOPT_SSL_VERIFYHOST, 2);
	}
		
	function setOption($option, $value) {
		$this->options[$option] = $value;
		return curl_setopt($this->curl, $option, $value);
	}
	
	function debug(){
		$this->debugvar['DEBUG_ERROR'] = $this->error;
		$this->debugvar['DEBUG_REQUEST_HEADERS'] = $this->requestheader;
		$this->debugvar['DEBUG_RESPONSE_HEADERS'] = $this->responseheader;
		$this->debugvar['DEBUG_LAST_URL'] = $this->lasturl;
		$this->debugvar['DEBUG_RESULT'] = $this->result;
		return $this->debugvar;
	}
	
	function setHeader($key,$value){
		$this->headers[$key] = $value;
	}
	
	function request($method,$url,$var = false){
		if(!empty($var)){
			$data = (is_array($var) ? http_build_query($var, '', '&') : $var);
			$this->setOption(CURLOPT_POSTFIELDS,$data);
		}
		if(!empty($this->headers) && is_array($this->headers)){
			$this->setRequestHeader();
		}
		$this->setMethod($method);
		$this->setOption(CURLOPT_URL,$url);
		$this->result = curl_exec($this->curl);
		$this->error['code'] = curl_errno($this->curl);
		$this->error['msg'] = curl_error($this->curl);
		$this->httpcode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
		$this->lasturl = curl_getinfo($this->curl, CURLINFO_EFFECTIVE_URL);
		$this->requestheader = $this->parseHeader(curl_getinfo($this->curl, CURLINFO_HEADER_OUT));
		$header_size = curl_getinfo($this->curl, CURLINFO_HEADER_SIZE);
		$this->responsecookie = $this->parseCookie(substr($this->result, 0, $header_size));
		$this->responseheader = $this->parseHeader(substr($this->result, 0, $header_size));
		$this->result = substr($this->result, $header_size);
		if($this->debug == true){
			var_dump($this->debug());
		} else {
			return $this->result;
		}
		$this->unsetMethod($method);
		$this->unsetCurl();
	}
	
	function setRequestHeader(){
		$headers = array();
        foreach ($this->headers as $key => $value) {
            $headers[] = $key.': '.$value;
        }
		$this->setOption(CURLOPT_HTTPHEADER, $headers);
	}
	
	function parseHeader($response){
		if (!preg_match_all('/([A-Za-z\-]{1,})\:(.*)\\r/', $response, $matches) || !isset($matches[1], $matches[2])){
			return false;
		}
		$headers = [];
		foreach ($matches[1] as $index => $key){
			$headers[$key] = $matches[2][$index];
		}
		return $headers;
	}
	
	function setMethod($method){
		switch (strtoupper($method)){
            case 'HEAD':
				$this->setOption(CURLOPT_CUSTOMREQUEST, $method);
				$this->setOption(CURLOPT_NOBODY, true);
                break;
            case 'GET':
				$this->setOption(CURLOPT_CUSTOMREQUEST, $method);
				$this->setOption(CURLOPT_HTTPGET, true);
                break;
            case 'POST':
				$this->setOption(CURLOPT_CUSTOMREQUEST, $method);
				$this->setOption(CURLOPT_POST, true);
                break;
            default:
				$this->setOption(CURLOPT_CUSTOMREQUEST, $method);
        }
	}
	
	function unsetHeader(){
		$this->headers = array();
	}
	
	function unsetCurl(){
		curl_close($this->curl);
		$this->unsetCookie();
	}
	
	function unsetCookie(){
		if(file_exists($this->cookiepath)){
			unlink($this->cookiepath);
		}
	}
	
	function unsetMethod($method){
		$this->unsetHeader();
		$this->setOption(CURLOPT_URL, false);
		$this->setOption(CURLOPT_CUSTOMREQUEST, null);
        switch (strtoupper($method)) {
            case 'HEAD':
				$this->setOption(CURLOPT_NOBODY, false);
                break;
            case 'POST':
				$this->setOption(CURLOPT_POST, false);
				$this->setOption(CURLOPT_POSTFIELDS, false);
                break;
        }
    }
	
	function setCookiePath($name){
		$path = getcwd(). DIRECTORY_SEPARATOR . "system" . DIRECTORY_SEPARATOR . "cookie" . DIRECTORY_SEPARATOR . $name;
		$this->setOption(CURLOPT_COOKIEJAR, $path);
		$this->setOption(CURLOPT_COOKIEFILE, $path);
		$this->cookiepath = $path;
	}
	
	function setCookie($key, $value = false){
		if(is_array($key)){
			foreach($key as $set => $cookie){
				$this->requestcookie[$set] = $cookie;
			}
		} else {
			$this->requestcookie[$key] = $value;
			$this->setOption(CURLOPT_COOKIE, http_build_query($this->requestcookie, '', '; '));
		}
	}

	function parseCookie($header){
		
		preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $header, $matches);
		$cookies = array();
		foreach($matches[1] as $item) {
			parse_str($item, $cookie);
			$cookies = array_merge($cookies, $cookie);
		}
		return $cookies;
	}
	
	function setTimeout($int) {
		$this->setOption(CURLOPT_TIMEOUT, intval($int));
	}
	
	function post($url,$var = false){
		return $this->request("POST",$url,$var);
	}
	
	function get($url,$var = false){
		return $this->request("GET",$url,$var);
	}
	
	function put($url,$var = false){
		return $this->request("PUT",$url,$var);
	}
	
	function head($url,$var = false){
		return $this->request("HEAD",$url,$var);
	}
	
	function delete($url,$var = false){
		return $this->request("DELETE",$url,$var);
	}
	
	public function setUserAgent($ua){
		$this->setOption(CURLOPT_USERAGENT, $ua);
	}

	public function setReferer($referer){
		$this->setOption(CURLOPT_REFERER, $referer);
	}

	public function setSocks($socks){
		$this->setOption(CURLOPT_PROXY, $socks);
		$this->setOption(CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
	}
	
	function getString($start,$end,$string){
		preg_match_all("/" . $start . "(.*?)" . $end . "/sm",$string,$result);
		return (isset($result[1][0]) ? $result[1][0] : false);
	}		
}