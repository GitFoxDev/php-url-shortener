<?php

class Url
{
	private $longUrl;
	private $db;
	private $config;
	
	public function __construct($db, $config)
	{
		$this->db = $db;
		$this->config = $config;
	}

	public function setLongUrl($longUrl)
	{
		if ($this->isUrl($longUrl))
			$this->longUrl = $longUrl;
	}
	
	/**
	 * Validate URL
	 * @param type $url
	 * @return boolean
	 */
	private function isUrl($url)
	{
		if (filter_var($url, FILTER_VALIDATE_URL) !== false)
			return true;
		else
			return false;
		
	}
	
	/**
	 * Check availability current ShortID in DB
	 * @param type $shortID
	 * @return boolean
	 */
	private function isShortID($shortID)
	{
		$result = $this->db->query("SELECT * FROM `shorten` WHERE `shoritd`='$shortID'");
		if ($result->num_rows > 0)
			return false;
		else
			return true;
	}
	
	/**
	 * Insert in DB info about new short URL
	 * @param type $shortID
	 * @return boolean
	 */
	private function writeShortID($shortID)
	{
		$result = $this->db->query("INSERT INTO `shorten` (`shortid`, `url`) VALUES ('$shortID', '$this->longUrl')");
		if ($result)
			return true;
		else
			return false;
	}
	
	public function getShortUrl()
	{
		if ($this->isUrl($this->longUrl))
		{
			$shortID = $this->generateShortID($this->config['lenght']);
			if ($this->isShortID($shortID))
			{
				if ($this->writeShortID($shortID))
					return '<span class="message">'.SITEURL.$shortID.'</span>';
				else
					return '<span class="message">DB Write Oops!</span>';
			}
		}
		else
			return '<span class="message">URL Oops!</span>';
	}
	
	private function generateShortID($lenght)
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($chars) - 1;  
		while (strlen($code) < $lenght)
		{
			$code .= $chars[mt_rand(0,$clen)];
		}
		return $code;
	}
}
