<?php

namespace Vol2223\Sgdrive\Factory;

use Google\Spreadsheet\ListFeed;
use Vol2223\Sgdrive\Api\Insert;

/**
 * Factory Api
 */
class ApiFactory
{
	/**
	 * @param ListFeed $feed
	 */
	public static function create(ListFeed $feed, $api)
	{
		switch($api) {
		case "insert":
			return new Insert($feed);
			break;
		}
	}
}
