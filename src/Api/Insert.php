<?php

namespace Vol2223\Sgdrive\Api;

use Google\Spreadsheet\ListFeed;

class Insert
{
	/**
	 * @param ListFeed $feed
	 * @param string $api
	 */
	public function __construct(ListFeed $feed)
	{
		$this->feed = $feed;
	}

	/**
	 * insert
	 *
	 * @param mixed $rows
	 */
	public function insert($row)
	{
		$this->feed->insert($row);
	}

	/**
	 * multi insert
	 *
	 * @param mixed $rows
	 */
	public function multiInsert($rows)
	{
		foreach ($rows as $row) {
			$this->feed->insert($row);
		}
	}
}
