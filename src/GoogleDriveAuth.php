<?php

namespace Vol2223\Sgdrive;

use Google_Client;
use Google_Auth_AssertionCredentials;

/**
 * auth value object
 */
class GoogleDriveAuth
{
	/**
	 * @var string
	 */
	private $clientId;

	/**
	 * @var string
	 */
	private $clientEmail;

	/**
	 * @var string
	 */
	private $clientKeyPath;

	/**
	 * @var string
	 */
	private $clientKeyPw;

	/**
	 * @param string $clientId
	 * @param string $clientEmail
	 * @param string $clientKeyPath
	 * @param string $clientKeyPw
	 */
	public function __construct(
		$clientId,
		$clientEmail,
		$clientKeyPath,
		$clientKeyPw
	) {
		$this->clientId      = $clientId;
		$this->clientEmail   = $clientEmail;
		$this->clientKeyPath = $clientKeyPath;
		$this->clientKeyPw   = $clientKeyPw;
	}

	/**
	 * @return Google_Client;
	 */
	public function auth()
	{
		$auth = new Google_Client();
		$auth->setApplicationName ('TestApplication');
		$auth->setClientId ($this->clientId);
		$auth->setAssertionCredentials (new Google_Auth_AssertionCredentials(
			$this->clientEmail,
			array('https://spreadsheets.google.com/feeds','https://docs.google.com/feeds'),
			file_get_contents ($this->clientKeyPath),
			$this->clientKeyPw
		));

		$auth->getAuth()->refreshTokenWithAssertion();
		return $auth;
	}
}
