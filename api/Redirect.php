<?php

class Redirect
{
	private $db;
	private $url = null;
	
	public function __construct($db)
	{
		$this->db = $db;
	}

	public function start($shortID)
	{
		if ($this->isShortID($shortID) !== false)
			header("Location: ".$this->url);
		else
			header("Location: ".SITEURL);
	}
	
	/**
	 * Check availability ShortID in DB
	 * @param type $shortID
	 * @return boolean
	 */
	private function isShortID($shortID)
	{
		$query = $this->db->query("SELECT * FROM `shorten` WHERE `shortid`='$shortID' LIMIT 1");
		if ($query->num_rows > 0)
		{
			$result = $query->fetch_assoc();
			$this->url = ($result['url'] == null ? SITEURL : $result['url']);
			return true;
		}
		else
			return false;
	}
}
