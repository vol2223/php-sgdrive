<?php

namespace Vol2223\Sgdrive;

use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ListFeed;
use Google\Spreadsheet\ServiceRequestFactory;
use Google\Spreadsheet\SpreadsheetFeed;
use Google\Spreadsheet\SpreadsheetService;
use Google_Auth_AssertionCredentials;
use Google_Client;
use Vol2223\Sgdrive\Factory\ApiFactory;

/**
 * Simple API wrapper for google drive
 */
class Client
{
	public function __construct(GoogleDriveAuth $auth)
	{
		$this->authenticate($auth);
	}

	/**
	 * @param string $feedTitle
	 * @param string $sheetName
	 */
	public function api($feedTitle, $sheetName, $api)
	{
		$feed = $this->getFeed($feedTitle, $sheetName);
		return ApiFactory::create($feed, $api);
	}

	/**
	 * @param string $feedTitle
	 * @param string $sheetName
	 * @return ListFeed
	 */
	private function getFeed($feedTitle, $sheetName)
	{
		$spreadsheet = $this->spreadsheetFeed()->getByTitle($feedTitle);
		$worksheetFeed = $spreadsheet->getWorksheets();
		$worksheet = $worksheetFeed->getByTitle($sheetName);
		return $worksheet->getListFeed();
	}

	/**
     * @return SpreadsheetFeed
	 */
	private function spreadsheetFeed()
	{
		$spreadsheetService = new SpreadsheetService();
		return $spreadsheetService->getSpreadsheets();
	}

	/**
	 * @param GoogleDriveAuth @auth
	 */
	private function authenticate(GoogleDriveAuth $auth)
	{
		$token  = json_decode($auth->auth()->getAccessToken());
		$accessToken = $token->access_token;

		$serviceRequest = new DefaultServiceRequest($accessToken);
		ServiceRequestFactory::setInstance($serviceRequest);
	}
}
