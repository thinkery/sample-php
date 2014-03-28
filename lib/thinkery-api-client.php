<?php

class ThinkeryApi extends OAuth2Client {
	public function __construct($key, $secret) {
		parent::__construct(array(
			"base_uri" => "https://api.thinkery.me/v1/",
			"client_id" => $key,
			"client_secret" => $secret,
			"access_token_uri" => "token",
			"authorize_uri" => "authorize",
			"cookie_support" => true
		));
	}
	public function getLoginUri($params = array()) {
		return $this->getUri(
			"https://thinkery.me/api/authorize.php",
			array_merge(array(
				'response_type' => 'code',
				'client_id' => $this->getVariable('client_id'),
				'redirect_uri' => $this->getCurrentUri(),
			), $params)
		);
	}

	public function getLogoutUri($params = array()) {
		return $this->getUri(
			"https://thinkery.me/logout.php",
			array_merge(array(
				'oauth_token' => $this->getAccessToken(),
				'redirect_uri' => $this->getCurrentUri(),
			), $params)
		);
	}
}

