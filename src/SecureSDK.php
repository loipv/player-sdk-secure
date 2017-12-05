<?php

/**
 * @author loipv <loipv792@gmail.com>
 * @package OVP
 * Created on Oct 16, 2017
 */

namespace SecureSDK;

class SecureSDK {
	
	/**
	 * Appkey
	 * @var string
	 */
	private $appkey = '';
	
	/**
	 * Secretkey
	 * @var string
	 */
	private $secretkey = '';
	
	/**
	 * Player Id
	 * @var string
	 */
	private $playerId = '';
	
	/**
	 * Expires time
	 * @var string
	 */
	private $expiresIn = 60; // Expire in 60s

	/**
	 * Ingnore expiration
	 * @var boolean
	 */
	private $ignoreExpiration = false;
	
	/**
	 * Secure uri
	 * @var string $sUri
	 */
	private $sUri = '/';
	
	/**
	 * Http headers
	 * @var array
	 */
	private $httpHeaders = [];
	
	/**
	 * User agent
	 * @var string
	 */
	private $ua = '';
	
	public function __construct($appkey, $secretkey, $playerId = '') {
		$this->appkey = $appkey;
		$this->secretkey = $secretkey;
		$this->playerId = $playerId;
	}
	
	/**
	 * Get JWT key
	 * @return string
	 */
	private function getJWTKey() {
		return $this->appkey.'-'.$this->secretkey;
	}
	
	/**
	 * Set player id
	 * @param string $playerId
	 */
	public function setPlayerId($playerId = '') {
		$this->playerId = $playerId;
	}
	
	/**
	 * Set token life time
	 * @param number $expiresIn
	 */
	public function setExpiresIn($expiresIn = 60) {
		$this->expiresIn = $expiresIn;
	}

	/**
	 * Set ingnore expired
	 * @param number $expiresIn
	 */
	public function setIgnoreExpiration($ignoreExpiration = true) {
		$this->ignoreExpiration = $ignoreExpiration;
	}
	
	/**
	 * Set base url secure token
	 * @param string $sUri
	 */
	public function setSecureUri($sUri = '/'){
		$this->sUri = $sUri;
	}
	
	/**
	 * Set http headers
	 * @param array $httpHeaders
	 */
	public function setHttpHeaders($httpHeaders = []) {
		$this->httpHeaders = $httpHeaders;
	}
	
	/**
	 * Get http headers
	 * @return unknown
	 */
	public function getHttpHeaders() {
		return $this->httpHeaders? : $_SERVER;
	}
	
	/**
	 * Set user agent
	 * @param string $ua
	 */
	public function setUserAgent($ua = '') {
		$this->ua = $ua;
	}
	
	/**
	 * Get user agent
	 * @return string
	 */
	public function getUserAgent() {
		if ($this->ua) return $this->ua;
		$httpHeaders = $this->getHttpHeaders();
		return isset($httpHeaders['HTTP_USER_AGENT'])? $httpHeaders['HTTP_USER_AGENT'] : '';
	}
	
	/**
	 * Get jwt token
	 * @return string
	 */
	public function getJWTToken() {
		$key = $this->getJWTKey();
		$iat = time();
		$data = [
				'appkey' => $this->appkey,
				'player' => $this->playerId,
				'ignoreExpiration' => $this->ignoreExpiration;
		];
		$payload = array_merge([ 'iat' => $iat, 'exp' => $iat + $this->expiresIn ], $data);
		return JWT::encode($payload, $key);
	}
	
	/**
	 * Get full secure token
	 * @return string
	 */
	public function getSecureToken() {
		$data = [$this->sUri.'secure/verify', $this->appkey, $this->playerId, $this->getJWTToken()];
		return base64_encode(join('/', $data));
	}
}